<?php include_once('include/function.php'); 
$log= login();
$su = superuser();

if ($su == 0) {
header('Location: login.php');
}
include_once('include/header.php'); 

echo "<div id=\"wrapper\">";
echo "<div id=\"content\">";				

echo "<h1><a href=\"index.php\">Articoli pubblicati</a></h1>";


if(isset($_POST['action']) and $_POST['action'] == 'Invia'){
	$ret = reg_check_data($_POST);
	$status = ($ret === true) ? reg_register($_POST) : REG_ERRORS;
	
	switch($status){
		case REG_ERRORS:
			?>
			<div class="post">Sono stati rilevati i seguenti errori:</div><br>
			<?php
			foreach($ret as $error)
				printf("<b>%s</b>: %s<br>", $error[0], $error[1]);
			?>
			<br><div class="post">Inserisci i dati corretti.</div>
			<?php
		break;
		case REG_FAILED:
			echo "<div class=\"post\">Registrazione Fallita a causa di un errore interno.</div>";
		break;
		case REG_SUCCESS:
			echo "<div class=\"post\">Registrazione avvenuta con successo.<br>
			È stata inviata una email contente le istruzioni per confermare la registrazione.</div><br>";
		break;
	}
}


?>
<form action="add-user.php" method="post">
<div align="center">
<table border="0" width="300">
	<tr>
		<td>Nome:</td>
		<td><input type="text" name="name"></td>
	</tr>
	<tr>
		<td>Cognome:</td>
		<td><input type="text" name="surname"></td>
	</tr>
	<tr>
		<td>Indirizzo:</td>
		<td><input type="text" name="indirizzo"></td>
	</tr>
	<tr>
		<td>Occupazione:</td>
		<td><input type="text" name="occupazione"></td>
	</tr>
	<tr>
		<td>Username:</td>
		<td><input type="text" name="username"></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><input type="password" name="password"></td>
	</tr>
	<tr>
		<td>Mail:</td>
		<td><input type="text" name="mail"></td>
	</tr>
	<tr>
	   <td></td>
		<td><input type="submit" name="action" value="Invia"></td>
	</tr>
</table>
</div>
</form>

</div>
</div>
  
 <?php require_once('include/footer.php'); ?>