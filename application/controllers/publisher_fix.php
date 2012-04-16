<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Publisher_fix extends CI_Controller {

  public function index()
  {
    show_404();
  }

  function cleanup_users() {

    $this->db->where('user not like','');
    $this->db->order_by('id','desc');
    $qry = $this->db->get('messages');
    if($qry->num_rows() > 0) {
      $results = $qry->result();
      foreach($results as $email) {

        $user = $email->user;
        $user = fix_usernames($user);
        $data = array('user'=>$user);
        $this->db->where('id',$email->id);
        $this->db->update('messages',$data);

      }
    }

  }

  function cleanup_local_transactions() {

    $data = array('format'=>'Local transaction');
    $this->db->where('format','Localtransaction');
    $this->db->update('messages',$data);

  }

  function identify_created_items() {
    $this->load->model('action_model');
    $created_action = $this->action_model->identify_action_id('created');

    $this->db->where('action',0);
    $this->db->order_by('id','desc');
    $qry = $this->db->get('messages');
    if($qry->num_rows() > 0) {
      $results = $qry->result();
      foreach($results as $email) {

        $subject_regex = "/\[PUBLISHER\] Created (.*?): \"(.*?)\"\s*\(by\s*(.*)\)/";
        if(preg_match($subject_regex, $email->subject)) {
          preg_match_all($subject_regex, $email->subject, $subject_content, PREG_PATTERN_ORDER);

          if(!empty($subject_content[0])) {

            $user = $subject_content[3][0];
            $user = fix_usernames($user);

            $data = array(
              'action'  => $created_action,
              'format'  => $subject_content[1][0],
              'title'   => $subject_content[2][0],
              'user'    => $user
            );
            //print_r($data);
            //echo("\n");
            $this->db->where('id',$email->id);
            $this->db->update('messages',$data);
          }

        }

      }
    }

  }

  function identify_assigned_items() {
    $this->load->model('action_model');
    $assigned_action = $this->action_model->identify_action_id('assigned');

    $this->db->where('action',0);
    $this->db->order_by('id','desc');
    $qry = $this->db->get('messages');
    if($qry->num_rows() > 0) {
      $results = $qry->result();
      foreach($results as $email) {

        $subject_regex = "/\[PUBLISHER\] Assigned: \"(.*?)\"\s*\((.*?)\)\s*to\s*(.*)/";
        if(preg_match($subject_regex, $email->subject)) {
          preg_match_all($subject_regex, $email->subject, $subject_content, PREG_PATTERN_ORDER);

          if(!empty($subject_content[0])) {

            $user = $subject_content[3][0];
            $user = fix_usernames($user);

            $data = array(
              'action'  => $assigned_action,
              'format'  => $subject_content[2][0],
              'title'   => $subject_content[1][0],
              'user'    => $user
            );
            //print_r($data);
            //echo("\n");
            $this->db->where('id',$email->id);
            $this->db->update('messages',$data);
          }

        }

      }
    }

  }

  function identify_new_version_items() {
    $this->load->model('action_model');
    $new_action = $this->action_model->identify_action_id('new version');

    $this->db->where('action',0);
    $this->db->order_by('id','desc');
    $qry = $this->db->get('messages');
    if($qry->num_rows() > 0) {
      $results = $qry->result();
      foreach($results as $email) {

        $subject_regex = "/\[PUBLISHER\] New version: \"(.*?)\"\s*\((.*?)\)\s*by\s*(.*)/";
        if(preg_match($subject_regex, $email->subject)) {
          preg_match_all($subject_regex, $email->subject, $subject_content, PREG_PATTERN_ORDER);

          if(!empty($subject_content[0])) {

            $user = $subject_content[3][0];
            $user = fix_usernames($user);

            $data = array(
              'action'  => $new_action,
              'format'  => $subject_content[2][0],
              'title'   => $subject_content[1][0],
              'user'    => $user
            );

            $this->db->where('id',$email->id);
            $this->db->update('messages',$data);
          }

        }

      }
    }

  }

  function identify_user_from_content() {

    $assigned_regex = "/Assigned to: (.*?)\n/";

    $this->db->where('user','');
    $this->db->order_by('id','desc');
    $qry = $this->db->get('messages');
    if($qry->num_rows() > 0) {
      $results = $qry->result();
      foreach($results as $email) {
        $email->content = str_replace('\r\n',"\n",$email->content);

        if(preg_match($assigned_regex, $email->content)) {
          preg_match_all($assigned_regex, $email->content, $assigned_content, PREG_PATTERN_ORDER);

          if(!empty($assigned_content[0])) {

            $user = $assigned_content[1][0];
            $user = fix_usernames($user);

            $data = array('user'=>$user);
            $this->db->where('id',$email->id);
            $this->db->update('messages',$data);

          }
        }
      }
    }

  }

  function remove_duplicates() {

    $this->db->save_queries = false;

    $this->db->order_by('action, action_date');
    $this->db->where('action',11);
    $qry = $this->db->get('messages');
    if($qry->num_rows() > 0) {
      $results = $qry->result();

      $action = -1;
      $user = '12345';
      $format = '12345';
      $title = '12345';
      $subject = '12345';
      $date = '12345';
      $remove = array();

      foreach($results as $record) {
        if (
           $record->action   != $action  ||
           $record->user     != $user    ||
           $record->format   != $format  ||
           $record->title    != $title   ||
           $record->subject  != $subject ||
           $record->action_date != $date
           )
        {
          $action = $record->action;
          $user = $record->user;
          $format = $record->format;
          $title = $record->title;
          $subject = $record->subject;
          $date = $record->action_date;
        } else {
          array_push($remove,$record);
        }
      }

      foreach($remove as $r) {

        $this->db->where('id',$r->id);
        $this->db->delete('messages');

      }

    }

    $this->db->save_queries = true;

  }

  function cleanup_titles() {

    $this->db->save_queries = false;

    $this->load->helper('publisher_data_helper');

    $this->db->where('action',1);
    $query = $this->db->get('messages');

    if($query->num_rows() > 0) {
      echo('<table width="100%" border="1">');

      $records = $query->result();
      foreach($records as $r) {

        $email_content = json_decode($r->content);
        $new_title = identify_title_from_content($email_content->body);

        echo("\n<tr>\n");
        echo("<td>".$r->id."</td>");
        echo("<td>".$r->title."</td>");
        if($new_title == '') {
          echo('<td>');
          print_r($email_content->body);
          echo('</td>');
        }
        elseif($new_title != $r->title && $new_title != '') {

          $data = array('title' => $new_title);
          $this->db->where('id', $r->id);
          $this->db->update('messages', $data);

          echo("<td>".$new_title."</td>");
        } else {
          echo("<td style='color:#ccc'>NO CHANGE</td>");
        }
        echo("\n</tr>\n");

      }
      echo('</table>');

    }

    $this->db->save_queries = true;


  }


}