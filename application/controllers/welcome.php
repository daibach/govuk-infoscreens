<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

  public function index()
  {
    $this->load->view('template/head');
    $this->load->view('welcome_message');
    $this->load->view('template/foot');
  }

  public function migrate()
  {
    $this->load->library('migration');
    $this->migration->current();
  }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */