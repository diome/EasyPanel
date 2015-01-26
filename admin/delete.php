<?php include_once('include/function.php'); 

// richiama la funzione login() per controllare il tipo di accesso dell'utente. Se la funzione restituisce 0 
// reindirizza la pagina a login.php

$log= login();

if ($log == 0) {
header('Location: login.php');
}


    $confirm = $_GET['confirm'];
    $id_delete = $_GET['id']; 

// se risultano esistenti le variabili lette dalla funzione $_GET si procede alla cancellazione dell'articolo

    if ($id_delete && $confirm) {
        $post_del = new post();
             
        $post_del -> load($id_delete);
       
       $result = $post_del -> del();
      
        $insertGoTo = "index.php?del=$result";
        header(sprintf("Location: %s", $insertGoTo));
		
    }
   
// l'header è richiamato in questo punto perchè per le funzioni di reindirizzamento richiamate prima è necessario che
// nessun output a monitor sia visibile prima.
   
    require_once('include/header.php'); 
?>

<div id="wrapper">
    <div id="content">				
          
    <h1><a href="post.php">Nuovo articolo</a> | <a href="index.php">Articoli pubblicati</a></h1>

    <?php
    
    if (!$id_delete && !$confirm) {
        echo "<h3>Non hai selezionato nessun articolo. Torna Alla home e selezionalo.</h3>";
    }
  

    if ($id_delete && !$confirm) {
    
        $post_del = new post();
        $post_del -> load($id_delete);
     
        $id = $post_del -> id();  
        $titolo = $post_del -> title();
        $body = $post_del -> body();
        $titolo_en = $post_del -> title_en();
        $body_en = $post_del -> body_en();
        $cat = $post_del -> category();

    
        echo "<div class=\"preview\"><div class=\"anteprima\">Anteprima</div>";
        echo "<h1>Categoria</h1> <h2>$cat</h2>";
        echo "<h1>Titolo in italiano</h1> <h2>$titolo</h2>";
        echo "<h1>Corpo del testo in italiano</h1><p>$body</p>";
        echo "<h1>Titolo in inglese</h1> <h2>$titolo_en</h2>";
        echo "<h1>Corpo del testo in inglese</h1><p>$body_en</p>";

   
    echo "<h3>Sicuro di voler cancellare l'articolo?</h3>
    <table>
        <tr>
            <td><a href=\"delete.php?id=$id_delete&confirm=1\"><img src=\"image/accept.png\" alt=\"Confirm\" border=\"no\" /></a></td>
            <td><a href=\"index.php\"><img src=\"image/delete_g.png\" alt=\"annulla\" border=\"no\" /></a></td>
        </tr>

   </table>";

}


?>

</div>
</div>

</div>
<?php require_once('include/footer.php'); ?>
