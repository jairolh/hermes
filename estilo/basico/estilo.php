<?
/*
############################################################################
#    UNIVERSIDAD DISTRITAL Francisco Jose de Caldas                        #
#    Copyright: Vea el archivo LICENCIA.txt que viene con la distribucion  #
############################################################################
*/
/****************************************************************************

estilo.php

Paulo Cesar Coronado
Copyright (C) 2001-2007

Última revisión 6 de junio de 2007

******************************************************************************
* @subpackage
* @package	bloques
* @copyright
* @version      0.2
* @author      	Paulo Cesar Coronado
* @link		N/D
* @description  Definicion de estilos - es una pagina CSS
* @usage
*****************************************************************************/


   include_once("../../clase/config.class.php");
   include_once("tema.php");

   $esta_configuracion=new config();
   $configuracion=$esta_configuracion->variable("../../");

    if (!isset($mi_tema))
    {
        $mi_tema = "basico";

    }

?>


body, td, th, li
{
    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
}

body
{
	text-align:center;
}

th
{
    font-weight: bold;
    background-image: url(<?PHP echo $configuracion['host'].$configuracion['site'].$configuracion['estilo'].'/'.$mi_tema ?>/gradient.jpg);
}

DIV
{
	-moz-box-sizing:border-box;
	box-sizing:border-box;
	margin:0;
	padding:0;
}

a:link
{
    text-decoration: none;
    color: <? echo $tema->enlace ?>;
}

a:visited
{
    text-decoration: none;
    color: <? echo $tema->enlace ?>;
}

a:hover
{
    text-decoration: underline;
    color: <? echo $tema->sobre ?>;
}

a.enlace:link
{
    text-decoration: none;
    color: #FFFFFF;
}

a.enlace:visited {
    text-decoration: none;
    color: #FFFFFF;
}


a.linkHorizontal:link
{
    color: #000000;
}

a.linkHorizontal:visited {
    color: #000000;
}

a.linkHorizontal:hover {
    text-decoration: underline;
    color: <? echo $tema->sobreOscuro ?>;
     background-image: url(<?PHP echo $configuracion["host"].$configuracion["site"].$configuracion["estilo"].'/'.$mi_tema ?>/gradient2.jpg)
}

a.wiki:link
{
    text-decoration: none;
    color: #0000FF;
}

a.wiki:visited {
    text-decoration: none;
    color: #0000FF;
}

a.wiki:hover {
    text-decoration: underline;
    color: #FF0000;

}

hr.hr_subtitulo
{
	border: 0;
	color: #000000;
	background-color: #999999;
	height: 1px;
	width: 100%;
	text-align: left;
}

.fondoprincipal {
    background-color: <?PHP echo $tema->fondo?>;
}

.fondoPie {
    background-color: #e4e5db;
}

.fondoImportante
{
    background-color: <?PHP echo $tema->apuntado?>;;
}


.tabla_general {
    background-color: <?PHP echo $tema->cuerpotabla ?>;
    width:<?PHP echo $configuracion["tamanno_gui"]?>px;
    border-width: 1px;
    border-color: <?PHP echo $tema->bordes?>;
    border-style: solid;
    border-collapse: collapse;
    border-spacing: 0px;
    margin-left:auto;
    margin-right:auto;

}

form {
    margin-bottom: 0;
}


.highlight {
    background-color: <?PHP echo $tema->highlight?>;
}

.bloquelateral {
    border-width: 1px;
    border-color: <?PHP echo $tema->bordes?>;
    border-style: solid;
    -moz-border-radius-bottomleft: 10px;
    -moz-border-radius-bottomright: 10px;
    background-color: <?PHP echo $tema->cuerpotabla?>;
}

.bloquelateral_2 {
    border-width: 1px;
    border-color: <?PHP echo $tema->bordes?>;
    border-style: solid;
    background-color: <?PHP echo $tema->celda_clara?>;
    width:100%;

}


.seccion_B {
    background-color: <?PHP echo $tema->fondo_B ?>;
    width:<?PHP echo $configuracion["tamanno_gui"]*(0.2) ?>;
}


td.seccion_B
{
	width:<?PHP echo $configuracion["tamanno_gui"]*(0.2) ?>;
	border: 0px;
	border-collapse: collapse;
	border-spacing: 0px;
}

td.seccion_C
{
	width:<?PHP echo $configuracion["tamanno_gui"]*(0.6) ?>;
	border: 0px;
	border-collapse: collapse;
	border-spacing: 0px;
}


td.seccion_D
{
	width:<?PHP echo $configuracion["tamanno_gui"]*(0.2) ?>;
	border: 0px;
	border-collapse: collapse;
	border-spacing: 0px;
}

