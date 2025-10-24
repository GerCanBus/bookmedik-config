<?php
class Database {
	public static $db;
	public static $con;
	
	function Database(){
	}

	function connect(){
// PASO 1
	// ********************************************************
        // ******** MODIFICO "USER" , "PASS" , DB   ***************
        // ********************************************************

		$con = new mysqli("localhost", "gerard", "123456", "bookmedik");
		$con->query("set sql_mode=''");
		return $con;
	}

	public static function getCon(){
		if(self::$con==null && self::$db==null){
			self::$db = new Database();
			self::$con = self::$db->connect();
		}
		return self::$con;
	}
	
}
?>
