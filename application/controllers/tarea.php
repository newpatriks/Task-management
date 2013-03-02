<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tarea extends CI_Controller {

	public function index()
	{
		
		
	}
	
	public function newTasca()
	{
		$edit 		= $_POST['edit'];
		$t_name		= $_POST['name'];
		$t_explain	= $_POST['explain'];
		$t_date_end	= $_POST['data_fi'];
		$t_durada	= $_POST['durada'];
		$t_sprint	= $_POST['sprint'];
		
		$this->load->model('tasca', 'm_tasca', TRUE);
		$this->m_tasca->newTask($t_name, $t_explain, $t_date_end, $t_sprint);
		$lastTask = $this->m_tasca->getLastTask();
		
		foreach($_POST as $key_p => $val_p)
		{
			//echo $key_p." => ".$val_p."<br/>";
			$t_assignada = explode("_" , $key_p);
			if ($t_assignada[0] == "usr")
			{
				// We've found the users assigned to the tasks
				//echo $lastTask[0]['pk_tasca']." | ".int($t_assignada[1]."<br/>");
				$this->m_tasca->relationTaskUser($lastTask[0]['pk_tasca'], $t_assignada[1]);
			}else{
			//	echo "NO ".$t_assignada[1]."<br/>";
			}
		}
	}
	
	public function updateTasca() 
	{		
		$id_tasca 		= $_POST['tasca'];
		$id_usuari_from = $_POST['usr_sender'];
		$id_usuari_to	= $_POST['usr_to'];

		$this->load->model('tasca', 'm_tasca', TRUE);		
		$this->m_tasca->setTascaNewUser($id_tasca, $id_usuari_from, $id_usuari_to);
	}
	
	public function updateTimer() 
	{
		$timer	 	= 	$_POST['temps'];
		$id_tasca	=	$_POST['id_task'];
		$id_ususari	=	$_POST['id_user'];
		
		$this->load->model('tasca', 'm_tasca', TRUE);
		$this->m_tasca->updateTimerTask($id_tasca, $id_ususari, $timer);
		
	}
	
	public function updateComplete()
	{
		$completada	= 	$_POST['is_complete_aux'];
		$id_tasca	=	$_POST['id_task'];
		$id_ususari	=	$_POST['id_user'];
		$date 		= 	date("y/m/d"); 
		
		//$this->output->enable_profiler(TRUE);
		
		$this->load->model('tasca', 'm_tasca', TRUE);
		if ($completada == "true")
		{
			$this->m_tasca->updateCompleteTask($id_tasca, $id_ususari, '1', $date);	
		}else{
			$this->m_tasca->updateCompleteTask($id_tasca, $id_ususari, '0', $date);
		}
	}
}
?>