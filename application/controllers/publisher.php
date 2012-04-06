<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Publisher extends CI_Controller {

  public function index($format='citizen')
  {

    $this->load->model(array('message_model'));
    $this->load->helper(array('date_helper','human_date_helper','publisher_user_helper'));

    $data['format'] = $format;
    $data['published_messages'] = $this->message_model->load_recent_messages('published',30,0,$format);
    $data['action_messages'] = $this->message_model->load_recent_messages('action',30,0,$format);
    $data['automatic_messages'] = $this->message_model->load_recent_messages('automatic',30,0,$format);

    $this->load->view('template/head');
    $this->load->view('publisher/publisher_updates',$data);
    $this->load->view('template/foot');
  }

  public function today($format='citizen')
  {

    $this->load->model(array('message_model'));

    $date = time();

    $today = $this->message_model->load_count_date($date,$format);
    $thisweek = $this->message_model->load_count_week($date,$format);

    $data['format'] = $format;
    $data['today'] = $this->message_model->convert_count_result($today);
    $data['thisweek'] = $this->message_model->convert_count_result($thisweek);
    $data['thisdate'] = $date;

    $this->load->view('template/head');
    $this->load->view('publisher/today',$data);
    $this->load->view('template/foot');

  }


  public function yesterday($format='citizen')
  {
    $this->load->model(array('message_model'));

    $data['thisdate'] = time();
    $data['yesterdaydate'] = strtotime('yesterday');


    $today = $this->message_model->load_count_date($data['thisdate'],$format);
    $yesterday = $this->message_model->load_count_date($data['yesterdaydate'],$format);

    $data['format'] = $format;
    $data['today'] = $this->message_model->convert_count_result($today);
    $data['yesterday'] = $this->message_model->convert_count_result($yesterday);

    $this->load->view('template/head');
    $this->load->view('publisher/yesterday',$data);
    $this->load->view('template/foot');

  }


  public function last_week($format='citizen')
  {
    $this->load->model(array('message_model'));

    $data['thisdate'] = time();
    $data['lastdate'] = strtotime('last week');


    $thisweek = $this->message_model->load_count_week($data['thisdate'],$format);
    $lastweek = $this->message_model->load_count_week($data['lastdate'],$format);

    $data['format'] = $format;
    $data['thisweek'] = $this->message_model->convert_count_result($thisweek);
    $data['lastweek'] = $this->message_model->convert_count_result($lastweek);

    $this->load->view('template/head');
    $this->load->view('publisher/last_week',$data);
    $this->load->view('template/foot');

  }

  public function fact_checks($format='citizen')
  {

    $this->load->model('message_model');
    $this->load->helper(array('date_helper','human_date_helper','publisher_user_helper'));

    $data['format'] = $format;
    $data['fact_checks'] = $this->message_model->load_recent_messages('automatic',30,4,$format);

    $this->load->view('template/head');
    $this->load->view('publisher/fact_checks',$data);
    $this->load->view('template/foot');

  }
}

/* End of file welcome.php */
/* Location: ./application/controllers/publisher.php */