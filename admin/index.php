<? include_once('include/function.php'); 
$log= login();


if ($log == 0) {
header('Location: login.php');
}
?>

<? include_once('include/header.php'); ?> 

<div id="wrapper">
    <div id="content">

<?php
    
    //verifico se l'utente loggato è il super amministratore
    
    $su = superuser();

    
    if (isset($_GET['public'])){
    $public=$_GET['public'];
    }else $public=null;

    if (isset($_GET['id'])){
    $id=$_GET['id'];
    }else $id=000;

    if (isset($_GET['del'])){
    $del=$_GET['del'];
    }else $del=0;

    if(isset($public) && ($public==0)) $pub=0;
    else $pub=1;

    $currentPage = "index.php";
    $maxRows_Recordset1 = 10;
    $pageNum_Recordset1 = 0;

    if (isset($_GET['pageNum_Recordset1'])) {
        $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
    }

    $startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

    mysql_select_db($_CONFIG['dbname'], $conn);
    $query_Recordset1 = "SELECT * FROM articoli WHERE `public`=$pub ORDER BY id DESC";
    $query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
    $Recordset1 = mysql_query($query_limit_Recordset1, $conn) or die(mysql_error());
    $row_Recordset1 = mysql_fetch_assoc($Recordset1);

    if (isset($_GET['totalRows_Recordset1'])) {
      $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
    } else {
      $all_Recordset1 = mysql_query($query_Recordset1);
      $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
    }

    $totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

    $queryString_Recordset1 = "";
    if (!empty($_SERVER['QUERY_STRING'])) {
        $params = explode("&", $_SERVER['QUERY_STRING']);
        $newParams = array();
    foreach ($params as $param) {
        if (stristr($param, "pageNum_Recordset1") == false && 
            stristr($param, "totalRows_Recordset1") == false) {
        array_push($newParams, $param);
        }
    }
        if (count($newParams) != 0) {
            $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
        }
    }
    $queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);


?>


        <h1><a href="post.php">Nuovo articolo</a> | <a href="index.php">Articoli pubblicati</a> | <a href="index.php?public=0">Articoli non pubblicati</a> <?php if($su) echo "<a href=\"add-user.php\"> | Aggiungi utenti</a>"; ?>| <a href="logout.php">Logout</a> 
        </h1>
        <?php
  
        if ($del==1){ 
	       echo "<div class=\"post\">L'articolo &egrave stato cancellato con successo.</div>";
        } elseif (($del)&&($del==0)){
            echo "<div class=\"post\">L'articolo non &egrave stato cancellato. Verifica l'anomalia.</div>";
        }

        if ($id){ 
	       echo "<div class=\"post\">L'articolo &egrave stato pubblicato con successo.</div>";
	
        } ?>
        </h1>

		    <table border="0">
                <tr>
                        <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
                              <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">Prima Pagina <-</a>
                              <?php } // Show if not first page ?>
                        </td>
                        <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
                              <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">Avanti</a>
                              <?php } // Show if not first page ?>
                        </td>
                        <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
                              <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">Indietro</a>
                              <?php } // Show if not last page ?>
                        </td>
                        <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
                              <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">-> Ultima pagina</a>
                              <?php } // Show if not last page ?>
                        </td>
                </tr>
                <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                </tr>
            </table>
            <table border="1" align="center">
                <tr align="center">
                
                <div class="titoli">
                    <th COLSPAN="3"></th>
                </div>

                </tr> 
 
                    <tr align="center">
  	
                    <th><h3>Italiano</h3></th>
                    <th><h3>Inglese</h3></th>
    
                    <th><h3>Categorie</h3></th>
                    
                    <th WIDTH="70"><h3>data</h3></th>
                    <th><h3></h3></th>
                    <th><h3></h3></th>
                    <th><h3></h3></th>
                    </tr>
  
                    <?php do { ?>
                <tr>
                  
                    <td> <?php echo $row_Recordset1['titolo']; ?>&nbsp; </td>
                    <td><?php echo $row_Recordset1['titolo_en']; ?>&nbsp; </td>
      	            <td ALIGN="center"><?php echo $row_Recordset1['category'];?>&nbsp; </td>
    <!--           /* <td ><?php $attach=$row_Recordset1['allegato']; if ($attach <> 'null') echo $attach; ?>&nbsp;</td>*/ -->
                    <td ><?php echo $row_Recordset1['data']; ?>&nbsp; </td>

                    <td><a href="edit.php?id=<?php echo $row_Recordset1['id']; ?>"><img src="image/page_edit_2.png" border="no" ></a> </td>

                    <td><a href="delete.php?id=<?php echo $row_Recordset1['id']; ?>"> <img src="image/cross_circle.png" border="no"> </a> </td>
	                
    
                </tr>
                <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
            </table>
            <br />
            <table border="0">
                <tr>
                    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">Prima pagina <-</a>
                    <?php } // Show if not first page ?>
                    </td>
                    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
                        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">Avanti</a>
                        <?php } // Show if not first page ?>
                    </td>
                    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">Indietro</a>
                        <?php } // Show if not last page ?>
                    </td>
                    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">-> Ultima pagina</a>
                        <?php } // Show if not last page ?>
                    </td>
                </tr>
            </table>
            articoli da <?php echo ($startRow_Recordset1 + 1) ?> a <?php echo min($startRow_Recordset1 + $maxRows_Recordset1, $totalRows_Recordset1) ?> su <?php echo $totalRows_Recordset1 ?>
    <p>&nbsp;</p>
    </div>
    </div>
 <?php
    mysql_free_result($Recordset1);

?> 
<? 
include_once('include/footer.php'); ?> 


