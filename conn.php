<?php
try{
    $pdo = new PDO("mysql:host=localhost;dbname=management","root","");
    echo "Successfully connected to the database";
    echo "<br />";
   

}catch(Exception $e){
    die('Error:' . $e->getMessage());

}
?>