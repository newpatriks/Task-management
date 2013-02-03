<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		// carreguem el model
		$this->load->model('tasca', 'm_tasca', TRUE);
		$data['list_tasks'] 	= $this->m_tasca->getAllTasques();
		$data['list_usuaris'] 	= $this->m_tasca->getAllUsuaris();
		$data['sprint']		 	= $this->m_tasca->getAllSprints();

		$data['edit'] = false;
		
		// carreguem les views
		$this->load->view('shared/header');
		$this->load->view('home', $data);
		//$this->load->view('tasks', $data);
		$this->load->view('shared/footer');
		
	}
}
?>