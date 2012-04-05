<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Publisher_scraper extends CI_Controller {

  public function index()
  {
    show_404();
  }

  function scrape() {

    $this->load->model(array('action_model','message_model'));
    $this->load->helper('date_helper');

    $emails = $this->_load_emails(GOVUK_IMAP_HOSTNAME.'INBOX',GOVUK_IMAP_USERNAME,GOVUK_IMAP_PASSWORD);
    $this->_process_emails($emails);

  }

  function _load_emails($hostname,$username,$password) {

    $inbox = imap_open($hostname,$username,$password) or die('Cannot connect to email: '.imap_last_error());

    $inbox_emails = imap_search($inbox,'ALL');

    $fetched_emails = array();

    if($inbox_emails) {
      $inbox_emails = array_slice($inbox_emails,0,40);
      foreach($inbox_emails as $email) {

        $overview = imap_fetch_overview($inbox,$email,0);
        $body = imap_body($inbox,$email);

        try {
          strtotime($overview[0]->date);
          imap_mail_move($inbox,$email,'INBOX/done2');
        } catch (Exception $ex) {
          echo('Error');
        }

        array_push($fetched_emails,array('body'=>$body,'overview'=>$overview));

      }
    }

    imap_close($inbox,CL_EXPUNGE);

    return $fetched_emails;

  }

  function _process_emails($all_emails) {

    if($all_emails) {

      foreach($all_emails as $email) {

        $subject_regex = "/\[PUBLISHER\] (Published|New version|Review requested|Fact check requested|Fact check okayed|Amends needed|Work started|Okayed for publication|Fact check okayed for publication): \"(.*?)\"\s*\((.*?)\)\s*by\s*(.*)/";
        $assigned_regex = "/\[PUBLISHER\] (Assigned): \"(.*?)\"\s*\((.*?)\)\s*to\s*(.*)/";
        $created_regex = "/\[PUBLISHER\] Created (.*?): \"(.*?)\"\s*\(by\s*(.*)\)/";
        $fcresponse_regex = "/\[PUBLISHER\] (Fact check response): \"(.*?)\"\s*\((.*?)\)/";

        if(preg_match($subject_regex, $email['overview'][0]->subject)) {
          //PUBLISHED, NEW VERSION, REVIEW REQUESTED, FACT CHECK REQUESTED
          //FACT CHECK OKAYED, FACT CHECK OKAYED FOR PUBLICATION, OKAYED FOR PUBLICATION
          //WORK STARTED, AMENDS NEEDED
          preg_match_all($subject_regex, $email['overview'][0]->subject,$subject_content,PREG_PATTERN_ORDER);
          $this->_process_status_email($email,$subject_content);

        } elseif(preg_match($fcresponse_regex, $email['overview'][0]->subject)) {
          //FACT CHECK RESPONSE
          preg_match_all($fcresponse_regex, $email['overview'][0]->subject,$subject_content,PREG_PATTERN_ORDER);
          $this->_process_fact_check_response_email($email,$subject_content);

        } elseif(preg_match($assigned_regex, $email['overview'][0]->subject)) {
          //ASSIGNED
          preg_match_all($assigned_regex, $email['overview'][0]->subject,$subject_content,PREG_PATTERN_ORDER);
          $this->_process_assigned_email($email,$subject_content);

        } elseif(preg_match($created_regex, $email['overview'][0]->subject)) {
          //CREATED
          preg_match_all($created_regex, $email['overview'][0]->subject,$subject_content,PREG_PATTERN_ORDER);
          $this->_process_created_email($email,$subject_content);

        } else {
          $this->_process_unknown_email($email);

        }


      }

    }

  }

  function _process_status_email($email,$regex_result) {

    if (!empty($regex_result[0])) {

      $action = $this->action_model->identify_action_id(strtolower($regex_result[1][0]));

      $user = $regex_result[4][0];
      if($user == "") { $user = $this->_find_user_from_content($email['body']); }
      $user = fix_usernames($user);

      $this->message_model->store_message(
        $action,                                //action
        $user,                                  //user
        $regex_result[3][0],                    //format
        $regex_result[2][0],                    //title
        $email['overview'][0]->subject,         //subject
        json_encode($email),                    //full email content
        strtotime($email['overview'][0]->date)  //action date
      );

    } else {
      $this->_process_unknown_email($email);
    }

  }

  function _process_fact_check_response_email($email,$regex_result) {

    if (!empty($regex_result[0])) {

      $action = $this->action_model->identify_action_id(strtolower($regex_result[1][0]));

      $user = $this->_find_user_from_content($email['body']);
      $user = fix_usernames($user);

      $this->message_model->store_message(
        $action,                                //action
        $user,                                  //user
        $regex_result[3][0],                    //format
        $regex_result[2][0],                    //title
        $email['overview'][0]->subject,         //subject
        json_encode($email),                    //full email content
        strtotime($email['overview'][0]->date)  //action date
      );

    } else {
      $this->_process_unknown_email($email);
    }

  }

  function _process_assigned_email($email,$regex_result) {

    if (!empty($regex_result[0])) {

      $action = $this->action_model->identify_action_id(strtolower($regex_result[1][0]));

      $user = $regex_result[4][0];
      if($user == "") { $user = $this->_find_user_from_content($email['body']); }
      $user = fix_usernames($user);

      $this->message_model->store_message(
        $action,                                //action
        $user,                                  //user
        $regex_result[3][0],                    //format
        $regex_result[2][0],                    //title
        $email['overview'][0]->subject,         //subject
        json_encode($email),                    //full email content
        strtotime($email['overview'][0]->date)  //action date
      );

    } else {
      $this->_process_unknown_email($email);
    }

  }

  function _process_created_email($email,$regex_result) {

    if (!empty($regex_result[0])) {

      $action = $this->action_model->identify_action_id('created');

      $user = $regex_result[3][0];
      if($user == "") { $user = $this->_find_user_from_content($email['body']); }
      $user = fix_usernames($user);

      $this->message_model->store_message(
        $action,                                //action
        $user,                                  //user
        $regex_result[1][0],                    //format
        $regex_result[2][0],                    //title
        $email['overview'][0]->subject,         //subject
        json_encode($email),                    //full email content
        strtotime($email['overview'][0]->date)  //action date
      );

    } else {
      $this->_process_unknown_email($email);
    }

  }

  function _process_unknown_email($email) {

    $this->message_model->store_message(
      0,
      '',
      '',
      '',
      $email['overview'][0]->subject,
      json_encode($email),
      strtotime($email['overview'][0]->date)
    );

  }

  function _find_user_from_content($content) {

    $user_regex = "/Assigned to: (.*?)\n/";

    $content = str_replace('\r\n',"\n",$content) ;
    if(preg_match($user_regex, $content)) {
      preg_match_all($user_regex, $content, $user_content, PREG_PATTERN_ORDER);

      if(!empty($user_content[0])) {
        return $user_content[1][0];
      }
    }

    return "";

  }


}

/* End of file welcome.php */
/* Location: ./application/controllers/publisher_scraper.php */