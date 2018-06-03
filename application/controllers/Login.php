<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	private $basepath = '/var/www/html/users/';


	public function __Construct()
	{
		parent::__Construct();
		session_start();
	}
	public function login() {
		$this->load->view('login');
		//exit('cao');
	}
	public function index() {
		$this->load->view('index');
		//exit('cao');
	}
	public function singin()
	{
		$this->form_validation->set_rules('username','USERNAME','required|trim');
		$this->form_validation->set_rules('password','PASSWORD','required|trim');
		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}
		else
		{
			$this->load->model('Users');
			$broj=$this->Users->checkUser2($this->input->post('username'),$this->input->post('password'));
			if($broj==1)
			{
				$info=$this->Users->getuser($this->input->post('username'));
				if($info[0]['type']=='user' && $info[0]['active']=='0')
				{
					$_SESSION['username']=$this->input->post('username');
					$_SESSION['iusername']=$this->input->post('username');
					$_SESSION['active']='0';
					$this->load->view('GetAppDataVPN');
				}
				else if($info[0]['type']=='user' && $info[0]['active']=='1')
				{
					$_SESSION['username']=$this->input->post('username');
					$_SESSION['login']='1';
					$_SESSION['active']='1';
					$_SESSION['type']='user';
					redirect('vpn/stat');
				}
				else if($info[0]['type']=='developer')
				{
					$_SESSION['username']=$this->input->post('username');
					$_SESSION['login']='1';
					$_SESSION['active']='1';
					$_SESSION['type']='developer';
					//session_destroy();
					redirect('vpn/dev');
				}	
			}
			else
			{
				$this->load->view('index');
			}
			//exit(print_r($_POST));
		}
	}
	public function signup()
	{
		//exit(print_r($_SESSION));
		$this->form_validation->set_rules('username','USERNAME','required|trim');
		$this->form_validation->set_rules('password','PASSWORD','required|trim');
		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}
		else
		{
			$this->load->model('Users');
			//exit('$broj');
			$broj=$this->Users->checkUser1($_SESSION['iusername']);
			if($broj==1)
			{
				$this->Users->signup($this->input->post('username'),$this->input->post('password'),$_SESSION['iusername']);
				$_SESSION['username']=$this->input->post('username');
				$_SESSION['iusername']=$this->input->post('username');
				$_SESSION['active']='0';
				$this->load->view('GetAppDataVPN');	
			}
			else
			{
				exit('User does not exist');
			}

		}
	}
	public function baseupload()
	{
		//exit('cao');
		$this->form_validation->set_rules('appname','APP Name','required');
		$this->form_validation->set_rules('color','Color','required');
		$this->form_validation->set_rules('currency','Currency','required');
		$this->form_validation->set_rules('cost','Cost','required');
		$this->form_validation->set_rules('trialperiod','Trialperiod','required');
		$this->form_validation->set_rules('trial','Trial','required');
		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}
		else
		{
			if((($this->input->post('stripelsk')=='' && $this->input->post('stripelpk')=='') && ($this->input->post('ppusername')!='' && $this->input->post('ppusername')!='')) || (($this->input->post('stripelsk')!='' && $this->input->post('stripelpk')!='') && ($this->input->post('ppusername')=='' && $this->input->post('ppusername')=='')))
			{}
			else
			{
				exit("You must provide Stripe OR Paypal details");
			}
			if (!isset($_FILES['files1'])) {
				exit('Please upload app image');
			}
			if (!isset($_FILES['files2'])) {
				exit('Please upload connect image');
			}
			if (!isset($_FILES['files3'])) {
				exit('Please upload disconnect image');
			}
			mkdir($this->basepath . $_SESSION['username'] ,0777);
				$this->load->library('upload');
				$error = array();
				$files = $_FILES;

				$_FILES['files1']['name'] = $files['files1']['name'][0];
				$_FILES['files1']['type'] = $files['files1']['type'][0];
				$_FILES['files1']['tmp_name'] = $files['files1']['tmp_name'][0];
				$_FILES['files1']['error'] = $files['files1']['error'][0];
				$_FILES['files1']['size'] = $files['files1']['size'][0];	

			 		$config['upload_path'] = $this->basepath . $_SESSION['username'];
				$config['allowed_types'] = 'png';
				$config['max_size'] = '5120';
				$config['max_widht'] = '1920';
				$config['max_height'] = '1080';
				$config['overwrite'] = TRUE;
				$config['remove_spaces'] = TRUE;
				$config['file_name'] = "appimage.png";
				$this->upload->initialize($config);
				if(!$this->upload->do_upload('files1')) {
					$error['error'] = $this->upload->display_errors();		
				}
				else {

				}	
				if(!empty($error)) {
					delete_files($this->basepath . $_SESSION['username'], true);	
					rmdir($this->basepath . $_SESSION['username']);						
					exit($error['error']);			
				}
				else{
					$this->formatImage($this->basepath . $_SESSION['username'] . "/appimage.png",300,300,"png",$this->basepath . $_SESSION['username'] . "/appimage.png");
				}
				$files = $_FILES;

				$_FILES['files2']['name'] = $files['files2']['name'][0];
				$_FILES['files2']['type'] = $files['files2']['type'][0];
				$_FILES['files2']['tmp_name'] = $files['files2']['tmp_name'][0];
				$_FILES['files2']['error'] = $files['files2']['error'][0];
				$_FILES['files2']['size'] = $files['files2']['size'][0];	

			 	$config['upload_path'] = $this->basepath . $_SESSION['username'];
				$config['allowed_types'] = 'png';
				$config['max_size'] = '5120';
				$config['max_widht'] = '1920';
				$config['max_height'] = '1080';
				$config['overwrite'] = TRUE;
				$config['remove_spaces'] = TRUE;
				$config['file_name'] = "connect.png";
				$this->upload->initialize($config);
				if(!$this->upload->do_upload('files2')) {
					$error['error'] = $this->upload->display_errors();		
				}
				else {

				}	
				if(!empty($error)) {
					delete_files($this->basepath . $_SESSION['username'], true);	
					rmdir($this->basepath . $_SESSION['username']);						
					exit($error['error']);								
				}
				else{
					$this->formatImage($this->basepath . $_SESSION['username'] . "/connect.png",528,418,"png",$this->basepath . $_SESSION['username'] . "/connect.png");
				}
				$files = $_FILES;

				$_FILES['files3']['name'] = $files['files3']['name'][0];
				$_FILES['files3']['type'] = $files['files3']['type'][0];
				$_FILES['files3']['tmp_name'] = $files['files3']['tmp_name'][0];
				$_FILES['files3']['error'] = $files['files3']['error'][0];
				$_FILES['files3']['size'] = $files['files3']['size'][0];	

			 	$config['upload_path'] = $this->basepath . $_SESSION['username'];
				$config['allowed_types'] = 'png';
				$config['max_size'] = '5120';
				$config['max_widht'] = '1920';
				$config['max_height'] = '1080';
				$config['overwrite'] = TRUE;
				$config['remove_spaces'] = TRUE;
				$config['file_name'] = "disconnect.png";
				$this->upload->initialize($config);
				if(!$this->upload->do_upload('files3')) {
					$error['error'] = $this->upload->display_errors();		
				}
				else {

				}	
				if(!empty($error)) {
					delete_files($this->basepath . $_SESSION['username'], true);	
					rmdir($this->basepath . $_SESSION['username']);						
					exit($error['error']);									
				}
				else{
					$this->formatImage($this->basepath . $_SESSION['username'] . "/disconnect.png",528,418,"png",$this->basepath . $_SESSION['username'] . "/disconnect.png");
				}
				
				write_file($this->basepath . $_SESSION['username'] ."/VersionCode.txt",'101', 'w+');
				write_file($this->basepath . $_SESSION['username'] ."/VersionLocation.txt",'First release', 'w+');
				//$text=sprintf("%s\r\nApp name: %s\r\nColor: %s\r\nCurrency: %s\r\nCost: %s\r\nTrial period : %s\r\nTrial: %s\r\nStripe Live SK: %s\r\nStripe Live PK: %s\r\nPayPal username: %s\r\nPayPal password: %s\r\n",$_SESSION['username'],$this->input->post('appname'),$this->input->post('color'),$this->input->post('currency'),$this->input->post('cost'),$this->input->post('trialperiod'),$this->input->post('trial'),$this->input->post('stripelsk'),$this->input->post('stripelpk'),$this->input->post('ppusername'),$this->input->post('pppassword'));
				

				$text2=sprintf("%s\r\nApp name: %s\r\nColor: %s\r\nCurrency: %s\r\nCost: %s\r\nTrial period : %s\r\nTrial: %s\r\nStripe Live SK: %s\r\nStripe Live PK: %s\r\nPayPal username: %s\r\nPayPal password: %s\r\nLogo Image: %s\r\nConnect Image: %s\r\nDisconect Image: %s",$_SESSION['username'],$this->input->post('appname'),$this->input->post('color'),$this->input->post('currency'),$this->input->post('cost'),$this->input->post('trialperiod'),$this->input->post('trial'),$this->input->post('stripelsk'),$this->input->post('stripelpk'),$this->input->post('ppusername'),$this->input->post('pppassword'),"http://165.227.38.2/users/".$_SESSION['username']."/appimage.png","http://165.227.38.2/users/".$_SESSION['username']."/connect.png","http://165.227.38.2/users/".$_SESSION['username']."/disconnect.png");
				write_file($this->basepath . $_SESSION['username'] ."/info.txt", $text2, 'w+');
				write_file("/var/www/html/jobs/".$_SESSION['username'].".txt", $text2, 'w+');				
				$this->load->model('Users');
				$this->Users->register($_SESSION['username']);
				//f-ja za upis app name-a na mjesto username-a
				$this->Users->appname($_SESSION['username'],$this->input->post('appname'));
				$_SESSION['active']=1;
				$_SESSION['login']=1;
				$_SESSION['type']='user';
				exit('success');	
		}

	}
	private function formatImage($putanja,$width,$height,$type,$savepath)
	{
		$params = array(
				"putanja" => $putanja,
				"width" => $width,
				"height" => $height,
				"type" => $type,
				"savepath" => $savepath
			);
	}
	public function download()
	{
		$code=$this->input->get('c');
		$version=$this->input->get('v');
		$this->load->model('Users');
		$broj=$this->Users->getDownloadnum($code);
		if($broj==1)
		{
			$podaci=$this->Users->getDownload($code);
			$file="/var/www/html/users/".$podaci[0]['username']."/".$podaci[0]['name'].$version.".apk";
			if(file_exists($file))
			{
				$this->load->helper('download');
				force_download($file, NULL);
			}
			else
			{
				exit("We couldn't find the file to download.");
			}
		}
		else
		{
			exit("We couldn't find the file to download.");
		}
	}
}
?>