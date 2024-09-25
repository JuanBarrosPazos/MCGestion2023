<?php

global $rutaModAdmin;
global $a;	$a = $_SESSION['Nombre']." ".$_SESSION['Apellidos'];
global $usertitle;		$usertitle = substr($a,0,18);
if(($_SESSION['Nivel']=="cliente")||($_SESSION['Nivel']=='caja')){
    print ("<div class='WellCome ocultahead'>".$usertitle."</br>Nivel: ".strtoupper($_SESSION['Nivel'])."</br>
    <img class='imgtitle' src='".$AdminClientesWeb."img_cliente/".$_SESSION['myimg']."' />
    </div>");
}else{
    print ("<div class='WellCome ocultahead'>".$usertitle."</br>Nivel: ".strtoupper($_SESSION['Nivel'])."</br>
    <img class='imgtitle' src='".$rutaModAdmin."Users/".$_SESSION['ref']."/img_admin/".$_SESSION['myimg']."' />
    </div>");
}

?>