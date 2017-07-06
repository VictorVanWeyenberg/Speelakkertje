<?php

require_once WWW_ROOT . 'controller' . DS . 'Controller.php';

require_once WWW_ROOT . 'dao' . DS . 'KinderenDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'OudersDAO.php';


class KinderenController extends Controller {


	private $kinderenDAO;
	private $oudersDAO;

	//private $selectedParent;

	function __construct() {

		$this->kinderenDAO = new KinderenDAO();
		$this->oudersDAO = new OudersDAO();
	}

	public function gegevens(){

		// Alle kinderen ocherzicht pagina

		$kinderen = $this->kinderenDAO->selectAllThisYear();

		if (!empty($_POST["years"]) && isset($_POST["allYear"])):
			if($_POST["allYear"] == 'on'):
				$kinderen = $this->kinderenDAO->selectAll();
			endif;
		endif;

		foreach ($kinderen as $kind):

			//fixen!...
			//var_dump($kind);
			if($kind['geslacht'] == "m"):
				$kind['geslacht'] = "jongen";
			else:
				$kind['geslacht'] = "meisje";
			endif;

			// if medisch != "geen" => color red

			// if !empty notitie => color red || orange
		endforeach;

		$this->set('kinderen', $kinderen);

	}

	public function toevoegen(){

		// een kind en ouder toevoegen aan de db


		/*
		<?php
			$user_id = 1;
			$password = 'HelloWorld';
			wp_set_password( $password, $user_id );
		?>
		*/


		//Kies welke button ouder of kind toevoegen
		if (isset($_GET['button'])) {
			$button = $_GET['button'];
			if ($button == 'nieuw') {

				$this->set('nieuw', $button);
				unset($_SESSION['ouder']);
			}else if($button == 'bestaand'){

				$ouders = $this->oudersDAO->selectAllNames();
				$this->set('ouders', $ouders);
			}
		}


		#region nieuwe ouder toevoegen
		//var_dump($_POST);
		if (isset($_POST['action_insert_parent']) && !empty($_POST['action_insert_parent']) && $_POST['action_insert_parent'] !== 0) {

			$bestaandEmail = $this->oudersDAO->selectAllEmails();
			if ($this->in_multiarray($_POST['email'], $bestaandEmail, 'email')){
				$errors['email'] = ' Email bestaat al!';
			}
			if(empty($_POST['email'])) {
				$errors['email'] = ' Email is niet ingevuld.';
			}
			if(empty($_POST['voornaam'])) {
				$errors['voornaam'] = ' Voornaam is niet ingevuld.';
			}
			if(empty($_POST['familienaam'])) {
				$errors['familienaam'] = ' Familienaam is niet ingevuld.';
			}
			if(empty($_POST['functie'])) {
				$errors['functie'] = ' Functie is niet ingevuld.';
			}
			if(empty($_POST['adres'])) {
				$errors['adres'] = ' Adres is niet ingevuld.';
			}
			if(empty($_POST['postcode'])) {
				$errors['postcode'] = ' Postcode is niet ingevuld.';
			}
			if(empty($_POST['stad'])) {
				$errors['stad'] = ' Stad is niet ingevuld.';
			}
			if(empty($_POST['tel1'])) {
				$errors['tel1'] = ' Telefoon nummer is niet ingevuld.';
			}
			if(empty($_POST['tel2'])) {
				$_POST['tel2'] = $_POST['tel1'];
			}

			if (empty($errors)) {
				//print_r(" geslaagd");
				$this->_handleParent($_POST);
			}else{
				//print_r("niet geslaagd");
				//var_dump($errors);
				$this->set('errors', $errors);
			}
		}

		#endregion

		#region selected ouder
		// als bestaande ouder is gekozen haal de juiste ouder uit het id
			if (empty($_POST['parent']) && isset($_SESSION['ouder'])) { $_POST['parents'] = $_SESSION['ouder']; }
			if (isset($_POST['parent']) && !empty($_POST['parent']) && $_POST['parent'] !== 0) {

				//var_dump($_POST['parent']);
				$newlySelectedParent = $this->oudersDAO->selectById($_POST['parent']);
				//var_dump($newlySelectedParent);

				if (!isset($this->selectedParent) || $this->selectedParent != $newlySelectedParent) {
					$this->selectedParent = $newlySelectedParent;
				}

				$_SESSION['ouder'] = $newlySelectedParent['user_id'];
				//var_dump($_SESSION);
				$this->set('selectedParent', $newlySelectedParent);

				// kind toevoegen via form
				if(!empty($_POST['action']) || !empty($_POST['add'])) {

					if(empty($_POST['voornaam'])) {
						$errors['voornaam'] = 'U hebt het kind zijn of haar naam niet ingevuld.';
					}
					if(empty($_POST['lastname'])) {
						$errors['lastname'] = 'U hebt het kind zijn of haar familienaam niet ingevuld.';
					}
					if(empty($_POST['geslacht'])) {
						$errors['geslacht'] = 'U hebt het kind zijn of haar geslacht niet ingevuld.';
					}
					if(empty($_POST['geboortedatum'])) {
						$errors['geboortedatum'] = 'U hebt het kind zijn of haar geboortedatum niet ingevuld.';
					}
					if(!isset($_POST['actief'])) {
						$errors['actief'] = 'U hebt niet ingevuld of het kind dit jaar komt naar het speelplein.';
					}
					if(empty($_POST['medische'])) {
						$errors['medische'] = 'U hebt niet ingevuld of het kind dit jaar komt naar het speelplein.';
					}
					if (!empty($errors)) {

						$this->_handleChild($_POST, $newlySelectedParent);
					}else{
						$this->set('errors', $errors);
					}

				}

			}


		#endregion

		#region selected volledig toevoegen


		#endregion

	}

