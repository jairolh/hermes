<?php
/*--------------------------------------------------------------------------------------------------------------------------
  @ Derechos de Autor: Vea el archivo LICENCIA.txt que viene con la distribucion
---------------------------------------------------------------------------------------------------------------------------*/
/*---------------------------------------------------------------------------------------
 |				Control Versiones				    	|	
 ----------------------------------------------------------------------------------------
 | fecha      |        Autor            | version     |              Detalle            |
 ----------------------------------------------------------------------------------------
 | 14/08/2009 | Jairo Lavado C.  	| 0.0.0.1     |                                 |
 ----------------------------------------------------------------------------------------
*/


if(!isset($GLOBALS["autorizado"]))
{
	include("../index.php");
	exit;		
}

include_once($configuracion["raiz_documento"].$configuracion["clases"]."/funcionGeneral.class.php");
include_once($configuracion["raiz_documento"].$configuracion["clases"]."/navegacion.class.php");

class funciones_adminConsulta extends funcionGeneral
{

	function __construct($configuracion, $sql)
	{
		//[ TO DO ]En futuras implementaciones cada usuario debe tener un estilo		
		//include ($configuracion["raiz_documento"].$configuracion["estilo"]."/".$this->estilo."/tema.php");
		include ($configuracion["raiz_documento"].$configuracion["estilo"]."/basico/tema.php");
		include_once($configuracion["raiz_documento"].$configuracion["clases"]."/encriptar.class.php");
		include_once($configuracion["raiz_documento"].$configuracion["clases"]."/log.class.php");

		$this->cripto = new encriptar();
		$this->log_us = new log();
		$this->tema = $tema;
		$this->sql = $sql;
		
		//Conexion General
		$this->acceso_db = $this->conectarDB($configuracion,"");
		
		//Datos de sesion
		
		$this->usuario = $this->rescatarValorSesion($configuracion, $this->acceso_db, "id_usuario");
		$this->identificacion = $this->rescatarValorSesion($configuracion, $this->acceso_db, "identificacion");
		
	}
	
	
	function nuevoRegistro($configuracion,$tema,$acceso_db)
	{
			
	}
	
   	function editarRegistro($configuracion,$tema,$id,$acceso_db,$formulario)
   	{						

	}
   	
   	function corregirRegistro()
    	{
	}
	
	function listaRegistro($configuracion,$id_registro)
	
    	{	
	}
		

	function mostrarRegistro($configuracion,$registro, $totalRegistros, $opcion, $variable)
    	{	
		switch($opcion)
		{
			case "multiplesRegistros":
				$this->multiplesRegistros($configuracion,$registro, $totalRegistros, $variable);
				break;
		
		}
		
	}
	
		
/*__________________________________________________________________________________________________
		
						Metodos especificos 
__________________________________________________________________________________________________*/


	
	function consultarRadicado($configuracion,$cod_radica){

		$this->formulario = "admin_radica";
                $indice=$configuracion["host"].$configuracion["site"]."/index.php?";	
                //var_dump($cod_radica);exit;
		if($cod_radica['id_rad'] == ""){
				
			$id_usuario = $this->usuario;
                       
			if ($_REQUEST['clave']){
                                $busquedaRadica = array( id_admin => $this->usuario,
                                                          vigencia => date('Y'), 
                                                          criterio_busqueda => $_REQUEST['criterio_busqueda'], 
                                                          valor => $_REQUEST['clave']);
				//$busqueda[1] = $_REQUEST['criterio_busqueda'];//tipo de consulta
				//$busqueda[2] = $_REQUEST['clave'];//cadena a buscar
				$cadena = "No hay Registros para la consulta.";
			}
			else{
				$cadena = "No Existen Radicados Registrados.";
			}	
                        //var_dump($busquedaUsuario);
    
			//Rescatar Usuarios, todos si es administrador general 
			if (is_array($busquedaRadica)){
                                
				$cadena_sql = $this->sql->cadena_sql($configuracion,$this->funcion->acceso_db,"radica_todos",$busquedaRadica);
			
			}		
			else{
				$cadena_sql = $this->sql->cadena_sql($configuracion,$this->funcion->acceso_db,"radica_todos","");
                            }
                            
			$registro_completo = $this->ejecutarSQL($configuracion, $this->acceso_db,$cadena_sql, "busqueda");

			//Obtener el total de registros
			$totalRegistros = $this->totalRegistros($configuracion, $this->acceso_db);

			$this->cadena_hoja = $cadena_sql;

			//Si no se viene de una hoja anterior
		 	if(!isset($_REQUEST["hoja"]))
			{
				$_REQUEST["hoja"] = 1;
			}
		
			$this->cadena_hoja .= " LIMIT ".(($_REQUEST["hoja"]-1) * $configuracion['registro']).",".$configuracion['registro'];		
			$registro = $this->ejecutarSQL($configuracion, $this->acceso_db, $this->cadena_hoja, "busqueda");
                       // var_dump($registro);
			if($totalRegistros)
			{	
				$hojas = ceil($totalRegistros / $configuracion['registro']);
			}
			else
			{
				$hojas = 1;
			}
			
			if(is_array($registro))
			{
				//evaluamos si existe mas de un usuario
				if($totalRegistros > 1)
				{
					$variable["pagina"] = "adminRadica";
					$variable["opcion"] = $_REQUEST["opcion"];
					$variable["hoja"] = $_REQUEST["hoja"];
                                        
					$menu = new navegacion();
					if($hojas > 1)
					{
						$menu->menu_navegacion($configuracion,$_REQUEST["hoja"],$hojas,$variable);
					}

					$this->mostrarRegistro($configuracion,$registro, $configuracion['registro'], "multiplesRegistros", "");
					$menu->menu_navegacion($configuracion,$_REQUEST["hoja"],$hojas,$variable);
				}
				else
				{
					//Consultar un usuario especifico
                                        $cod_radica['id_rad']=$registro[0]['ID_RAD'];
					$this->consultarRadicado($configuracion,$cod_radica);
				}
			}
			else
			{
				include_once($configuracion["raiz_documento"].$configuracion["clases"]."/alerta.class.php");
				
				alerta::sin_registro($configuracion,$cadena);
			}

		}
		else{
			//busca si existen registro de datos de usuarios en la base de datos 
                    
			$cadena_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"busqueda_radicado",$cod_radica);
                        
                        $datos_radica = $this->ejecutarSQL($configuracion, $this->acceso_db, $cadena_sql, "busqueda");
			//busca el estado del usuario
                        //busca los roles del usuario en la base de datos 
			$sol_tram_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"radica_tramites",$cod_radica);			
			$registro_tramite = $this->ejecutarSQL($configuracion, $this->acceso_db, $sol_tram_sql, "busqueda");			

