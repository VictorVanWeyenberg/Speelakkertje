<?php

require_once WWW_ROOT . 'controller' . DS . 'Controller.php';

require_once WWW_ROOT . 'dao' . DS . 'KinderenDAO.php';

class WeekController extends Controller {

	private $kinderenDAO;
	private $dag, $week, $jaar;

	function __construct() {
		$this->kinderenDAO = new KinderenDAO();
	}

	private function removeAanwezigheid($post) {
			$data = array();
			$data["kind_id"] = $post["id"];
			$data["dag"] = $post["dag"];
			$data["week"] = $post["week"];
			$data["jaar"] = $post["jaar"];
			$inserted = $this->kinderenDAO->removeAanwezig($data);
	}

	public function week() {

		$pageNumber = 1;
		if(isset($_GET["pageNumber"])) {
			$pageNumber = $_GET["pageNumber"];
		}

		if(isset($_POST["dagtype"])) {
			$data = array();
			$data["kind_id"] = $_POST["id"];
			$data["dagtype"] = $_POST["dagtype"];
			$data["dag"] = $_POST["dag"];
			$data["week"] = $_POST["week"];
			$data["jaar"] = $_POST["jaar"];
			$data["registratiedatum"] = date("Y-m-d H:i:s");
			$inserted = $this->kinderenDAO->insertAanwezig($data);
			if (!$inserted) {
				$this->removeAanwezigheid($_POST);
			}
		}

		if (isset($_POST["id"]) && !isset($_POST["dagtype"])) {
			$this->removeAanwezigheid($_POST);
		}

		if (isset($_POST["week"]) && isset($_POST["dag"]) && isset($_POST["jaar"])) {
			if ($_POST["week"] < 1 || $_POST["week"] > 5) {
				$_SESSION["error"] = "Week ID out of bounds.";
				$this->redirect("index.php");
				exit();
			}
			if ($_POST["dag"] < 1 || $_POST["dag"] > 5) {
				$_SESSION["error"] = "Dag ID out of bounds.";
				$this->redirect("index.php");
				exit();
			}
			$this->set("aanwezigheden", $this->kinderenDAO->getAanwezighedenVanWeek($_POST["dag"], $_POST["week"], $_POST["jaar"], $_POST["filter"], $pageNumber));
			$this->set("aantalAanwezigheden", $this->kinderenDAO->getAantalAanwezighedenVanWeek($_POST["week"], $_POST["jaar"], $pageNumber));
		}

	}

	public function weken() {
		if (isset($_GET["jaar"])) {
			$this->set("overzicht", $this->kinderenDAO->getTotaalOverzicht($_GET["jaar"]));
		} else {
			$this->set("overzicht", $this->kinderenDAO->getTotaalOverzicht($_POST["jaar"]));
		}
	}

}