	public function weizigen(){

		// een kind of ouder weizigen in de db of actief zetten!


		if (empty($_GET)):

			$_SESSION['error'] = "Er is geen kind gevonden";
			$this->redirect('index.php?page=kinderen');
		elseif(empty($_GET['kind'])):

			$_SESSION['error'] = "Er is geen geldig kind gevonden";
			$this->redirect('index.php?page=kinderen');
		endif;

		$pieces = explode("-", $_GET['kind']);
		$voornaam = $pieces[0];
		$achternaam = $pieces[1];

		//selectChildByName(voornaam, achternaam);
		$kind = $this->kinderenDAO->selectChildByName($voornaam, $achternaam);
		$ouder = $this->oudersDAO->selectById($kind['user_id']);

		$this->set('ouder', $ouder);
		$this->set('kind', $kind);

		if (!empty($_POST)):
			if ( isset($_POST["action_update_child"]) && $_POST["action_update_child"] == "Kind Opslaan" ):

				if(empty($_POST['naam'])) {
					$errors['naam'] = 'U hebt het kind zijn of haar naam niet ingevuld.';
				}
				if(empty($_POST['achternaam'])) {
					$errors['achternaam'] = 'U hebt het kind zijn of haar familienaam niet ingevuld.';
				}
				if(empty($_POST['geslacht'])) {
					$errors['geslacht'] = 'U hebt het kind zijn of haar geslacht niet ingevuld.';
				}
				if(empty($_POST['geboortedatum'])) {
					$errors['geboortedatum'] = 'U hebt het kind zijn of haar geboortedatum niet ingevuld.';
				}
				if(!isset($_POST['actief'])) {
					$errors['actief'] = 'U hebt niet ingevuld of het kind dit jaar komt naar het speelplein.';
				}
				if(empty($_POST['medische'])) {
					$errors['medische'] = 'U hebt niet ingevuld of het kind dit jaar komt naar het speelplein.';
				}
				if (empty($errors)) {

					$this->_handleUpdateChild($_POST);
				}else{
					var_dump($errors);
					var_dump($_POST);

					$this->set('errors', $errors);
				}




			endif;
			if ( isset($_POST["action_update_parent"]) && $_POST["action_update_parent"] == "Ouder Opslaan" ):



				$bestaandEmail = $this->oudersDAO->selectAllEmails();
				if ($this->in_multiarray($_POST['email'], $bestaandEmail, 'email') && $_POST['email'] !== $ouder['email']){
					$errors['email'] = ' Email bestaat al!';
				}
				if(empty($_POST['email'])) {
					$errors['email'] = ' Email is niet ingevuld.';
				}
				if(empty($_POST['voornaam'])) {
					$errors['voornaam'] = ' Voornaam is niet ingevuld.';
				}
				if(empty($_POST['familienaam'])) {
					$errors['familienaam'] = ' Familienaam is niet ingevuld.';
				}
				if(empty($_POST['functie'])) {
					$errors['functie'] = ' Functie is niet ingevuld.';
				}
				if(empty($_POST['adres'])) {
					$errors['adres'] = ' Adres is niet ingevuld.';
				}
				if(empty($_POST['postcode'])) {
					$errors['postcode'] = ' Postcode is niet ingevuld.';
				}
				if(empty($_POST['stad'])) {
					$errors['stad'] = ' Stad is niet ingevuld.';
				}
				if(empty($_POST['tel1'])) {
					$errors['tel1'] = ' Telefoon nummer is niet ingevuld.';
				}
				if(empty($_POST['tel2'])) {
					$_POST['tel2'] = $_POST['tel1'];
				}

				if (empty($errors)) {
					// print_r(" geslaagd");
					$this->_handleUpdateParent($_POST);
				}else{
					print_r("niet geslaagd");
					var_dump($errors);
					$this->set('errors', $errors);
				}




			endif;

		endif;

	}

