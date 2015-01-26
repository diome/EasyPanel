<?php include_once('include/function.php'); 
$log= login();

if ($log == 0) {
header('Location: login.php');
}
?>

<? include_once('include/header.php'); ?> 


<?php
$id=$_GET['id'];

//Costruisce un oggetto post e carica gli elementi in variabili da mandare in output

$post_edit = new post();
$post_edit -> load($id);
   
$id = $post_edit -> id();  
$titolo = $post_edit -> title();
$body = $post_edit -> body();
$titolo_en = $post_edit -> title_en();
$body_en = $post_edit -> body_en();
$cat = $post_edit -> category();
?>

<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

<?php require_once('include/header.php'); ?>					
<div id="wrapper">
    <div id="content">
					         
<h1>Modifica | <a href="index.php">Articoli Pubblicati</a><div class="step1">Step</div></h1>

			    <form action="preview.php?edit=1&id=<?php print($id);?>&save=0" method="post" name="form2" id="form2">
					  <table align="center">
                        <tr valign="baseline">
                          <td nowrap="nowrap" align="right">Titolo in italiano:</td>
                          <td><input type="text" name="titolo" value="<?php echo htmlentities($titolo, ENT_COMPAT, 'iso-8859-1'); ?>" size="32" />
                        <div class="category">Categoria <input type="text" name="category" value="<?php echo htmlentities($cat, ENT_COMPAT, 'iso-8859-1'); ?>" size="20" /> </div>
                          </td>
                        </tr>
                      
                        <tr valign="baseline">
                          <td nowrap="nowrap" align="right" valign="top">Corpo del testo in italiano:</td>
                          <td><textarea name="body" cols="80" rows="10"><?php echo htmlentities($body, ENT_COMPAT, 'iso-8859-1'); ?></textarea>
                          </td>
                          </tr>
                            <tr valign="baseline">
                          <td nowrap="nowrap" align="right">Titolo in inglese:</td>
                          <td><input type="text" name="titolo_en" value="<?php echo htmlentities($titolo_en, ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
                        </tr>
                           <tr valign="baseline">
                          <td nowrap="nowrap" align="right" valign="top">Corpo del testo in inglese:</td>
                          <td><textarea name="body_en" cols="80" rows="10"><?php echo htmlentities($body_en, ENT_COMPAT, 'iso-8859-1'); ?></textarea>
                          </td>
                        </tr>
                                             
                		 <tr valign="baseline">
                          <td nowrap="nowrap" align="right">&nbsp;</td>
                          <td><input type="submit" value="modifica" /></td>
                        </tr>
                      </table>
                      <input type="hidden" name="MM_update" value="form2" />
                      <input type="hidden" name="edit_id" value="<?php echo $id; ?>" />
                    </form>
                    <p>&nbsp;</p>
                  <p>&nbsp;
					<br /> </p>
</div>
  </div>
             
 <?php require_once('include/footer.php'); ?>