			//Obtener el total de registros
			$totalRegistros = $this->totalRegistros($configuracion, $this->acceso_db);

			$this->cadena_hoja = $roles_sql;

			//Si no se viene de una hoja anterior
		 	if(!isset($_REQUEST["hoja"]))
			{
				$_REQUEST["hoja"] = 1;
			}
			$this->cadena_hoja .= " LIMIT ".(($_REQUEST["hoja"]-1) * $configuracion['registro']).",".$configuracion['registro'];		
			$sol_tram = $this->ejecutarSQL($configuracion, $this->acceso_db, $this->cadena_hoja, "busqueda");
			
			if($totalRegistros)
			{	
				$hojas = ceil($totalRegistros / $configuracion['registro']);
			}
			else
			{
				$hojas = 1;
			}
		
			//Obtener el total de registros
			$totalTramite = $this->totalRegistros($configuracion, $this->acceso_db);
			?>			
			<table width="90%" align="center" border="0" cellpadding="10" cellspacing="0" >
			<tbody>
								<tr>
				<td>
					<table width="100%" border="0" align="center" cellpadding="5 px" cellspacing="1px" >
					  <tr class="texto_subtitulo">
						<td>
							Consulta de Solicitud de Tramite<br>
								<hr class="hr_subtitulo">
						</td>
				 	  </tr>
					  <tr>
						<td>
							<table class='contenidotabla'>
								<tr >
                                                                    <td class='cuadro_plano centrar ancho10' >Radicado:</td>
									<td class='cuadro_plano '><? echo  $datos_radica[0]['VIG']."-".$datos_radica[0]['ID_TRAM']."-".$datos_radica[0]['NRO_RAD']?></td>
								</tr>	
								<tr >
									<td class='cuadro_plano centrar ancho10' >Oficio:</td>
									<td class='cuadro_plano '><? echo  $datos_radica[0]['COD_OF']?></td>
								</tr>
                                                                <tr >
									<td class='cuadro_plano centrar ancho10' >Dependencia</td>
									<td class='cuadro_plano '><? echo  $datos_radica[0]['DEPEN']?></td>
								</tr>
								<tr >
									<td class='cuadro_plano centrar ancho10' >Descripci&oacute;n:</td>
									<td class='cuadro_plano '><? echo  $datos_radica[0]['DESCR']?></td>
								</tr>
                                                                <tr >
									<td class='cuadro_plano centrar ancho10' >Fecha:</td>
									<td class='cuadro_plano '><? echo  $datos_radica[0]['FEC_REG']?></td>
								</tr>
								<tr >
									<td class='cuadro_plano centrar ancho10' >Tramite:</td>
									<td class='cuadro_plano '><? echo  $datos_radica[0]['TRAM']?></td>
								</tr>			
								<tr >
                                                                    <td class='cuadro_plano centrar ancho10' >Concepto:</td>
									<td class='cuadro_plano '><? echo  $datos_radica[0]['CONCEP']?></td>
								</tr>
                                                                <tr >
                                                                    <td class='cuadro_plano centrar ancho10' >Estado:</td>
									<td class='cuadro_plano '><? echo  $datos_radica[0]['EST']?></td>
								</tr>
                                                             
