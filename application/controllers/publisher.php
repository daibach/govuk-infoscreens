<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Publisher extends CI_Controller {

	public function index()
	{
		
		$this->load->model(array('message_model'));
		$this->load->helper(array('date_helper','human_date_helper','publisher_user_helper'));
		
		$data['published_messages'] = $this->message_model->load_recent_messages('published',30);
		$data['action_messages'] = $this->message_model->load_recent_messages('action',30);
		$data['automatic_messages'] = $this->message_model->load_recent_messages('automatic',30);
		
		$this->load->view('template/head');
		$this->load->view('publisher/publisher_updates',$data);
		$this->load->view('template/foot');
	}
	
	public function today()
	{
		$this->load->model(array('message_model'));
		
		$today = $this->message_model->load_count_date(1323389390);
		$thisweek = $this->message_model->load_count_week(1323389390);
		
		$data['today'] = $this->message_model->convert_count_result($today);
		$data['thisweek'] = $this->message_model->convert_count_result($thisweek);
		
		$this->load->view('template/head');
		$this->load->view('publisher/today',$data);
		$this->load->view('template/foot');
		
	}


	
}

/* End of file welcome.php */
/* Location: ./application/controllers/publisher.php */