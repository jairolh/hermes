<?
/***************************************************************************
  
index.php 

Paulo Cesar Coronado
Copyright (C) 2001-2005

Última revisión 6 de Marzo de 2006

*****************************************************************************
* @subpackage   
* @package	bloques
* @copyright    
* @version      0.2
* @author      	Paulo Cesar Coronado
* @link		N/D
* @description  Menu principal del bloque entidades de salud
* @usage        
*****************************************************************************/
if(!isset($GLOBALS["autorizado"]))
{
	include("../index.php");
	exit;		
}


include_once($configuracion["raiz_documento"].$configuracion["clases"]."/encriptar.class.php");

$indice=$configuracion["host"].$configuracion["site"]."/index.php?";
$indiceSeguro=$configuracion["host"].$configuracion["site"]."/index.php?";
$cripto=new encriptar();
?><table align="center" class="tablaMenu">
	<tbody>
		<tr>
			<td >
				<table align="center" border="0" cellpadding="5" cellspacing="2" class="bloquelateral_2" width="100%">
				<?/*?>	<tr class="bloquelateralcuerpo">
						<td class="cuadro_simple">
						<a href="<?		
							$variable="pagina=crearPagina";
							$variable=$cripto->codificar_url($variable,$configuracion);
							echo $indice.$variable;		
							?>">  Crear Pag&iacute;na</a>
							
						</td>
					</tr>
					<tr class="bloquelateralcuerpo">
						<td class="cuadro_simple">
						<a href="<?		
							$variable="pagina=editarContenido";
							$variable=$cripto->codificar_url($variable,$configuracion);
							echo $indice.$variable;		
							?>">  Editar Contenido Pag&iacute;na</a>
							
						</td>
					</tr>
					<tr class="bloquelateralcuerpo">
						<td class="cuadro_simple">
						<a href="<?		
							$variable="pagina=adminUsuario";
							$variable=$cripto->codificar_url($variable,$configuracion);
							echo $indice.$variable;		
							?>">  Adminisrar Usuarios</a>
							
						</td>
					</tr><?*/?>
					<tr class="bloquelateralcuerpo">
						<td class="cuadro_simple">
						<a href="<?		
							$variable="pagina=adminNoticia";
							$variable=$cripto->codificar_url($variable,$configuracion);
							echo $indice.$variable;		
							?>">  Administrar Noticias</a>
							
						</td>
					</tr>
					<tr class="bloquelateralcuerpo">
						<td class="cuadro_simple">
						<a href="<?		
							$variable="pagina=adminUsuario";
							$variable=$cripto->codificar_url($variable,$configuracion);
							echo $indice.$variable;		
							?>">  Administrar Usuarios</a>
							
						</td>
					</tr>
					<tr class="bloquelateralcuerpo">
						<td class="cuadro_simple">
						<a href="<?		
							$variable="pagina=adminTipoTramite";
							$variable=$cripto->codificar_url($variable,$configuracion);
							echo $indice.$variable;		
							?>">  Administrar Tipo de Tramite</a>
							
						</td>
					</tr>                                        
				</table>
			</td>
		</tr>
	</tbody>
</table>
