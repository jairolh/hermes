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

class funciones_adminTramite extends funcionGeneral
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


	function form_Tramite($configuracion,$registro,$tema,$estilo)
	{
		$indice=$configuracion["host"].$configuracion["site"]."/index.php?";

		/*****************************************************************************************************/
		include_once($configuracion["raiz_documento"].$configuracion["clases"]."/html.class.php");
		
		$enlace = $this->acceso_db;
		$id_usuario = $this->usuario;
		//var_dump($registro);
		$html = new html();
		$tab = 1; 
		$this->formulario="admin_tramite";
                $this->verificar="seleccion_valida(".$this->formulario.",'id_estado')";
                $this->verificar.="&& control_vacio(".$this->formulario.",'desc_tram')";
	
		?>
		<script src="<? echo $configuracion["host"].$configuracion["site"].$configuracion["javascript"]  ?>/funciones.js" type="text/javascript" language="javascript"></script>
		
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
				echo "TRAMITAR SOLICITUD - ".$registro[0]['AREA'];

			?>
		<hr class='hr_subtitulo'/></td></tr>
                <tr>
			<td width='30%'><?
				$texto_ayuda = "<b>Estado que se asignara al Tramite.</b><br> ";
				?><font color="red" >*</font><span onmouseover="return escape('<? echo $texto_ayuda?>')">Estado:</span>
			</td>
			<td>
                        <?	//Evaluamos el rol del usuario actual en el sistema, si es administrador general no tiene 
				//restricciones en roles; si NO es administrador general, no puede crear usuarios con rol Administrador 
				//general
                               $configuracion["ajax_function"]="xajax_ASIG_USUARIO";
                               $configuracion["ajax_control"]="id_estado";	
                               $configuracion["ajax_control2"]="asig_tram";		
                               echo "<input type='hidden' id='asig_tram' name='asig_tram' value='".$registro[0]['ID_RAD']."'/>";
                               
				if($registro[0]['POS_TRAM']==0)
                                    { $busquedaEst = $this->sql->cadena_sql($configuracion,$this->funcion->acceso_db,"listar_estado","R");
                                      $estado=$html->cuadro_lista($busquedaEst,'id_estado',$configuracion,-1,0,FALSE,$tab++,'id_estado');    
                                    }
                                 else
                                    { $busquedaEst = $this->sql->cadena_sql($configuracion,$this->funcion->acceso_db,"listar_estado","T");
                                       $estado=$html->cuadro_lista($busquedaEst,'id_estado',$configuracion,-1,4,FALSE,$tab++,'id_estado');    
                        	    }
                                
                        	echo $estado;
                            ?>	
				 
			</td>
		</tr>		
                <tr>
			<td width='30%'><?
				$texto_ayuda = "<b>Descripción del resultado del tramite solicitado.</b><br> ";
				?><font color="red" >*</font><span onmouseover="return escape('<? echo $texto_ayuda?>')">Descripci&oacute;n:</span>
			</td>
			<td>
				<textarea  name='desc_tram' cols='51' rows='10' tabindex='<? echo $tab++ ?>' value='<? echo $registro[0][3] ?>'></textarea>
			</td>
		</tr>	
                 <tr>
			<td width='30%'><?
				$texto_ayuda = "<b>Usuario a quien se asigna la continuacion del tramite, en la siguiente área.</b><br> ";
				?><span onmouseover="return escape('<? echo $texto_ayuda?>')">Asignar:</span>
			</td>
			<td>
                                <div id="asigUs"><?
                                        $us_tram=$html->cuadro_lista("",'asig_usuario',$configuracion,-1,0,FALSE,$tab++,'asig_usuario');
                                        echo $us_tram;?>
                                      </div>

       			</td>
		</tr>	
			
		</table>
		<table align='center'>
		  <tr align='center'>
			<td colspan='2' rowspan='1'>
                                <input type='hidden' name='id_radicado' value='<?echo $registro[0]['ID_RAD'];?>'/>
                                <input type='hidden' name='id_area' value='<?echo $registro[0]['ID_AREA'];?>'/>
                                <input type='hidden' name='id_usuario' value='<?echo $registro[0]['ID_USU'];?>'/>
                                <input type='hidden' name='id_tramite' value='<?echo $registro[0]['ID_TRAM'];?>'/>
                                <input type='hidden' name='posicion_tramite' value='<?echo $registro[0]['POS_TRAM'];?>'/>
                                <input type='hidden' name='action' value='admin_tramite'/>
	    			<input type='hidden' name='opcion' value='tramitar'/>
				<input value="Guardar" name="aceptar" tabindex='<?= $tab++ ?>' type="button" onclick=" if(confirm('Recuerde que una vez guarde la información no puede modificarla! Desea dar tramite a la Solicitud? ')){if(<?= $this->verificar; ?>){document.forms['<? echo $this->formulario?>'].submit()}else{false}}else{false}"/>
                                
    			<input name='cancelar' value='Cancelar' type='submit' tabindex='<?= $tab++ ?>'>
				<br>
			</td>
 		  </tr> 
		</table>

		</form>		
	<?php
	} // fin function form_usuario

	// funcion que recibe los datos de los tramites recibidos

	function Tramitar($configuracion){
			  
		//rescata los valores para ingresar los datos del usuario
		//----------------------------------------------------
            //list($d,$m,$a)=explode("/",$_REQUEST["fecha_inactiva"]);
            
            
            $tramite=array(id_usuario => $this->usuario,
                           id_radicado => $_REQUEST['id_radicado'],
                           id_area => $_REQUEST['id_area'],
                           describe => strtoupper($_REQUEST['desc_tram']),
                           fecha_tramitado => date('Y-m-d H:i:s'),
                           estado_tram => $_REQUEST['id_estado'],
                           id_tramite => $_REQUEST['id_tramite'],
                           posicion => ($_REQUEST['posicion_tramite']+1),
                           estado => $_REQUEST['id_estado']);
                            //var_dump($tramite);exit;
            
                        $tramitar_sql= $this->sql->cadena_sql($configuracion,$this->acceso_db,"tramitar", $tramite);
                        @$rs_tramitar = $this->ejecutarSQL($configuracion, $this->acceso_db, $tramitar_sql,"");
                                   
			$variable = "pagina=adminTramite";
			$variable .= "&opcion=consultar";
			$variable .= "&id_tramite=".$tramite['id_tramite'];
			$variable .= "&id_area=".$tramite['id_area'];
			if ($rs_tramitar){
                            //buscar siguiente area
                            $areas_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"areas_tramite",$tramite);
                            $rs_areas = $this->ejecutarSQL($configuracion, $this->acceso_db, $areas_sql,"busqueda");
                                                        
                            if($tramite['estado']==7)    
                                     {$tramite['posicion']=0;
                                      $area_tram_sql= $this->sql->cadena_sql($configuracion,$this->acceso_db,"busqueda_tramite_area", $tramite);
                                      $rs_area_tram = $this->ejecutarSQL($configuracion, $this->acceso_db, $area_tram_sql,"busqueda");
                                        
                                        $nvo_tramite=array(cod_usuario => 0,
                                                       cod_rad => $_REQUEST['id_radicado'],
                                                       cod_area => $rs_area_tram[0]['ID_AREA'],
                                                       fecha_registro => '0000-00-00 00:00:00',
                                                       asig_usuario => $_REQUEST['asig_usuario'],  
                                                       estado => '4');
                                                       //var_dump($nvo_tramite);                                   
                                     }
                            elseif(($tramite['posicion']-1)==0)    
                                    {   //busca los datos de la siguiente area
                                        $tramite['posicion'] =($tramite['posicion']-1);
                                        $area_tram_sql= $this->sql->cadena_sql($configuracion,$this->acceso_db,"busqueda_tramite_area", $tramite);
                                        $rs_area_tram = $this->ejecutarSQL($configuracion, $this->acceso_db, $area_tram_sql,"busqueda");
                                        $fin_tramite=array(cod_usuario =>$tramite['id_usuario'],
                                                       id_rad => $tramite['id_radicado'],
                                                       cod_rad => $tramite['id_radicado'],
                                                       cod_area => $rs_area_tram[0]['ID_AREA'],
                                                       fecha_tramitado => date('Y-m-d H:i:s'),
                                                       estado_tram => $tramite['estado_tram'],
                                                       estado =>$tramite['estado']);
                                                       //var_dump($fin_tramite);
                                     }
                            elseif($rs_areas[0]['areas']>$_REQUEST['posicion_tramite'])    
                                    {   //busca los datos de la siguiente area
                                        $area_tram_sql= $this->sql->cadena_sql($configuracion,$this->acceso_db,"busqueda_tramite_area", $tramite);
                                        $rs_area_tram = $this->ejecutarSQL($configuracion, $this->acceso_db, $area_tram_sql,"busqueda");
                                        
                                        $nvo_tramite=array(cod_usuario => 0,
                                                       cod_rad => $_REQUEST['id_radicado'],
                                                       cod_area => $rs_area_tram[0]['ID_AREA'],
                                                       fecha_registro => '0000-00-00 00:00:00',
                                                       asig_usuario => $_REQUEST['asig_usuario'],  
                                                       estado => '4');
                                                       //var_dump($nvo_tramite);
                                     }
                                 else
                                        {   
                                        $area_tram_sql= $this->sql->cadena_sql($configuracion,$this->acceso_db,"busqueda_tramite_area", $tramite);
                                        $rs_area_tram = $this->ejecutarSQL($configuracion, $this->acceso_db, $area_tram_sql,"busqueda");
                                        $fin_tramite=array(cod_usuario =>$tramite['id_usuario'],
                                                       id_rad => $tramite['id_radicado'],
                                                       cod_rad => $tramite['id_radicado'],
                                                       cod_area => $rs_area_tram[0]['ID_AREA'],
                                                       fecha_tramitado => date('Y-m-d H:i:s'),
                                                       estado_tram => '9',
                                                       estado =>$tramite['estado']);
                                                     //  var_dump($fin_tramite);exit;
                                     }
                               
                            
                            if($nvo_tramite) //registra el tramite a la siguiente area   
                                    {  $nvo_tram_sql= $this->sql->cadena_sql($configuracion,$this->acceso_db,"insertar_tramite", $nvo_tramite);
                                       @$rs_nvo_tram = $this->ejecutarSQL($configuracion, $this->acceso_db, $nvo_tram_sql,"");
                                        if($nvo_tramite['asig_usuario']>0)    
                                            {  $nvo_asig_sql= $this->sql->cadena_sql($configuracion,$this->acceso_db,"insertar_asignado", $nvo_tramite);
                                               @$rs_nvo_asigm = $this->ejecutarSQL($configuracion, $this->acceso_db, $nvo_asig_sql,"");
                                            }
                                       
                                    }
                             elseif($fin_tramite) //termina el tramite   
                                    {  $fin_tram_sql= $this->sql->cadena_sql($configuracion,$this->acceso_db,"terminar_tramite", $fin_tramite);
                                       @$rs_nvo_tram = $this->ejecutarSQL($configuracion, $this->acceso_db, $nvo_tram_sql,"");
                                       $nvo_asig_sql= $this->sql->cadena_sql($configuracion,$this->acceso_db,"actualiza_tramite", $fin_tramite);
                                       @$rs_nvo_asigm = $this->ejecutarSQL($configuracion, $this->acceso_db, $nvo_asig_sql,"");
                                    }       
                            							
				//VARIABLES PARA EL LOG
				$registro[0] = "TRAMITAR";
				$registro[1] = $tramite['id_radicado'];
				$registro[2] = "RADICADO";
				$registro[3] = $solicitudes;
				$registro[4] = time();
				$registro[5] = "Se Tramito solicitud ". $tramite['id_radicado']." ";
                                $registro[5].= "por el usuario ". $tramite['id_usuario'];
				$this->log_us->log_usuario($registro,$configuracion);
				echo "<script>alert('Se ha Tramitado la Solicitud, con Exito! Recuerde que para que le sea descargada la solicitud, el usuario de la siguiente área debe registrar el recibo de la Solicitud!')</script>";
			}
			else
			{
				echo "<script>alert('No es posible Tramitar la solicutud')</script>";
			}

		$pagina = $configuracion["host"].$configuracion["site"]."/index.php?";
		$variable = $this->cripto->codificar_url($variable,$configuracion);
		echo "<script>location.replace('".$pagina.$variable."')</script>";

	} // fin function tramitar
        
 
	function recibirTramite($configuracion,$id_tramite){

                include_once($configuracion["raiz_documento"].$configuracion["clases"]."/html.class.php");
                $indice=$configuracion["host"].$configuracion["site"]."/index.php?";	
                $html = new html();
                //var_dump($cod_radica);
		        $id_usuario['id_us'] = $this->usuario;
                $cadena = "No Existen Tramites Registrados.";
                //echo $id_usuario;
                $tramite_sql = $this->sql->cadena_sql($configuracion,$this->funcion->acceso_db,"listar_tram",$id_usuario);
                $rs_tramite = $this->ejecutarSQL($configuracion, $this->acceso_db,$tramite_sql, "busqueda");
                
                if($id_tramite['id_tramite'])
                   { $cod_tramite['id_tramite']=$id_tramite['id_tramite']; }
                else 
                   {$cod_tramite['id_tramite']=$rs_tramite[0]['ID_TRAM'];}   
                $cod_tramite['cod_us']=$this->usuario;
                $cod_tramite['id_rad']=0;
                
                $area_us_sql = $this->sql->cadena_sql($configuracion,$this->funcion->acceso_db,"roles",$cod_tramite);
                $rs_area_us = $this->ejecutarSQL($configuracion, $this->acceso_db,$area_us_sql, "busqueda");
                
                if(count($rs_area_us)>1 && $id_tramite['id_area'] )
                      { $cod_tramite['id_area']=$id_tramite['id_area'];}  
                else  { $cod_tramite['id_area']=$rs_area_us[0]['ID_AREA'];}
        
                $this->formulario1 = "admin_tramite"; ?>
        		<form enctype='multipart/form-data' method='POST' action='index.php' name='<? echo $this->formulario1;?>'>
                           <table width='80%'  class='formulario'  align='center'>
                                    <tr class='bloquecentralcuerpobeige'>
                                        <td  colspan='3'><hr class='hr_subtitulo'/>
                                         RECIBIR SOLICITUDES DE TRAMITE
                                        <hr class='hr_subtitulo'/></td>
                                    </tr>
                                    <tr>
                                        <td width='30%'><?
                                            $texto_ayuda = "<b>Tipo de tramite a recibir.</b><br> ";
                                            ?><span onmouseover="return escape('<? echo $texto_ayuda?>')">Tipo Tramite:</span>
                                            </td>
                                            <td><?     
                                                       $cod_tram=$html->cuadro_lista($rs_tramite,'id_tramite',$configuracion,$cod_tramite['id_tramite'],1,FALSE,$tab++,'id_tramite');
                                                       echo $cod_tram;
                                                       ?>
                                                      
                                            </td>
                                    </tr>
                                    <tr>
                                            <td width='30%'><?
                                                    $texto_ayuda = "<b>Áreas a que el usuario esta inscrito.</b><br> ";
                                                    ?><span onmouseover="return escape('<? echo $texto_ayuda?>')">&Aacute;rea:</span>
                                            </td>
                                            <td><?  
                                                    if(count($rs_area_us)>1)
                                                         { $us_tram=$html->cuadro_lista($area_us_sql ,'id_area',$configuracion,$cod_tramite['id_area'],1,FALSE,$tab++,'id_area');
                                                         }
                                                    else { $us_tram=$html->cuadro_lista($area_us_sql ,'id_area',$configuracion,$cod_tramite['id_area'],3,FALSE,$tab++,'id_area');}
                                                    
                                                    echo $us_tram;?>
                                                <input type='hidden' name='opcion' value='recibir'/>
                                                <input type='hidden' name='action' value='<? echo $this->formulario1;?>'/>
                                                <input name='Consultar' value='>>' type='submit' tabindex='<?= $tab++ ?>' />
                                             </td>
                                    </tr>
                                    
                        </table>
                        </form>
                        <?php
                        
                        $busquedaArea = array( cod_usuario => $this->usuario,
                                               id_area => $cod_tramite['id_area'], 
                                               id_tramite => $cod_tramite['id_tramite'], 
                                               perfil => '4');
                        
                        $area_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"buscar_area_tramite",$busquedaArea);
			@$rs_area = $this->ejecutarSQL($configuracion, $this->acceso_db, $area_sql,"busqueda");

                        $sol_tram_sql = $this->sql->cadena_sql($configuracion,$this->funcion->acceso_db,"busqueda_radicado",$cod_tramite);
			@$rs_sol_tram = $this->ejecutarSQL($configuracion, $this->acceso_db,$sol_tram_sql, "busqueda");
                        
			
			if(is_array($rs_sol_tram))
			{$this->formulario2 = "Recibe"; 
                         $this->verificar = "verificar_Checks(".$this->formulario2.", 1, '')";
                               ?>
                         
                
                        <form enctype='multipart/form-data' method='POST' action='index.php' name='<? echo $this->formulario2;?>'>
                           <table width='80%'  class='formulario'  align='center'>
                            <tr class='bloquecentralcuerpobeige'>
                                <td><span>
                               <a href="#" onclick="cambiaGrupoChecks(this,true)">Seleccionar Todos</a> /
                               <a href="#" onclick="cambiaGrupoChecks(this,false)">Deseleccionar Todos</a>
                               </span>
                                </td> 
                           </tr> 
                           </table>
                           <table width='80%'  class='formulario'  align='center'>
                             <?
                            
                            echo "<br>";
                            $total_campos= count($rs_sol_tram);

                            for ($j=0; $j<$total_campos; $j++){
                                if (fmod($j,5)==0)
                                    echo "<tr>";

                                $id=$rs_sol_tram[$j]['ID_RAD']; //se almacena el id para proporcionar el nombre
                                $nombre= $rs_sol_tram[$j]['VIG']."-".$rs_sol_tram[$j]['ID_TRAM']."-".$rs_sol_tram[$j]['NRO_RAD']; //con el campo nombre se le dá el nombre al checkbox
                                $texto_ayuda =" Seleccionar"; //el comentario sirve para el texto ayuda

                                ?>
                                    <td style='border:none;'>
                                        <input type="checkbox" tabindex="<?echo $tab++ ?>" name= "<? echo 'id_sol_'.$j ?>" value="<? echo $rs_sol_tram[$j]['ID_RAD'] ?>" id="<?echo "id_sol_".$j; ?>">
                                        <span onmouseover="return escape ('<? echo $texto_ayuda?>')" > <?echo $nombre?></span>
                                    </td>
                            <?
                                if (fmod($j,5)==4)
                                    echo "</tr>";

                            }?>
                                   <tr align='center'>
                             <td colspan='5' rowspan='1'>
                                 <br>
				<input type='hidden' name='action' value='admin_tramite'/>
	    			<input type='hidden' name='opcion' value='nuevo'/>
                                <input type='hidden' name='tramites' value='<? echo $j ?>'/>
                                <input type='hidden' name='id_tramite' value='<? echo $rs_area[0]['id_tramite']?>'/>
                                <input type='hidden' name='id_area' value='<? echo $rs_area[0]['id_area']?>'/>
                                <input type='hidden' name='posicion' value='<? echo $rs_area[0]['posicion']?>'/>
                                
                                <!--<input value="Guardar" name="aceptar" tabindex='<?= $tab++ ?>' type="button" onclick="if(<?//= $this->verificar; ?>){ document.forms['<?// echo $this->formulario2?>'].submit()}else{false}"/>-->
                                <input value="Guardar" name="aceptar" tabindex='<?= $tab++ ?>' type="button" onclick=" if(confirm('Recuerde que una vez guarde la información no puede modificarla! Desea Recibir los tramites? ')){if(<?= $this->verificar; ?>){document.forms['<? echo $this->formulario2?>'].submit()}else{false; alert('Debe seleccionar almenos una opción')}}else{false}"/>
                                <input name='cancelar' value='Cancelar' type='submit' tabindex='<?= $tab++ ?>'>
                                

                                <!--input name='cancelar' value='Cancelar' type='button' tabindex='<?// $tab++ ?>' onclick="if(confirm('Señor usuario confirma que desea salir del formulario?, recuerde que perdera los datos que no halla guardado')){location.replace('<?// echo $pagina.$variable?>');}" -->
                             </td>
                         </tr> 
                                    
                        </table>
                        </form><?php
                        
			}
			else
			{
				include_once($configuracion["raiz_documento"].$configuracion["clases"]."/alerta.class.php");
				
				alerta::sin_registro($configuracion,$cadena);
			}

		
		
	}//fin funcion recibir tramite

        
        // funcion que recibe los datos de los tramites recibidos

	function guardarTramite($configuracion){
			  
		//rescata los valores para ingresar los datos del usuario
		//----------------------------------------------------
            //list($d,$m,$a)=explode("/",$_REQUEST["fecha_inactiva"]);
            
            
           $tram_area=array(  id_usuario => $this->usuario,
                               id_tramite => $_REQUEST['id_tramite'],
                               id_area => $_REQUEST['id_area'],
                               posicion => $_REQUEST['posicion'],
                               fecha_registro => date('Y-m-d H:i:s'),
                               estado => '5');
           //var_dump($tram_area);//exit;
           
           /*busca el nmero de areas del tramite*/
           //$areas_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"buscar_area_tramitado",$tram_area);
           //$rs_areas = $this->ejecutarSQL($configuracion, $this->acceso_db, $areas_sql,"");
           
           /*rescata los valores de las solicitudes y actualiza */
           for($aux=0;$aux<=$_REQUEST['tramites'];$aux++)
               {if($_REQUEST['id_sol_'.$aux]>0){
                    $tram_area['id_rad']=$_REQUEST['id_sol_'.$aux];
                    $solicitudes.=$tram_area['id_rad'].",";
                    $tram_area['estado_tram']='3';
                    
                    $busca_area_sql[$aux]= $this->sql->cadena_sql($configuracion,$this->acceso_db,"buscar_area_tramitado", $tram_area);
                    $rs_busca_area = $this->ejecutarSQL($configuracion, $this->acceso_db,$busca_area_sql[$aux],"busqueda");
                    
                    //var_dump($rs_busca_area);
                    $recibe_rad_sql[$aux]= $this->sql->cadena_sql($configuracion,$this->acceso_db,"recibir", $tram_area);
                    $rs_recibe_rad = $this->ejecutarSQL($configuracion, $this->acceso_db,$recibe_rad_sql[$aux],"");
                    
                    if(isset($rs_busca_area) && isset($rs_recibe_rad))
                            {  $rs_busca_area[0]['fecha_traslado']=date('Y-m-d H:i:s');
                               $desc_rad_sql[$aux]= $this->sql->cadena_sql($configuracion,$this->acceso_db,"descargar", $rs_busca_area);
                               $rs_desc_rad = $this->ejecutarSQL($configuracion, $this->acceso_db,$desc_rad_sql[$aux],"");
                            }
                    
                    
                    $asig_sql[$aux]= $this->sql->cadena_sql($configuracion,$this->acceso_db,"recibe_asignado", $tram_area);
                    @$rs_asigm = $this->ejecutarSQL($configuracion, $this->acceso_db, $asig_sql[$aux],"");
                    $tramite_sql[$aux]= $this->sql->cadena_sql($configuracion,$this->acceso_db,"actualiza_tramite",$tram_area);
                    }
               }
              
			$variable = "pagina=adminTramite";
			$variable .= "&opcion=consultar";
			$variable .= "&id_tramite=".$tram_area['id_tramite'];
			$variable .= "&id_area=".$tram_area['id_area'];
			if ($rs_recibe_rad){
                             for($aux=0;$aux<=$_REQUEST['tramites'];$aux++)
                                   {if($_REQUEST['id_sol_'.$aux]>0){
                                        @$rs_tramita = $this->ejecutarSQL($configuracion, $this->acceso_db,$tramite_sql[$aux],"");
                                        }
                                   }
 							
				//VARIABLES PARA EL LOG
				$registro[0] = "REGISTRAR";
				$registro[1] = $tram_area['id_usuario'];
				$registro[2] = "RECIBE SOLICITUD";
				$registro[3] = $solicitudes;
				$registro[4] = time();
				$registro[5] = "Recibe solicitudes ".$solicitudes." para ser tramitadas";
				$registro[5] .= " en el area ".$tram_area['id_area'];
				$registro[5] .= ", para el tramite ".$tram_area['id_tramite'];
                                $this->log_us->log_usuario($registro,$configuracion);
				echo "<script>alert('Se han Asignado las Solicitudes, con Exito!')</script>";
			}
			else
			{
				echo "<script>alert('No es posible Registrar las solicutudes al Usuario')</script>";
			}

		$pagina = $configuracion["host"].$configuracion["site"]."/index.php?";
		$variable = $this->cripto->codificar_url($variable,$configuracion);
		echo "<script>location.replace('".$pagina.$variable."')</script>";

	} // fin function guardarUsuario


	function consultarTramites($configuracion,$cod_radica,$cabecera){

                include_once($configuracion["raiz_documento"].$configuracion["clases"]."/html.class.php");
                $indice=$configuracion["host"].$configuracion["site"]."/index.php?";	
                $html = new html();
                
		$this->formulario = "admin_tramite";
                $indice=$configuracion["host"].$configuracion["site"]."/index.php?";	
            //    var_dump($cod_radica);
		//if($cod_radica['id_rad'] == ""){
                    
		$_REQUEST['vigenciaC']=isset($_REQUEST['vigenciaC'])?$_REQUEST['vigenciaC']:date('Y');
		$id_usuario['id_us'] = $this->usuario;
                //busca vigencias
                $vigencia_sql = $this->sql->cadena_sql($configuracion,$this->funcion->acceso_db,"vigencia_tramites",$id_usuario);
                $rs_vigencia = $this->ejecutarSQL($configuracion, $this->acceso_db,$vigencia_sql, "busqueda");
                                        
                $tramite_sql = $this->sql->cadena_sql($configuracion,$this->funcion->acceso_db,"listar_tram",$id_usuario);
                $rs_tramite = $this->ejecutarSQL($configuracion, $this->acceso_db,$tramite_sql, "busqueda");
              //var_dump($rs_tramite);
                if($cod_radica['id_tramite'])
                   { $tram_Usuario['id_tramite']=$cod_radica['id_tramite']; }
                else 
                   {$tram_Usuario['id_tramite']=$rs_tramite[0]['ID_TRAM'];}   
                $tram_Usuario['cod_us']=$this->usuario;
                $tram_Usuario['vigenciaC']=$_REQUEST['vigenciaC'];
                $tram_Usuario['id_rad']=0;
                
                
                $area_us_sql = $this->sql->cadena_sql($configuracion,$this->funcion->acceso_db,"roles",$tram_Usuario);
                $rs_area_us = $this->ejecutarSQL($configuracion, $this->acceso_db,$area_us_sql, "busqueda");
                
                if(count($rs_area_us)>1 && $_REQUEST['id_area'] )
                      { $tram_Usuario['id_area']=$_REQUEST['id_area'];}  
                else  { $tram_Usuario['id_area']=$rs_area_us[0]['ID_AREA'];}
                         
                if(!$cod_radica['id_area'])
                        {$cod_radica['id_area']=$tram_Usuario['id_area'];}
                
           
               if (!isset($_REQUEST['clave']) && $cabecera==1 ){
                
                $this->formulario1 = "tramite"; 
                $nomBloque = "admin_tramite"; ?>
        		<form enctype='multipart/form-data' method='POST' action='index.php' name='<? echo $this->formulario1;?>'>
                           <table width='80%'  class='formulario'  align='center'>
                                    <tr class='bloquecentralcuerpobeige'>
                                        <td  colspan='3'><hr class='hr_subtitulo'/>
                                        <input name='Regresar' value='<<' type='submit' tabindex='<?= $tab++ ?>' />    
                                         CONSULTAR SOLICITUDES DE TRAMITE
                                        <hr class='hr_subtitulo'/></td>
                                    </tr>
                                    <tr>
                                        <td width='30%'><?
                                            $texto_ayuda = "<b>Vigencia del tramite.</b><br> ";
                                            ?><span onmouseover="return escape('<? echo $texto_ayuda?>')">Vigencia:</span>
                                            </td>
                                            <td><?      $cod_vig=$html->cuadro_lista($rs_vigencia,'vigenciaC',$configuracion,$_REQUEST['vigenciaC'],1,FALSE,$tab++,'vigenciaC');
                                                        echo $cod_vig;
                                                       ?>
                                            </td>
                                    </tr>                                    
                                    <tr>
                                        <td width='30%'><?
                                            $texto_ayuda = "<b>Tipo de tramite a recibir.</b><br> ";
                                            ?><span onmouseover="return escape('<? echo $texto_ayuda?>')">Tipo Tramite:</span>
                                            </td>
                                            <td><?     
                                                       $cod_tram=$html->cuadro_lista($rs_tramite,'id_tramite',$configuracion,$cod_radica['id_tramite'],1,FALSE,$tab++,'id_tramite');
                                                       echo $cod_tram;
                                                       ?>
                                                      
                                            </td>
                                    </tr>
                                    <tr>
                                            <td width='30%'><?
                                                    $texto_ayuda = "<b>Áreas del tramite.</b><br> ";
                                                    ?><span onmouseover="return escape('<? echo $texto_ayuda?>')">&Aacute;rea:</span>
                                            </td>
                                            <td><?  
                                                    if(count($rs_area_us)>1)
                                                         { $us_tram=$html->cuadro_lista($area_us_sql ,'id_area',$configuracion,$tram_Usuario['id_area'],1,FALSE,$tab++,'id_area');
                                                         }
                                                    else { $us_tram=$html->cuadro_lista($area_us_sql ,'id_area',$configuracion,$tram_Usuario['id_area'],3,FALSE,$tab++,'id_area');}
                                                    
                                                    echo $us_tram;?>
                                                <input type='hidden' name='opcion' value='consultar'/>
                                                <input type='hidden' name='action' value='<? echo $nomBloque;?>'/>
                                             </td>
                                    </tr>
                                    
                        </table>
                        </form>
                        <?php }
                      if($cod_radica['id_rad'] == ""){  
			if ($_REQUEST['clave']){
                                $busquedaRadica = array(  cod_us => $this->usuario,
                                                          vigencia => date('Y'), 
                                                          criterio_busqueda => $_REQUEST['criterio_busqueda'],
                                                          id_area=>$tram_Usuario['id_area'],
                                                          valor => $_REQUEST['clave']);
                           
				//$busqueda[1] = $_REQUEST['criterio_busqueda'];//tipo de consulta
				//$busqueda[2] = $_REQUEST['clave'];//cadena a buscar
				$cadena = "No hay Registros para la consulta.";
			}
			else{
				$cadena = "No Existen tramites Registrados.";
			}	
                        //var_dump($busquedaUsuario);
    
			//Rescatar Usuarios, todos si es administrador general 
			if (is_array($busquedaRadica)){
                                
				$cadena_sql = $this->sql->cadena_sql($configuracion,$this->funcion->acceso_db,"tramite_todos",$busquedaRadica);
			
			}		
			else{  
				$cadena_sql = $this->sql->cadena_sql($configuracion,$this->funcion->acceso_db,"tramite_todos",$tram_Usuario);
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
				//evaluamos si existe mas de un registro
				if($totalRegistros > 1)
				{
					$variable["pagina"] = "adminTramite";
					$variable["opcion"] = $_REQUEST["opcion"];
                                        $variable["bloque"] = "admin_tramite";
                                        $variable["hoja"] = isset($_REQUEST["hoja"])?$_REQUEST["hoja"]:'1';
					if(isset($_REQUEST["clave"]))
                                            {$variable["clave"] = $_REQUEST["clave"];}
                                        if(isset($_REQUEST["criterio_busqueda"]))
                                            {$variable["criterio_busqueda"] = $_REQUEST["criterio_busqueda"];}    
                                        $variable["vigenciaC"] = isset($_REQUEST["vigenciaC"])?$_REQUEST["vigenciaC"]:'';
                                        $variable["id_tramite"] = isset($_REQUEST[" id_tramite"])?$_REQUEST[" id_tramite"]:'1';
					$variable["id_area"] = isset($_REQUEST["id_area"])?$_REQUEST["id_area"]:'';

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
					$this->consultarTramites($configuracion,$cod_radica,'2');
				}
			}
			else
			{
				include_once($configuracion["raiz_documento"].$configuracion["clases"]."/alerta.class.php");
				
				alerta::sin_registro($configuracion,$cadena);
			}

		}
		else{        
                    
                       $busquedaArea = array( cod_usuario => $this->usuario,
                                           id_rad => $cod_radica['id_rad'], 
                                           id_area=>$cod_radica['id_area'], 
                                           perfil => '4');
                     
                       
                        $area_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"buscar_area_tramite",$busquedaArea);
			@$rs_area = $this->ejecutarSQL($configuracion, $this->acceso_db, $area_sql,"busqueda");
                        $rs_area[0]['id_rad']=$cod_radica['id_rad'];  
			//busca si existen registro de datos de usuarios en la base de datos 
                       // var_dump($rs_area);
                    
                    
			$cadena_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"busqueda_radicado",$cod_radica);
                        $datos_radica = $this->ejecutarSQL($configuracion, $this->acceso_db, $cadena_sql, "busqueda");
			//busca el estado del usuario
                        //busca los roles del usuario en la base de datos 
                        
                       
			$sol_tram_sql = $this->sql->cadena_sql($configuracion,$this->acceso_db,"radica_tramites",$rs_area);			
                        @$rs_sol_tramite = $this->ejecutarSQL($configuracion, $this->acceso_db, $sol_tram_sql, "busqueda");			
                        
                        
			//Obtener el total de registros
			$totalRegistros = $this->totalRegistros($configuracion, $this->acceso_db);

			$this->cadena_hoja = $sol_tram_sql;

			//Si no se viene de una hoja anterior
		 	if(!isset($_REQUEST["hoja"]))
			{
				$_REQUEST["hoja"] = 1;
			}
			$this->cadena_hoja .= " LIMIT ".(($_REQUEST["hoja"]-1) * $configuracion['registro']).",".$configuracion['registro'];		
			$registro_tramite = $this->ejecutarSQL($configuracion, $this->acceso_db, $this->cadena_hoja, "busqueda");
			//var_dump($registro_tramite);
                        $registro_tramite[0]['ID_TRAM']=$rs_area[0]['id_tramite'];
                        $registro_tramite[0]['POS_TRAM']=$rs_area[0]['posicion'];
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
                                //var_dump($registro_tramite);
                                
                                //echo "<br>".$registro_tramite[0]['ID_EST']." ".$busquedaArea['cod_usuario']." ".$registro_tramite[0]['ID_USU']." ".$registro_tramite[0]['ID_AREA']." ".$rs_area[0]['id_area'];
				if($totalTramite > 0 && $registro_tramite[0]['ID_EST']<=5 && $busquedaArea['cod_usuario']==$registro_tramite[0]['ID_USU'] && $registro_tramite[0]['ID_AREA']==$rs_area[0]['id_area']) 
                                        {$this->form_Tramite($configuracion,$registro_tramite,$tema,$estilo);}
                                else    {
					$variable["pagina"] = "adminTramite";
					$variable["opcion"] = $_REQUEST["opcion"];
					$variable["hoja"] = $_REQUEST["hoja"];
					$variable["id_radica"] = $_REQUEST["id_radica"];
                                        $variable["id_tramite"] = $_REQUEST["id_tramite"];
                                        $variable["id_area"] = $_REQUEST["id_area"];
					$menu = new navegacion();

				?>
					</td>
				</tr>	
				<tr>
				    <td>
					<table width="100%" border="0" align="center" cellpadding="5 px" cellspacing="1px" >
					  <tr class="texto_subtitulo">
						<td>
							Descripci&oacute;n de Tramite <br/>
								<hr class="hr_subtitulo"/>
						</td>
				 	  </tr>
					  <tr>
						<td>
							<table class='contenidotabla'>
								<tr class='cuadro_color'>
                                                                    <td class='cuadro_plano centrar ancho10' >&Aacute;rea</td>
									<td class='cuadro_plano centrar'>Tramit&oacute; </td>
									<td class='cuadro_plano centrar'>Asignado a: </td>
									<td class='cuadro_plano centrar'>Registrado </td>
                                                                        <td class='cuadro_plano centrar'>Tramitado </td>
                                                                        <td class='cuadro_plano centrar'>Estado</td>
                                                                        <td class='cuadro_plano centrar'>Opciones</td>
                                                                </tr>			

							<?
                                                        foreach($registro_tramite as $key => $value )
							{
								?><tr> 
									 <td class='cuadro_plano'><?php echo $registro_tramite[$key]['AREA'];?></td>
									 <td class='cuadro_plano'><?php echo $registro_tramite[$key]['USU'];?></td>
                                                                         <td class='cuadro_plano'><?php echo $registro_tramite[$key]['TMP_USU'];?></td>    
                                                                         <td class='cuadro_plano'><?php echo $registro_tramite[$key]['FEC_REG'];?></td>    
									 <td class='cuadro_plano'><?php echo $registro_tramite[$key]['FEC_TRAM'];?></td>
                                                                         <td class='cuadro_plano'><?php echo $registro_tramite[$key]['EST'];?></td>
                                                                         
                                                                         
                                                                         <td align='center' width='10%' class='cuadro_plano' >
                                                                             
                                                                     <?php if($registro_tramite[$key]['ID_EST']==4 AND isset($registro_tramite[$key]['ID_TMP_USU']))
                                                                               {?>  <a href='<?
                                                                                    $enlace="pagina=borrar_registro";
                                                                                    $enlace.="&opcion=asignado";
                                                                                    $enlace.="&cod_usuario=".$registro_tramite[$key]['ID_TMP_USU'];
                                                                                    $enlace.="&cod_area=".$registro_tramite[$key]['ID_AREA'];
                                                                                    $enlace.="&cod_rad=".$registro_tramite[$key]['ID_RAD'];
                                                                                   
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
                                                                            </td>
                                                                         
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
			<? }//fin if tramites >0 y estado <5
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
		//var_dump($registro);
		?><table width="80%" align="center" border="0" cellpadding="10" cellspacing="0" >
			<tbody>
				<tr>
					<td >
						<table width="100%" border="0" align="center" cellpadding="5 px" cellspacing="1px" >
							<tr class="texto_subtitulo">
								<td>
								Solicitud de Tramite Asignado<br>
								<hr class="hr_subtitulo">
								</td>
							</tr>
							<tr>
								<td>
									<table class='contenidotabla'>
										<tr class='cuadro_color'>
											<td class='cuadro_plano centrar ancho10' >Radicado</td>
											<td class='cuadro_plano centrar'>Descripci&oacute;n </td>
                                                                                        <td class='cuadro_plano centrar'>Concepto </td>
                                                                                        <td class='cuadro_plano centrar'>Fecha Asignado </td>
                                                                                        <td class='cuadro_plano centrar'>Estado</td>
                                                                                        <td class='cuadro_plano centrar'>Fecha Tramitado </td>
										</tr><?
                                                                                
                                                         foreach ($registro as $key => $value)
                                                                {     
                                                        		//Con enlace a la busqueda
									$parametro = "pagina=adminTramite";
									$parametro .= "&hoja=1";
									$parametro .= "&opcion=consultar";
									$parametro .= "&accion=consultar";
                                                                        $parametro .= "&id_tramite=".$registro[$key]['ID_TRAM'];
									$parametro .= "&id_radica=".$registro[$key]['ID_RAD'];
                                                                        $parametro .= "&id_area=".$registro[$key]['ID_AREA'];
                                                                        $parametro .= "&vigenciaC=".$_REQUEST["vigenciaC"];
                                                                        $parametro = $cripto->codificar_url($parametro,$configuracion);
									echo "	<tr>    
                                                                                        <td class='cuadro_plano centrar'><a href='".$indice.$parametro."'>".$registro[$key]['VIG']."-".$registro[$key]['ID_TRAM']."-".$registro[$key]['NRO_RAD']."</a></td>
										 	<td class='cuadro_plano centrar'>".$registro[$key]['DESCR']."</td>    
                                                                                        <td class='cuadro_plano centrar'>".$registro[$key]['CONCEP']."</td>
                                                                                        <td class='cuadro_plano centrar'>".$registro[$key]['FEC_ASIG']."</td>    
                                                                                        <td class='cuadro_plano centrar'>".$registro[$key]['EST_ASIG']."</td>    
                                                                                        <td class='cuadro_plano centrar'>".$registro[$key]['FEC_TRAM']."</td>    
											
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


                
                