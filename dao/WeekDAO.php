<?php
require_once WWW_ROOT . 'dao' . DS . 'DAO.php';
class WeekDAO extends DAO {

	public function selectAanwezigheidById($id) {
		$sql = "SELECT * FROM wp_aanwezig WHERE id = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function getTotaalOverzicht($jaar) {
		$sql = "SELECT wp_kinderen.ID, wp_kinderen.achternaam, wp_kinderen.voornaam,
						GROUP_CONCAT(wp_aanwezig.week) as weken,  GROUP_CONCAT(wp_aanwezig.dag) as dagen ,  GROUP_CONCAT(wp_aanwezig.dagtype) as dagtypes
						FROM wp_kinderen
						LEFT JOIN wp_aanwezig ON wp_aanwezig.kind_id = wp_kinderen.ID
						WHERE wp_aanwezig.jaar LIKE :jaar
						GROUP BY wp_kinderen.ID ";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":jaar", "%".$jaar."%");
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getAanwezighedenVanWeek($dag, $week, $jaar, $filter, $pageNumber) {
		$sql = "SELECT wp_kinderen.ID, wp_kinderen.voornaam, wp_kinderen.achternaam, GROUP_CONCAT(wp_aanwezig.dagtype) as dagtypes, COUNT(CASE wp_aanwezig.dagtype WHEN 'VM' THEN 1 WHEN 'NM' THEN 1 END) as halvedagen_aanwezig, COUNT(CASE wp_aanwezig.dagtype WHEN 'VD' THEN 1 END) as volledagen_aanwezig
			FROM wp_kinderen
			LEFT JOIN wp_aanwezig ON wp_kinderen.ID = wp_aanwezig.kind_id
			WHERE (wp_aanwezig.dag = :dag OR wp_aanwezig.dag IS NULL) AND (wp_aanwezig.week = :week OR wp_aanwezig.week IS NULL) AND (wp_aanwezig.jaar = :jaar OR wp_aanwezig.jaar IS NULL) ";
		if ($filter != "") {
			$sql .= "AND wp_kinderen.voornaam LIKE :filter ";
		}
		$sql .= "GROUP BY wp_kinderen.ID
		LIMIT :pageNumber, 30";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":dag", $dag);
		$stmt->bindValue(":week", $week);
		$stmt->bindValue(":jaar", $jaar);
		if ($filter != "") {
			$stmt->bindValue(":filter", "%" . $filter . "%");
		}
		$stmt->bindValue(":pageNumber", ($pageNumber - 1) * 30);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getAantalAanwezighedenVanWeek($week, $jaar, $pageNumber) {
		$sql = "SELECT wp_kinderen.ID, COUNT(CASE wp_aanwezig.dagtype WHEN 'VM' THEN 1 WHEN 'NM' THEN 1 END) as halvedagen_aanwezig, COUNT(CASE wp_aanwezig.dagtype WHEN 'VD' THEN 1 END) as volledagen_aanwezig
			FROM wp_kinderen
			LEFT JOIN wp_aanwezig ON wp_kinderen.ID = wp_aanwezig.kind_id
			WHERE wp_aanwezig.week = :week AND wp_aanwezig.jaar = :jaar
			GROUP BY wp_kinderen.ID";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":week", $week);
		$stmt->bindValue(":jaar", $jaar);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}


	private function selectAanwezigByData($data) {
		$sql = "SELECT `ID` FROM `wp_aanwezig` WHERE `kind_id` = :kind_id AND `dag` = :dag AND `week` = :week AND `jaar` = :jaar AND `dagtype` = :dagtype";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':kind_id', $data['kind_id']);
		$stmt->bindValue(':dag', $data['dag']);
		$stmt->bindValue(':week', $data['week']);
		$stmt->bindValue(':jaar', $data['jaar']);
		$stmt->bindValue(':dagtype', $data['dagtype']);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function insertAanwezig($data) {
		if (empty($this->selectAanwezigByData($data))) {
			$sql = "INSERT INTO `wp_aanwezig` (`kind_id`,`dagtype`,`dag`,`week`,`jaar`,`registratiedatum`)
						VALUES 			      (:kind_id, :dagtype, :dag, :week, :jaar, :registratiedatum)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':kind_id', $data['kind_id']);
			$stmt->bindValue(':dagtype', $data['dagtype']);
			$stmt->bindValue(':dag', $data['dag']);
			$stmt->bindValue(':week', $data['week']);
			$stmt->bindValue(':jaar', $data['jaar']);
			$stmt->bindValue(':registratiedatum', $data['registratiedatum']);
			if($stmt->execute()) {
				$insertedId = $this->pdo->lastInsertId();
				return $this->selectAanwezigheidById($insertedId);
			}
		}
		return false;
	}

	public function removeAanwezig($data) {
		$sql = "DELETE
			FROM `wp_aanwezig`
			WHERE `kind_id` = :kind_id AND `dag` = :dag AND `week` = :week AND `jaar` = :jaar ";
		if (isset($data["dagtype"])) {
			$sql .= "AND `dagtype` = :dagtype";
		}
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':kind_id', $data['kind_id']);
		$stmt->bindValue(':dag', $data['dag']);
		$stmt->bindValue(':week', $data['week']);
		$stmt->bindValue(':jaar', $data['jaar']);
		if (isset($data["dagtype"])) {
			$stmt->bindValue(':dagtype', $data['dagtype']);
		}
		return $stmt->execute();
	}

}
