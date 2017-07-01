<?php

require_once WWW_ROOT . 'controller' . DS . 'Controller.php';

require_once WWW_ROOT . 'dao' . DS . 'KinderenDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'WeekDAO.php';

class WeekController extends Controller {

	private $kinderenDAO;
	private $weekDAO;
	private $dag, $week, $jaar;

	function __construct() {
		$this->kinderenDAO = new KinderenDAO();
		$this->weekDAO = new WeekDAO();
	}

	private function removeAanwezigheid($post, $dagtype) {
			$data = array();
			$data["kind_id"] = $post["id"];
			$data["dag"] = $post["dag"];
			$data["week"] = $post["week"];
			$data["jaar"] = $post["jaar"];
			if (isset($dagtype)) {
				$data["dagtype"] = $dagtype;
			}
			$inserted = $this->weekDAO->removeAanwezig($data);
	}

	public function week() {

		$pageNumber = 1;
		if(isset($_GET["pageNumber"])) {
			$pageNumber = $_GET["pageNumber"];
		}

		if (isset($_POST["id"])) {
			if(isset($_POST["dagtype"])) {
				$data = array();
				$data["kind_id"] = $_POST["id"];
				$data["dagtype"] = $_POST["dagtype"];
				$data["dag"] = $_POST["dag"];
				$data["week"] = $_POST["week"];
				$data["jaar"] = $_POST["jaar"];
				$data["registratiedatum"] = date("Y-m-d H:i:s");
				$inserted = $this->weekDAO->insertAanwezig($data);
				if (!$inserted) {
					if ($data["dagtype"] == "VM") {
						$this->removeAanwezigheid($_POST, "NM");
					} else if ($data["dagtype"] == "NM") {
						$this->removeAanwezigheid($_POST, "VM");
					}
				}
			} else {
				$this->removeAanwezigheid($_POST, null);
			}
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
			$this->set("aanwezigheden", $this->weekDAO->getAanwezighedenVanWeek($_POST["dag"], $_POST["week"], $_POST["jaar"], $_POST["filter"], $pageNumber));
			$this->set("aantalAanwezigheden", $this->weekDAO->getAantalAanwezighedenVanWeek($_POST["week"], $_POST["jaar"], $pageNumber));
		}

	}

	public function weken() {


		// if (isset($_GET["jaar"])) {
		// 	$this->set("overzicht", $this->kinderenDAO->getTotaalOverzicht($_GET["jaar"]));
		// } else { //if(isset($_POST["jaar"])) {
		// 	$this->set("overzicht", $this->kinderenDAO->getTotaalOverzicht($_POST["jaar"]));
		// }
		// // } else {
		// // 	$year = date("Y");
		// // 	$this->set("overzicht", $this->kinderenDAO->getTotaalOverzicht($year);
		// // }


		$overzicht = 0;
		if (isset($_GET["jaar"])) {
			$overzicht =  $this->weekDAO->getTotaalOverzicht($_GET["jaar"]);
		} else if(isset($_POST["jaar"])) {
			$overzicht = $this->weekDAO->getTotaalOverzicht($_POST["jaar"]);
		} else {
			$year = date("Y");
			$overzicht = $this->weekDAO->getTotaalOverzicht($year);
		}

		$bekerendOverzicht = array();
		foreach ($overzicht as $kind) {

			$kind['week_1'] = 0;
			$kind['week_2'] = 0;
			$kind['week_3'] = 0;
			$kind['week_4'] = 0;
			$kind['week_5'] = 0;
			$kind['TOTAAL'] = 0;

			$week_pieces = explode(",", $kind['weken']);
			foreach ($week_pieces as $week ) {
				switch ($week) {
					case 1:
						$kind['week_1'] += 1;
						break;
					case 2:
						$kind['week_2'] += 1;
						break;
					case 3:
						$kind['week_3'] += 1;
						break;
					case 4:
						$kind['week_4'] += 1;
						break;
					case 5:
						$kind['week_5'] += 1;
						break;
					default:
						$kind['TOTAAL'] += 1;
						break;
				}
			}
			$kind['TOTAAL'] = $kind['week_1'] + $kind['week_2'] + $kind['week_3'] + $kind['week_4'] + $kind['week_5'];
			array_push($bekerendOverzicht, $kind);
		}
		//["ID"]=> int(9) ["achternaam"]=> string(12) "Van de Velde" ["voornaam"]=> string(3) "Art" ["weken"]=> string(5) "1,3,3" ["dagen"]=> string(5) "1,1,3" ["dagtypes"]
		$this->set("overzicht", $bekerendOverzicht);

	}
	public function fiscaal() {

	}

}
