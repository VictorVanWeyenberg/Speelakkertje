<?php

require_once WWW_ROOT . 'controller' . DS . 'Controller.php';

require_once WWW_ROOT . 'dao' . DS . 'KinderenDAO.php';

class WeekController extends Controller {

	private $kinderenDAO;
	private $dag, $week, $jaar;

	function __construct() {
		$this->kinderenDAO = new KinderenDAO();
	}

	public function week() {

		if (isset($_GET["dag"]))  { $dag  = $_GET['dag']; }
		if (isset($_GET["id"]))   { $week = $_GET['id'];  }
		if (isset($_GET["jaar"])) { $jaar = $_GET['jaar'];}

		if(isset($_POST["aanwezigheid"])) {
			$data = array();
			$data["kind_id"] = $_POST["id"];
			$data["dagtype"] = $_POST["dagtype"];
			$data["dag"] = $_POST["dag"];
			$data["week"] = $_GET["id"];
			$data["jaar"] = $_POST["jaar"];
			$data["registratiedatum"] = date();
			$this->kinderenDAO->insert($data);
			$this->redirect("index.php?page=week&id=" . $_GET["id"]);
		}
		if (isset($_GET["id"]) && isset($_POST["dag"]) && isset($_POST["jaar"])) {
			if ($_GET["id"] < 1 || $_GET["id"] > 5) {
				$_SESSION["error"] = "Week ID out of bounds.";
				$this->redirect("index.php");
				exit();
			}
			if ($_POST["dag"] < 1 || $_POST["dag"] > 5) {
				$_SESSION["error"] = "Dag ID out of bounds.";
				$this->redirect("index.php");
				exit();
			}
			$this->set("aanwezigheden", $this->kinderenDAO->getAanwezighedenVanWeek($_POST["dag"], $_GET["id"], $_POST["jaar"]));
			$this->set("aantalAanwezigheden", $this->kinderenDAO->getAantalAanwezighedenVanWeek($_GET["id"], $_POST["jaar"]));
		} else if (isset($_GET["id"])) {
			if ($_GET["id"] < 1 || $_GET["id"] > 5) {
				$_SESSION["error"] = "Week ID out of bounds.";
				$this->redirect("index.php");
				exit();
			}
			$this->set("aanwezigheden", $this->kinderenDAO->getAanwezighedenVanWeek(strval(date("N")), $_GET["id"], strval(date("Y"))));
			$this->set("aantalAanwezigheden", $this->kinderenDAO->getAantalAanwezighedenVanWeek($_GET["id"], strval(date("Y"))));
		}
	}

	public function weken() {
		if (isset($_GET["jaar"])) {
			$this->set("overzicht", $this->kinderenDAO->getTotaalOverzicht($_GET["jaar"]));
		} else {
			$this->set("overzicht", $this->kinderenDAO->getTotaalOverzicht($_POST["jaar"]));
		}
	}

	private function _handleInsertPresentChild($get, $post){

		var_dump($get);
		var_dump($post);

	}

}