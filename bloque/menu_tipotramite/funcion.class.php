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
class registro_menutipotramite implements funcionRegistro
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
		
	?>
		
	<table align="center" class="tablaMenu">
	<tbody>
		<tr>
			<td >
				<table align="center" border="0" cellpadding="5" cellspacing="2" class="bloquelateral_2" width="100%">
					 <tr class="bloquelateralcuerpo">
						<td class="cuadro_simple">
						<a href="<?		
							$variable="pagina=adminTipoTramite";
							$variable.="&opcion=nuevo";
							$variable=$this->cripto->codificar_url($variable,$configuracion);
							echo $indice.$variable;		
							?>">  Registrar Nuevo Tramite</a>
						</td>
					</tr>
                          <? if($_REQUEST['id_tramite']){	?>
                                     	<tr class="bloquelateralcuerpo">
						<td class="cuadro_simple">
						<a href="<?		
							$variable="pagina=adminTipoTramite";
							$variable.="&opcion=nuevo_concepto";
							$variable.="&id_tramite=".$_REQUEST['id_tramite'];
                                                        $variable=$this->cripto->codificar_url($variable,$configuracion);
							echo $indice.$variable;		
							?>">  Relacionar concepto</a>
						</td>
					</tr>
                                        <tr class="bloquelateralcuerpo">
						<td class="cuadro_simple">
						<a href="<?		
							$variable="pagina=adminTipoTramite";
							$variable.="&opcion=nuevo_area";
                                                        $variable.="&id_tramite=".$_REQUEST['id_tramite'];
							$variable=$this->cripto->codificar_url($variable,$configuracion);
							echo $indice.$variable;		
							?>">  Relacionar Nueva &Aacute;rea</a>
						</td>
					</tr>
                          <? }
                          if($_REQUEST['id_area']){	?>              
                                         <tr class="bloquelateralcuerpo">
						<td class="cuadro_simple">
						<a href="<?		
							$variable="pagina=adminTipoTramite";
							$variable.="&opcion=consultar";
							$variable=$this->cripto->codificar_url($variable,$configuracion);
							echo $indice.$variable;		
							?>">  Consultar Tramite Asignados</a>
						</td>
					</tr>
                          <? }	?>              
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
