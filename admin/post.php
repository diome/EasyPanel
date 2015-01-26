<?php include_once('include/function.php'); 
$log= login();

if ($log == 0) {
header('Location: login.php');
}
?>

<? include_once('include/header.php'); ?> 

<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

<?php require_once('include/header.php'); ?>					

<div id="wrapper">
	<div id="content">				
          
    <h1>Nuovo articolo | <a href="index.php">Articoli Pubblicati</a><div class="step1">Step</div></h1>
        <div class="inserisci">
					

					<form action="preview.php?save=0" method="post" name="form2" id="form2">
                      <table align="center" border="none">
                      <th COLSPAN="2" align="center"><h3>Articolo in italiano</h3>
                      </th>
                        <tr valign="baseline">
                          <td nowrap="nowrap" align="right">Titolo (italiano):</td>
                          <td><input type="text" name="titolo" value="Inserisci il titolo dell'articolo" size="32" />
                          <div class="category">Categoria<input type="text" name="category" value="Generale" size="20" /></div>
                          </td>
                        </tr>
                        
                        <tr valign="baseline">
                          <td nowrap="nowrap" align="right" valign="top">Corpo del testo:<br />(Italiano)</td>
                          <td><textarea name="body" cols="80" rows="10"></textarea>
                          </td>
                        </tr>
                        <th COLSPAN="2" align="center"><h3>Articolo in inglese</h3></th>

                        <tr valign="baseline">
                          <td nowrap="nowrap" align="right">Titolo (inglese):</td>
                          <td><input type="text" name="titolo_en" value="Inserisci il titolo dell'articolo" size="32" /></td>
                        </tr>
                        
                         <tr valign="baseline">
                          <td nowrap="nowrap" align="right" valign="top">Corpo del testo:<br />(inglese)</td>
                          <td><textarea name="body_en" cols="80" rows="10"></textarea>
                          </td>
                        </tr>
                        <tr valign="baseline">
                          <td nowrap="nowrap" align="right"><img src="image/calendar_day.png" alt="Calendar" border="no" /></td>
                          <td><input type="text" name="data" value="<?php echo date("Y-m-d");  ?>" size="11" /></td>
                           
                        </tr>
                        <tr valign="baseline">
                          <td nowrap="nowrap" align="right">&nbsp;</td>
                          <td><input type="submit" value="Anteprima" /></td>
                        </tr>
                      </table>
                  
                      <input type="hidden" name="MM_preview" value="form_p" />
                      <br />
                  </form>
                  
     </div>       
	</div>
  </div>

               <?php require_once('include/footer.php'); ?>

