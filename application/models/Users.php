<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model {

	private $table = 'clients';
	private $table2 = 'users';
	private $table3 = 'downloads';

	public function getuser($client)
	{
		$this->db->where('username',$client);
		$result = $this->db->get($this->table2);
		return $result->result_array();	
	}

	public function insertUser($username,$password,$datum,$email,$customerId) {
		$data = array(
			'username' => $username,
			'password' => $password,
			'active_date' => $datum,
			'email' => $email,
			'customerId' => $customerId
		);

		$result = $this->db->insert($this->table,$data);
		//exit(print_r($this->db));
		if ($result) {
			return 1;
		}
		else {
			return 0;
		}
	}

	public function insertUser2($client,$username,$password,$datum,$email,$customerId) {
		$details=$this->getuser($client);
		if (empty($details)) 
		{
     		return 0;
		}		
		if($details[0]['saldo']<1)
		{
			return 0;
		}
		//exit($details[0]['saldo']);
		$data = array(
			'id'=> $details[0]['id'],
			'username' => $username,
			'password' => $password,
			'active_date' => $datum,
			'email' => $email,
			'customerId' => $customerId,
			'created_date' => $datum
		);

		$result = $this->db->insert($this->table,$data);

		if ($result) {
			return 1;
		}
		else {
			return 0;
		}
	}	

	public function createUsername() {
		$username = substr(md5(microtime()),rand(0,26),12);
		$num = $this->checkUsername($username);
		if ($num==0) {
			return $username;
		}
		else {
			return $this->createUsername();
		}
	}	

	public function checkUsername($user) {
		$this->db->where('username',$user);
		$query = $this->db->get($this->table);
		return $query->num_rows();
	}

	public function getCredentials($email,$customerId) {
		$this->db->where('email',$email);
		$this->db->where('customerId',$customerId);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	public function cancelUser($email,$customerId) {
		$this->db->set('canceled', '1');
		$this->db->set('canceled2', '1');
		$this->db->set('canceled3', '1');
		$this->db->set('canceled4', '1');
		$this->db->set('canceled5', '1');
		$this->db->set('canceled6', '1');
		$this->db->set('canceled7', '1');
		$this->db->set('deleted', '1');
		$this->db->where('email', $email);
		$this->db->where('customerId', $customerId);
		$this->db->update($this->table); 		
	}

	public function checkUserSaldo($user) {
		$this->db->where('username',$user);
		$query = $this->db->get($this->table2);
		$saldo = $query->result_array(); 
		if ($saldo[0]['saldo'] >= 1) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}	

	public function checkCredentials($username,$password) {
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$query = $this->db->get($this->table);
		return $query->num_rows();
	}

	public function checkUser($client) {
		$this->db->where('username',$client);
		$query = $this->db->get($this->table2);
		return $query->num_rows();		
	}
	
	public function checkUser2($client,$password) {
		$this->db->where('username',$client);
		$this->db->where('password',$password);
		$query = $this->db->get($this->table2);
		return $query->num_rows();		
	}

	public function checkUser1($client) {
		$this->db->where('username',$client);
		$this->db->where('active',0);
		$query = $this->db->get($this->table2);
		return $query->num_rows();		
	}	
	public function signup($username,$password,$iusername)
	{
		$this->db->set('username', $username);
		$this->db->set('password', $password);
		$this->db->where('username', $iusername);
		$this->db->update($this->table2);
		//return $query->num_rows();
	}
		public function register($username)
	{
		$this->db->set('active', "1");
		$this->db->where('username', $username);
		$this->db->update($this->table2);
		//return $query->num_rows();
	}
		public function appname($username,$appname)
	{
		$this->db->set('appname', $appname);
		$this->db->where('username', $username);
		$this->db->update($this->table2);
		//return $query->num_rows();
	}

  	public function numthismonth($userid) {
  		$month=date('m');
  		$this->db->where('substring(created_date,6,2)',$month);
  		$this->db->where('id',$userid);
  		$query = $this->db->get($this->table);
  		return $query->num_rows();  		
  	}

  	public function numthisweek($userid) {
		$today=date('Y-m-d');
		$day2=(date('D')=='Mon')?date('Y-m-d'):date('Y-m-d',strtotime("previous monday"));
  		$this->db->where("substring(created_date,1,10) >=",$day2);
  		$this->db->where("substring(created_date,1,10) <=",$today);
  		$this->db->where('id',$userid);
  		$query = $this->db->get($this->table);
  		return $query->num_rows();  		
  	} 

  	public function numtoday($userid) {
		$today=date('Y-m-d');
  		$this->db->where("substring(created_date,1,10)",$today);
  		$this->db->where('id',$userid);
  		$query = $this->db->get($this->table);
  		return $query->num_rows();  		
  	}	

  	public function numallusers($userid) {
  		$this->db->where('id',$userid);
  		$query = $this->db->get($this->table);
  		return $query->num_rows();
  	}

  	public function lookupemail() {
  		$this->db->where('email',$this->input->post('user'));
  		$query = $this->db->get($this->table);
  		return $query->result_array();
  	}

  	public function userdetails($custid) {
  		$this->db->where('customerId',$custid);
  		$query = $this->db->get($this->table);
  		return $query->result_array();  		
  	}

  	public function saldostatus($userid) {
  		$this->db->where('id',$userid);
  		$query = $this->db->get($this->table2);
  		return $query->result_array()[0]['saldo'];
  	}

  	public function insertDownloads($code,$name,$username)
  	{
  			$data = array(
			'code' => $code,
			'name' => $name,
			'username' => $username,
			'num_downloads' => '0'
		);
  		$result = $this->db->insert($this->table3,$data);
		if ($result) {
			return 1;
		}
		else {
			return 0;
		}
  	}
  	public function getDownload($code)
  	{
  		$this->db->where('code',$code);
  		$query = $this->db->get($this->table3);
  		return $query->result_array();	
  	}
  	public function getDownloadnum($code)
  	{
  		$this->db->where('code',$code);
  		$query = $this->db->get($this->table3);
  		return $query->num_rows();	
  	} 

  	public function getAppname($user) {
  		$this->db->where('username',$user);
  		return $this->db->get($this->table2)->result_array()[0]['appname'];
  	}

  	public function getAppnamebyId($id) {
  		$this->db->where('id',$id);
  		return $this->db->get($this->table2)->result_array()[0]['appname'];
  	}

  	public function getUserEmail($user) {
  		$this->db->where('username',$user);
  		return $this->db->get($this->table2)->result_array()[0]['email'];  		
  	}

  	public function getAppnameFromCusId($cusid) {
 		$this->db->where('customerId',$cusid);
 		$id = $this->db->get($this->table)->result_array()[0]['id']; 
 		return $this->getAppnamebyId($id);
  	}

  	public function checkCustomerId($cusid) {
		$this->db->where('customerId',$cusid);
		$query = $this->db->get($this->table);
		return $query->num_rows();  		
  	}

}