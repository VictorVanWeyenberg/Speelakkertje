<?php

require_once WWW_ROOT . 'controller' . DS . 'Controller.php';

require_once WWW_ROOT . 'dao' . DS . 'UserDAO.php';

require_once WWW_ROOT . 'phpass' . DS . 'Phpass.php';


class DashboardController extends Controller {


	private $userDAO;

	function __construct() {	

		$this->userDAO = new UserDAO();
	}


	public function index(){

		// login pagina redarect naar login

		//$cookie_name = "user";
		//$cookie_value = "admin";
		//setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
		//unset($_COOKIE['user']);

		
		//$this->set('kinderen', $this->sponsorsDAO->selectAll());
		//var_dump($_COOKIE);

	}

	public function dashboard(){
		
		//dashboard pagina


	}

	public function login(){

		if(!empty($_POST)){
			if(!empty($_POST['username']) && !empty($_POST['password'])){

				$user = $this->userDAO->selectByUser($_POST['username']);

				if(!empty($user)){
				$hasher = new \Phpass\Hash;
				$authenticated = $hasher->checkPassword(
					$_POST['password'],
					$user['password']
					);

					if($authenticated){

								$cookie_name = "user_tHg4*t?Vrs@3K6#5J4";
								$cookie_value = $_POST['username'];
								setcookie($cookie_name, $cookie_value, strtotime('+1 day 00:59'), "/"); // 86400 = 1 day
					}else{
						$_SESSION['error'] = "unknown username / password";
					}

				}else{
					$_SESSION['error'] = "unknown username / password";
				}
		}else{
				$_SESSION['error'] = "unknown username / password";
			}
		}
		$this->redirect('index.php?page=dashboard');
	}

	public function logout(){

		if( isset($_COOKIE['user_tHg4*t?Vrs@3K6#5J4']) && !empty($_COOKIE['user_tHg4*t?Vrs@3K6#5J4'])){

			//unset($_COOKIE['user']);
			unset($_COOKIE['user_tHg4*t?Vrs@3K6#5J4']);
    		setcookie('user_tHg4*t?Vrs@3K6#5J4', '', time() - 3600, '/'); // empty value and old timestamp
		}

		$_SESSION['info'] = "user is logged out";
		$this->redirect('index.php');
	}

	public function register(){

		// registreer pagina

		if(!empty($_POST)){

			$errors = array();
			if(empty($_POST['username'])){
				$errors['username'] = "please fill in an username";
			}
			if(empty($_POST['password'])){
				$errors['password'] = "please fill in a password";

			}
			if($_POST['password'] != $_POST['confirm_password']){
				$errors['confirm_password'] = "please fill in a matching pass";
			}

			if(empty($errors)){


				$hasher = new \Phpass\Hash;

				$inserted_user = array(
					"username" => $_POST['username'],
					"password" => $hasher->hashPassword($_POST['password']),
					"role" => 0,
					"registratiedatum" => date("Y-m-d H:i:s")
					);

				if(!empty($inserted_user)){

					$this->userDAO->insert($inserted_user);
					$_SESSION['info'] = "registration succesful!";
					$this->redirect('index.php?page=dashboard');
				}
				
			}else{
				$_SESSION['error'] = "Gebruiker registreren is niet gelukt";
				$this->set('errors', $errors);

			}
		}

	}

	public function delete(){

		$role = 0;
		$users = $this->userDAO->selectByRole($role);
		$this->set('users', $users);

		if (!empty($_GET['id'])) {

			$date = $_GET['id'];
			$user = $this->userDAO->selectByRegistratiedatum($date);
			
			if (!empty($user)) {

				$this->userDAO->delete($date);
				$_SESSION['info'] = "Delete user succesful!";
				$this->redirect('index.php?page=dashboard');
			}
			

		}
	}

	
}