	private function in_multiarray($elem, $array,$field){

		$top = sizeof($array) - 1;
		$bottom = 0;
		while($bottom <= $top)
		{
				if($array[$bottom][$field] == $elem)
						return true;
				else
						if(is_array($array[$bottom][$field]))
								if(in_multiarray($elem, ($array[$bottom][$field])))
										return true;

				$bottom++;
		}
		return false;
	}

	private function _handleParent($post) {

		$nickname = str_replace(".", "-", $post['email']);
		$nickname = str_replace("@", "", $nickname); // teken removen
		$pass = '$P$BHQ.M7rugyAsMgjutSRCfa1iOgkZmJ0'; #k4%YeK6w9%WTLa^^U?Dy

		$user = array(
			'user_login' => $post['email'],
			'user_pass' => $pass,
			'user_nicename' => $post['email'],
			'user_email' => $post['email'],
			'user_registered' => date("Y-m-d H:i:s"),
			'user_status' => 0,
			'display_name' => $post['voornaam']." ".$post['familienaam']
		);

		$inserted_user = $this->oudersDAO->insertUser($user);
		//var_dump($inserted_user);
		if(!empty($inserted_user)) {

			//var_dump($inserted_user);

			if ($post["functie"] == "p") {
			$post['geslacht'] = "m";
			}else{
				$post['geslacht'] = "v";
			}

			$ouder = array(
				'user_id' => $inserted_user['ID'],
				'voornaam' => $post['voornaam'],
				'familienaam' => $post['familienaam'],
				'functie' => $post['functie'],
				'geslacht' => $post['geslacht'],
				'tel1' => $post['tel1'],
				'tel2' => $post['tel2'],
				'email' => $post['email'],
				'adres' => $post['adres'],
				'postcode' => $post['postcode'],
				'stad' => $post['stad'],
				'registratiedatum' => date("Y-m-d H:i:s")
			);


			//var_dump("gelukt");

			$insert_ouder = $this->oudersDAO->insert_ouder($ouder);
			//var_dump($insert_ouder);
			if(!empty($insert_ouder)) {

				$_SESSION['info'] = 'Toevoegen van '. $post['voornaam']. " ". $post['familienaam'].' is gelukt!';
				$_SESSION['ouder'] = $insert_ouder['user_id'];
				//var_dump($insert_ouder);
				$this->redirect('index.php?page=voegtoe&button=bestaand');
			} else {
				$errors = $this->oudersDAO->getValidationErrorsParent($ouder);
				$this->set('errors', $errors);
			}

		} else {
			$errors = $this->oudersDAO->getValidationErrorsUser($user);
			$this->set('errors', $errors);
			//var_dump($insert_user);
		}

	}

	private function _sendmail($email, $data){

		$to      = $email;
		$subject = 'speelplein \'t Speelakkertje heeft u geregistreerd';
		$headers = 'From: speelplein@speelakkertje.be' . "\r\n" .
				'Reply-To: speelplein@speelakkertje.be' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
		$message =
			'Dag beste '.$data['familienaam']." ".$data['voornaam'] ."\r\n" .
			"\r\n" .
			'<p>Een plein verantwoordelijke van speelplein \'t Speelakkertje heeft u email adres geregistreerd.'. "\r\n" .
			'Dit voor uw kinderen te kunnen koppelen aan uw gegevens, zodat u ook uw kinderen kan weizigen en voor uw kinderen volgend jaar weer op actief te zetten.'. "\r\n" .
			'Voor veiligheidsredenen geven we u geen wachtwoord mee in de mail, maar kan u op de website speelakkertje.be een uw wachtwoord resetten. <a href="http://speelakkertje.be/wp-login.php?action=lostpassword">Dit kan u doen op deze link te klikken</a></p>'. "\r\n" .
			'<p>Mocht de link niet werken klik dan op de volgende URL: http://speelakkertje.be/wp-login.php?action=lostpassword</p>'. "\r\n" .
			"\r\n" .
			'Vriendelijke groeten' . "\r\n" .
			'Speelplein \'t Speelakketje';

		mail($to, $subject, $message, $headers);

	}