							</table>
						</td>
					  </tr>
					</table>
				   </td>
				</tr>
				<tr>
					<td>
				<?
				//Mostramos el menu de la paginación
				if($totalTramite > 0){
					$variable["pagina"] = "adminRadica";
					$variable["opcion"] = $_REQUEST["opcion"];
					$variable["hoja"] = $_REQUEST["hoja"];
					$variable["id_radica"] = $_REQUEST["id_radica"];
					$menu = new navegacion();

				?>
					</td>
				</tr>	
				<tr>
				    <td>
					<table width="100%" border="0" align="center" cellpadding="5 px" cellspacing="1px" >
					  <tr class="texto_subtitulo">
						<td>
							Descripci&oacute;n de Tramite<br>
								<hr class="hr_subtitulo">
						</td>
				 	  </tr>
					  <tr>
						<td>
							<table class='contenidotabla'>
								<tr class='cuadro_color'>
                                                                    <td class='cuadro_plano centrar ancho10' >&Aacute;rea</td>
									<td class='cuadro_plano centrar'>Registrado </td>
                                                                        <td class='cuadro_plano centrar'>Tramitado </td>
                                                                        <td class='cuadro_plano centrar'>Estado</td>
                                                                </tr>			

							<?
                                                        foreach($registro_tramite as $key => $value )
							{
								?><tr> 
									 <td class='cuadro_plano'><?php echo $registro_tramite[$key]['AREA'];?></td>  
                                                                         <td class='cuadro_plano'><?php echo $registro_tramite[$key]['FEC_REG'];?></td>    
									 <td class='cuadro_plano'><?php echo $registro_tramite[$key]['FEC_TRAM'];?></td>
                                                                         <td class='cuadro_plano'><?php echo $registro_tramite[$key]['EST'];?></td>
								  </tr>
                                                                <?php  
						
							}
							?>
							</table>
								</td>
							</tr>
					</table>
					</td>
				</tr>
				<tr>
					<td>
						<?
							$menu->menu_navegacion($configuracion,$_REQUEST["hoja"],$hojas,$variable);
			
						?>
					</td>
				</tr>

				<?
				}//fin if roles >0
				?>
			</tbody>
			</table>
			<?				
		}//fin else existe cod_usuario
	}//fin funcion consultar usuarios

       
        
	// funcion que muestra los datos de varios usuarios

	function multiplesRegistros($configuracion,$registro, $total, $variable)
	{
		include_once($configuracion["raiz_documento"].$configuracion["clases"]."/encriptar.class.php");
		$indice = $configuracion["host"].$configuracion["site"]."/index.php?";
		$cripto = new encriptar();
		
		?><table width="80%" align="center" border="0" cellpadding="10" cellspacing="0" >
			<tbody>
				<tr>
					<td >
						<table width="100%" border="0" align="center" cellpadding="5 px" cellspacing="1px" >
							<tr class="texto_subtitulo">
								<td>
								Solicitud de Tramite<br>
								<hr class="hr_subtitulo">
								</td>
							</tr>
							<tr>
								<td>
									<table class='contenidotabla'>
										<tr class='cuadro_color'>
											<td class='cuadro_plano centrar ancho10' >Radicado</td>
											<td class='cuadro_plano centrar'>Dependencia </td>
                                                                                        <td class='cuadro_plano centrar'>Tramite </td>
                                                                                        <td class='cuadro_plano centrar'>Fecha </td>
										</tr><?
                                                                                
                                                         foreach ($registro as $key => $value)
                                                                {     
                                                        		//Con enlace a la busqueda
									$parametro = "pagina=adminRadica";
									$parametro .= "&hoja=1";
									$parametro .= "&opcion=consultar";
									$parametro .= "&accion=consultar";
                                                                        $parametro .= "&id_radica=".$registro[$key]['ID_RAD'];
									$parametro = $cripto->codificar_url($parametro,$configuracion);
									echo "	<tr>    
                                                                                        <td class='cuadro_plano centrar'><a href='".$indice.$parametro."'>".$registro[$key]['VIG']."-".$registro[$key]['NRO_RAD']."</a></td>
										 	<td class='cuadro_plano centrar'>".$registro[$key]['DEPEN']."</td>    
                                                                                        <td class='cuadro_plano centrar'>".$registro[$key]['TRAM']."</td>
                                                                                        <td class='cuadro_plano centrar'>".$registro[$key]['FEC_REG']."</td>    
											
										</tr>";
		
			
								}//fin for 
								?>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class='cuadro_plano cuadro_brown'>
						<p class="textoNivel0">Por favor realice click sobre la solicitud que desee consultar.</p>
					</td>
				</tr>
			</tbody>
		</table>
		<?
	}//fin funcion multiples usuarios
		


} // fin de la clase
	

?>


                
                