td.seccion_C_colapsada
{
	width:<?PHP echo $configuracion["tamanno_gui"]*(0.8) ?>;
	border: 0px;
	border-collapse: collapse;
	border-spacing: 0px;
}


.login_celda1
{
    background-color: #f4f5eb;
}

.cuadro_color
{
    background-color: #f4f5eb;
}

.cuadro_login {
    border-width: 1px;
    font-size: 12;
    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
    text-align: left;
}

.cuadro_plano {
    border-width: 1px;
    border:1px solid #AAAAAA;
    font-size: 12;
    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
    text-align: left;
}

.cuadro_print {
    border-width: 1px;
    border:1px solid #AAAAAA;
    font-size: 10;
    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
    text-align: left;
}

.cuadro_print_ruta {
    border-width: 1px;
    border:1px solid #AAAAAA;
    font-size: 14;
    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
    text-align: rigth;
}

.cuadro_simple {
    border-width: 0px;
    font-size: 12;
    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
    text-align: left;
    background-color: <?PHP echo $tema->celda_oscura?>;
}

.cuadro_corregir {
    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
    text-align: left;
    font-weight: bold;
    color: #FF0000;
}

<? /*===================Estilos de Texto ===================================*/
/**************Encabezado cuando se muestra un registro*********************/?>
.encabezado_registro
{
    border-width: 0px;
    font-size: 16;
    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
    text-align: left;
    font-weight: bold;
}
<? /***************************************************************************/?>

.texto_negrita {
    font-weight: bold;
}


.texto_subtitulo
{
    border-width: 0px;
    font-size: 14;
    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
    text-align: left;
    color:  <?PHP echo $tema->subtitulo?>;
}

.texto_elegante
{
    border-width: 0px;
    font-size: 14;
    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
    text-align: left;
    color:  <?PHP echo $tema->subtitulo?>;
}

.texto_azul
{
    color:#0000FF;
}

.texto_gris
{
    color:#555555;
}

.textoBlanco
{
    color:#FFFFFF;
}

.texto_titulo
{
    border-width: 0px;
    font-size: 18;
    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
    text-align: left;
    font-weight: bold;
    color:  <?PHP echo $tema->titulo?>;
}

.texto_pequeño
{
    border-width: 0px;
    font-size: 12;
    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
    
    color:  <?PHP echo $tema->subtitulo?>;
}

<? /*===================Estilos de Tablas ===================================*/?>

table.tablaBase
{
	width:100%;
	border-collapse: collapse;
}

table.tablaBase td
{
	padding: 0px;
	border: 0px;
	border-collapse: collapse;
	border-spacing: 0px;
	border-color: <?PHP echo $tema->bordes?>;
    	border-style: solid
}





table.tablaMarcoLateral
{
	width:100%;

}

table.tablaMarco
{
	width:100%;
	padding:10px;
	border-collapse: collapse;
	border-spacing: 0px;

}

table.tablaMarco td
{
	padding:5px;

}

table.tablaMarcoGeneral
{
	width:100%;
	padding:30px;
	border-collapse: collapse;
	border-spacing: 0px;

}

table.tablaMarcoGeneral td
{
	padding:10px;

}

table.tablaMarcoPequenno
{
	width:100%;
	padding:5px;

}


table.contenidotabla
{
	font-size: 10;
	font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
	text-align: justify;
	width:100%;
	border-collapse: collapse;
	border-spacing: 0px;
    }

table.contenidotabla td
{
	padding:3px;
}



table.Cuadricula
{
	font-size: 11px;
	font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
	width:100%;
	border:1px;
	border-collapse: collapse;
	border-spacing: 0px;
	border-color: <?PHP echo $tema->bordes?>;
    	border-style: solid;
}

table.Cuadricula td
{
	padding:3px;
	border:1px;
	border-collapse: collapse;
	border-spacing: 0px;
	border-color: <?PHP echo $tema->bordes?>;
    	border-style: solid;
}


table.tarjeton
{
	font-size: 12px;
	font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
	width:100%;
	border:0px;
	border-spacing: 2px;
	border-color: <?PHP echo $tema->bordes?>;
    	border-style: solid;
}

table.tarjeton td
{
	padding:5px;
	border:0px;
	border-spacing: 3px;
	border-color: <?PHP echo $tema->bordes?>;
    	border-style: solid;
}

.tabla_basico {
	background-color:#F9F9F9;
	border:1px solid #AAAAAA;
	font-size:95%;
	padding:5px;
	width:90%;
	margin-left:10%;
	margin-right:10%;
}


table.normalTarjeton
{
	font-size: 11px;
	font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
	width:100%;
	border:0px;
	border-collapse: collapse;
	border-spacing: 0px;
	border-color: <?PHP echo $tema->bordes?>;
<!--     	border-style: solid; -->
}

