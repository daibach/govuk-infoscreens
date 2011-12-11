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
				
				imap_mail_move($inbox,$email,'INBOX/done2');
	
	      array_push($fetched_emails,array('body'=>$body,'overview'=>$overview));
	      
	    }
    }
    
    imap_close($inbox,CL_EXPUNGE);
    
    return $fetched_emails;

  }
	
  function _process_emails($all_emails) {
    
    if($all_emails) {
      
      foreach($all_emails as $email) {
        
        $subject_regex = "/\[PUBLISHER\] (Published|New version|Review requested|Fact check requested|Fact check okayed|Amends needed|Work started|Okayed for publication|Assigned|Fact check okayed for publication|Okayed for publication): \"(.*?)\"\s*\((.*?)\)\s*by\s*(.*)/";
        $fcresponse_subject_regex = "/\[PUBLISHER\] (Fact check response): \"(.*?)\"\s*\((.*?)\)/";
        
        if(preg_match($subject_regex, $email['overview'][0]->subject)) {
          preg_match_all($subject_regex, $email['overview'][0]->subject,$subject_content,PREG_PATTERN_ORDER);
          
          if(!empty($subject_content[0])) {
						
						$action = $this->action_model->identify_action_id(strtolower($subject_content[1][0]));
						$user = $this->_fix_user($subject_content[4][0]);
						
						$this->message_model->store_message(
							$action,
							$user,
							$subject_content[3][0],
							$subject_content[2][0],
							$email['overview'][0]->subject,
							json_encode($email),
							$email['overview'][0]->udate
						);
      			
          } else {
	
						$this->message_model->store_message(
							0,
							'',
							'',
							'',
							$email['overview'][0]->subject,
							json_encode($email),
							$email['overview'][0]->udate
						);
						
          }
        
        } elseif(preg_match($fcresponse_subject_regex, $email['overview'][0]->subject)) {
            preg_match_all($fcresponse_subject_regex, $email['overview'][0]->subject,$subject_content,PREG_PATTERN_ORDER);
            if(!empty($subject_content[0])) {
	
							$action = $this->action_model->identify_action_id(strtolower($subject_content[1][0]));
	
							$this->message_model->store_message(
								$action,
								'',
								$subject_content[3][0],
								$subject_content[2][0],
								$email['overview'][0]->subject,
								json_encode($email),
								$email['overview'][0]->udate
							);

            } else {
							$this->message_model->store_message(
								0,
								'',
								'',
								'',
								$email['overview'][0]->subject,
								json_encode($email),
								$email['overview'][0]->udate
							);
            }
            
        } else {
					$this->message_model->store_message(
						0,
						'',
						'',
						'',
						$email['overview'][0]->subject,
						json_encode($email),
						$email['overview'][0]->udate
					);
        }
        
        
      }
      
    }
    
    
  }

  function _fix_user($username) {
    switch($username) {
      case 'SarahRichards': return 'Sarah Richards'; break;
      case 'JulianMilne': return 'Julian Milne'; break;
      case 'GrahamSpicer': return 'Graham Spicer'; break;
      case 'JonSanger': return 'Jon Sanger'; break;
      case 'DonnaForsyth': return 'Donna Forsyth'; break;
      case 'DarrylDeaton': return 'Darryl Deaton'; break;
			case 'BeckThompson': return 'Beck Thompson'; break;
			case 'MattJarvis': return 'Matt Jarvis'; break;
			case 'AlanMaddrell': return 'Alan Maddrell'; break;
      default: return $username;
    }
  }
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/publisher_scraper.php */