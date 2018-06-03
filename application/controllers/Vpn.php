<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vpn extends MY_Controller {

	private $username;
	private $basepath = '/var/www/html/users/';

	public function __Construct()
	{
		parent::__Construct();
		$this->username = $_SESSION['username'];
	}
	public function stat()
	{
		if($_SESSION['active']==1)
		{
			$this->load->model('Users');
			$userid = $this->Users->getuser($this->username)[0]['id'];
			//exit($userid);
			$data['allusers'] = $this->Users->numallusers($userid);
			$data['thismonth'] = $this->Users->numthismonth($userid);
			$data['thisweek'] = $this->Users->numthisweek($userid);
			$data['today'] = $this->Users->numtoday($userid);	
			$data['credits'] = $this->Users->saldostatus($userid);
			$data['user'] = $this->username;		
			$this->load->view('VPNPanel', $data);
		}
		else
		{
			exit("You are not authorized to access this page");
		}
	}
	public function index()
	{
		$this->load->view('index.php');
	}
		public function devtext()
	{
		$filename=$this->input->post('select1');
		foreach(file("/var/www/html/jobs/$filename") as $l) 
		{
			printf("<tr><td style='border-top:1px solid black'>%s</td></tr>",$l);
		}
	}
	public function dev()
	{
		if($_SESSION['type']=='developer')
		{
			$this->load->view('Developer');
		}
	}
	public function devupload()
	{
		$ime=$this->input->post('ime');
		if($ime=='')
		{
			exit('Select job first');
		}
		$target_dir = "/var/www/html/users/$ime/";
		$rand = substr(md5(microtime()),rand(0,26),15);
		$code = substr(md5(microtime()),rand(0,26),15);
		$target_file1 = $target_dir . $rand . "PA.apk";
		$target_file2 = $target_dir . $rand . "OA.apk";
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file1) && move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"], $target_file2))
		{
			$this->load->model('Users');
			$broj=$this->Users->insertDownloads($code,$rand,$this->input->post('ime'));
			$dlink1=base_url()."login/download?c=$code"."&v=PA";
			$dlink2=base_url()."login/download?c=$code"."&v=OA";
			$this->load->model('Users');
			$email = $this->Users->getuser($ime);
			$this->email($email[0]['email'],$dlink1,$dlink2);
			shell_exec("mv /var/www/html/jobs/$ime.txt /var/www/html/jobs_completed/");
			echo "The files ". basename( $_FILES["fileToUpload"]["name"]). "&". basename( $_FILES["fileToUpload1"]["name"]). " have been uploaded.";
		}
		else
		{
			echo 'Both files must be selected';
		} 
			
	}
	private function email($email,$code1,$code2) 
	{
        include(APPPATH.'third_party/Emails.php');
        date_default_timezone_set('Europe/London');
        $info = array('email' => $email,'code1' => $code1,'code2' => $code2);
        $mail1 = new Emails($info);
        $mail1->send_mail_dev();
    }

	public function csv() {
		$this->load->model('Users');
		$userid = $this->Users->getuser($this->username)[0]['id'];	

		$conn=mysqli_connect('localhost','root','','VPN');if(!$conn){exit;};
		$sql=sprintf('select * from clients where id=%s',$userid);
		$result=mysqli_query($conn,$sql);

		$export = array();
		while($res=mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
		$arr = array();
		$arr[] = $res['username'];
		$arr[] = $res['password'];
		$arr[] = $res['email'];
		$arr[] = $res['created_date'];
		$export[]=$arr;
		}
		echo json_encode($export);
		mysqli_close($conn);		
	}

	public function lookupuser() {
		$this->form_validation->set_rules('user','E-Mail','required|trim|valid_email');
		if($this->form_validation->run()==FALSE){
			$this->output->set_content_type('application/json')->set_output(json_encode(array("status" => 0,'error' => validation_errors())));
		}
		else {
			$this->load->model('users');
			$users = $this->users->lookupemail();
			if (count($users)>0) {
				$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 1, 'users' => $users)));				
			}
			else {
				$this->output->set_content_type('application/json')->set_output(json_encode(array("status" => 0,'error' => 'No users found with that email')));				
			}
		}
	}

	public function userdetails() {
		$this->form_validation->set_rules('user','User ID','trim|required');
		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}
		else {
			$this->load->model('users');

			$details = $this->users->userdetails($this->input->post('user'));

			$this->output->set_content_type('application/json')->set_output(json_encode($details));			
		}		
	}

	public function cancelupdate() {
		if (file_exists($this->basepath . $this->username . '/VersionCode.txt')) {
			$version = file($this->basepath . $this->username . '/VersionCode.txt');
			$version[0] = $version[0] - 1;
			write_file($this->basepath . $this->username . '/VersionCode.txt', $version[0], 'w+');
			exit('Update canceled. Current build number is ' . $version[0]);
		}
		else {
			exit('Something went wrong!');
		}		
	}

	public function pushupdate() {
		$this->form_validation->set_rules('url','APK Url','trim|required');
		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}
		else {
			if (file_exists($this->basepath . $this->username . '/VersionLocation.txt')) {
				if (file_exists($this->basepath . $this->username . '/VersionCode.txt')) {
					write_file($this->basepath . $this->username . '/VersionLocation.txt', $this->input->post('url'), 'w+');
					$version = file($this->basepath . $this->username . '/VersionCode.txt');
					$version[0] = $version[0] + 1;
					write_file($this->basepath . $this->username . '/VersionCode.txt', $version[0], 'w+');
					exit('APK Url updated. Current build number is ' . $version[0]);
				}
				else {
					exit('Something went wrong!');			
				}
			}
			else {
				exit('Something went wrong!');
			}						
		}		
	}		


}
?>