table.normalTarjeton td
{
	padding:3px;
	border:0px;
	border-collapse: collapse;
	border-spacing: 0px;
	border-color: <?PHP echo $tema->bordes?>;
<!--     	border-style: solid; -->
}


table.normalTarjeton tr
{
	padding:3px;
	border:0px;
	border-collapse: collapse;
	border-spacing: 0px;
	border-color: <?PHP echo $tema->bordes?>;
<!--     	border-style: solid; -->
}

.tabla_organizacion
{
	border:0px;
	padding:10px;
	width:100%;
}

.tabla_alerta {
	background-color:#fdffe5;
	border:1px solid #AAAAAA;
	font-size:95%;
	padding:5px;
	width:90%;
	margin-left:10%;
	margin-right:10%;
}


.posicionTarjeton {
	background-color:#fdffe5;
	padding:5px;
	margin-left:10%;
	margin-right:10%;
	text-align: center;
	font-size:20px;
	    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
    font-weight: bold;
}


.tabla_simple
{
	background-color:#FFFFF5;
	border:1px solid #CCCCCC;
	font-size:11px;
	width:100%;
	text-align: center;
}



.paginacentral {
    border-width: 1px;
    border-color: <?PHP echo $tema->bordes?>;
    border-style: solid;
    -moz-border-radius-bottomleft: 10px;
    -moz-border-radius-bottomright: 10px;
    -moz-border-radius-topleft: 10px;
    -moz-border-radius-topright: 10px;
    background-color: <?PHP echo $tema->cuerpotabla?>;
}

.bloquelateralencabezado {
    font-size: 13;
    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
    font-weight: bold;
    background-color: <?PHP echo $tema->encabezado?>;
<!--     background-image: url(<?PHP echo $configuracion["host"].$configuracion["site"].$configuracion["estilo"].'/'.$mi_tema ?>/gradient.jpg) -->
}

.bloquelateralcuerpo {
    font-size: 11;
    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
    }

.bloquecentralencabezado {
    font-size: 13;
    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
    font-weight: bold;
    background-color: <?PHP echo $tema->encabezado?>;
<!--     background-image: url(<?PHP echo $configuracion['host'].$configuracion['site'].$configuracion['estilo'].'/'.$mi_tema ?>/gradient.jpg) -->
}

.bloquecentralcuerpo {
    font-size: 12;
    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
    text-align: justify;
    }



.bloquelateralayuda {
    font-size: 10;
    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
    text-decoration: italic;
    }

.centralcuerpo {
    font-size: 12;
    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
    color: #0F0F0F;
    background-color: <?PHP echo $tema->encabezado?>;
<!--     background-image: url(<?PHP echo $configuracion['host'].$configuracion['site'].$configuracion['estilo'].'/'.$mi_tema ?>/gradient.jpg) -->
}

 .menuHorizontal {
    font-size: 12;
    text-align: center;
    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
    background-image: url(<?PHP echo $configuracion['host'].$configuracion['site'].$configuracion['estilo'].'/'.$mi_tema ?>/gradient.jpg)
}
.centralencabezado {
    font-size: 12;
    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
    text-align: center;
    background-color: <?PHP echo $tema->encabezado?>;
<!--     background-image: url(<?PHP echo $configuracion['host'].$configuracion['site'].$configuracion['estilo'].'/'.$mi_tema ?>/gradient.jpg) -->
}


.centrar
{
    text-align: center;
}

.derecha {
    text-align: right;
}

.textoCentral {
    font-size: 12;
    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
    }

<? /*===================Estilos Especificos para el Proyecto WebOffice===================================*/?>
.webofficeFondoOscuro
{
	background-color: #2d3750;
	heigth:10px;
}

#cuadroLogin
{
	position:relative;
	top:0px;
	left:0px;

}

#menu1
{
	list-style-image:url(<?PHP echo $configuracion['host'].$configuracion['site'].$configuracion['grafico'].'/'?>/bullet1.jpg);

}

#menu1 li
{
	padding: 2px 0px 0px 0px;
}

#divMenu2
{
	padding:0px 0px 0px 0px;
	heigth:10px;
	margin:0;
	padding:0;
}

#menu2 {
	list-style:none;
	margin:0;
	padding:0;
}

#menu2 li {
	margin:0px;
	padding:0px 5px 0px 5px;
	border:0px solid #CCCCCC;
	float:left;
	color:#FFFFFF;
	text-align:center;
}


#mensaje1
{
	padding:5px;
}

.textoNivel1
{
    font-size: 10px;
    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
}

html>body .textoNivel1
{
    font-size: 12;
    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
}


.textoNivel0
{
    font-size: 11;
    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
}

.textoTema
{
	color: #2d3750;
}

#notiCondor
{
	background-color:#EEEEEE;
	heigth:127px;


}

