<?php include_once('include/function.php'); 
$log= login();

if ($log == 0) {
header('Location: login.php');
}
?>
<?php 
$self="preview.php";

if (isset($_GET['save'])) {
	$save=$_GET['save'];
}else $save=0;

if (isset($_GET['edit'])) {
	$edit=$_GET['edit'];
}else $edit=0;

if (isset($_GET['id'])) {
	$id=$_GET['id'];
}else $id=0;

if($save == 1){
	

    $post_public = new post();
    $post_public -> load($id);
    $result = $post_public -> mod_show($save);


        if ($result==1) {
            $insertGoTo = "index.php?id=$id";
            header(sprintf("Location: %s", $insertGoTo));
		}
        else echo "ERRORE, Contatta l'amministratore";
}

include_once('include/header.php'); 

echo "<div id=\"wrapper\">";
echo "<div id=\"content\">";				

echo "<h1><a href=\"post.php\">Nuovo Articolo</a> | <a href=\"index.php\">Articoli pubblicati</a><div class=\"step2\">Step</div></h1>";

	

if($save == 0) {
	
	if((isset($edit) && $edit == 1)){
        $post_preview = new post();
        $post_preview -> edit_post($id); 
    }

    else {
    	
        $post_preview = new post();
        $post_preview -> ins_preview();     
    }
    
    $id = $post_preview -> id();  
    $titolo = $post_preview -> title();
    $body = $post_preview -> body();
    $titolo_en = $post_preview -> title_en();
    $body_en = $post_preview -> body_en();
    $cat = $post_preview -> category();

    echo "<div class=\"preview\"><div class=\"anteprima\">Anteprima</div>";
    echo "<h1>Categoria</h1> <h2>$cat</h2> ";
    echo "<h1>Titolo in italiano</h1> <h2>$titolo</h2>";
    echo "<h1>Corpo del testo (italiano)</h1><p>$body</p>";
    echo "<h1>Titolo in inglese</h1> <h2>$titolo_en</h2>";
    echo "<h1>Corpo del testo (inglese)</h1><p>$body_en</p>";	
	 
	echo "<div id=\"tasti\">
	<table border=\"0\">

	<tr>
   
	<td>
    <a href=\"$self?save=1&id=$id\"><img src=\"image/accept.png\" alt=\"accept\" border=\"no\" /></a></td>
	<td><a href=\"edit?id=$id\"><img src=\"image/page_edit.png\" border=\"no\" ></a></td>
	<td><a href=\"delete.php?id=$id\"><img src=\"image/delete_g.png\" alt=\"Confirm\" border=\"no\" /></a></td>
    </tr>
    </table>
    </div>";

    echo " ";
    echo "</div>";
        
}
 ?> 

</div>
</div>
  
 <?php require_once('include/footer.php'); ?>