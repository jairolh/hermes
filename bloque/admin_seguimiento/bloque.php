<?
/*--------------------------------------------------------------------------------------------------------------------------
  @ Derechos de Autor: Vea el archivo LICENCIA.txt que viene con la distribucion
---------------------------------------------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------------------------------------------
* @name          bloque.php 
* @author        Paulo Cesar Coronado
* @revision      Última revisión 12 de enero de 2009
/*--------------------------------------------------------------------------------------------------------------------------
* @subpackage		bloqueAdminUsuario
* @package		bloques
* @copyright    	Universidad Distrital Francisco Jose de Caldas
* @version      	0.0.0.1 - Agosto 14 de 2009
* @author		Maritza Callejas Cely
* @author			Oficina Asesora de Sistemas
* @link			N/D
* @description  	Bloque para gestionar los usuarios del sistema Portal DW. Implementa los casos
*			de uso: 
*			Registrar cuenta de Usuario
*			Editar Datos de Usuario
*			Consultar Usuario
*			Cambiar el estado del Usuario
*			Cambiar Contraseña
/*--------------------------------------------------------------------------------------------------------------------------*/
if(!isset($GLOBALS["autorizado"]))
{
	include("../index.php");
	exit;		
}

include_once($configuracion["raiz_documento"].$configuracion["clases"]."/bloque.class.php");
include_once("funcion.class.php");
include_once("sql.class.php");

//Clase
class bloqueAdminSeguimiento extends bloque
{

	 public function __construct($configuracion)
	{
 		$this->sql = new sql_adminSeguimiento();
 		$this->funcion = new funciones_adminSeguimiento($configuracion, $this->sql);
 		
	}
	
	
	function html($configuracion)
	{		
		//Rescatar datos de sesion
		$usuario = $this->funcion->rescatarValorSesion($configuracion, $this->funcion->acceso_db, "usuario");
		$id_usuario = $this->funcion->rescatarValorSesion($configuracion, $this->funcion->acceso_db, "id_usuario");
		switch ($_REQUEST['opcion'])
		{ 
			case 'consultar':
		  		//Consultar usuario
                                $cod_Radica = array(id_rad => $_REQUEST['id_radica']);
				$this->funcion->consultarRadicado($configuracion,$cod_Radica);
				break;
                        
                       
                         default:
		  		//Consultar usuario
				$this->funcion->consultarRadicado($configuracion,"");
				break;	
				
		}//fin switch
		
	}// fin funcion html
	
	
	function action($configuracion)
	{
		switch($_REQUEST['opcion'])
		{	case "nuevo":
                    		$this->funcion->guardarRadicado($configuracion);
				break;
			
			default: 
				//recupera los datos para realizar la busqueda de usuario				
				$pagina = $configuracion["host"].$configuracion["site"]."/index.php?";
				$variable = "pagina=seguimiento";
				foreach ($_REQUEST as $clave => $valor) 
                                    {   if($clave!='pagina' && $clave!='action' && $clave!='index')
                                           { $variable.="&".$clave."=".$valor; }
                                    }
				
				include_once($configuracion["raiz_documento"].$configuracion["clases"]."/encriptar.class.php");
				$this->cripto = new encriptar();
				$variable = $this->cripto->codificar_url($variable,$configuracion);
				
				echo "<script>location.replace('".$pagina.$variable."')</script>";

				break;
		}//fin switch
	}//fin funcion action
	
	
}// fin clase bloqueAdminUsuario


// @ Crear un objeto bloque especifico

$esteBloque = new bloqueAdminSeguimiento($configuracion);


if(isset($_REQUEST['cancelar']))
{   unset($_REQUEST['action']);		
	$pagina = $configuracion["host"].$configuracion["site"]."/index.php?";
	$variable = "pagina=seguimiento";
	$variable .= "&opcion=consultar";
	include_once($configuracion["raiz_documento"].$configuracion["clases"]."/encriptar.class.php");
	$this->cripto = new encriptar();
	$variable = $this->cripto->codificar_url($variable,$configuracion);
	
	echo "<script>location.replace('".$pagina.$variable."')</script>";
}

//echo "action".$_REQUEST['action'];exit;
if(!isset($_REQUEST['action']))
{
	$esteBloque->html($configuracion);
}
else
{
	$esteBloque->action($configuracion);

}


?>