html>body #notiCondor
{
	background-image: url(<?PHP echo $configuracion['host'].$configuracion['site'].$configuracion['grafico'].'/login_principal'?>/index_2_5.jpg);

}

#noticiero
{
	position:relative;
	overflow:auto;
	margin:2px;
	padding:0px 5px 0px 5px;
	height:110px;
}


table.formulario td {
	border-width: 1px 1px 1px 1px;
	padding: 5px 5px 5px 5px;
	border-style: inset inset inset inset;
	border-color: #DEDEDE #DEDEDE #DEDEDE #DEDEDE;
	-moz-border-radius: 0px 0px 0px 0px;
}


table.formulario {
	border-width: 1px 1px 1px 1px;
	border-spacing: 2px;
	border-style: outset outset outset outset;
	border-color: #DEDEDE #DEDEDE #DEDEDE #DEDEDE;
	border-collapse: collapse;
	background-color:#FFFFFF;
	border:1px solid #DEDEDE;
	font-size:12px;
	padding:10px;
	width:100%;
}


table.tablaImportante
{
	border-width: 0px 0px 1px 15px;
	border-style:solid;
	border-color:#b30012;
	width:100%;
	padding:10px;
	border-collapse: collapse;
	border-spacing: 0px;

}

table.tablaImportante td
{
	padding:5px;
	background-color:#FFFFFF;

}

.botonGrande
{
	width:100px;
	height:100px;
	font-size:25px;
}

.numeroGrande
{
	font-size:70px;
}

.letraGrande
{
	font-size:34px;
}


table.tablaMenu
{
	border-width: 0px;
	border-style:solid;
	width:100%;
	padding:7px;
	border-collapse: collapse;
	border-spacing: 1px;


}

.titulo
{
    font-width:bold;
    font-size: 48;
    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
    text-align: left;

}
td.titulo{
	font-width:bold;
    font-size: 48;
    font-family: "Arial", Verdana, Trebuchet MS, Helvetica, sans-serif;
    text-align: left;
}

div.titulo{
	   background-color:#f7f7f7;

}

/* CSS para drag - drop */
#mainContainer{
		width:600px;
		margin:0 auto;
		margin-top:10px;
		border:1px solid #000;
		padding:2px;
}
	
#capitals{
		width:200px;
		float:left;
		border:1px solid #000;
		background-color:#E2EBED;
		padding:3px;
		height:400px;
}

#countries{
		width:300px;
		float:center;
		margin:2px;
		height:400px;
            
}	

.dragableBox,.dragableBoxRight{
		width:80px;
		height:20px;
		border:1px solid #000;
		background-color:#FFF;		
		margin-bottom:5px;
		padding:10px;
		font-weight:bold;
		text-align:center;
}

div.dragableBoxRight{
		height:65px;
		width:110px;
		float:left;
		margin-right:5px;
		padding:5px;
		background-color:#E2EBED;
}

dropBox{
		width:190px;
		border:1px solid #000;
		background-color:#E2EBED;
		height:400px;
		margin-bottom:10px;
		padding:3px;
		overflow:auto;
}		

a{
		color:#F00;
}
		
.clear{
		clear:both;
}

.caja_espacio{
    border-width: 1px;
    border-color: <?PHP echo $tema->bordes?>;
    border-style: solid;
    background-color: <?PHP echo $tema->celda_clara?>;
    width:100%;
    height:100%;

}

<!--.table { }
.table .row { }
.table .row .cell { display: inline-block; }-->

<!--.table { }
.table .row { clear: left; }
.table .row .cell{ float: left; }-->

div.tabla
{
	clear: none;
	overflow: auto;
}

div.fila
{
	clear: both;
}

div.col_titulo
{
	float: left;
	padding: 5px;
	background: #F0E0A0;
	border-color: #F0E0A0;
	border-style: solid;
	border-right-width: 0px;
	border-left-width: 0px;
	border-top-width: 0px;
	border-bottom-width: 1px;
}

div.col
{
	float: left;
	padding: 5px;
	border-color: #F0E0A0;
	border-style: solid;
	border-right-width: 0px;
	border-left-width: 0px;
	border-top-width: 0px;
	border-bottom-width: 1px;
}


#principal{
   border-width: 1px;
   border-color: <?PHP echo $tema->bordes?>;
   border-style: solid;
   width:100%;
}

#fila{
   border-width: 1px;
   border-color: <?PHP echo $tema->bordes?>;
   border-style: solid;
   width:100%;
  
}
#fila div{
   border-width: 1px;
   border-color: <?PHP echo $tema->bordes?>;
   border-style: solid;
   width:110px;
   height:100px;
   display:inline;
}

#bottom{position:absolute;bottom:0;width:100%}