	private function _handleUpdateParent($post) {

		$user = array(
			'ID' => $post['user_id'],
			'user_login' => $post['email'],
			'user_nicename' => $post['email'],
			'user_email' => $post['email'],
			'display_name' => $post['voornaam']." ".$post['familienaam']
		);

			if ($post["functie"] == "p") {
			$post['geslacht'] = "m";
			}else{
				$post['geslacht'] = "v";
			}

			$ouder = array(
				'ID' => $post['PARENT_ID'],
				'voornaam' => $post['voornaam'],
				'familienaam' => $post['familienaam'],
				'functie' => $post['functie'],
				'geslacht' => $post['geslacht'],
				'tel1' => $post['tel1'],
				'tel2' => $post['tel2'],
				'email' => $post['email'],
				'adres' => $post['adres'],
				'postcode' => $post['postcode'],
				'stad' => $post['stad'],
				'updatedatum' => date("Y-m-d H:i:s")
			);

			// var_dump("gelukt");
			// var_dump($post);

			// USER ID ???? HOE WAAR HUH ??? NOG DOEN!!!!

			 $inserted_user = $this->oudersDAO->UpdateUser($user);
			 $insert_ouder = $this->oudersDAO->Updated_ouder($ouder);
			//var_dump($insert_ouder);
			if(!empty($insert_ouder && !empty($insert_ouder))) {

				$_SESSION['info'] = 'Toevoegen van '. $post['voornaam']. " ". $post['familienaam'].' is gelukt!';
				$_SESSION['ouder'] = $insert_ouder['user_id'];
				//var_dump($insert_ouder);
				$this->redirect('index.php?page=kinderen');
			} else {
				$errors = $this->oudersDAO->getValidationErrorsParent($ouder);
				$this->set('errors', $errors);
			}

	}

	private function _handleChild($post, $ouder) {

				//user_id`,`ouder_id`,`voornaam`,`achternaam`,geslacht,`geboortedatum`,`alleen_naar_huis`,`medische`,`notitie`,`actief`,`registratiedatum
		$bday = str_replace("/","-", $post['geboortedatum']);
		$kind = array(
			'user_id' => $ouder['user_id'],
			'ouder_id' => $ouder['ID'],
			'voornaam' => $post['naam'],
			'achternaam' => $post['lastname'],
			'geslacht' => $post['geslacht'],
			'geboortedatum' => $bday,
			'alleen_naar_huis' => 0,
			'medische' => $post['medische'],
			'notities' => $post['notities'],
			'actief' => $post['actief'],
			'registratiedatum' => date("Y-m-d H:i:s")
		);

		var_dump($kind);

		$insert = $this->kinderenDAO->insert($kind);
		//$insert = "good";
		//var_dump($post);
		if(!empty($insert)) {

			$_SESSION['info'] = 'kind toevoegen bij van '. $ouder['voornaam']. " ". $ouder['familienaam'].'gelukt!';
			if (isset($_POST['action']) && $_POST['action'] == "opslaan") {

				//["action"]=> string(7) "Opslaan"
				// toevoegen en alles legen ook ouder
				unset($_SESSION['ouder']);
				$this->redirect('index.php?page=voegtoe');
			}else if(isset($_POST['add'])){

				//["add"]
				//toevoegen en niet ouder legen
				$this->redirect('index.php?page=voegtoe&button=bestaand');
			} else{

				unset($_SESSION['ouder']);
				$this->redirect('index.php?page=voegtoe');
			}
		} else {
			$errors = $this->kinderenDAO->getValidationErrors($kind);
			$this->set('errors', $errors);
		}
	}
	private function _handleUpdateChild($post) {

				//user_id`,`ouder_id`,`voornaam`,`achternaam`,geslacht,`geboortedatum`,`alleen_naar_huis`,`medische`,`notitie`,`actief`,`registratiedatum
		$bday = str_replace("/","-", $post['geboortedatum']);
		$kind = array(
			'ID' => $post['ID'],
			'voornaam' => $post['naam'],
			'achternaam' => $post['achternaam'],
			'geslacht' => $post['geslacht'],
			'geboortedatum' => $bday,
			'alleen_naar_huis' => 0,
			'medische' => $post['medische'],
			'notities' => $post['notities'],
			'actief' => $post['actief'],
			'updatedatum' => date("Y-m-d H:i:s")
		);

		$insert = $this->kinderenDAO->update($kind);
		//$insert = "good";
		//var_dump($post);
		if(!empty($insert)) {

			$_SESSION['info'] = 'Bijwerken van '. $post['naam']. " ". $post['achternaam'].' gelukt!';
			$this->redirect('index.php?page=kinderen');

		} else {
			$errors = $this->kinderenDAO->getValidationErrors($kind);
			$this->set('errors', $errors);
		}
	}

}
