<?php
/*--------------------------------------------------------------------------------------------------------------------------
  @ Derechos de Autor: Vea el archivo LICENCIA.txt que viene con la distribucion
---------------------------------------------------------------------------------------------------------------------------*/
/*---------------------------------------------------------------------------------------
 |				Control Versiones				    	|	
 ----------------------------------------------------------------------------------------
 | fecha      |        Autor            | version     |              Detalle            |
 ----------------------------------------------------------------------------------------
 ----------------------------------------------------------------------------------------
*/


if(!isset($GLOBALS["autorizado"]))
{
	include("../index.php");
	exit;		
}

include_once($configuracion["raiz_documento"].$configuracion["clases"]."/funcionGeneral.class.php");
include_once($configuracion["raiz_documento"].$configuracion["clases"]."/navegacion.class.php");

class funciones_adminTipoTramite extends funcionGeneral
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
		$this->form_Tramite($configuracion,$registro,$tema,"");
		
	}
	
        function nuevoConcepto($configuracion,$tema,$acceso_db)
	{
		if ($_REQUEST['forma'] == 'nuevo_concepto')
		     {$this->form_Concepto($configuracion,$registro,$tema,"");}
                else {$this->relaciona_Concepto($configuracion,$registro,$tema,"");}   
	}
        
        function nuevoArea($configuracion,$tema,$acceso_db)
	{       $this->cadena_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"posicion_area_tramite",$_REQUEST['id_tramite']);
		$posicion = $this->acceso_db->ejecutarAcceso($this->cadena_sql,"busqueda");
		//var_dump($posicion);  
		if ($_REQUEST['forma'] == 'nuevo_area')
		     {$this->form_Area($configuracion,$registro,$tema,$posicion);}
                else {$this->relaciona_Area($configuracion,$registro,$tema,$posicion);}   
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


	function form_Tramite($configuracion,$registro,$tema,$estilo)
	{
		$indice=$configuracion["host"].$configuracion["site"]."/index.php?";

		/*****************************************************************************************************/
		include_once($configuracion["raiz_documento"].$configuracion["clases"]."/html.class.php");
		
		$enlace = $this->acceso_db;
		$id_usuario = $this->usuario;
				
		$html = new html();
		$tab = 1;
		$this->formulario = "admin_tipotramite";
                $this->verificar .= "seleccion_valida(".$this->formulario.",'id_dep')";
                $this->verificar .= "&& control_vacio(".$this->formulario.",'nom_ttram')";
                $this->verificar .= "&& control_vacio(".$this->formulario.",'res_ttram')";
                $this->verificar .= "&& control_vacio(".$this->formulario.",'desc_ttram')";
                $this->verificar .= "&& control_vacio(".$this->formulario.",'dias_ttram')";
	
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
				echo "REGISTRAR NUEVO TIPO DE TRAMITE";
			   else
				echo "EDITAR TIPO DE TRAMITE";

			?>
		<hr class='hr_subtitulo'/></td></tr>
                <tr>
			<td width='30%'><?
				$texto_ayuda = "<b>Dependencia responsable del tramite.</b><br> ";
				?><font color="red" >*</font><span onmouseover="return escape('<? echo $texto_ayuda?>')">Dependencia:</span>
			</td>
			<td>
                        <?	                           			              
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
				$texto_ayuda = "<b>Nombre del tipo de tramite.</b><br> ";
				?><font color="red" >*</font><span onmouseover="return escape('<? echo $texto_ayuda?>')">Nombre:</span>
			</td>
			<td>
				<input type='text' name='nom_ttram' value='<? echo $registro[0][2] ?>' size='40' maxlength='50' tabindex='<? echo $tab++ ?>' />
			</td>
		</tr>		
		<tr>
			<td width='30%'><?
				$texto_ayuda = "<b>Resumen del tipo de tramite (Una sola palabra).</b><br> ";
				?><font color="red" >*</font><span onmouseover="return escape('<? echo $texto_ayuda?>')">Resumen:</span>
			</td>
			<td>
				<input type='text' name='res_ttram' value='<? echo $registro[0][2] ?>' size='40' maxlength='50' tabindex='<? echo $tab++ ?>' />
			</td>
		</tr>
                <tr>
			<td width='30%'><?
				$texto_ayuda = "<b>Descripción del tramite solicitado.</b><br> ";
				?><span onmouseover="return escape('<? echo $texto_ayuda?>')">Descripci&oacute;n:</span>
			</td>
			<td>
				<textarea  name='desc_ttram' cols='51' rows='3' tabindex='<? echo $tab++ ?>' value='<? echo $registro[0][3] ?>'></textarea>
			</td>
		</tr>		
		<tr>
			<td width='30%'><?
				$texto_ayuda = "<b>Dias habiles de duracion del tramite.</b><br> ";
				?><font color="red" >*</font><span onmouseover="return escape('<? echo $texto_ayuda?>')">Duraci&oacute;n:</span>
			</td>
			<td>
				<input type='text' name='dias_ttram' value='<? echo $registro[0][5] ?>' size='15' maxlength='4' tabindex='<? echo $tab++ ?>' onKeyPress='return solo_numero_sin_slash(event)' />
			</td>
		</tr>	
		</table>
		<table align='center'>
		  <tr align='center'>
			<td colspan='2' rowspan='1'>
                                <input type='hidden' name='usuario' value='<? echo $_REQUEST["usuario"] ?>'>
                     		<input type='hidden' name='action' value='admin_tipotramite'/>
	    			<input type='hidden' name='opcion' value='nuevo'>
                                <input value="Guardar" name="aceptar" tabindex='<?= $tab++ ?>' type="button" onclick=" if(confirm('Recuerde que una vez guarde la información no puede modificarla! Desea registrar el Tipo de Tramite? ')){if(<?= $this->verificar; ?>){document.forms['<? echo $this->formulario?>'].submit()}else{false}}else{false}"/>
                                
                                <input name='cancelar' value='Cancelar' type='submit' tabindex='<?= $tab++ ?>'/>
				<br>
			</td>
 		  </tr> 
		</table>

		</form>		
	<?php
	} // fin function form_usuario
        
        function relaciona_Concepto($configuracion,$registro,$tema,$estilo)
	{
		$indice=$configuracion["host"].$configuracion["site"]."/index.php?";

		/*****************************************************************************************************/
		include_once($configuracion["raiz_documento"].$configuracion["clases"]."/html.class.php");
		
		$enlace = $this->acceso_db;
		$id_usuario = $this->usuario;
				
		$html = new html();
		$tab = 1;
		$this->formulario = "admin_tipotramite";
                $this->formulario1 = "nuevo_concepto";
                
                $this->verificar .= "seleccion_valida(".$this->formulario.",'id_concep')";
	
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
				echo "RELACIONAR CONCEPTO | ";
			   else
				echo "EDITAR CONCEPTO | ";
			?>
                <a href="<?		
                    $variable="pagina=adminTipoTramite";
                    $variable.="&opcion=nuevo_concepto";
                    $variable.="&forma=nuevo_concepto";
                    $variable.="&id_tramite=".$_REQUEST['id_tramite'];
                    $variable=$this->cripto->codificar_url($variable,$configuracion);
                    echo $indice.$variable;		
                    ?>">  >> Registrar Nuevo Concepto</a>

	        <hr class='hr_subtitulo'/></td></tr>
                
                <tr>
			<td width='30%'><?
				$texto_ayuda = "<b>Tipo de Concepto para los tramites.</b><br> ";
				?><font color="red" >*</font><span onmouseover="return escape('<? echo $texto_ayuda?>')">Concepto:</span>
			</td>
			<td>
                        <?	                           			              
				if(!$registro)
                                    { $busquedaConcep = $this->sql->cadena_sql($configuracion,$this->funcion->acceso_db,"listar_concep","");
                                      $concep=$html->cuadro_lista($busquedaConcep,'id_concep',$configuracion,-1,2,FALSE,$tab++,'id_concep');
                                    }
                                 else
                                    { $busquedaConcep = $this->sql->cadena_sql($configuracion,$this->funcion->acceso_db,"listar_concep",$registro);
                                      $concep=$html->cuadro_lista($busquedaConcep,'id_concep',$configuracion,0,3,FALSE,$tab++,'id_concep');
                                    }
                        	echo $concep;
                  
			?>	
				 
			</td>
		</tr>		
	
		</table>
		<table align='center'>
		  <tr align='center'>
			<td colspan='2' rowspan='1'>
                                <input type='hidden' name='usuario' value='<? echo $_REQUEST["usuario"] ?>'>
                                <input type='hidden' name='id_tramite' value='<? echo $_REQUEST["id_tramite"] ?>'>
                     		<input type='hidden' name='action' value='admin_tipotramite'/>
	    			<input type='hidden' name='opcion' value='nuevo_concepto'>
                                <input value="Guardar" name="aceptar" tabindex='<?= $tab++ ?>' type="button" onclick=" if(confirm('Recuerde que una vez guarde la información no puede modificarla! Desea registrar el Tipo de Tramite? ')){if(<?= $this->verificar; ?>){document.forms['<? echo $this->formulario?>'].submit()}else{false}}else{false}"/>
                                <input name='cancelar' value='Cancelar' type='submit' tabindex='<?= $tab++ ?>'/>
				<br>
			</td>
 		  </tr> 
		</table>

		</form>		
	<?php
	} // fin function form_usuario
  

	function form_Concepto($configuracion,$registro,$tema,$estilo)
	{
		$indice=$configuracion["host"].$configuracion["site"]."/index.php?";

		/*****************************************************************************************************/
		include_once($configuracion["raiz_documento"].$configuracion["clases"]."/html.class.php");
		
		$enlace = $this->acceso_db;
		$id_usuario = $this->usuario;
				
		$html = new html();
		$tab = 1;
		$this->formulario = "admin_tipotramite";
                $this->verificar = "control_vacio(".$this->formulario.",'nom_concep')";
                $this->verificar .= "&& control_vacio(".$this->formulario.",'desc_concep')";
                
	
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
				echo "REGISTRAR NUEVO CONCEPTO";
			   else
				echo "EDITAR CONCEPTO";

			?>
		<hr class='hr_subtitulo'/></td></tr>
		<tr>
			<td width='30%'><?
				$texto_ayuda = "<b>Nombre del Concepto.</b><br> ";
				?><font color="red" >*</font><span onmouseover="return escape('<? echo $texto_ayuda?>')">Nombre:</span>
			</td>
			<td>
				<input type='text' name='nom_concep' value='<? echo $registro[0][2] ?>' size='40' maxlength='50' tabindex='<? echo $tab++ ?>' />
			</td>
		</tr>
                <tr>
			<td width='30%'><?
				$texto_ayuda = "<b>Descripción del concepto.</b><br> ";
				?><font color="red" >*</font><span onmouseover="return escape('<? echo $texto_ayuda?>')">Descripci&oacute;n:</span>
			</td>
			<td>
				<textarea  name='desc_concep' cols='51' rows='3' tabindex='<? echo $tab++ ?>' value='<? echo $registro[0][3] ?>'></textarea>
			</td>
		</tr>	
		</table>
		<table align='center'>
		  <tr align='center'>
			<td colspan='2' rowspan='1'>
                                <input type='hidden' name='id_tramite' value='<? echo $_REQUEST["id_tramite"] ?>'>
                     		<input type='hidden' name='action' value='admin_tipotramite'/>
	    			<input type='hidden' name='opcion' value='nuevo_concepto'>
                                <input value="Guardar" name="aceptar" tabindex='<?= $tab++ ?>' type="button" onclick=" if(confirm('Recuerde que una vez guarde la información no puede modificarla! Desea registrar el Concepto? ')){if(<?= $this->verificar; ?>){document.forms['<? echo $this->formulario?>'].submit()}else{false}}else{false}"/>
                                
                                <input name='cancelar' value='Cancelar' type='submit' tabindex='<?= $tab++ ?>'/>
				<br>
			</td>
 		  </tr> 
		</table>

		</form>		
	<?php
	} // fin function form_usuario
  
        
        // funcion que recibe los datos de los tramites recibidos

	function guardarTtramite($configuracion){
			  
		//rescata los valores para ingresar los datos del usuario
		//----------------------------------------------------
            //list($d,$m,$a)=explode("/",$_REQUEST["fecha_inactiva"]);
           
            /*busca el id del tipo de tramite*/
           $Ttram_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"Ttramite_id","");
           $rs_Ttram = $this->ejecutarSQL($configuracion, $this->acceso_db, $Ttram_sql,"busqueda");
                      
           $nvoTtram=array(   id_usuario => $this->usuario,
                               id_Ttram=>$rs_Ttram[0]['ID_TRAM'],
                               id_dep => $_REQUEST['id_dep'],
                               nombre => STRTOUPPER($_REQUEST['nom_ttram']),
                               resumen => STRTOUPPER($_REQUEST['res_ttram']), 
                               descr => STRTOUPPER($_REQUEST['desc_ttram']),
                               dias => $_REQUEST['dias_ttram'],
                               fecha_registro => date('Y-m-d'),
                               fecha_fin => date('0000-00-00'),
                               estado => '1');
 
           //var_dump($nvoTtram);//exit;
           
           $nvoTtram_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"inserta_Ttram",$nvoTtram);
           @$rs_nvoTtram = $this->ejecutarSQL($configuracion, $this->acceso_db, $nvoTtram_sql,"");
           
           
           /*datos para guardar en las areas admisnitrativoas y  radicacion*/
           $area[0]['nombre']='ADMINISTRATIVA';
           $area[0]['desc']='AREA ADMINISTRATIVA, DONDE SE PUEDE REALIZAR DEVOLUCIONES A DEPENDENCIAS Y SEGUIMIENTO A TRAMITES';
           $area[0]['estado']=1;
           $area[1]['nombre']='RADICACION';
           $area[1]['desc']='AREA RADICACION, SE REGISTRAN LAS SOLICITUDES PARA TRAMITES';
           $area[1]['estado']=1;
           
           $variable = "pagina=adminTipoTramite";
	   $variable .= "&opcion=consultar";
			if ($rs_nvoTtram){
                             for($aux=0;$aux<2;$aux++)
                                   { $dato= array(id_dep=>$nvoTtram['id_dep'], nombre=>$area[$aux]['nombre']);
                                     //busca el area administrativa y de radicacion
                                     $area_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"buscar_area",$dato);
                                     $rs_area = $this->ejecutarSQL($configuracion, $this->acceso_db, $area_sql,"busqueda");
                                 
                                      $areaTtram=array(id_tramite=>$nvoTtram['id_Ttram'],
                                                            estado=>1,
                                                            fecha_registro=>$nvoTtram['fecha_registro'],
                                                            desc=>$area[$aux]['desc']." PARA EL TRAMITE ".$nvoTtram['nombre'],
                                                            posicion=>$aux
                                                            );
                                     
                                     if($rs_area[0]['ID_AREA']>0)
                                         { $areaTtram['id_area']=$rs_area[0]['ID_AREA'];
                                         }
                                     else {
                                           //busca el id del area
                                           $idarea_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"area_id","");
                                           $rs_idarea = $this->ejecutarSQL($configuracion, $this->acceso_db, $idarea_sql,"busqueda");
                                       
                                           $dato['id_area']=$rs_idarea[0]['ID_AREA'];
                                           $dato['nombre']=$area[$aux]['nombre'];
                                           $dato['desc']=$area[$aux]['desc'];
                                           $dato['estado']=$area[$aux]['estado'];
                                           //inserta el nueva area
                                           $nvarea_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"inserta_area",$dato);
                                           $rs_nvarea = $this->ejecutarSQL($configuracion, $this->acceso_db, $nvarea_sql,"");
                                           $areaTtram['id_area']=$rs_idarea[0]['ID_AREA'];
                                          }  
                                    $nvoTtram_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"inserta_Ttram_area",$areaTtram);    
                                    @$rs_nvoTtram = $this->ejecutarSQL($configuracion, $this->acceso_db, $nvoTtram_sql,"");
                                   }
 				
                                $variable .= "&id_tramite=".$nvoTtram['id_Ttram'];
				//VARIABLES PARA EL LOG
				$registro[0] = "REGISTRAR";
				$registro[1] = $nvoTtram['id_usuario'];
				$registro[2] = "NUEVO TIPO DE TRAMITE ";
				$registro[3] = $nvoTtram['nombre'];
				$registro[4] = time();
				$registro[5] = "Registra el nuevo tipo de tramite ".$nvoTtram['nombre'];
                                $this->log_us->log_usuario($registro,$configuracion);
				echo "<script>alert('Se ha Registrado el Nuevo  Tipo de Tramite, con Exito!')</script>";
			}
			else
			{
				echo "<script>alert('No es posible Registrar el tipo de tramite')</script>";
			}

		$pagina = $configuracion["host"].$configuracion["site"]."/index.php?";
		$variable = $this->cripto->codificar_url($variable,$configuracion);
		echo "<script>location.replace('".$pagina.$variable."')</script>";

	} // fin function guardar el tipo de tramite


	function consultarTramites($configuracion,$cod_tram){

                include_once($configuracion["raiz_documento"].$configuracion["clases"]."/html.class.php");
                $indice=$configuracion["host"].$configuracion["site"]."/index.php?";	
                $html = new html();
                
		$this->formulario = "admin_tipotramite";
                $indice=$configuracion["host"].$configuracion["site"]."/index.php?";	
                                  
				
		$id_usuario = $this->usuario;
              
                      if($cod_tram['id_tramite'] == ""){  
			
			$cadena = "No Existen Tipos de Tramites Registrados.";
			
                        //var_dump($busquedaUsuario);
    
			//Rescatar Usuarios, todos si es administrador general 
			$cadena_sql = $this->sql->cadena_sql($configuracion,$this->funcion->acceso_db,"tramite_todos","");
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
					$variable["pagina"] = "adminTipoTramite";
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
                                        $cod_tram['id_tram']=$registro[0]['ID_TRAM'];
					$this->consultarTramites($configuracion,$cod_tram);
				}
			}
			else
			{
				include_once($configuracion["raiz_documento"].$configuracion["clases"]."/alerta.class.php");
				
				alerta::sin_registro($configuracion,$cadena);
			}

		}
		else{        
                    
                        $cadena_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"tramite_todos",$cod_tram);
                        $datos_tram = $this->ejecutarSQL($configuracion, $this->acceso_db, $cadena_sql, "busqueda");
			
                        //busca conceptos relacionados al tramite
                        $concep_tram_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"buscar_concep",$cod_tram);			
                        @$concep_tramite = $this->ejecutarSQL($configuracion, $this->acceso_db,  $concep_tram_sql, "busqueda");			
                       // var_dump($concep_tramite);
                        
                        //busca areas del tramite
                        $area_tram_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"buscar_area_tramite",$cod_tram);			
                        @$tipos_tramite = $this->ejecutarSQL($configuracion, $this->acceso_db, $area_tram_sql, "busqueda");			
                        // var_dump($registro_tramite);
                        
			//Obtener el total de registros
			$totalRegistros = $this->totalRegistros($configuracion, $this->acceso_db);

			$this->cadena_hoja = $area_tram_sql;

			//Si no se viene de una hoja anterior
		 	if(!isset($_REQUEST["hoja"]))
			{
				$_REQUEST["hoja"] = 1;
			}
			$this->cadena_hoja .= " LIMIT ".(($_REQUEST["hoja"]-1) * $configuracion['registro']).",".$configuracion['registro'];		
			$registro_tramite = $this->ejecutarSQL($configuracion, $this->acceso_db, $this->cadena_hoja, "busqueda");
			
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
                        
                        $this->formulario1 = "tipotramite"; 
                        $nomBloque = "admin_tipotramite"; 

			?>			
			<table width="90%" align="center" border="0" cellpadding="10" cellspacing="0" >
			<tbody>
                            <tr>
				<td>
					<table width="100%" border="0" align="center" cellpadding="5 px" cellspacing="1px" >
					  <tr class="texto_subtitulo">
						<td>

                                                        <form enctype='multipart/form-data' method='POST' action='index.php' name='<? echo $this->formulario1;?>'>
                                                            <input type='hidden' name='pagina' value='adminTipoTramite'/>
                                                            <input type='hidden' name='opcion' value='consultar'/>
                                                            <input type='hidden' name='action' value='<? echo $nomBloque;?>'/>
                                                            <input name='Regresar' value='<<' type='submit' tabindex='<?= $tab++ ?>' /> Tipo de Tramite
                                                        </form><br>
                                                        <hr class="hr_subtitulo">
						</td>
				 	  </tr>
					  <tr>
						<td>
							<table class='contenidotabla'>
								<tr >
                                                                    <td class='cuadro_plano centrar ancho10' >Código:</td>
								    <td class='cuadro_plano centrar'><? echo  $datos_tram[0]['ID_TRAM'];?></td>
                                                                    <td class='cuadro_plano centrar ancho10' >Fecha Registro:</td>
								    <td class='cuadro_plano '><? echo  $datos_tram[0]['FEC_TRAM']?></td>
								
								</tr>	
								<tr >
									<td class='cuadro_plano centrar ancho10' >Nombre:</td>
									<td class='cuadro_plano ' colspan="3"><? echo  $datos_tram[0]['TRAM']?></td>
								</tr>			
								<tr >
									<td class='cuadro_plano centrar ancho10' >Descripci&oacute;n:</td>
									<td class='cuadro_plano ' colspan="3"><? echo  $datos_tram[0]['DESC_TRAM']?></td>
								</tr>
                                                                <tr >
									<td class='cuadro_plano centrar ancho10' >Dependencia:</td>
									<td class='cuadro_plano ' colspan="3"><? echo  $datos_tram[0]['NOM_DEP']?></td>
								</tr>			
								<tr >
                                                                        <td class='cuadro_plano centrar ancho10' >Resumen:</td>
									<td class='cuadro_plano ' colspan="3"><? echo  $datos_tram[0]['RES_TRAM']?></td>
								</tr>
                                                                <tr >
                                                                    <td class='cuadro_plano centrar ancho10' >Estado:</td>
									<td class='cuadro_plano ' colspan="3"><? echo  $datos_tram[0]['EST_TRAM']?></td>
								</tr>
							</table>
						</td>
					  </tr>
					</table>
				   </td>
				</tr>
				<tr>
					<td>
                                        <?$this->mostrar_conceptos($configuracion,$concep_tramite); ?>
					</td>
				</tr>	
				<tr>
                                    <td>
                                    <?
                                    $variable["pagina"] = "adminTipoTramite";
                                    $variable["opcion"] = $_REQUEST["opcion"];
                                    $variable["hoja"] = $_REQUEST["hoja"];
                                    $variable["id_tramite"] = $_REQUEST["id_tramite"];
                                    $menu = new navegacion();
                                    
                                    $this->mostrar_areas( $configuracion,$registro_tramite); ?>
                                    </td>
				</tr>
				<tr>
					<td>
						<?
							$menu->menu_navegacion($configuracion,$_REQUEST["hoja"],$hojas,$variable);
			
						?>
					</td>
				</tr>

			</tbody>
			</table>
			<?				
		}//fin else existe cod_usuario
	}//fin funcion consultar usuarios

        function mostrar_conceptos($configuracion,$registro_tramite)
                            {
				?>

					<table width="100%" border="0" align="center" cellpadding="5 px" cellspacing="1px" >
					  <tr class="texto_subtitulo">
						<td>
							Conceptos del Tramite <br/>
								<hr class="hr_subtitulo"/>
						</td>
				 	  </tr>
					  <tr>
						<td>
							<table class='contenidotabla'>
								<tr class='cuadro_color'>
                                                                        <td class='cuadro_plano centrar'>Concepto</td>
									<td class='cuadro_plano centrar'>Descripci&oacute;n </td>
                                                                        <td class='cuadro_plano centrar'>Registrado </td>
                                                                        <td class='cuadro_plano centrar'>Estado</td>
                                                                      <!--  <td class='cuadro_plano centrar'>Opciones</td>-->
                                                                </tr>			

							<?
                                                        foreach($registro_tramite as $key => $value )
							{
								?><tr> 
									 <td class='cuadro_plano'><?php echo $registro_tramite[$key]['CONCEP'];?></td>
									 <td class='cuadro_plano'><?php echo $registro_tramite[$key]['DESC_CONCEP'];?></td>
                                                                         <td class='cuadro_plano'><?php echo $registro_tramite[$key]['FEC_CONCEP'];?></td>    
                                                                         <td class='cuadro_plano'><?php echo $registro_tramite[$key]['EST_CONCEP'];?></td>
                                                                         
                                                                         
                                                                         <!--<td align='center' width='10%' class='cuadro_plano' >
                                                                             
                                                                     <?php if($registro_tramite[$key]['EST_CONCEP']=='ACTIVO' AND isset($registro_tramite[$key]['ID_TRAM']))
                                                                               {?>  <a href='<?
                                                                                    $enlace="pagina=borrar_registro";
                                                                                    $enlace.="&opcion=concepto";
                                                                                    $enlace.="&id_tramite=".$registro_tramite[$key]['ID_TRAM'];
                                                                                    $enlace.="&id_concepto=".$registro_tramite[$key]['ID_CONCEP'];
                                                                                    
                                                                                   
                                                                                    //$variable.="&registro=".$registro[$contador][0];
                                                                                    $redireccion="";		
                                                                                    reset ($_REQUEST);
                                                                                    while (list ($clave, $val) = each ($_REQUEST)) 
                                                                                    {
                                                                                            $redireccion.="&".$clave."=".$val;

                                                                                    }

                                                                                    $enlace.="&redireccion=".$this->cripto->codificar_url($redireccion,$configuracion);
                                                                                    $enlace=$this->cripto->codificar_url($enlace,$configuracion);

                                                                                    echo $indice.$enlace;	
                                                                                    ?>'><img width='24' heigth='24' src='<? echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]."/boton_borrar.png"?>' alt='Inactivar Concepto' title='Inactivar Concepto' border='0' /></a>	
                                                                              <?php }
                                                                                else {?>
                                                                                    <img width='24' heigth='24' src='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]."/button_cancel.png";?>' alt='Registro Inactivo' title='Registro Inactivo' border='0' />
                                                                              <?php }?>
                                                                            </td>-->
                                                                         
								  </tr>
                                                                <?php  
						
							}
							?>
							</table>
						</td>
                                            </tr>
					</table><?
        }

	function guardarConcepto($configuracion,$concep){
			  
		//rescata los valores para ingresar los datos del usuario
		//----------------------------------------------------
            //list($d,$m,$a)=explode("/",$_REQUEST["fecha_inactiva"]);
           // var_dump($concep); 
            
           if($concep['id_concep']=='')
               {   //busca el id del concepto
                   $idconcep_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"id_concep","");
                   $rs_idconcep = $this->ejecutarSQL($configuracion, $this->acceso_db, $idconcep_sql,"busqueda");
                   
                   $concep['id_concep']=$rs_idconcep[0]['ID_CONCEP'];
                   $nvoConcep=array( 
                               id_concepto=>$concep['id_concep'],
                               nombre => STRTOUPPER($_REQUEST['nom_concep']),
                               desc => STRTOUPPER($_REQUEST['desc_concep']),
                               estado => '1');
                                    
                   //var_dump($nvoConcep);
                   $nvconcep_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"inserta_Concep",$nvoConcep);
                   $rs_idconcep = $this->ejecutarSQL($configuracion, $this->acceso_db, $nvconcep_sql,"");
                   
               }
            
          $TramConcep=array( id_usuario => $this->usuario,
               id_concepto => $concep['id_concep'],
               id_tramite => $concep['id_tramite'],
               fecha_registro => date('Y-m-d'),
               fecha_fin => date('0000-00-00'),
               estado => '1');
            // var_dump($TramConcep);
             $tramconcep_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"inserta_TramConcep",$TramConcep);
             $rs_tramconcep = $this->ejecutarSQL($configuracion, $this->acceso_db, $tramconcep_sql,"");
             
             $variable = "pagina=adminTipoTramite";
	     $variable .= "&opcion=consultar";
             
			if ($rs_tramconcep){
                            
                                $variable .= "&id_tramite=".$TramConcep['id_tramite'];
				//VARIABLES PARA EL LOG
				$registro[0] = "REGISTRAR";
				$registro[1] = $TramConcep['id_usuario'];
				$registro[2] = "NUEVO CONCEPTO ";
				$registro[3] = $TramConcep['id_concepto'];
				$registro[4] = time();
				$registro[5] = "Registra el concepto ".$TramConcep['id_concepto']." al tipo de tramite ".$TramConcep['id_concepto'];
                                $this->log_us->log_usuario($registro,$configuracion);
				echo "<script>alert('Se ha Registrado el Nuevo Concepto, con Exito!')</script>";
			}
			else
			{
				echo "<script>alert('No es posible Registrar el Concepto')</script>";
			}

		$pagina = $configuracion["host"].$configuracion["site"]."/index.php?";
		$variable = $this->cripto->codificar_url($variable,$configuracion);
		echo "<script>location.replace('".$pagina.$variable."')</script>";

	} // fin function guardar el tipo de tramite
        
        
        function mostrar_areas( $configuracion,$registro_tramite)
                            {
				?>

					<table width="100%" border="0" align="center" cellpadding="5 px" cellspacing="1px" >
					  <tr class="texto_subtitulo">
						<td>
							Areas del Tramite <br/>
								<hr class="hr_subtitulo"/>
						</td>
				 	  </tr>
					  <tr>
						<td>
							<table class='contenidotabla'>
								<tr class='cuadro_color'>
                                                                    <td class='cuadro_plano centrar ancho10' >Posici&oacute;n</td>
                                                                        <td class='cuadro_plano centrar'>&Aacute;rea</td>
									<td class='cuadro_plano centrar'>Descripci&oacute;n </td>
                                                                        <td class='cuadro_plano centrar'>Registrado </td>
                                                                        <td class='cuadro_plano centrar'>Estado</td>
                                                                     <!--   <td class='cuadro_plano centrar'>Opciones</td>-->
                                                                </tr>			

							<?
                                                        foreach($registro_tramite as $key => $value )
							{
								?><tr> 
									 <td class='cuadro_plano centrar' ><?php echo $registro_tramite[$key]['POS'];?></td> 
                                                                         <td class='cuadro_plano'><?php echo $registro_tramite[$key]['AREA'];?></td>
									 <td class='cuadro_plano'><?php echo $registro_tramite[$key]['DESC_AREA'];?></td>
                                                                         <td class='cuadro_plano'><?php echo $registro_tramite[$key]['FEC_TRAM'];?></td>    
                                                                         <td class='cuadro_plano'><?php echo $registro_tramite[$key]['EST_AREA'];?></td>
                                                                         
                                                                         
                                                                       <!--  <td align='center' width='10%' class='cuadro_plano' >
                                                                             
                                                                     <?php if($registro_tramite[$key]['EST_AREA']=='ACTIVO' AND isset($registro_tramite[$key]['ID_TRAM']))
                                                                               {?>  <a href='<?
                                                                                    $enlace="pagina=borrar_registro";
                                                                                    $enlace.="&opcion=areaTram";
                                                                                    $enlace.="&id_tramite=".$registro_tramite[$key]['ID_TRAM'];
                                                                                    //$enlace.="&cod_area=".$registro_tramite[$key]['ID_AREA'];
                                                                                    //$enlace.="&cod_rad=".$registro_tramite[$key]['ID_RAD'];
                                                                                   
                                                                                    //$variable.="&registro=".$registro[$contador][0];
                                                                                    $redireccion="";		
                                                                                    reset ($_REQUEST);
                                                                                    while (list ($clave, $val) = each ($_REQUEST)) 
                                                                                    {
                                                                                            $redireccion.="&".$clave."=".$val;

                                                                                    }

                                                                                    $enlace.="&redireccion=".$this->cripto->codificar_url($redireccion,$configuracion);
                                                                                    $enlace=$this->cripto->codificar_url($enlace,$configuracion);

                                                                                    echo $indice.$enlace;	
                                                                                    ?>'><img width='24' heigth='24' src='<? echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]."/boton_borrar.png"?>' alt='Borrar Asignacion' title='Borrar Asignacion' border='0' /></a>	
                                                                              <?php }
                                                                                else {?>
                                                                                    <img width='24' heigth='24' src='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]."/button_cancel.png";?>' alt='Registro Asignado' title='Registro Asignado' border='0' />
                                                                              <?php }?>
                                                                            </td>-->
                                                                         
								  </tr>
                                                                <?php  
						
							}
							?>
							</table>
						</td>
                                            </tr>
					</table><?
        }

        
        function relaciona_Area($configuracion,$registro,$tema,$posicion)
	{
		$indice=$configuracion["host"].$configuracion["site"]."/index.php?";

		/*****************************************************************************************************/
		include_once($configuracion["raiz_documento"].$configuracion["clases"]."/html.class.php");
		
		$enlace = $this->acceso_db;
		$id_admin = $this->usuario;
		//usuario administrador echo $id_admin;				
		$html = new html();
		$tab = 1;
               
		$this->formulario = "admin_tipotramite";
                $this->verificar = "seleccion_valida(".$this->formulario.",'id_dep')";
                $this->verificar.= "&& seleccion_valida(".$this->formulario.",'id_area')";
                $this->verificar.= "&& control_vacio(".$this->formulario.",'desc_area_tram')";
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
				echo "RELACIONAR AREA | ";
			   else
				echo "EDITAR AREA | ";

			?>
                         <a href="<?		
                    $variable="pagina=adminTipoTramite";
                    $variable.="&opcion=nuevo_area";
                    $variable.="&forma=nuevo_area";
                    $variable.="&id_tramite=".$_REQUEST['id_tramite'];
                    $variable=$this->cripto->codificar_url($variable,$configuracion);
                    echo $indice.$variable;		
                    ?>">  >> Registrar Nueva &Aacute;rea</a>
		<hr class='hr_subtitulo'/></td></tr>	
                <tr>
			<td width='30%'><?
				$texto_ayuda = "<b>Dependencia que participara en el tramite.</b><br> ";
				?><font color="red" >*</font><span onmouseover="return escape('<? echo $texto_ayuda?>')">Dependencia:</span>
			</td>
			<td>
                        <?	//Evaluamos el rol del usuario actual en el sistema, si es administrador general no tiene 
				//restricciones en roles; si NO es administrador general, no puede crear usuarios con rol Administrador 
				//general
                               $configuracion["ajax_function"]="xajax_AREA";
                               $configuracion["ajax_control"]="id_dep";
			              
				if(!$registro)
                                    { $busquedaDep = $this->sql->cadena_sql($configuracion,$this->funcion->acceso_db,"listar_dep",1);
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
				$texto_ayuda = "<b>Area de la Dependencia que se asignara al tramite.</b><br> ";
				?><font color="red" >*</font><span onmouseover="return escape('<? echo $texto_ayuda?>')">Área:</span>
			</td>
			<td><?
                                if(!$registro)		
                                 { ?><div id="areaDep"><?
                                        $area=$html->cuadro_lista("",'id_area',$configuracion,-1,0,FALSE,$tab++,'id_area');
                                        echo $area;?>
                                      </div><?
                                    }
                                else
                                {  $busquedaArea = $this->sql->cadena_sql($configuracion,$this->funcion->acceso_db,"buscar_area",$registro);
                                   $area=$html->cuadro_lista($busquedaArea,'id_area',$configuracion,$registro[0]['ID_AREA'],3,FALSE,$tab++,'id_area');
                                   echo $area;
                                }?>
       			</td>
		</tr>
                	<tr>
			<td width='30%'><?	
				$texto_ayuda = "<b>Posici&oacute;n que ocupara el &Aacute;rea en el Tramite.</b><br> ";
				?><font color="red" >*</font><span onmouseover="return escape('<? echo $texto_ayuda?>')">Posici&oacute;n:</span>
			</td>
			<td>    <input type='text' name='posicion' value='<? echo $posicion[0]['POS']; ?>'
                                size='12' maxlength='25' tabindex='<? echo $tab++ ?> 'readonly="readonly"/>
				</td>
		</tr>
                <tr>
			<td width='30%'><?
				$texto_ayuda = "<b>Descripción de la labor del &Aacute;rea en el tramite.</b><br> ";
				?><font color="red" >*</font><span onmouseover="return escape('<? echo $texto_ayuda?>')">Labor &Aacute;rea en el tramite::</span>
			</td>
			<td>
				<textarea  name='desc_area_tram' cols='51' rows='3' tabindex='<? echo $tab++ ?>' value='<? echo $registro[0][3] ?>'></textarea>
			</td>
		</tr>
		</table>
	
                <table align='center'>
		  <tr align='center'>
			<td colspan='2' rowspan='1'>
                                <input type='hidden' name='id_tramite' value='<? echo $_REQUEST["id_tramite"]; ?>' />
				<input type='hidden' name='action' value='admin_tipotramite'/>
                             	<input type='hidden' name='opcion' value='nuevo_area'/>
                               	<input value="Guardar" name="aceptar" tabindex='<?= $tab++ ?>' type="button" onclick=" if(confirm('Recuerde que una vez guarde la información no puede modificarla! Desea relacionar el &Aacute;rea? ')){if(<?= $this->verificar; ?>){document.forms['<? echo $this->formulario?>'].submit()}else{false}}else{false}"/>
                                <input name='cancelar' value='Cancelar' type='submit' tabindex='<?= $tab++ ?>'/>
				<br>
			</td>
 		  </tr> 
		</table>

		</form>		
	<?php
	} // fin function form_usuario

        function form_Area($configuracion,$registro,$tema,$posicion)
	{
		$indice=$configuracion["host"].$configuracion["site"]."/index.php?";

		/*****************************************************************************************************/
		include_once($configuracion["raiz_documento"].$configuracion["clases"]."/html.class.php");
		
		$enlace = $this->acceso_db;
		$id_admin = $this->usuario;
		//usuario administrador echo $id_admin;				
		$html = new html();
		$tab = 1;
               
		$this->formulario = "admin_tipotramite";
                $this->verificar = "seleccion_valida(".$this->formulario.",'id_dep')";
                $this->verificar.= "&& control_vacio(".$this->formulario.",'nom_area')";
                $this->verificar.= "&& verificar_acentos(".$this->formulario.",'nom_area')";
                $this->verificar.= "&& verificar_caracteres_especiales(".$this->formulario.",'nom_area')";
                $this->verificar.= "&& control_vacio(".$this->formulario.",'desc_area')";
                $this->verificar.= "&& control_vacio(".$this->formulario.",'desc_area_tram')";
                
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
				echo "NUEVA AREA PARA EL TRAMITE";
			   else
				echo "EDITAR AREA";

			?>
		<hr class='hr_subtitulo'/></td></tr>	
                <tr>
			<td width='30%'><?
				$texto_ayuda = "<b>Dependencia que participara el tramite.</b><br> ";
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
				$texto_ayuda = "<b>Nombre de la nueva &Aacute;rea.</b><br> ";
				?><font color="red" >*</font><span onmouseover="return escape('<? echo $texto_ayuda?>')">Nombre:</span>
			</td>
			<td>
				<input type='text' name='nom_area' value='<? echo $registro[0][2] ?>' size='40' maxlength='50' tabindex='<? echo $tab++ ?>' />
			</td>
		</tr>
                <tr>
			<td width='30%'><?
				$texto_ayuda = "<b>Descripción de la nueva &Aacute;rea.</b><br> ";
				?><font color="red" >*</font><span onmouseover="return escape('<? echo $texto_ayuda?>')">Descripci&oacute;n &Aacute;rea:</span>
			</td>
			<td>
				<textarea  name='desc_area' cols='51' rows='3' tabindex='<? echo $tab++ ?>' value='<? echo $registro[0][3] ?>'></textarea>
			</td>
		</tr>
                <tr>
			<td width='30%'><?	
				$texto_ayuda = "<b>Posici&oacute;n que ocupara el &Aacute;rea en el Tramite.</b><br> ";
				?><font color="red" >*</font><span onmouseover="return escape('<? echo $texto_ayuda?>')">Posici&oacute;n:</span>
			</td>
			<td>    <input type='text' name='posicion' value='<? echo $posicion[0]['POS']; ?>'
                                size='12' maxlength='25' tabindex='<? echo $tab++ ?> 'readonly="readonly"/>
				</td>
		</tr>
                <tr>
			<td width='30%'><?
				$texto_ayuda = "<b>Descripción de la labor del &Aacute;rea en el tramite.</b><br> ";
				?><font color="red" >*</font><span onmouseover="return escape('<? echo $texto_ayuda?>')">Labor &Aacute;rea en el tramite:</span>
			</td>
			<td>
				<textarea  name='desc_area_tram' cols='51' rows='3' tabindex='<? echo $tab++ ?>' value='<? echo $registro[0][3] ?>'></textarea>
			</td>
		</tr>
		</table>
	
                <table align='center'>
		  <tr align='center'>
			<td colspan='2' rowspan='1'>
                                <input type='hidden' name='id_tramite' value='<? echo $_REQUEST["id_tramite"]; ?>' />
				<input type='hidden' name='action' value='admin_tipotramite'/>
                             	<input type='hidden' name='opcion' value='nuevo_area'/>
                               	<input value="Guardar" name="aceptar" tabindex='<?= $tab++ ?>' type="button" onclick=" if(confirm('Recuerde que una vez guarde la información no puede modificarla! Desea Registrar la nueva &Aacute;rea? ')){if(<?= $this->verificar; ?>){document.forms['<? echo $this->formulario?>'].submit()}else{false}}else{false}"/>
                                <input name='cancelar' value='Cancelar' type='submit' tabindex='<?= $tab++ ?>'/>
				<br>
			</td>
 		  </tr> 
		</table>

		</form>		
	<?php
	} // fin function form_usuario
    // funcion que muestra los datos de varios usuarios

	function guardarArea($configuracion,$area){
			  
		//rescata los valores para ingresar los datos del usuario
		//----------------------------------------------------
            //list($d,$m,$a)=explode("/",$_REQUEST["fecha_inactiva"]);
            
           if($area['id_area']=='')
               {   //busca el id del concepto
                   $idarea_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"area_id","");
                   $rs_idarea = $this->ejecutarSQL($configuracion, $this->acceso_db, $idarea_sql,"busqueda");
                   
                   $area['id_area']=$rs_idarea[0]['ID_AREA'];
                   $nvoArea=array( 
                               id_area=>$area['id_area'],
                               id_dep=>$_REQUEST['id_dep'],
                               nombre => STRTOUPPER($_REQUEST['nom_area']),
                               desc => STRTOUPPER($_REQUEST['desc_area']),
                               estado => '1');
                                    
                  $nvarea_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"inserta_area",$nvoArea);
                  $rs_nvarea = $this->ejecutarSQL($configuracion, $this->acceso_db, $nvarea_sql,"");
                   
               }
            
          $TramArea=array( id_usuario => $this->usuario,
               id_area => $area['id_area'],
               id_tramite => $_REQUEST['id_tramite'],
               posicion => $_REQUEST['posicion'],
               desc => STRTOUPPER($_REQUEST['desc_area_tram']),
               fecha_registro => date('Y-m-d'),
               fecha_fin => date('0000-00-00'),
               estado => '1');
            // var_dump($TramArea);
            $tramarea_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"inserta_Ttram_area",$TramArea);
            $rs_tramarea = $this->ejecutarSQL($configuracion, $this->acceso_db, $tramarea_sql,"");
             
             $variable="pagina=adminTipoTramite";
	     $variable.="&opcion=consultar";
             
			if ($rs_tramarea){
                            
                                $variable.="&id_tramite=".$TramArea['id_tramite'];
				//VARIABLES PARA EL LOG
				$registro[0] = "REGISTRAR";
				$registro[1] = $TramArea['id_usuario'];
				$registro[2] = "NUEVO AREA ";
				$registro[3] = $TramArea['id_area'];
				$registro[4] = time();
				$registro[5] = "Registra el area ".$TramArea['id_area']." al tipo de tramite ".$TramArea['id_concepto'];
                                $this->log_us->log_usuario($registro,$configuracion);
				echo "<script>alert('Se ha Registrado la Nueva Área, con Exito!')</script>";
			}
			else
			{
				echo "<script>alert('No es posible Registrar el Área')</script>";
			}

		$pagina = $configuracion["host"].$configuracion["site"]."/index.php?";
		$variable = $this->cripto->codificar_url($variable,$configuracion);
		echo "<script>location.replace('".$pagina.$variable."')</script>";

	} // fin function guardar el tipo de tramite
        

        
	function multiplesRegistros($configuracion,$registro, $total, $variable)
	{
		include_once($configuracion["raiz_documento"].$configuracion["clases"]."/encriptar.class.php");
		$indice = $configuracion["host"].$configuracion["site"]."/index.php?";
		$cripto = new encriptar();
		//var_dump($registro);
		?><table width="80%" align="center" border="0" cellpadding="10" cellspacing="0" >
			<tbody>
				<tr>
					<td >
						<table width="100%" border="0" align="center" cellpadding="5 px" cellspacing="1px" >
							<tr class="texto_subtitulo">
								<td>
								Tramites Registrados<br>
								<hr class="hr_subtitulo">
								</td>
							</tr>
							<tr>
								<td>
									<table class='contenidotabla'>
										<tr class='cuadro_color'>
											<td class='cuadro_plano centrar ancho10' >Código</td>
											<td class='cuadro_plano centrar'>Tramite </td>
                                                                                        <td class='cuadro_plano centrar'>Dependencia </td>
                                                                                        <td class='cuadro_plano centrar'>Estado</td>
										</tr><?
                                                                                
                                                         foreach ($registro as $key => $value)
                                                                {     
                                                        		//Con enlace a la busqueda
									$parametro = "pagina=adminTipoTramite";
									$parametro .= "&hoja=1";
									$parametro .= "&opcion=consultar";
									$parametro .= "&accion=consultar";
                                                                        $parametro .= "&id_tramite=".$registro[$key]['ID_TRAM'];
                                                                        $parametro = $cripto->codificar_url($parametro,$configuracion);
									echo "	<tr>    
                                                                                        <td class='cuadro_plano centrar'><a href='".$indice.$parametro."'>".$registro[$key]['ID_TRAM']."</a></td>
                                                                                        <td class='cuadro_plano centrar'>".$registro[$key]['TRAM']."</td>    
										 	<td class='cuadro_plano centrar'>".$registro[$key]['NOM_DEP']."</td>    
                                                                                        <td class='cuadro_plano centrar'>".$registro[$key]['EST_TRAM']."</td>    
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
						<p class="textoNivel0">Por favor realice click sobre el código tramite que desee consultar.</p>
					</td>
				</tr>
			</tbody>
		</table>
		<?
	}//fin funcion multiples usuarios
        
		

} // fin de la clase
	

?>


                
                