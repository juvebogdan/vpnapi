<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class AppyAPI extends REST_Controller {

	private $masterkodiLocation = '/var/www/appy.zone/public_html/appy/V5/master/kodi/builds.txt';

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['index_get']['limit'] = 100; // 100 requests per hour per user/key
    }	

    // public function index_post()
    // {

    // 	date_default_timezone_set("Europe/London");
    //     $this->load->helper('url');
    //     $this->load->helper('file');
    //     $email = $this->post('email'); 
    //     $customerId = $this->post('customerId');
        
    //     if ($email == '' || $customerId == '') {
    //          $this->response([
    //             'status' => 'failed',
    //             'message' => 'You must provide all details'
    //         ], 400);             
    //     }


    //     $pass = substr(md5(microtime()),rand(0,26),12);

    //     $datum = date('Y-m-d H:i');

    //     $this->load->model('users');

    //     $username = $this->users->createUsername();       

    //     $rows = $this->users->insertUser($username,$pass,$datum,$email,$customerId);

    //     if ($rows>0) {
    //         $this->email($email,$username,$pass);
    //         $this->response([
    //             'status' => 'success',
    //             'message' => 'Created user ' . $username
    //         ], 200);
    //     }
    //     else {
    //          $this->response([
    //             'status' => 'failed',
    //             'message' => 'Error occured'
    //         ], 400);           
    //     }

    // }


    public function getData_post() {
		

    	date_default_timezone_set("Europe/London");
        $this->load->helper('url');
        $this->load->helper('file');
        $email = $this->post('email'); 
        $customerId = $this->post('customerId');

        $this->load->model('users');

        $credentials = $this->users->getCredentials($email,$customerId);

        if (empty($credentials)) {
	        $this->response([
	            'status' => 'failed',
	            'message' => 'User with email ' . $email . ' does not exist'
	        ], 404);          	
        }
        else {
        	$this->credentialsEmail($email,$credentials[0]['username'],$credentials[0]['password']);
	        $this->response([
	            'status' => 'success',
	            'message' => 'Email with credentials has been sent to ' . $email
	        ], 200);  
        }    

    }

    public function deleteUser_post() {
        
        date_default_timezone_set("Europe/London");
        $this->load->helper('url');
        $this->load->helper('file');
        $email = $this->post('email'); 
        $customerId = $this->post('customerId');

        $this->load->model('users');

        $credentials = $this->users->getCredentials($email,$customerId);
 

        if (empty($credentials)) {
            $this->response([
                'status' => 'failed',
                'message' => 'User with email ' . $email . ' and with customerId ' . $customerId . ' does not exist'
            ], 404);            
        }
        else {

            $this->users->cancelUser($email,$customerId);
            $appname = $this->users->getAppnameFromCusId($customerId);
            $this->cancelEmail($email,$appname);  
            $this->response([
                'status' => 'success',
                'message' => 'Account has been cancelled'
            ], 200);
        }        
    } 

    public function check_post() {
        
        date_default_timezone_set("Europe/London");
        $this->load->helper('url');
        $this->load->helper('file');

        $username = $this->post('username'); 
        $password = $this->post('password');

        $this->load->model('users');

        $credentials = $this->users->checkCredentials($username,$password);
 

        if ($credentials == 0) {
            $this->response([
                'status' => 'failed',
                'message' => 'User does not exist in database'
            ], 404);            
        }
        else {
            $this->response([
                'status' => 'success',
                'message' => 'Credentials are ok'
            ], 200);
        }        
    }        

    private function email($email,$username,$password,$appname,$returnemail) {

        include(APPPATH.'third_party/Mailer.php');

        date_default_timezone_set('Europe/London');

        $info = array('email' => $email,'username' => $username, 'password' => $password, 'appname' => $appname, 'returnemail' => $returnemail);
    
        $mail1 = new Mailer($info,APPPATH.'views/emailApp.html');
    
        $mail1->send_mail();
    
    }

    private function credentialsEmail($email,$username,$password) {       
        include(APPPATH.'third_party/Mailer.php');

        date_default_timezone_set('Europe/London');

        $info = array('email' => $email,'username' => $username, 'password' => $password);      
    
        $mail1 = new Mailer($info,APPPATH.'views/getData.html');          
    
        $mail1->send_reset_mail();    	
    }

    private function cancelEmail($email,$appname) {
        include(APPPATH.'third_party/Mailer.php');

        date_default_timezone_set('Europe/London');

        $info = array('email' => $email,'appname' => $appname);
    
        $mail1 = new Mailer($info,APPPATH.'views/cancelEmail.html');
    
        $mail1->send_cancel_mail();      
    }
    

    public function newindex_post()
    {

        date_default_timezone_set("Europe/Athens");
        $this->load->helper('url');
        $this->load->helper('file');
        $email = $this->post('email'); 
        $client = $this->post('client');
        $customerId = $this->post('customerId');
        
        if ($email == '' || $client == '' || $customerId == '') {
             $this->response([
                'status' => 'failed',
                'message' => 'You must provide all details'
            ], 400);             
        }

        $pass = substr(md5(microtime()),rand(0,26),12);

        $datum = date('Y-m-d H:i');

        $this->load->model('users');

        if ($this->users->checkUser($client)==0) {
             $this->response([
                'status' => 'failed',
                'message' => 'Wrong username'
            ], 400); 
        }

        if ($this->users->checkCustomerId($customerId)>0) {
             $this->response([
                'status' => 'failed',
                'message' => 'Duplicate customerid'
            ], 400); 
        }

        $username = $this->users->createUsername();                        
        if($this->users->checkUserSaldo($client)) {
            $rows = $this->users->insertUser2($client,$username,$pass,$datum,$email,$customerId);
            $appname = $this->users->getAppname($client);
            $returnemail = $this->users->getUserEmail($client);
            if ($rows>0) {
                $this->email($email,$username,$pass,$appname,$returnemail);
                $this->response([
                    'status' => 'success',
                    'message' => 'Created user ' . $username
                ], 200);
            }
            else {
                 $this->response([
                    'status' => 'failed',
                    'message' => 'Error occured'
                ], 400);           
            }
        }
        else  {
             $this->response([
                'status' => 'failed',
                'message' => 'User does not have enough credits on his account'
            ], 400);            
        }

    }    


}
