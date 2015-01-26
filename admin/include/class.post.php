<?php

require_once('config.php');

class post {
	
	private $_article;
   
    public function __construct() {
       $this->_article = array();
       $this->_article['id'] = 0000;
       $this->_article['title'] = null;
       $this->_article['title_en'] = null;
       $this->_article['body'] = null;
       $this->_article['body_en'] = null;
       $this->_article['data'] = null;
       $this->_article['attach'] = null;
       $this->_article['category'] = null;
        $this->_article['show'] = null;
    }


  
    function __get($propertyName) {
      if(!array_key_exists($propertyName, $this->_article))
        throw new Exception('Invalid property value!');
     
      if(method_exists($this, 'get' . $propertyName)) {
        return call_user_func(array($this, 'get' . $propertyName));
      } else {
        return $this->_article[$propertyName];
      }
    }

    function __set($propertyName, $value) {
      if(!array_key_exists($propertyName, $this->_article))
        throw new Exception('Invalid property value!');
     
      if(method_exists($this, 'set' . $propertyName)) {
        return call_user_func(
                 array($this, 'set' . $propertyName),
                  $value
                   );
      } else {
        $this->_article[$propertyName] = $value;
      }
    }
 
    function load($id) {
      if(strtotime($id) == -1) {
        throw new Exception("The id must be a valid number!");
      }
        global $_CONFIG;
        global $conn;

	   $query = "SELECT * FROM ".$_CONFIG['table_articoli']." where id=$id";
	 
	   $result = mysql_query($query, $conn) or die(mysql_error());
	   $row = mysql_fetch_assoc($result);
    
       $this->_article['id'] = $row['id'];
       $this->_article['title'] = $row['titolo'];
       $this->_article['title_en'] = $row['titolo_en'];
       $this->_article['body'] = $row['body'];
       $this->_article['body_en'] = $row['body_en'];
       $this->_article['data'] = $row['data'];
       $this->_article['attach'] = $row['allegato'];
       $this->_article['category'] = $row['category'];
       $this->_article['show'] = $row['public'];
    }
   
	function id() {
      return $this->id;
    }
	function title() {
      return $this->title;
    }
	function title_en() {
      return $this->title_en;
    }
	function body() {
      return $this->body;
    }
   	function body_en() {
      return $this->body_en;
    } 
    function show() {
      return $this->show;
    } 
    function category() {
      return $this->category;
    } 

   
  function ins_preview() {
  	  	
	global $_CONFIG;
	global $conn;
	
	$insertSQL = sprintf("INSERT INTO articoli (titolo, titolo_en, body, body_en, `data`, category) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['titolo'], "text"),
                       GetSQLValueString($_POST['titolo_en'], "text"),
                       GetSQLValueString($_POST['body'], "text"),
                       GetSQLValueString($_POST['body_en'], "text"),
                       GetSQLValueString($_POST['data'], "date"),
                       GetSQLValueString($_POST['category'], "text"));
  
  
    $query = "SELECT * FROM articoli ORDER by id DESC";
  
    mysql_select_db($_CONFIG['dbname'], $conn);
   
    $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
    $numero = mysql_query($query, $conn) or die(mysql_error());
    $row = mysql_fetch_assoc($numero);


    mysql_free_result($numero); 
  
    $this->_article['id'] = $row['id'];
    $this->_article['title'] = $row['titolo'];
    $this->_article['title_en'] = $row['titolo_en'];
    $this->_article['body'] = $row['body'];
    $this->_article['body_en'] = $row['body_en'];
    $this->_article['data'] = $row['data'];
    $this->_article['attach'] = $row['allegato'];
    $this->_article['category'] = $row['category'];
    $this->_article['show'] = $row['public'];
 
  }  	
    
function mod_show($show){
	
	global $_CONFIG;
	global $conn;
	 
	$id = $this->id;
 	$updateSQL = "UPDATE articoli SET public = $show WHERE id =$id;";
  
 	mysql_select_db($_CONFIG['dbname'], $conn);
  
  	$numero = mysql_query($updateSQL, $conn) or die(mysql_error());
  	
  	return $numero;
  		
	}
  
function edit_post($id) {
 
    $this->_article['id']=$id;
    $this->_article['title'] = $_POST['titolo'];
    $this->_article['title_en'] = $_POST['titolo_en'];
    $this->_article['body'] = $_POST['body'];
    $this->_article['body_en'] = $_POST['body_en'];
    $this->_article['data'] = $_POST['data'];
    $this->_article['attach'] = $_POST['allegato'];
    $this->_article['category'] = $_POST['category'];
    $this->_article['show'] = $_POST['public'];

	global $_CONFIG;
	global $conn;
	
  
    $updateSQL = sprintf("UPDATE articoli SET titolo=%s, titolo_en=%s, body=%s, body_en=%s  WHERE id=$id",
                       GetSQLValueString($_POST['titolo'], "text"),
                       GetSQLValueString($_POST['titolo_en'], "text"),
                       GetSQLValueString($_POST['body'], "text"),
                       GetSQLValueString($_POST['body_en'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

    mysql_select_db($_CONFIG['dbname'], $conn);
    $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());
       
    }

function del(){
    
    global $_CONFIG;
    global $conn;
    mysql_select_db($_CONFIG['dbname'], $conn);
    $query = "DELETE FROM articoli WHERE id = $this->id";
    
    $result = mysql_query($query, $conn) or die(mysql_error());

    return $result;
   
}

}
  
?>
