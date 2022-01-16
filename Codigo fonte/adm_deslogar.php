<?php

session_start();

$_SESSION['macomp_codigo_usuario_adm_macomp'] = "";
	$_SESSION['macomp_nome'] = "";
	$_SESSION['macomp_usuario'] = "";
	$_SESSION['macomp_senha'] = "";
    
	session_destroy();
	
	
 echo '<script language="javascript">';
	   echo  'window.location.href = "index.php";';
	   echo '</script>';
	   
?>