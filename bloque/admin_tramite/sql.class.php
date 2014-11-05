<?php
/*--------------------------------------------------------------------------------------------------------------------------
  @ Derechos de Autor: Vea el archivo LICENCIA.txt que viene con la distribucion
---------------------------------------------------------------------------------------------------------------------------*/

if(!isset($GLOBALS["autorizado"]))
{
	include("../index.php");
	exit;		
}

include_once($configuracion["raiz_documento"].$configuracion["clases"]."/sql.class.php");

class sql_adminTramite extends sql
{
	function cadena_sql($configuracion,$conexion, $opcion,$variable="")
	{
		
		switch($opcion)
		{	
                                      				
			case "inserta_rad":
				$cadena_sql="INSERT INTO ";
				$cadena_sql.= $configuracion["prefijo"]."tsolicitud ";
				$cadena_sql.="(";
				$cadena_sql.= "id_sol, ";
				$cadena_sql.= "id_dependencia, ";
				$cadena_sql.= "id_Ttramite, ";
				$cadena_sql.= "id_tconcep, ";
				$cadena_sql.= "vigencia, ";
                                $cadena_sql.= "num_radica, ";
				$cadena_sql.= "cod_oficio, ";
				$cadena_sql.= "descripcion, ";
                                $cadena_sql.= "fecha_registro, ";
				$cadena_sql.= "estado ";
				$cadena_sql.=") ";
				$cadena_sql.="VALUES (";
				$cadena_sql.="'', ";
				$cadena_sql.="'".$variable['cod_dep']."', ";
				$cadena_sql.="'".$variable['cod_tram']."', ";
				$cadena_sql.="'".$variable['cod_doc']."', ";
				$cadena_sql.="'".$variable['vigencia']."', ";
				$cadena_sql.="'".$variable['nro_rad']."', ";
				$cadena_sql.="'".$variable['nro_oficio']."', ";
				$cadena_sql.="'".$variable['descr']."',";
                                $cadena_sql.="'".$variable['fecha_registro']."',";
                                $cadena_sql.="'".$variable['estado']."'";
				$cadena_sql.=")";
				break;	

			

			case "busqueda_radicado":
								
				$cadena_sql= "SELECT ";
				$cadena_sql.= "sol.id_sol ID_RAD, ";
				$cadena_sql.= "sol.id_dependencia ID_DEP, ";
				$cadena_sql.= "sol.id_Ttramite ID_TRAM, ";
                                $cadena_sql.= "area.id_area ID_AREA, ";
                                $cadena_sql.= "area.nombre AREA, ";
                                $cadena_sql.= "tram.nombre TRAM, ";
				$cadena_sql.= "sol.id_tconcep ID_CONCEP, ";
                                $cadena_sql.= "tconp.nombre CONCEP, ";
				$cadena_sql.= "sol.vigencia VIG, ";
                                $cadena_sql.= "sol.num_radica NRO_RAD, ";
				$cadena_sql.= "sol.cod_oficio COD_OF, ";
				$cadena_sql.= "sol.descripcion DESCR, ";
                                $cadena_sql.= "sol.fecha_registro FEC_REG, ";
				$cadena_sql.= "sol.estado ID_EST, ";
                                $cadena_sql.= "esta.nombre EST ";
				$cadena_sql.= "FROM ";
				$cadena_sql.= $configuracion["prefijo"]."tsolicitud sol ";
                                $cadena_sql.= " INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."tramita_solicitud tram_sol ON tram_sol.id_sol=sol.id_sol ";
                                $cadena_sql.= " INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."tipo_tramite tram ON tram.id_Ttramite=sol.id_Ttramite ";
                                $cadena_sql.= " INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."area area ON area.id_area=tram_sol.id_area ";
                                $cadena_sql.= " INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."tipo_concepto tconp ON tconp.id_tconcep=sol.id_tconcep ";
                                $cadena_sql.= " INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."estado esta ON esta.id_estado=sol.estado ";
                                $cadena_sql.= "WHERE ";
                                if($variable['id_rad']>0)
                                    {  $cadena_sql.= " sol.id_sol='".$variable['id_rad']."'"; }
                                else{  $cadena_sql.= " sol.id_Ttramite='".$variable['id_tramite']."'";
                                       $cadena_sql.= " AND tram_sol.id_area='".$variable['id_area']."'";
                                       $cadena_sql.= " AND tram_sol.id_usuario='0' "; 
                                       $cadena_sql.= " AND tram_sol.estado='4' "; 
                                       $cadena_sql.= " AND sol.id_sol NOT IN ("; 
                                       $cadena_sql.= "SELECT ";
                                       $cadena_sql.= "Uasig.id_sol ";
                                       $cadena_sql.= "FROM ";
                                       $cadena_sql.= $configuracion["prefijo"]."tmp_asigna Uasig ";
                                       $cadena_sql.= "WHERE ";
                                       $cadena_sql.= "Uasig.id_usuario<>'".$variable['cod_us']."' ";
                                       $cadena_sql.= "AND Uasig.id_area ='".$variable['id_area']."' ";
                                       $cadena_sql.= "AND Uasig.estado=1) ";
                                    }
                                

			break;	
	
			case "tramite_todos":
				$cadena_sql= "SELECT ";
				$cadena_sql.= "sol.id_sol ID_RAD, ";
                                $cadena_sql.= "tram_sol.id_area ID_AREA, ";
				$cadena_sql.= "sol.id_Ttramite ID_TRAM, ";
				$cadena_sql.= "dep.nombre DEPEN, ";
				$cadena_sql.= "tram.nombre TRAM, ";
				$cadena_sql.= "concep.id_tconcep ID_CONCEP, ";
                                $cadena_sql.= "concep.nombre CONCEP, ";
				$cadena_sql.= "sol.vigencia VIG, ";
                                $cadena_sql.= "sol.num_radica NRO_RAD, ";
				$cadena_sql.= "sol.cod_oficio COD_OF, ";
				$cadena_sql.= "sol.fecha_registro FEC_REG, ";
				$cadena_sql.= "sol.estado EST, ";
                                $cadena_sql.= "tram_sol.fecha_registro FEC_ASIG, ";
                                $cadena_sql.= "tram_sol.fecha_tramitado FEC_TRAM, ";
                                $cadena_sql.= "esta.nombre EST_ASIG, ";
				$cadena_sql.= "sol.descripcion DESCR ";
				$cadena_sql.= "FROM ";
				$cadena_sql.= $configuracion["prefijo"]."tsolicitud sol ";
                                $cadena_sql.= " INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."tramita_solicitud tram_sol ON tram_sol.id_sol=sol.id_sol ";
                                $cadena_sql.= " INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."dependencia dep ON dep.id_dependencia=sol.id_dependencia ";
                                $cadena_sql.= " INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."tipo_tramite tram ON tram.id_Ttramite=sol.id_Ttramite ";
                                $cadena_sql.= " INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."tipo_concepto concep ON concep.id_tconcep=sol.id_tconcep ";
                                $cadena_sql.= " INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."estado esta ON esta.id_estado=tram_sol.estado ";
                                $cadena_sql.="WHERE "; 
				$cadena_sql.=" tram_sol.id_usuario =".$variable['cod_us']." ";
                                
                              //  var_dump($variable);
					
					if($variable['criterio_busqueda']=='FECHA')
					     {	$cadena_sql.="AND sol.fecha_registro LIKE '".$variable['valor']."%' ";
				   	     }
					elseif($variable['criterio_busqueda']=='NUM_RAD')
                                            {       $cadena_sql.=" AND "; 
                                                    $cadena_sql.=" concat(sol.id_Ttramite,'-',sol.num_radica) LIKE '%".$variable['valor']."%' ";
                                            }
                                        elseif($variable['criterio_busqueda']=='DESCRIP')
                                            {       $cadena_sql.="AND "; 
                                                      $cadena_sql.=" sol.descripcion LIKE '%".$variable['valor']."%'";
                                            }
					else
					     {	$cadena_sql.=" AND sol.vigencia='".$variable['vigenciaC']."'";
                                                $cadena_sql.=" AND tram.id_Ttramite='".$variable['id_tramite']."'";
                                                $cadena_sql.=" AND tram_sol.id_area='".$variable['id_area']."'";
                                             }
                               $cadena_sql.=" AND sol.estado NOT IN (8,9) "; 
                               $cadena_sql.= " ORDER BY sol.vigencia DESC,";
                               $cadena_sql.= " sol.num_radica DESC, ";
                               $cadena_sql.= " sol.num_radica DESC ";
                                                                     
                              break;	
                              
                       case "vigencia_tramites":
				$cadena_sql= "SELECT DISTINCT ";
				$cadena_sql.= "sol.vigencia COD_VIG, ";
                                $cadena_sql.= "sol.vigencia VIG ";
                                $cadena_sql.= "FROM ";
				$cadena_sql.= $configuracion["prefijo"]."tsolicitud sol ";
                                $cadena_sql.="WHERE "; 
				$cadena_sql.=" sol.id_usuario =".$variable['id_us']." ";
                                $cadena_sql.= " ORDER BY sol.vigencia DESC ";
                                     
                              break;       
       
			case "radica_tramites":
				$cadena_sql= "SELECT DISTINCT ";
				$cadena_sql.= "sol.id_sol ID_RAD, ";
                                $cadena_sql.= "area.id_area ID_AREA, ";
                                $cadena_sql.= "area.nombre AREA, ";
                                $cadena_sql.= "sol.id_usuario ID_USU, ";
                                $cadena_sql.= "(SELECT concat(usu.nombre,' ',usu.apellido)  ";
                                $cadena_sql.= "FROM  ";
                                $cadena_sql.= $configuracion["prefijo"]."registrado usu";
                                $cadena_sql.= " WHERE usu.id_usuario=sol.id_usuario ) USU,";
                                $cadena_sql.= " asig.id_usuario ID_TMP_USU,";
                                $cadena_sql.= "(SELECT concat(usu2.nombre,' ',usu2.apellido)  ";
                                $cadena_sql.= "FROM  ";
                                $cadena_sql.= $configuracion["prefijo"]."registrado usu2";
                                $cadena_sql.= " WHERE usu2.id_usuario=asig.id_usuario ) TMP_USU, ";
                                $cadena_sql.= "sol.fecha_registro FEC_REG, ";
                                $cadena_sql.= "sol.fecha_tramitado FEC_TRAM, ";
                                $cadena_sql.= "sol.fecha_traslado FEC_SALE, ";
                                $cadena_sql.= "esta.id_estado ID_EST, ";
				$cadena_sql.= "esta.nombre EST ";
				$cadena_sql.= "FROM ";
                                $cadena_sql.= $configuracion["prefijo"]."tramita_solicitud sol ";
                                $cadena_sql.= " INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."area area ON area.id_area=sol.id_area ";
                                $cadena_sql.= " INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."estado esta ON esta.id_estado=sol.estado ";
                                $cadena_sql.= " LEFT OUTER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."tmp_asigna asig ON asig.id_sol=sol.id_sol AND asig.id_area=sol.id_area AND asig.estado=1 ";
                                $cadena_sql.="WHERE "; 
				$cadena_sql.=" sol.id_sol=".$variable[0]['id_rad'];
                                /*$cadena_sql.=" AND "; 
				$cadena_sql.=" sol.id_area=".$variable[0]['id_area'];*/
                                $cadena_sql.=" ORDER BY esta.id_estado, sol.id_usuario ASC ";
				                                
                             //  echo $cadena_sql;exit;
				break;		

                            
                    //se usa
                        case "listar_tram":
				
				$cadena_sql= "SELECT DISTINCT ";
                                $cadena_sql.="tram.id_Ttramite ID_TRAM, ";
                                $cadena_sql.="tram.nombre TRAM ";
                                $cadena_sql.="FROM ";
                                $cadena_sql.=$configuracion["prefijo"]."tipo_tramite tram";
                                $cadena_sql.=" INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."area_ttramite area_tram ";
                                $cadena_sql.= "ON area_tram.id_Ttramite=tram.id_Ttramite ";
                                $cadena_sql.= " INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."registrado_subsistema sub";
                                $cadena_sql.=" ON sub.id_area=area_tram.id_area AND sub.id_subsistema=4";
                                $cadena_sql.=" AND ";
                                $cadena_sql.=" sub.id_usuario=".$variable['id_us'];
                                $cadena_sql.=" WHERE tram.id_Ttramite>0 ORDER BY tram.id_Ttramite ";
                                                        
			break;	
                    
                    case "areas_tramite":
				
				$cadena_sql= "SELECT MAX";
                                $cadena_sql.="(area_tram.posicion_tramite) areas ";
                                $cadena_sql.=" FROM ";
                                $cadena_sql.= $configuracion["prefijo"]."area_ttramite area_tram ";
                                $cadena_sql.= " WHERE ";
                                $cadena_sql.= " area_tram.id_Ttramite='".$variable['id_tramite']."' ";
                                
                                
			break;	    
                   
                    case "buscar_area_tramite":
				
				$cadena_sql= "SELECT DISTINCT ";
                                $cadena_sql.="sub.id_usuario id_usuario, ";
                                $cadena_sql.="area_tram.id_area id_area, ";
                                $cadena_sql.="area.nombre area, ";
                                $cadena_sql.="area_tram.id_Ttramite id_tramite, ";
                                $cadena_sql.="area_tram.posicion_tramite posicion ";
                                $cadena_sql.=" FROM ";
                                $cadena_sql.= $configuracion["prefijo"]."registrado_subsistema sub ";
                                $cadena_sql.=" INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."area_ttramite area_tram ";
                                $cadena_sql.= " ON area_tram.id_area=sub.id_area ";
                                $cadena_sql.=" INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."area area ";
                                $cadena_sql.= " ON area_tram.id_area=area.id_area ";
                                if($variable['id_tramite'])
                                    {$cadena_sql.= " AND area_tram.id_Ttramite='".$variable['id_tramite']."' ";}
                                elseif($variable['id_rad'])    
                                    {$cadena_sql.= " INNER JOIN ";
                                     $cadena_sql.= $configuracion["prefijo"]."tsolicitud sol ";
                                     $cadena_sql.= " ON sol.id_Ttramite=area_tram.id_Ttramite";
                                     $cadena_sql.= " INNER JOIN ";
                                     $cadena_sql.= $configuracion["prefijo"]."tramita_solicitud tram_sol ";    
                                     $cadena_sql.= " ON tram_sol.id_area=area_tram.id_area  AND tram_sol.id_sol=sol.id_sol  AND tram_sol.id_sol=".$variable['id_rad'];    
                                    }
                                $cadena_sql.= " WHERE ";
                                $cadena_sql.= " sub.id_usuario=".$variable['cod_usuario'];
                                $cadena_sql.= " AND sub.id_subsistema=".$variable['perfil'];
                                if($variable['id_area'])
                                    {$cadena_sql.= " AND area.id_area='".$variable['id_area']."' ";}
                                
			break;	

                        case "buscar_area_tramitado":
				
				$cadena_sql= "SELECT DISTINCT ";
                                $cadena_sql.="area_tram.id_Ttramite id_tramite, ";
                                $cadena_sql.="tram_sol.id_sol id_radicado, ";
                                $cadena_sql.="tram_sol.id_area id_area, ";
                                $cadena_sql.="tram_sol.id_usuario id_usuario, ";
                                $cadena_sql.="tram_sol.estado estado, ";
                                $cadena_sql.="area_tram.posicion_tramite posicion ";
                                $cadena_sql.=" FROM ";
                                $cadena_sql.= $configuracion["prefijo"]."tramita_solicitud tram_sol ";    
                                $cadena_sql.=" INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."area_ttramite area_tram ";
                                $cadena_sql.= " ON area_tram.id_area=tram_sol.id_area ";
                                $cadena_sql.= " INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."tsolicitud sol ";
                                $cadena_sql.= " ON sol.id_Ttramite=area_tram.id_Ttramite AND sol.id_sol=tram_sol.id_sol ";
                                $cadena_sql.= " WHERE ";
                                $cadena_sql.= "  tram_sol.id_sol=".$variable['id_rad'];    
                                $cadena_sql.= "  AND tram_sol.estado IN (6,7)";    
                                $cadena_sql.=" ORDER BY area_tram.posicion_tramite DESC ";
                                $cadena_sql.=" LIMIT 0,1 ";
                                
			break;	
                        
                        
			case "tramitar":
				$cadena_sql  = "UPDATE "; 
				$cadena_sql .= $configuracion["prefijo"]."tramita_solicitud "; 
				$cadena_sql .= "SET " ;   
                                $cadena_sql.=" descripcion='".$variable['describe']."', ";
                                $cadena_sql.=" estado='".$variable['estado_tram']."', ";
                                $cadena_sql.=" fecha_tramitado='".$variable['fecha_tramitado']."'";
				$cadena_sql .= " WHERE ";
				$cadena_sql .= " id_sol='".$variable['id_radicado']."' ";
                                $cadena_sql .= " AND id_area='".$variable['id_area']."'";
                                $cadena_sql .= " AND id_usuario='".$variable['id_usuario']."'; ";
				
				break;
                            
                       case "descargar":
				$cadena_sql  = "UPDATE "; 
				$cadena_sql .= $configuracion["prefijo"]."tramita_solicitud "; 
				$cadena_sql .= "SET " ;   
                                $cadena_sql.=" fecha_traslado='".$variable[0]['fecha_traslado']."'";
				$cadena_sql .= " WHERE ";
				$cadena_sql .= " id_sol='".$variable[0]['id_radicado']."' ";
                                $cadena_sql .= " AND id_area='".$variable[0]['id_area']."'";
                                $cadena_sql .= " AND id_usuario='".$variable[0]['id_usuario']."'; ";
				
				break;     
                            
                       	case "recibir":
				$cadena_sql  = "UPDATE "; 
				$cadena_sql .= $configuracion["prefijo"]."tramita_solicitud "; 
				$cadena_sql .= "SET " ;   
                                $cadena_sql.=" id_usuario='".$variable['id_usuario']."', ";
                                $cadena_sql.=" estado='".$variable['estado']."', ";
                                $cadena_sql.=" fecha_registro='".$variable['fecha_registro']."'";
				$cadena_sql .= " WHERE ";
				$cadena_sql .= " id_sol='".$variable['id_rad']."' ";
                                $cadena_sql .= " AND ";
                                $cadena_sql .= " id_area='".$variable['id_area']."';";
				
				break;    

                        case "actualiza_tramite":
				$cadena_sql  = "UPDATE "; 
				$cadena_sql .= $configuracion["prefijo"]."tsolicitud "; 
				$cadena_sql .= "SET " ;   
                                $cadena_sql.=" estado='".$variable['estado_tram']."' ";
                                $cadena_sql .= " WHERE ";
				$cadena_sql .= " id_sol='".$variable['id_rad']."'; ";
                                
				break;    
                            
                        case "listar_estado":
				
				$cadena_sql= "SELECT DISTINCT ";
                                $cadena_sql.="id_estado ID_EST, ";
                                $cadena_sql.="nombre EST ";
                                $cadena_sql.="FROM ";
                                $cadena_sql.=$configuracion["prefijo"]."estado ";
                                $cadena_sql.=" WHERE tipo='".$variable."'";
                        
			break;	    
                        
                        case "insertar_tramite":
								
				$cadena_sql= "INSERT INTO ";
                                $cadena_sql.=$configuracion["prefijo"]."tramita_solicitud ";
                                $cadena_sql.="(id_sol, ";
                                $cadena_sql.="id_area, ";
                                $cadena_sql.="id_usuario, ";
                                $cadena_sql.="estado, ";
                                $cadena_sql.="fecha_registro) ";
                                $cadena_sql.=" VALUES ";
                                $cadena_sql.="('".$variable['cod_rad']."',";
                                $cadena_sql.="'".$variable['cod_area']."',";
                                $cadena_sql.="'".$variable['cod_usuario']."',";
                                $cadena_sql.="'".$variable['estado']."',";
                                $cadena_sql.="'".$variable['fecha_registro']."')";
                                                               
			break;	
                    
                       	case "terminar_tramite":
				$cadena_sql="UPDATE "; 
				$cadena_sql.=$configuracion["prefijo"]."tramita_solicitud "; 
				$cadena_sql.="SET " ;   
                                $cadena_sql.=" estado='".$variable['estado']."', ";
                                $cadena_sql.=" fecha_tramitado='".$variable['fecha_tramitado']."', ";
                                $cadena_sql.=" fecha_traslado='".$variable['fecha_tramitado']."' ";
				$cadena_sql.=" WHERE ";
				$cadena_sql.=" id_sol='".$variable['cod_rad']."' ";
                                $cadena_sql.=" AND ";
                                $cadena_sql.=" id_area='".$variable['cod_area']."' ";
                                $cadena_sql.=" AND ";
                                $cadena_sql.=" id_usuario='".$variable['cod_usuario']."'; ";
				
				break;                        
                    
                    
                        case "busqueda_tramite_area":
				
				$cadena_sql= "SELECT DISTINCT ";
				$cadena_sql.= "area.id_area ID_AREA, ";
                                $cadena_sql.= "area.nombre AREA, ";
                                $cadena_sql.= "usu.id_usuario ID_US, ";
                                $cadena_sql.= "concat(usu.nombre,' ',usu.apellido) USU ";
                                $cadena_sql.= "FROM ";
                                $cadena_sql.= $configuracion["prefijo"]."registrado usu";
                                $cadena_sql.=" INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."registrado_subsistema sub ";
                                $cadena_sql.= " ON usu.id_usuario=sub.id_usuario AND sub.estado=1 ";
                                $cadena_sql.=" INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."area_ttramite area_tram ";
                                $cadena_sql.= " ON area_tram.id_area=sub.id_area ";
                                $cadena_sql.=" INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."area area ON area.id_area=area_tram.id_area ";
                                /*$this->cadena_sql.=" INNER JOIN ";
                                $this->cadena_sql.= $configuracion["prefijo"]."area_ttramite area_tram ON area_tram.id_area=area.id_area AND area_tram.id_Ttramite=sol.id_Ttramite ";*/
                                
                                $cadena_sql.="WHERE "; 
				$cadena_sql.="area_tram.id_Ttramite=".$variable['id_tramite'];
                                $cadena_sql.=" AND area_tram.posicion_tramite=".$variable['posicion'];
                                
							
                               //echo $this->cadena_sql;exit;
				break;	
                            
                          case "insertar_asignado":
								
				$cadena_sql= "INSERT INTO ";
                                $cadena_sql.=$configuracion["prefijo"]."tmp_asigna ";
                                $cadena_sql.="(id_sol, ";
                                $cadena_sql.="id_area, ";
                                $cadena_sql.="id_usuario, ";
                                $cadena_sql.="estado, ";
                                $cadena_sql.="fecha_registro) ";
                                $cadena_sql.=" VALUES ";
                                $cadena_sql.="('".$variable['cod_rad']."',";
                                $cadena_sql.="'".$variable['cod_area']."',";
                                $cadena_sql.="'".$variable['asig_usuario']."',";
                                $cadena_sql.="'1',";
                                $cadena_sql.="'".date('Y-m-d H:i:s')."')";
                         
			break;	  
                    
                        case "recibe_asignado":
								
				$cadena_sql= "UPDATE ";
                                $cadena_sql.=$configuracion["prefijo"]."tmp_asigna ";
                                $cadena_sql.=" SET ";
                                $cadena_sql.="estado='0', ";
                                $cadena_sql.="fecha_fin='".date('Y-m-d')."'";
                                $cadena_sql.=" WHERE ";
                                $cadena_sql.=" id_sol='".$variable['id_rad']."' ";
                                $cadena_sql.=" AND ";
                                $cadena_sql.="id_area='".$variable['id_area']."' ";
                                $cadena_sql.=" AND ";
                                $cadena_sql.="id_usuario='".$variable['id_usuario']."'";
                                                                                         
			break;	
                    
			case "roles":
                            
				$cadena_sql= "SELECT ";
                                $cadena_sql.= "reg.id_area ID_AREA, ";
                                $cadena_sql.= "area.nombre AREA ";
                                $cadena_sql.= "FROM ";
                                $cadena_sql.= $configuracion["prefijo"]."registrado_subsistema reg ";
                                $cadena_sql.= "INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."subsistema sub on reg.id_subsistema=sub.id_subsistema and sub.id_subsistema=4 ";
                                $cadena_sql.= "INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."area area on reg.id_area=area.id_area ";
                                $cadena_sql.= "INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."dependencia dep on dep.id_dependencia=area.id_dependencia ";
                                $cadena_sql.= "INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."area_ttramite areat on areat.id_area=area.id_area ";
                                $cadena_sql.= "WHERE ";
                                $cadena_sql.= "reg.id_usuario ='".$variable['cod_us']."' ";
                                $cadena_sql.= "AND areat.id_Ttramite ='".$variable['id_tramite']."'";
                                $cadena_sql.= " ORDER BY areat.posicion_tramite ";
                                
                                                                                        
                                break;                    

 
			default:
				$cadena_sql="";
				break;
		}//fin switch
		return $cadena_sql;
	}// fin funcion cadena_sql
	
	
}//fin clase sql_adminUsuario
?>

