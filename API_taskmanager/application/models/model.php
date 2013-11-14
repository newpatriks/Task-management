<?php
class Model extends CI_Model {

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    // TASKS
    function getTasks($limit, $sprint)
    {
	    $this->db->select('*, DAY(tasca.data_fi) AS dia_datafi, MONTH(tasca.data_fi) AS mes_datafi, YEAR(tasca.data_fi) AS any_datafi,  usuari.nom as usuari_nom, tasca.nom as tasca_nom');
	    $this->db->from('tasca');
	    $this->db->where('fk_sprint', $sprint);
	    $this->db->join('tasca_x_usuari', 'tasca_x_usuari.fk_tasca = tasca.pk_tasca');
	    $this->db->join('usuari', 'usuari.pk_usuari = tasca_x_usuari.fk_usuari');
        //$this->db->group_by('pk_tasca');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }
    
    function getTask($id)
    {
	    $this->db->select('*, DAY(tasca.data_fi) AS dia_datafi, MONTH(tasca.data_fi) AS mes_datafi, YEAR(tasca.data_fi) AS any_datafi,  usuari.nom as usuari_nom, tasca.nom as tasca_nom, pk_tasca');
	    $this->db->from('tasca');
	    $this->db->where('pk_tasca', $id);
	    //$this->db->where('fk_sprint', $sprint);
	    $this->db->join('tasca_x_usuari', 'tasca_x_usuari.fk_tasca = tasca.pk_tasca');
	    $this->db->join('usuari', 'usuari.pk_usuari = tasca_x_usuari.fk_usuari');
        $query = $this->db->get();
        return $query->result();
    }
    
    function newTask($t_name, $t_explain, $t_date_end, $t_sprint)
    {
	    $data = array(
        	'nom' => $t_name ,
       		'explicacio' => $t_explain ,
   			'data_fi' => $t_date_end,
   			'fk_sprint' => $t_sprint
   		);

   		$this->db->insert('tasca', $data); 
    }
    
    function getLastTask()
    {
	    $this->db->order_by('pk_tasca', 'desc');
		$this->db->limit(1);
		$query = $this->db->get('tasca');				
		return $query->result_array();
    }
    
    function relationTaskUser($pk_tasca, $t_assignada)
    {
	    $data = array(
        	'fk_tasca' => $pk_tasca ,
       		'fk_usuari' => $t_assignada
   		);
   		$this->db->insert('tasca_x_usuari', $data);
    }

    
    // USERS
    function getUsers($limit)
    {
	    $this->db->select('*');
	    $this->db->from('usuari');
        $query = $this->db->get();
        return $query->result();
    }
    
    function getUser($id)
    {
	    $this->db->select('*');
	    $this->db->from('usuari');
	    $this->db->where('pk_usuari', $id);
        $query = $this->db->get();
        return $query->result();
    }
    
    function updateUser( $id , $name, $surname, $profile )
    {
	    $data = array(
        	'nom' => $timer,
        	'cognoms' => $surname, 
        	'perfil' => $profile
   		);
   		$this->db->update('usuari', $data, array('pk_usuari' => $id ));    
    }
    
    function deleteUser( $id ) 
    {
	     $this->db->delete('usuari', array('pk_usuari' => $id)); 
	     return $query->result();
    }
    
    /*    
    function getInfoSprint($id_sprint) 
    {
	    $this->db->select('*');
        $this->db->select("DATE_FORMAT( data_finalitzacio, '%d/%m/%Y' ) AS data_entrega",  FALSE );
	    $this->db->from('sprint');
	    $this->db->where('pk_sprint',$id_sprint);
        $query = $this->db->get();
        return $query->result();
    }
    
    function setTascaNewUser($id_tasca, $id_usuari_from, $id_usuari_to)
    {
	    $data = array(
        	'fk_usuari' => $id_usuari_to
   		);
   		$this->db->update('tasca_x_usuari', $data, array('fk_tasca' => $id_tasca, 'fk_usuari' => $id_usuari_from ));
    }    
    function updateTimerTask($id_tasca, $id_ususari, $timer)
    {
		$data = array(
        	'temps_dedicat' => $timer
   		);
   		$this->db->update('tasca_x_usuari', $data, array('fk_tasca' => $id_tasca, 'fk_usuari' => $id_ususari ));    
    }
  	
  	function updateCompleteTask($id_tasca, $id_ususari, $completada, $date)
  	{	
		$data = array(
			'completada' => $completada,
			'data_fi' => $date
   		);
   		$this->db->update('tasca', $data, array('pk_tasca' => $id_tasca));
  	}  
  	*/
}
?>