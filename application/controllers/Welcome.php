<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->helper('url');
		exit('cao');

		//$this->load->view('welcome_message');
	}

	public function curl() {
	   	$username = '';
	    $password = '';
	     

	    $curl_handle = curl_init();
	    curl_setopt($curl_handle, CURLOPT_URL, 'http://165.227.38.2/vpnapi/AppyAPI/newindex');
	    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($curl_handle, CURLOPT_POST, 1);
	    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, array(
	        'email' => "bogdan.krivokapic@ericsson.com",
	        'client' => 'bogdan',
	        'customerId' => 'wefioevoifjv' 
	    ));
	     
	    
	    curl_setopt($curl_handle, CURLOPT_USERPWD, $username . ':' . $password);
	     
	    $buffer = curl_exec($curl_handle);
	    curl_close($curl_handle);
	     
	    $result = json_decode($buffer);	
	    print_r($result);
	}


	public function getuserData() {
	    /*$username = '';
	    $password = '';

	    $curl_handle = curl_init();
	  	curl_setopt($curl_handle, CURLOPT_URL, 'http://165.227.38.2/vpnapi/AppyAPI/getData');
	    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($curl_handle, CURLOPT_POST, 1);
	    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, array(
	        'email' => "krivokapic.bogdan10@gmail.com",
	        'customerId' => 'cus_customer'
	    ));
	     
	    curl_setopt($curl_handle, CURLOPT_USERPWD, $username . ':' . $password);
	     
	    $buffer = curl_exec($curl_handle);
	    curl_close($curl_handle);
	     
	    //$result = json_decode($buffer);	

	    print_r($buffer);	*/	
	}

	public function delete() {
	    $username = '';
	    $password = '';

	    $curl_handle = curl_init();
	  	curl_setopt($curl_handle, CURLOPT_URL, 'http://165.227.38.2/vpnapi/AppyAPI/deleteUser');
	    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($curl_handle, CURLOPT_POST, 1);
	    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, array(
	        'email' => "bogdan.krivokapic@ericsson.com",
	        'customerId' => 'wefioevoifjv'
	    ));
	     
	    curl_setopt($curl_handle, CURLOPT_USERPWD, $username . ':' . $password);
	     
	    $buffer = curl_exec($curl_handle);
	    curl_close($curl_handle);
	     
	    $result = json_decode($buffer);	

	    print_r($result);
	}

	public function check() {
		/*$username = '';
	    $password = '';

	    $curl_handle = curl_init();
	  	curl_setopt($curl_handle, CURLOPT_URL, 'http://165.227.38.2/vpnapi/AppyAPI/checkcredentials');
	    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($curl_handle, CURLOPT_POST, 1);
	    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, array(
	        'username' => '34f095f2bcc9',
	        'password' => 'b88072fae7b0',
	    ));
	     
	    curl_setopt($curl_handle, CURLOPT_USERPWD, $username . ':' . $password);
	     
	    $buffer = curl_exec($curl_handle);
	    curl_close($curl_handle);
	     
	    $result = json_decode($buffer);	

	    print_r($result);*/
	}	

}
