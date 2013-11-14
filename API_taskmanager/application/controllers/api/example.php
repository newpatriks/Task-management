<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Example extends REST_Controller
{
	function user_get()
    {
        if(!$this->get('id'))
        {
        	$this->response(NULL, 400);
        }
		$user = $this->m_task->getUser( $this->get('id') );
    	//$user = @$users[$this->get('id')];
        if($user)
        {
            $this->response($user, 200); // 200 being the HTTP response code
        }else{
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }
    
    function user_post()
    {
        $this->m_task->updateUser( $this->get('id'), $this->get('name'), $this->get('surname'), $this->get('profile') );
        $message = array('id' => $this->get('id'), 'name' => $this->post('name'), 'email' => $this->post('email'), 'message' => 'ADDED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    function user_delete()
    {
    	$this->m_task->deleteUser( $this->get('id') );
        $message = array('id' => $this->get('id'), 'message' => 'DELETED!');
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    function users_get()
    {
        $users = $this->m_task->getUsers( $this->get('limit') );
        if($users)
        {
            $this->response($users, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }
	

	public function send_post()
	{
		var_dump($this->request->body);
	}


	public function send_put()
	{
		var_dump($this->put('foo'));
	}
	
	
	function tasks_get()
    {
        $tasks = $this->m_task->getTasks($this->get('limit'), $this->get('sprint'));
        if($tasks)
        {
            $this->response($tasks, 200); // 200 being the HTTP response code
        }else{
            $this->response(array('error' => 'Couldn\'t find any tasks!'), 404);
        }
    }
    
    function task_get()
    {
        if(!$this->get('id'))
        {
        	$this->response(NULL, 400);
        }
        $task = $this->m_task->getTask( $this->get('id') );
    	//$task = @$task[$this->get('id')];
        if($task)
        {
            $this->response($task, 200); // 200 being the HTTP response code
        }else{
            $this->response(array('error' => 'Task could not be found'), 404);
        }
    }
    
    function task_put()
    {
    	// Create new task and assign the task to the user/s
	    $this->m_task->newTask($this->get('name'), $this->get('explain'), $this->get('date_end'), $this->get('sprint'));
	    $task = $this->m_task->getLastTask();
	    foreach($this->get('users') as $key => $usr)
	    {
			$this->m_task->relationTaskUser($task[0]->pk_tasca, $usr); 
	    }
    }
}