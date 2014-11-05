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

class sql_adminRadica extends sql
{
	function cadena_sql($configuracion,$conexion, $opcion,$variable="")
	{
		
		switch($opcion)
		{	
                        case "areaUsuario":
                            $cadena_sql="SELECT DISTINCT";
                            $cadena_sql.=" id_usuario ID_ADMIN,";
                            $cadena_sql.=" id_area AREA";
                            $cadena_sql.=" FROM ";
                            $cadena_sql.= $configuracion["prefijo"]."registrado_subsistema ";
                            $cadena_sql.=" WHERE ";
                            $cadena_sql.=" id_usuario=".$variable['id_us'];
                            //echo $cadena_sql;exit;
                        break;
                    				
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
				$cadena_sql.= "estado, ";
                                $cadena_sql.= "id_usuario ";
				$cadena_sql.=") ";
				$cadena_sql.="VALUES (";
				$cadena_sql.="'', ";
				$cadena_sql.="'".$variable['cod_dep']."', ";
				$cadena_sql.="'".$variable['cod_tram']."', ";
				$cadena_sql.="'".$variable['cod_doc']."', ";
				$cadena_sql.="'".$variable['vigencia']."', ";
				$cadena_sql.="'".$variable['nro_rad']."', ";
				$cadena_sql.="UPPER('".$variable['nro_oficio']."'), ";
				$cadena_sql.="'".$variable['descr']."',";
                                $cadena_sql.="'".$variable['fecha_registro']."',";
                                $cadena_sql.="'".$variable['estado']."',";
                                $cadena_sql.="'".$variable['cod_usuario']."'";
				$cadena_sql.=")";
				break;	

			

			case "busqueda_radicado":
								
				$cadena_sql= "SELECT ";
				$cadena_sql.= "sol.id_sol ID_RAD, ";
				$cadena_sql.= "sol.id_dependencia ID_DEP, ";
				$cadena_sql.= "sol.id_Ttramite ID_TRAM, ";
                $cadena_sql.= "tram.nombre TRAM, ";
                $cadena_sql.= "tram.gen_consec CONSEC, ";
                $cadena_sql.= "varia.valor TIP_CONSEC, ";
				$cadena_sql.= "sol.id_tconcep ID_CONCEP, ";
                $cadena_sql.= "tconp.nombre CONCEP, ";
				$cadena_sql.= "sol.vigencia VIG, ";
                $cadena_sql.= "sol.num_radica NRO_RAD, ";
				$cadena_sql.= "sol.cod_oficio COD_OF, ";
				$cadena_sql.= "sol.descripcion DESCR, ";
                $cadena_sql.= "sol.fecha_registro FEC_REG, ";
				$cadena_sql.= "sol.estado ID_EST, ";
				$cadena_sql.= "dep.nombre DEPEN, ";
				$cadena_sql.= "esta.nombre EST, ";
				$cadena_sql.= "sol.id_usuario ID_US_RAD, ";
				$cadena_sql.= "upper(concat(usu.nombre,' ',usu.apellido)) US_RAD, ";
				$cadena_sql.= "tram.dias_respuesta RESP ";
				$cadena_sql.= "FROM ";
				$cadena_sql.= $configuracion["prefijo"]."tsolicitud sol ";
                                $cadena_sql.= " INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."tipo_tramite tram ON tram.id_Ttramite=sol.id_Ttramite ";
                                $cadena_sql.= " INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."tipo_concepto tconp ON tconp.id_tconcep=sol.id_tconcep ";
                                $cadena_sql.= " INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."estado esta ON esta.id_estado=sol.estado ";
                                $cadena_sql.= " INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."registrado usu ON usu.id_usuario=sol.id_usuario ";
                                $cadena_sql.= " LEFT OUTER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."variable varia ON tram.id_tipo=varia.id_tipo ";
                                $cadena_sql.= " INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."dependencia dep ON dep.id_dependencia=sol.id_dependencia ";

                                $cadena_sql.= "WHERE ";
                                if($variable['id_rad']=="")
                                    { $cadena_sql.= " sol.vigencia='".$variable['vigencia']."'";
                                      $cadena_sql.= " AND sol.id_Ttramite='".$variable['cod_tram']."'";
									  $cadena_sql.= " AND sol.num_radica='".$variable['nro_rad']."'";
                                    }
                                else{ $cadena_sql.= " sol.id_sol='".$variable['id_rad']."'";
                                    }
                                

			break;	
                        
                        case "busqueda_oficio":
								
				$cadena_sql= "SELECT ";
				$cadena_sql.= "sol.id_sol ID_RAD ";
				$cadena_sql.= "FROM ";
				$cadena_sql.= $configuracion["prefijo"]."tsolicitud sol ";
                                $cadena_sql.= "WHERE ";
                                $cadena_sql.= " sol.vigencia='".$variable['vigencia']."'";
                                $cadena_sql.= " AND upper(sol.cod_oficio)=upper('".$variable['nro_oficio']."')";

			break;	

	
			case "radica_todos":
				$cadena_sql= "SELECT ";
				$cadena_sql.= "sol.id_sol ID_RAD, ";
                                $cadena_sql.= "sol.id_Ttramite ID_TRAM, ";
				$cadena_sql.= "dep.nombre DEPEN, ";
				$cadena_sql.= "tram.nombre TRAM, ";
				$cadena_sql.= "sol.id_tconcep ID_CONCEP, ";
				$cadena_sql.= "sol.vigencia VIG, ";
                                $cadena_sql.= "sol.num_radica NRO_RAD, ";
				$cadena_sql.= "sol.cod_oficio COD_OF, ";
				$cadena_sql.= "sol.fecha_registro FEC_REG, ";
				$cadena_sql.= "sol.estado EST, ";
				$cadena_sql.= "sol.descripcion DESCR ";
				$cadena_sql.= "FROM ";
				$cadena_sql.= $configuracion["prefijo"]."tsolicitud sol ";
                                $cadena_sql.= " INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."dependencia dep ON dep.id_dependencia=sol.id_dependencia ";
                                $cadena_sql.= " INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."tipo_tramite tram ON tram.id_Ttramite=sol.id_Ttramite ";
                              //  var_dump($variable);
					
					if($variable['criterio_busqueda']=='FECHA')
					{       $cadena_sql.="WHERE ";
						$cadena_sql.=" sol.fecha_registro LIKE '".$variable['valor']."%'";
					}
					elseif($variable['criterio_busqueda']=='NUM_RAD')
					{       $cadena_sql.="WHERE "; 
						$cadena_sql.=" sol.vigencia=".$variable['vigencia'];
                                                $cadena_sql.=" AND CONCAT(sol.id_Ttramite,'-',sol.num_radica) LIKE '%".$variable['valor']."%'";
					}
                                        elseif($variable['criterio_busqueda']=='COD_US')
					{       $cadena_sql.="WHERE "; 
						    $cadena_sql.=" reg.id_usuario =".$variable['valor'];
					}
					elseif($variable['criterio_busqueda']=='DESCRIP')
					{       $cadena_sql.="WHERE "; 
						    $cadena_sql.=" sol.descripcion LIKE '%".$variable['valor']."%'";
					}
                                        else
					{       $cadena_sql.="WHERE "; 
						$cadena_sql.=" sol.vigencia=".$variable;
					}
                                $cadena_sql.= " ORDER BY sol.fecha_registro DESC ";       
				
                               //echo $cadena_sql;exit;
				break;		

			case "radica_tramites":
				$cadena_sql= "SELECT ";
				$cadena_sql.= "sol.id_sol ID_RAD, ";
                                $cadena_sql.= "area.nombre AREA, ";
                                $cadena_sql.= "sol.id_usuario ID_USU, ";
                                $cadena_sql.= "concat(usu.nombre,' ',usu.apellido) USU, ";
                                $cadena_sql.= "sol.descripcion DESCR, ";
				$cadena_sql.= "sol.fecha_registro FEC_REG, ";
                                $cadena_sql.= "sol.fecha_tramitado FEC_TRAM, ";
                                $cadena_sql.= "sol.fecha_traslado FEC_SALE, ";
				$cadena_sql.= "esta.nombre EST ";
				$cadena_sql.= "FROM ";
                                $cadena_sql.= $configuracion["prefijo"]."tramita_solicitud sol ";
                                $cadena_sql.= " INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."area area ON area.id_area=sol.id_area ";
								$cadena_sql.= " INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."area_ttramite area_tram ON area_tram.id_area=sol.id_area AND area_tram.id_Ttramite=".$variable['id_tram']." ";
                                $cadena_sql.= " INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."registrado usu ON usu.id_usuario=sol.id_usuario ";
                                $cadena_sql.= " INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."estado esta ON esta.id_estado=sol.estado ";
                                $cadena_sql.="WHERE "; 
				$cadena_sql.=" sol.id_sol=".$variable['id_rad'];
				$cadena_sql.= " ORDER BY ";
                                $cadena_sql.= " area_tram.posicion_tramite DESC ";
							
                               //echo $cadena_sql;exit;
				break;		

                            
                    
                        case "numero_rad":
				
				$cadena_sql= "SELECT ";
                                $cadena_sql.="MAX(DISTINCT rad.num_radica) NRO_RAD ";
                                $cadena_sql.="FROM ";
                                $cadena_sql.=$configuracion["prefijo"]."tsolicitud  rad ";
                                $cadena_sql.="WHERE rad.vigencia='".$variable['vigencia']."' ";
                                $cadena_sql.="AND rad.id_Ttramite='".$variable['cod_tram']."' ";
                                $cadena_sql.="ORDER BY rad.num_radica ASC ";
                        
			break;	
                    
                       case "listar_tram":
				
				$cadena_sql= "SELECT DISTINCT ";
                                $cadena_sql.="id_Ttramite ID_TRAM, ";
                                $cadena_sql.="nombre TRAM ";
                                $cadena_sql.="FROM ";
                                $cadena_sql.=$configuracion["prefijo"]."tipo_tramite ";
                                $cadena_sql.="WHERE id_Ttramite>0 ORDER BY nombre ";
                        
			break;
                    
                    
                    
                       case "listar_dep":
				
				$cadena_sql= "SELECT DISTINCT ";
                                $cadena_sql.="id_dependencia ID_DEP, ";
                                $cadena_sql.="nombre DEP ";
                                $cadena_sql.="FROM ";
                                $cadena_sql.=$configuracion["prefijo"]."dependencia ";
                                $cadena_sql.=" WHERE id_dependencia>0 ";
                                if($variable['nombre_dep'])
					{ $cadena_sql.=" AND ";
					  $cadena_sql.=" nombre=upper('".$variable['nombre_dep']."') ";
					}
                                $cadena_sql.=" ORDER BY nombre ";
                        
			break;	
                   
                   case "cod_dep":
				
				$cadena_sql= "SELECT ";
                                $cadena_sql.=" MAX(DISTINCT id_dependencia) ID_DEP ";
                                $cadena_sql.="FROM ";
                                $cadena_sql.=$configuracion["prefijo"]."dependencia ";
                                $cadena_sql.="WHERE id_dependencia>0 ORDER BY id_dependencia DESC ";
                        
			break;
                     
                    
                    case "buscar_dep":
				
				$cadena_sql= "SELECT DISTINCT ";
                                $cadena_sql.="dep.id_dependencia ID_DEP, ";
                                $cadena_sql.="dep.nombre DEPE ";
                                $cadena_sql.="FROM ";
                                $cadena_sql.=$configuracion["prefijo"]."dependencia dep ";
                                $cadena_sql.= "INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."area area on dep.id_dependencia=area.id_dependencia ";
                                $cadena_sql.= "AND area.id_area='".$variable[0]['ID_AREA']."'";
                               
			break;	
                    
                    case "inserta_dep":
								
				$cadena_sql= "INSERT INTO ";
                                $cadena_sql.=$configuracion["prefijo"]."dependencia ";
                                $cadena_sql.="(id_dependencia, ";
                                $cadena_sql.="nombre, ";
                                $cadena_sql.="descripcion, ";
                                $cadena_sql.="estado) ";
                                $cadena_sql.=" VALUES";
                                $cadena_sql.="('".$variable['cod_dep']."',";
                                $cadena_sql.="'".$variable['nombre_dep']."',";
                                $cadena_sql.="'".$variable['desc_dep']."',";
                                $cadena_sql.="'".$variable['estado']."')";
                                                               
			break;	
                    
                    
                     case "lista_area_dep":
				
				$cadena_sql= "SELECT DISTINCT ";
                                $cadena_sql.="area.id_area ID_AREA, ";
                                $cadena_sql.="area.nombre AREA ";
                                $cadena_sql.="FROM ";
                                $cadena_sql.= $configuracion["prefijo"]."area area ";
                                $cadena_sql.= "WHERE area.id_dependencia='".$variable[0]['ID_DEP']."'";
                               
			break;	
                    
                     case "buscar_area":
				
				$cadena_sql= "SELECT DISTINCT ";
                                $cadena_sql.="area.id_area ID_AREA, ";
                                $cadena_sql.="area.nombre AREA ";
                                $cadena_sql.="FROM ";
                                $cadena_sql.= $configuracion["prefijo"]."area area ";
                                $cadena_sql.= "WHERE area.id_area='".$variable[0]['ID_AREA']."'";
                               
			break;	
                    
                    case "buscar_area_tramite":
				
				$cadena_sql= "SELECT DISTINCT ";
                                $cadena_sql.="area_tram.id_area ID_AREA, ";
                                $cadena_sql.="area_tram.id_Ttramite ID_TRAM ";
                                $cadena_sql.="FROM ";
                                $cadena_sql.= $configuracion["prefijo"]."area_ttramite area_tram ";
                                $cadena_sql.= "WHERE area_tram.id_Ttramite='".$variable['cod_tram']."' ";
                                $cadena_sql.= "AND area_tram.posicion_tramite='2' ";
                                $cadena_sql.= "AND area_tram.estado='1' ";
                               
                                
                                
			break;	

                    case "listar_area_tramite":
				
				$cadena_sql= "SELECT DISTINCT ";
                                $cadena_sql.="area_tram.id_Ttramite ID_TRAM, ";
                                $cadena_sql.="area.id_area ID_AREA, ";
                                $cadena_sql.="area.nombre AREA, ";
								$cadena_sql.="area_tram.posicion_tramite POS ";
                                $cadena_sql.="FROM ";
                                $cadena_sql.= $configuracion["prefijo"]."area_ttramite area_tram ";
								$cadena_sql.=" INNER JOIN ";
								$cadena_sql.= $configuracion["prefijo"]."area area ON area_tram.id_area=area.id_area ";
                                $cadena_sql.= "WHERE area_tram.id_Ttramite='".$variable['cod_tram']."' ";
//                                $cadena_sql.= "AND area_tram.posicion_tramite>'1' ";
                                $cadena_sql.= "AND area_tram.estado='1' ";
                               
                                
                                
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

                    case "vigencia_tramites":
				$cadena_sql= "SELECT DISTINCT ";
				$cadena_sql.= "sol.vigencia COD_VIG, ";
                                $cadena_sql.= "sol.vigencia VIG ";
                                $cadena_sql.= "FROM ";
				$cadena_sql.= $configuracion["prefijo"]."tsolicitud sol ";
                                $cadena_sql.= " ORDER BY sol.vigencia DESC ";
                                     
                              break;
 
			default:
				$cadena_sql="";
				break;
		}//fin switch
		return $cadena_sql;
	}// fin funcion cadena_sql
	
	
}//fin clase sql_adminUsuario
?>

