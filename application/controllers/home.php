<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		// loading helpers
		$this->load->helper('url');
	
		// We're looking for a argument on URL. This argument will be the sprint 
		// about we're going to load the information.
		if ($this->uri->segment(1) === FALSE)
		{
			$id_sprint = 1;
		}else{
			if ($this->uri->segment(1) == 'home')
			{
				if ($this->uri->segment(2) === FALSE)
				{
					$id_sprint = 1;		
				}else{
					$id_sprint = $this->uri->segment(2)-1;		
				}
			}else{
				$id_sprint = $this->uri->segment(1)-1;
			}
		}
				
		// loading models
		$this->load->model('tasca', 'm_tasca', TRUE);
		$data['sprint']			= $this->m_tasca->getAllSprints();
		$data['sprint_actual'] 	= $this->m_tasca->getInfoSprint($id_sprint);
		$data['list_tasks'] 	= $this->m_tasca->getAllTasques($id_sprint);
		$data['list_usuaris'] 	= $this->m_tasca->getAllUsuaris();

		$data['edit'] 	= false;
		
		// carreguem les views
		$this->load->view('shared/header');
		$this->load->view('home', $data);
		//$this->load->view('tasks', $data);
		$this->load->view('shared/footer');
		
	}
}
?>