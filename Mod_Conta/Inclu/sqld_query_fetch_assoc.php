<?php

global $tableName; $tableName = "`".$_SESSION['clave']."admin`";
$sqld =  "SELECT * FROM $tableName WHERE `ref` = '$_SESSION[ref]' AND `Usuario` = '$_SESSION[Usuario]'";
$qd = mysqli_query($db, $sqld);
$rowd = mysqli_fetch_assoc($qd); 

?>