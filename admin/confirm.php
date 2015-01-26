
<?php
include_once("include/function.php");
include_once('include/header.php'); 

echo "<div id=\"wrapper\">";
echo "<div id=\"content\">";	

echo "<div id=\"confirm\">";

if(isset($_GET['id']) and strlen($_GET['id']) == 32){
	reg_clean_expired();
	$status = reg_confirm($_GET['id']);
	
	switch($status){
		case REG_SUCCESS:
			echo "La tua registrazione &egrave; stata confermata, ora puoi effettuare il <a href=\"index.php\">login.</a>";
		break;
		case REG_FAILED:
			echo "La registrazione non puo' essere confermata, probabilmente poich&egrave; &egrave; scaduta.";
		break;
	}
}


?>
</div>
</div>
</div>
<?php include_once('include/footer.php'); ?>