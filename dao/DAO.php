<?php
class DAO {
	private static $dbHost = "77.73.96.216";
	private static $dbName = "jnet34_wordpress_a";
	private static $dbUser = "wordpress_0";
	private static $dbPass = "zk5H$2P3Mg";

	// private static $dbHost = "localhost";
	// private static $dbName = "jnet34_wordpress_b";
	// private static $dbUser = "jnet34_staf";
	// private static $dbPass = "zk5H$2P3Mg";

	private static $sharedPDO;

	protected $pdo;

	function __construct() {
		if(empty(self::$sharedPDO)) {
			self::$sharedPDO = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName, self::$dbUser, self::$dbPass);
			self::$sharedPDO->exec("SET CHARACTER SET utf8");
			self::$sharedPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			self::$sharedPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		}
		$this->pdo =& self::$sharedPDO;
	}

	// webhosting:
	// url: https://www.speelakkertje.be:8443
	// user: jnet34
	// pass: R2D2R2D2
}
