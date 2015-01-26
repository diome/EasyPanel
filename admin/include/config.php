<?php
// FileName="config.php"
// Type="MYSQL"
// HTTP="true"

//Costruisco un vettore nel quale salva tutti i parametri del DB

$_CONFIG['host'] = "localhost";
$_CONFIG['user'] = "USERNAME";
$_CONFIG['pass'] = "PASSWORD";
$_CONFIG['dbname'] = "DB_NAME";

$_CONFIG['table_sessioni'] = "sessioni";
$_CONFIG['table_utenti'] = "utenti";
$_CONFIG['table_articoli'] = "articoli";

//Definisco il tempo in secondi della durata della sessione e del tempo registrazione

$_CONFIG['expire'] = 3600;
$_CONFIG['regexpire'] = 24; //in ore

//definisco le costanti da associare alle variabile per la gestione degli utenti

define('AUTH_LOGGED', 99);
define('AUTH_NOT_LOGGED', 100);

define('AUTH_USE_COOKIE', 101);
define('AUTH_USE_LINK', 103);
define('AUTH_INVALID_PARAMS', 104);
define('AUTH_LOGEDD_IN', 105);
define('AUTH_FAILED', 106);

define('REG_ERRORS', 107);
define('REG_SUCCESS', 108);
define('REG_FAILED', 109);


$conn = mysql_connect($_CONFIG['host'], $_CONFIG['user'], $_CONFIG['pass']) or die('Impossibile stabilire una connessione');
mysql_select_db($_CONFIG['dbname']);
?>
