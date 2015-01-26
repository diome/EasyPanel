<?php
include_once("include/function.php");

list($status, $user) = auth_get_status();

if($status == AUTH_LOGGED & auth_get_option("TRANSICTION METHOD") == AUTH_USE_LINK){
	$link = "?uid=".$_GET['uid'];
}else	$link = '';

		switch($status){
		      case AUTH_LOGGED:
		          header('Location: index.php');
		      break;
		      case AUTH_NOT_LOGGED:
        ?>
        	
<? include_once('include/header.php'); ?> 

<div id="wrapper">
    <div id="content">
    <div id="login">
		<form action="log.php<?=$link?>" method="post">
			<table cellspacing="2">
				<tr>
					<td>Nome Utente:</td>
					<td><input type="text" name="uname"></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="passw"></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="action" value="login"></td>
				</tr>
			</table>
		</form>
    </div>
		<?php
			break;
		}
include_once("include/footer.php");

		?>
	</body>
</html>