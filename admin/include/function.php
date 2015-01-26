<?php
require_once('config.php');
require_once('class.post.php');
include_once("./lib/auth.lib.php");
include_once("./lib/reg.lib.php");

if (!function_exists("GetSQLValueString")) {


    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
    {
        $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

        $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

        switch ($theType) {
            case "text":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;    
            case "long":
            case "int":
                $theValue = ($theValue != "") ? intval($theValue) : "NULL";
                break;
            case "double":
                $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
                break;
            case "date":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "defined":
                $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                break;
            case "varchar":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break; 
        }
  return $theValue;
    }
}

function login(){

//verifico lo stato di un utente

list($status, $user) = auth_get_status();

if($status != AUTH_LOGGED){
    $log = "logged";

}else {
$log = 1;
}
return $log;

}

//verifico se i campi inseriti nella tabella di registrazione sono corretti

$_CONFIG['check_table'] = array(
	"username" => "check_username",
	"password" => "check_global",
	"name" => "check_global",
	"surname" => "check_global",
	"indirizzo" => "check_global",
	"occupazione" => "check_global",
	"mail" => "check_global"
);

//verifico se il tipo dei dati inseriti nel form corrispondono a quel che dovrebbero essere.

function check_username($value){
	global $_CONFIG;
	
	$value = trim($value);
	if($value == "")
		return "Il campo non può essere lasciato vuoto";
	$query = mysql_query("
	SELECT id
	FROM ".$_CONFIG['table_utenti']."
	WHERE username='".$value."'");
	if(mysql_num_rows($query) != 0)
		return "Nome utente già utilizzato";
	
	return true;
}

function check_global($value){
	global $_CONFIG;
	
	$value = trim($value);
	if($value == "")
		return "Il campo non può essere lasciato vuoto";
	
	return true;
}


?>