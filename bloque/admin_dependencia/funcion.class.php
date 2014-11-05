<?php
/*--------------------------------------------------------------------------------------------------------------------------
  @ Derechos de Autor: Vea el archivo LICENCIA.txt que viene con la distribucion
---------------------------------------------------------------------------------------------------------------------------*/
/*---------------------------------------------------------------------------------------
 |				Control Versiones				    	|	
 ----------------------------------------------------------------------------------------
 | fecha      |        Autor            | version     |              Detalle            |
 ----------------------------------------------------------------------------------------
 | 14/08/2009 | Maritza Callejas C.  	| 0.0.0.1     |                                 |
 ----------------------------------------------------------------------------------------
*/


if(!isset($GLOBALS["autorizado"]))
{
	include("../index.php");
	exit;		
}

include_once($configuracion["raiz_documento"].$configuracion["clases"]."/funcionGeneral.class.php");
include_once($configuracion["raiz_documento"].$configuracion["clases"]."/navegacion.class.php");

class funciones_adminRadica extends funcionGeneral
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
		$this->form_radicado($configuracion,$registro,$this->tema,"");
		
	}
	
   	function editarRegistro($configuracion,$tema,$id,$acceso_db,$formulario)
   	{						
		$this->cadena_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"usuario",$id);
		$registro = $this->acceso_db->ejecutarAcceso($this->cadena_sql,"busqueda");
		if ($_REQUEST['opcion'] == 'cambiar_clave')
		{
		$this->formContrasena($configuracion,$registro,$this->tema,'');
		}
		else
		{
		$this->form_usuario($configuracion,$registro,$this->tema,'');
		}
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


	function form_radicado($configuracion,$registro,$tema,$estilo)
	{
		$indice=$configuracion["host"].$configuracion["site"]."/index.php?";

		/*****************************************************************************************************/
		include_once($configuracion["raiz_documento"].$configuracion["clases"]."/html.class.php");
		
		$enlace = $this->acceso_db;
		$id_usuario = $this->usuario;
				
		$html = new html();
		$tab = 1;
		$this->formulario = "admin_usuario";
                $this->verificar .= "seleccion_valida(".$this->formulario.",'id_dep')";
                $this->verificar .= "&& seleccion_valida(".$this->formulario.",'id_tram')";
                $this->verificar .= "&& seleccion_valida(".$this->formulario.",'id_doc')";
                $this->verificar .= "&& control_vacio(".$this->formulario.",'nro_oficio')";
                $this->verificar .= "&& control_vacio(".$this->formulario.",'desc_sol')";
	
		?>
		<script src="<? echo $configuracion["host"].$configuracion["site"].$configuracion["javascript"]  ?>/funciones.js" type="text/javascript" language="javascript"></script>
		<script src="<? echo $configuracion["host"].$configuracion["site"].$configuracion["javascript"]  ?>/md5.js" type="text/javascript" language="javascript"></script>		

		<form enctype='multipart/form-data' method='POST' action='index.php' name='<? echo $this->formulario;?>'>
		<hr>
		
		<table width='80%' height="45" valign="top" >		
		<tr>
			<td colspan="5"><font color="red" size="-2"  ><br>Todos los campos marcados con ( * ) son obligatorios. <br></font></td>
		</tr>
		</table>
		
		<table width='80%'  class='formulario'  align='center'>
		<tr class='bloquecentralcuerpobeige'><td  colspan='3'><hr class='hr_subtitulo'/>
			<? if(!$registro)		
				echo "REGISTRAR SOLICITUD DE TRAMITE";
			   else
				echo "EDITAR SOLICITUD DE TRAMITE";

			?>
		<hr class='hr_subtitulo'/></td></tr>
                <tr>
			<td width='30%'><?
				$texto_ayuda = "<b>Dependencia que solicita realizar el tramite.</b><br> ";
				?><font color="red" >*</font><span onmouseover="return escape('<? echo $texto_ayuda?>')">Dependencia:</span>
			</td>
			<td>
                        <?	//Evaluamos el rol del usuario actual en el sistema, si es administrador general no tiene 
				//restricciones en roles; si NO es administrador general, no puede crear usuarios con rol Administrador 
				//general
                           			              
				if(!$registro)
                                    { $busquedaDep = $this->sql->cadena_sql($configuracion,$this->funcion->acceso_db,"listar_dep","");
                                      $depart=$html->cuadro_lista($busquedaDep,'id_dep',$configuracion,-1,2,FALSE,$tab++,'id_dep');
                                    }
                                 else
                                    { $busquedaDep = $this->sql->cadena_sql($configuracion,$this->funcion->acceso_db,"buscar_dep",$registro);
                                      $depart=$html->cuadro_lista($busquedaDep,'id_dep',$configuracion,0,3,FALSE,$tab++,'id_dep');
                                    }
                        	echo $depart;
                  
			?>	
				 
			</td>
		</tr>		
                
                <tr>
			<td width='30%'><?
				$texto_ayuda = "<b>Tramite que se solicita realizar.</b><br> ";
				?><font color="red" >*</font><span onmouseover="return escape('<? echo $texto_ayuda?>')">Tramite:</span>
			</td>
			<td>
                        <?
                               $configuracion["ajax_function"]="xajax_DOCUMENTO";
                               $configuracion["ajax_control"]="id_tram";
				if(!$registro)
                                    { $busqueda_tram = $this->sql->cadena_sql($configuracion,$this->funcion->acceso_db,"listar_tram","");
                                      $tram=$html->cuadro_lista($busqueda_tram,'id_tram',$configuracion,-1,2,FALSE,$tab++,'id_tram');
                                    }
                                 else
                                    { $busqueda_tram = $this->sql->cadena_sql($configuracion,$this->funcion->acceso_db,"buscar_tram",$registro);
                                      $tram=$html->cuadro_lista($busqueda_tram,'id_tram',$configuracion,0,3,FALSE,$tab++,'id_tram');
                                    }
                        	echo $tram;
                  
			?>	
				 
			</td>
		</tr>	
                
                <tr>
			<td width='30%'><?
				$texto_ayuda = "<b>Concepto con el que solicita el tramite.</b><br> ";
				?><font color="red" >*</font><span onmouseover="return escape('<? echo $texto_ayuda?>')">Concepto:</span>
			</td>
			<td><?
                                if(!$registro)		
                                 { ?><div id="docTram"><?
                                        $doc_tram=$html->cuadro_lista("",'id_doc',$configuracion,-1,0,FALSE,$tab++,'id_doc');
                                        echo $doc_tram;?>
                                      </div><?
                                    }
                                else
                                {  $busquedaDoc = $this->sql->cadena_sql($configuracion,$this->funcion->acceso_db,"buscar_doc",$registro);
                                   $doc_tram=$html->cuadro_lista($busquedaDoc,'id_doc',$configuracion,$registro[0]['ID_DOC'],3,FALSE,$tab++,'id_doc');
                                   echo $doc_tram;
                                }?>
       			</td>
		</tr>	
		<tr>
			<td width='30%'><?
				$texto_ayuda = "<b>Número del documento con que radica.</b><br> ";
				?><font color="red" >*</font><span onmouseover="return escape('<? echo $texto_ayuda?>')">N&uacute;mero Oficio:</span>
			</td>
			<td>
				<input type='text' name='nro_oficio' value='<? echo $registro[0][2] ?>' size='40' maxlength='16' tabindex='<? echo $tab++ ?>' />
			</td>
		</tr>		
		<tr>
			<td width='30%'><?
				$texto_ayuda = "<b>Descripción del tramite solicitado.</b><br> ";
				?><span onmouseover="return escape('<? echo $texto_ayuda?>')">Descripci&oacute;n:</span>
			</td>
			<td>
				<textarea  name='desc_sol' cols='51' rows='3' tabindex='<? echo $tab++ ?>' value='<? echo $registro[0][3] ?>'></textarea>
			</td>
		</tr>		
			
		</table>
		<table align='center'>
		  <tr align='center'>
			<td colspan='2' rowspan='1'>
                                <input type='hidden' name='usuario' value='<? echo $_REQUEST["usuario"] ?>'>
                     		<input type='hidden' name='action' value='admin_radica'/>
	    			<input type='hidden' name='opcion' value='nuevo'>
				
                                <!--<input value="Guardar" name="aceptar" tabindex='?= $tab++ ?>' type="button" onclick="if(?= $this->verificar; ?>){?echo $this->formulario?>.contrasena.value = hex_md5(?echo $this->formulario?>.contrasena.value);?echo $this->formulario?>.reescribir_contrasena.value = hex_md5(?echo $this->formulario?>.reescribir_contrasena.value);document.forms['? echo $this->formulario?>'].submit()}else{false}"/>-->
                                <input value="Guardar" name="aceptar" tabindex='<?= $tab++ ?>' type="button" onclick="if(<?= $this->verificar; ?>){document.forms['<? echo $this->formulario?>'].submit()}else{false}"/>
    			<input name='cancelar' value='Cancelar' type='submit' tabindex='<?= $tab++ ?>'>
				<br>
			</td>
 		  </tr> 
		</table>

		</form>		
	<?php
	} // fin function form_usuario

	// funcion que guarda los datos del nuevo usuario

	function guardarRadicado($configuracion){
			  
		//rescata los valores para ingresar los datos del usuario
		//----------------------------------------------------
            
             //list($d,$m,$a)=explode("/",$_REQUEST["fecha_inactiva"]);
             $nvo_rad=array(    cod_usuario => $this->usuario,
                                cod_dep => $_REQUEST['id_dep'],
                                cod_tram => $_REQUEST['id_tram'],
                                cod_doc => $_REQUEST['id_doc'],
                                nro_rad => '',
                                vigencia => date('Y'),
                                nro_oficio => $_REQUEST['nro_oficio'],
                                descr => $_REQUEST['desc_sol'],    
                                fecha_registro => date('Y-m-d H:i:s'),
                                estado => '2');
                //var_dump($nvo_rad);//exit;
                $num_rad_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"numero_rad",$nvo_rad);
		$rs_num_rad = $this->ejecutarSQL($configuracion, $this->acceso_db, $num_rad_sql,"busqueda");
		
                if ($rs_num_rad[0]['NRO_RAD']>0)
                    { $nvo_rad['nro_rad']=($rs_num_rad[0]['NRO_RAD']+1);}  
                else{ $nvo_rad['nro_rad']=1;}
                //var_dump($nvo_rad);    
		//evaluamos si el usuario existe
		$existe_rad_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"busqueda_oficio",$nvo_rad);
                $rs_existe_rad = $this->ejecutarSQL($configuracion, $this->acceso_db, $existe_rad_sql,"busqueda");
		//var_dump($rs_existe_rad);    EXIT;
		if(!$rs_existe_rad){ 
			//ejecuta el ingreso del usuario
                        //var_dump($nvo_rad);
                    
			$radica_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"inserta_rad",$nvo_rad);
			@$rs_radica = $this->ejecutarSQL($configuracion, $this->acceso_db, $radica_sql,"");
                        //consultamos el area 2 del tramite
                	$area_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"buscar_area_tramite",$nvo_rad);
			@$rs_area = $this->ejecutarSQL($configuracion, $this->acceso_db, $area_sql,"busqueda");
                                                                        
                	//consultamos el identificador del nuevo registro			
			$nvo_radica_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"busqueda_radicado",$nvo_rad);
			$rs_nvo_radica = $this->ejecutarSQL($configuracion, $this->acceso_db, $nvo_radica_sql,"busqueda");
                        //  var_dump($rs_nvo_radica);
                        
                        $nvo_tram=array(
                                cod_rad => $rs_nvo_radica[0]['ID_RAD'],
                                cod_area => $rs_area[0]['ID_AREA'],
                                cod_usuario => '0',
                                fecha_registro => $rs_nvo_radica[0]['FEC_REG'],
                                estado => '4');
                        
                        //registra el inicio del tramite en el area 2 del tipo_tramite
                        $tramite_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"insertar_tramite",$nvo_tram);
			@$rs_tramita = $this->ejecutarSQL($configuracion, $this->acceso_db, $tramite_sql,"");
                                                         
			$variable = "pagina=adminRadica";
			$variable .= "&opcion=imprimir";
                        $variable .= "&id_radica=".$nvo_tram['cod_rad'];
			if ($rs_nvo_radica){
							
				//VARIABLES PARA EL LOG
				$registro[0] = "REGISTRAR";
				$registro[1] = $nvo_rad['cod_rad'];
				$registro[2] = "RADICADO";
				$registro[3] = $nvo_rad['vigencia']."-".$nvo_rad['nro_rad'];
				$registro[4] = time();
				$registro[5] = "Registra radicado ". $nvo_rad['vigencia']."-".$nvo_rad['nro_rad'];
				$registro[5] .= " de la dependencia ".$nvo_rad['cod_dep'];
				$registro[5] .= ", para el tramite ".$nvo_rad['cod_tram'];
                                $registro[5] .= ", en el concepto ".$nvo_rad['cod_doc'];
				$this->log_us->log_usuario($registro,$configuracion);
				echo "<script>alert('Radicado registrado con exito!')</script>";
			}
			else
			{
				echo "<script>alert('No es posible Registrar el radicado en este momento')</script>";
			}

		}//fin if NO existencia de usuario	
		else{
			$variable = "pagina=adminRadica";
			$variable .= "&opcion=nuevo";
			echo "<script>alert('YA EXISTE UNA SOLICITUD DE TRAMITE CON EL OFICIO ".$nvo_rad['nro_oficio']." PARA LA VIGENCIA ".$nvo_rad['vigencia']."')</script>";
		}
		$pagina = $configuracion["host"].$configuracion["site"]."/index.php?";
		$variable = $this->cripto->codificar_url($variable,$configuracion);
		echo "<script>location.replace('".$pagina.$variable."')</script>";

	} // fin function guardarUsuario

	function consultarRadicado($configuracion,$cod_radica){

		$this->formulario = "admin_radica";
                $indice=$configuracion["host"].$configuracion["site"]."/index.php?";	
                //var_dump($cod_radica);
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
									<td class='cuadro_plano centrar'>Tramita </td>
									<td class='cuadro_plano centrar'>Descripci&oacute;n </td>
									<td class='cuadro_plano centrar'>Registrado </td>
                                                                        <td class='cuadro_plano centrar'>Tramitado </td>
                                                                        <td class='cuadro_plano centrar'>Estado</td>
                                                                </tr>			

							<?
                                                        foreach($registro_tramite as $key => $value )
							{
								?><tr> 
									 <td class='cuadro_plano'><?php echo $registro_tramite[$key]['AREA'];?></td>
									 <td class='cuadro_plano'><?php echo $registro_tramite[$key]['USU'];?></td>
                                                                         <td class='cuadro_plano'><?php echo $registro_tramite[$key]['DESCR'];?></td>    
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
        
        function imprimirRadicado($configuracion,$cod_radica){

		$this->formulario = "admin_radica";
                $indice=$configuracion["host"].$configuracion["site"];	
                //var_dump($cod_radica);
               
			//busca si existen registro de datos de usuarios en la base de datos 
                    
			$cadena_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"busqueda_radicado",$cod_radica);
                        
                        $datos_radica = $this->ejecutarSQL($configuracion, $this->acceso_db, $cadena_sql, "busqueda");
			?>			
			<table width="90%" align="center" border="0" cellpadding="0" cellspacing="0" >
			<tbody>
			  <tr>
				<td width="65%"> </td>
                                <td>
                                    
					<table width="100%" border="0" align="center" cellpadding="5 px" cellspacing="1px" >
					  <tr class="texto_subtitulo">
                                              <td>Solicitud de Tramite &nbsp; <input type="button" name="imprimir" value="Imprimir" onclick="window.print();" style="height: 20px; width: 50px;font-size: 10px" /> 
								<hr class="hr_subtitulo">
						</td>
				 	  </tr>
					  <tr>
						<td>
							<table class='contenidotabla'>
								<tr >
                                                                    <td class='cuadro_print centrar' >Consultar:</td>
									<td class='cuadro_plano '><? echo  $indice;?></td>
                                                                   
								</tr>
                                                                <tr >
                                                                    <td class='cuadro_print centrar' >Radicado:</td>
									<td class='cuadro_print '><? echo  $datos_radica[0]['VIG']."-".$datos_radica[0]['ID_TRAM']."-".$datos_radica[0]['NRO_RAD']?></td>
                                                                   
								</tr>	
								<tr >
									<td class='cuadro_print centrar' >Oficio:</td>
									<td class='cuadro_print '><? echo  $datos_radica[0]['COD_OF']?></td>
								</tr>			
								
                                                                <tr >
									<td class='cuadro_print centrar' >Fecha:</td>
									<td class='cuadro_print '><? echo  $datos_radica[0]['FEC_REG']?></td>
								</tr>
								<tr >
									<td class='cuadro_print centrar' >Tramite:</td>
									<td class='cuadro_print '><? echo  $datos_radica[0]['TRAM']?></td>
								</tr>			
								<tr >
                                                                    <td class='cuadro_print centrar' >Concepto:</td>
									<td class='cuadro_print '><? echo  $datos_radica[0]['CONCEP']?></td>
								</tr>
                                                                <tr >
                                                                    <td class='cuadro_print centrar' >Radico:</td>
									<td class='cuadro_print '><? echo  $datos_radica[0]['US_RAD']?></td>
								</tr>
                                                               
							</table>
						</td>
					  </tr>
					</table>
				   </td>
				</tr>
				
			</tbody>
			</table>
			<?	
                        echo "<script>window.print()</script>";

	}//fin funcion imprimir radicado
        
        
	// funcion que muestra los datos de varios registros

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
                                                                                        <td class='cuadro_plano centrar'><a href='".$indice.$parametro."'>".$registro[$key]['VIG']."-".$registro[$key]['ID_TRAM']."-".$registro[$key]['NRO_RAD']."</a></td>
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


                
                