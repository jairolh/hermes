<?php
// +----------------------------------------------------------------------
// | PHP Source                                                           
// +----------------------------------------------------------------------
// | Copyright (C) 2013 by Jairo Lavado 
// +----------------------------------------------------------------------
// |
// | Copyright: See COPYING file that comes with this distribution
// +----------------------------------------------------------------------
//
	require_once("../clase/encriptar.class.php");
	$crypto=new encriptar();
	
	echo $crypto->codificar("mysql")."<br>";//Motor
        echo $crypto->codificar("localhost")."<br>";//Servidor
        echo $crypto->codificar("hermes")."<br>";//DB;
        echo $crypto->codificar("hermes")."<br>";//Usuario
        echo $crypto->codificar("admin_hermes")."<br>";//Clave
        echo $crypto->codificar("hermes_")."<br>";//Prefijo
        
	
?>
