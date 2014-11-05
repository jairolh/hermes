<?php
/*--------------------------------------------------------------------------------------------------------------------------
  @ Derechos de Autor: Vea el archivo LICENCIA.txt que viene con la distribucion
---------------------------------------------------------------------------------------------------------------------------*/

if(!isset($GLOBALS["autorizado"]))
{
	include("../index.php");
	exit;		
}

include_once($configuracion["raiz_documento"].$configuracion["clases"]."/encriptar.class.php");
include_once($configuracion["raiz_documento"].$configuracion["clases"]."/funcionRegistro.class.php");
include_once($configuracion["raiz_documento"].$configuracion["clases"]."/sesion.class.php");
//@ Clase que contiene los métodos que ejecutan tareas y crean los botones del menú
class registro_menuConsulta implements funcionRegistro
{
	//@ Método costructor que crea el objeto sql de la clase sql_noticia y el objeto cripto de la clase encriptar	
	function __construct($configuracion)
	{
		//[ TO DO ]En futuras implementaciones cada usuario debe tener un estilo		
		//include ($configuracion["raiz_documento"].$configuracion["estilo"]."/".$this->estilo."/tema.php");
		//$this->tema=$tema;
		
		//$this->sql=new sql_menuproyecto();
		$this->cripto=new encriptar();
	}
	
	// @ Método que crea el los botones del menu de usuarios 
	function nuevoRegistro($configuracion,$tema,$acceso_db)
	{
		$indice=$configuracion["host"].$configuracion["site"]."/index.php?";
        $formulario="adminConsulta";
	$validar="control_vacio(".$formulario.",'clave')";
                
                
	?>

		
	<table align="center" class="tablaMenu">
	<tbody>
		<tr>
			<td >
				<table align="center" border="0" cellpadding="5" cellspacing="2" class="bloquelateral_2" width="100%">
					<tr class="bloquelateralcuerpo">
						<td class="cuadro_simple">
						<form enctype='multipart/form-data,text/plain' method='POST' action='index.php' name='adminConsulta'>
						<table width="100%" border="1">
						<tr class="texto_subtitulo">
							<td class="cuadro_simple">Consultar Radicado:
								<hr class="hr_subtitulo">
							</td>
						</tr>
				
						<tr class="texto_subtitulo">
							<td class="cuadro_simple">
							
							<input type ='radio' name='criterio_busqueda' value='NUM_RAD' <? if (!$_REQUEST['criterio_busqueda'] OR $_REQUEST['criterio_busqueda']=='NUM_RAD') {?>CHECKED <? }?>>Vigencia-Tramite-Radicado<br>
							<!--<input type ='radio' name='criterio_busqueda' value='FECHA' <? if ($_REQUEST['criterio_busqueda']=='FECHA') {?>CHECKED <? }?>> Fecha (aaaa-mm-dd)<br>-->
							</td>
						</tr><tr class="texto_subtitulo">
							<td class="cuadro_simple">
							<input type='text' name='clave' size="20" maxlength='50' <? if(isset($_REQUEST['clave'])){?> value='<? echo $_REQUEST['clave'];?>'<? }?> />
							</td>
						</tr>
                                                
						<tr>
							<td class="cuadro_simple">
							<input type='hidden' name='action' value='admin_consulta'/>
							<input type='hidden' name='opcion' value='consultar'/>
                                                        <input type='hidden' name='opcion' value='mostrar'> 
							  <center><input name="consultar" value="Consultar" type="button" onclick="if(<?echo $formulario?>.clave.value!=''){ document.forms['<?echo $formulario?>'].submit();};return(<? echo $validar; ?>)? document.forms['<? echo $formulario?>'].submit():false" tabindex='<? echo $tab++ ?>'/><br> </center>
							</td>
						</tr>
						</table>
						</form>
						</td>
					</tr>
					
				</table>
			</td>
		</tr>

	</tbody>
</table>
	<?
	}
	
	
	function editarRegistro($configuracion,$tema,$id_entidad,$acceso_db,$formulario)
	{
		
	}
		
	function mostrarRegistro($configuracion,$tema,$id_entidad, $acceso_db, $formulario)
	{
				
	}
		
	function corregirRegistro()
	{
	
	}
	
	function procesarRegistro($configuracion)
	{
	}
	//@ Método realiza la conexion con la base de datos.
	function conectarDB($configuracion)
	{
		$this->acceso_db=new dbms($configuracion);
		$this->enlace=$this->acceso_db->conectar_db();
		if (is_resource($this->enlace))
		{
				return $this->acceso_db;
		}
		else
		{
			die("Imposible conectarse a la base de datos");
		}
	}	
}
?>
