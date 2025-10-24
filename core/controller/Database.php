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

// PASO 2

	//  *******  "HARCODEADAS"	$con = new mysqli("localhost", "gerard", "123456", "bookmedik");




// Ruta al fichero de configuracion (subimos dos niveles desde este archivo)
$configPath = __DIR__ . '/../../config.ini';

// Comprobamos que existe y se puede leer
if (!is_readable($configPath)) {
    die('Falta el fichero de configuracion config.ini o no tiene permisos de lectura.');
}

// Leemos el fichero de configuración
$cfg = parse_ini_file($configPath, true, INI_SCANNER_TYPED);
$db  = $cfg['database'] ?? [];

// Cargamos los parámetros con valores por defecto por si faltan
$host    = $db['host']    ?? 'localhost';
$dbname  = $db['name']    ?? 'bookmedik';
$user    = $db['user']    ?? 'gerard';
$pass    = $db['pass']    ?? '123456';
$charset = $db['charset'] ?? 'utf8mb4';

// Creamos la conexion
$con = new mysqli($host, $user, $pass, $dbname);
if ($con->connect_error) {
    die('Error de conexion a la base de datos: ' . $con->connect_error);
}

// Establecemos el juego de caracteres
if (!$con->set_charset($charset)) {
    error_log('No se pudo establecer el charset ' . $charset . ': ' . $con->error);
}

// ********  FIN "HARCOREADAS"  ****************

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
