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

class sql_adminTipoTramite extends sql
{
	function cadena_sql($configuracion,$conexion, $opcion,$variable="")
	{
		
		switch($opcion)
		{	
                                      				
			case "inserta_Ttram":
				$cadena_sql="INSERT INTO ";
				$cadena_sql.= $configuracion["prefijo"]."tipo_tramite ";
				$cadena_sql.="(";
				$cadena_sql.= "id_Ttramite, ";
				$cadena_sql.= "nombre, ";
				$cadena_sql.= "descripcion, ";
				$cadena_sql.= "estado, ";
                                $cadena_sql.= "fecha_registro, ";
				$cadena_sql.= "resumen, ";
                                $cadena_sql.= "id_dependencia, ";
				$cadena_sql.= "dias_respuesta ";
				$cadena_sql.=") ";
				$cadena_sql.="VALUES (";
				$cadena_sql.="'".$variable['id_Ttram']."', ";
				$cadena_sql.="'".$variable['nombre']."', ";
				$cadena_sql.="'".$variable['descr']."', ";
				$cadena_sql.="'".$variable['estado']."', ";
				$cadena_sql.="'".$variable['fecha_registro']."', ";
				$cadena_sql.="'".$variable['resumen']."', ";
                                $cadena_sql.="'".$variable['id_dep']."',";
                                $cadena_sql.="'".$variable['dias']."'";
				$cadena_sql.=")";
				break;	
	

                       
			case "tramite_todos":
				$cadena_sql= "SELECT DISTINCT ";
                                $cadena_sql.="tram.id_Ttramite ID_TRAM, ";
                                $cadena_sql.="tram.nombre TRAM, ";
                                $cadena_sql.="tram.descripcion DESC_TRAM, ";
                                $cadena_sql.="est.nombre EST_TRAM, ";
                                $cadena_sql.="tram.fecha_registro FEC_TRAM, ";
                                $cadena_sql.="tram.resumen RES_TRAM, ";
                                $cadena_sql.="tram.dias_respuesta RTA_TRAM, ";
                                $cadena_sql.="tram.id_dependencia ID_DEP, ";
                                $cadena_sql.="dep.nombre NOM_DEP ";
                                $cadena_sql.="FROM ";
                                $cadena_sql.=$configuracion["prefijo"]."tipo_tramite tram";
                                $cadena_sql.=" INNER JOIN ";
                                $cadena_sql.=$configuracion["prefijo"]."dependencia dep";
                                $cadena_sql.=" ON dep.id_dependencia =tram.id_dependencia ";
                                $cadena_sql.=" INNER JOIN ";
                                $cadena_sql.=$configuracion["prefijo"]."estado est ";
                                $cadena_sql.=" ON est.id_estado=tram.estado ";
                              
                              	if($variable['id_tramite'])
				     {	$cadena_sql.="WHERE ";
                                        $cadena_sql.="tram.id_Ttramite='".$variable['id_tramite']."'";
				    }
                                $cadena_sql.="ORDER BY tram.id_Ttramite ";        
                              break;		

                       
		    case "Ttramite_id":
				$cadena_sql= "SELECT MAX(DISTINCT ";
                                $cadena_sql.="tram.id_Ttramite)+1 ID_TRAM ";
                                $cadena_sql.="FROM ";
                                $cadena_sql.=$configuracion["prefijo"]."tipo_tramite tram";
                         
                              break;	                              
                              

                       case "buscar_area_tramite":
				
				$cadena_sql= "SELECT DISTINCT ";
                                $cadena_sql.="area_tram.id_area ID_AREA, ";
                                $cadena_sql.="area.nombre AREA, ";
                                $cadena_sql.="area.descripcion DESC_AREA, ";
                                $cadena_sql.="area_tram.id_Ttramite ID_TRAM, ";
                                $cadena_sql.="area_tram.posicion_tramite POS, ";
                                $cadena_sql.="area_tram.fecha_registro FEC_TRAM, ";
                                $cadena_sql.="est.nombre EST_AREA ";
                                $cadena_sql.=" FROM ";
                                $cadena_sql.= $configuracion["prefijo"]."area_ttramite area_tram ";
                                $cadena_sql.=" INNER JOIN ";
                                $cadena_sql.= $configuracion["prefijo"]."area area ";
                                $cadena_sql.= " ON area_tram.id_area=area.id_area ";
                                $cadena_sql.= " AND area_tram.id_Ttramite='".$variable['id_tramite']."' ";
                                $cadena_sql.=" INNER JOIN ";
                                $cadena_sql.=$configuracion["prefijo"]."estado est ";
                                $cadena_sql.=" ON est.id_estado=area_tram.estado ";
                                $cadena_sql.= " ORDER BY area_tram.posicion_tramite ";
                       break;	
                    
                       case "posicion_area_tramite":
				
				$cadena_sql= "SELECT MAX(DISTINCT ";
                                $cadena_sql.="area_tram.posicion_tramite)+1 POS  ";
                                $cadena_sql.=" FROM ";
                                $cadena_sql.= $configuracion["prefijo"]."area_ttramite area_tram ";
                                $cadena_sql.=" WHERE  ";
                                $cadena_sql.= " area_tram.id_Ttramite='".$variable['id_tramite']."' ";
                                
			break;	
                   
                       case "buscar_area":
				
				$cadena_sql= "SELECT DISTINCT ";
                                $cadena_sql.="area.id_area ID_AREA, ";
                                $cadena_sql.="area.id_dependencia ID_DEP, ";
                                $cadena_sql.="area.nombre AREA, ";
                                $cadena_sql.="area.descripcion DESC_AREA ";
                                $cadena_sql.=" FROM ";
                                $cadena_sql.= $configuracion["prefijo"]."area area ";
                                $cadena_sql.= " WHERE ";
                                $cadena_sql.= " area.nombre='".$variable['nombre']."' ";
                                $cadena_sql.=" AND ";
                                $cadena_sql.="area.id_dependencia='".$variable['id_dep']."' ";
                                $cadena_sql.=" AND ";
                                $cadena_sql.=" area.estado=1 ";
       			break;	
                    
                    	case "area_id":
				$cadena_sql= "SELECT MAX(DISTINCT ";
                                $cadena_sql.="area.id_area)+1 ID_AREA ";
                                $cadena_sql.="FROM ";
                                $cadena_sql.=$configuracion["prefijo"]."area area";
                        break;
                    
                        case "inserta_area":
				$cadena_sql="INSERT INTO ";
				$cadena_sql.= $configuracion["prefijo"]."area ";
				$cadena_sql.="(";
                                $cadena_sql.= "id_area, ";
				$cadena_sql.= "id_dependencia, ";
				$cadena_sql.= "nombre, ";
				$cadena_sql.= "descripcion, ";
				$cadena_sql.= "estado ";
				$cadena_sql.=") ";
				$cadena_sql.="VALUES (";
				$cadena_sql.="'".$variable['id_area']."', ";
                                $cadena_sql.="'".$variable['id_dep']."', ";
				$cadena_sql.="'".$variable['nombre']."', ";
				$cadena_sql.="'".$variable['desc']."', ";
				$cadena_sql.="'".$variable['estado']."' ";
				$cadena_sql.=")";
			break;	

                        case "inserta_Ttram_area":
				$cadena_sql="INSERT INTO ";
				$cadena_sql.= $configuracion["prefijo"]."area_ttramite ";
				$cadena_sql.="(";
				$cadena_sql.= "id_area, ";
                                $cadena_sql.= "id_Ttramite, ";
				$cadena_sql.= "fecha_registro, ";
                                $cadena_sql.= "fecha_fin, ";
                                $cadena_sql.= "estado, ";
				$cadena_sql.= "descripcion, ";
				$cadena_sql.= "posicion_tramite ";
				$cadena_sql.=") ";
				$cadena_sql.="VALUES (";
				$cadena_sql.="'".$variable['id_area']."', ";
                                $cadena_sql.="'".$variable['id_tramite']."', ";
                                $cadena_sql.="'".$variable['fecha_registro']."', ";
                                $cadena_sql.="'".$variable['fecha_fin']."', ";
				$cadena_sql.="'".$variable['estado']."', ";
				$cadena_sql.="'".$variable['desc']."', ";
				$cadena_sql.="'".$variable['posicion']."'";
				$cadena_sql.=")";
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
  
                        
                      case "listar_dep":
				
				$cadena_sql= "SELECT DISTINCT ";
                                $cadena_sql.="id_dependencia ID_DEP, ";
                                $cadena_sql.="nombre DEP ";
                                $cadena_sql.="FROM ";
                                $cadena_sql.=$configuracion["prefijo"]."dependencia ";
                                $cadena_sql.=" WHERE id_dependencia>0 ";
                                if($variable)
					{$cadena_sql.=" AND id_dependencia IN ";
                                        $cadena_sql.=" (SELECT DISTINCT id_dependencia  FROM ".$configuracion["prefijo"]."area) ";       
                                        }
                                $cadena_sql.=" ORDER BY nombre ";
                        
			break;	     
                            
                        case "listar_estado":
				
				$cadena_sql= "SELECT DISTINCT ";
                                $cadena_sql.="id_estado ID_EST, ";
                                $cadena_sql.="nombre EST ";
                                $cadena_sql.="FROM ";
                                $cadena_sql.=$configuracion["prefijo"]."estado ";
                                $cadena_sql.=" WHERE tipo='".$variable."'";
                        
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
                       
                       case "inserta_Concep":
				$cadena_sql="INSERT INTO ";
				$cadena_sql.= $configuracion["prefijo"]."tipo_concepto ";
				$cadena_sql.="(";
				$cadena_sql.= "id_tconcep, ";
                                $cadena_sql.= "nombre, ";
				$cadena_sql.= "descripcion, ";
                                $cadena_sql.= "estado ";
				$cadena_sql.=") ";
				$cadena_sql.="VALUES (";
				$cadena_sql.="'".$variable['id_concepto']."', ";
                                $cadena_sql.="'".$variable['nombre']."', ";
                                $cadena_sql.="'".$variable['desc']."', ";
                                $cadena_sql.="'".$variable['estado']."' ";
				$cadena_sql.=")";
			break;     
                    
                        case "inserta_TramConcep":
				$cadena_sql="INSERT INTO ";
				$cadena_sql.= $configuracion["prefijo"]."tconcep_ttramite ";
				$cadena_sql.="(";
				$cadena_sql.="id_Ttramite, ";
                                $cadena_sql.="id_tconcep, ";
                                $cadena_sql.="fecha_registro, ";
                                $cadena_sql.="fecha_fin, ";
                                $cadena_sql.="estado ";
				$cadena_sql.=") ";
				$cadena_sql.="VALUES (";
				$cadena_sql.="'".$variable['id_tramite']."', ";
                                $cadena_sql.="'".$variable['id_concepto']."', ";
                                $cadena_sql.="'".$variable['fecha_registro']."', ";
                                $cadena_sql.="'".$variable['fecha_fin']."', ";
                                $cadena_sql.="'".$variable['estado']."' ";
				$cadena_sql.=")";
			break; 
                       
                       case "buscar_concep":

                                $cadena_sql="SELECT DISTINCT ";
                                $cadena_sql.="tconcep.id_tconcep ID_CONCEP,";
                                $cadena_sql.="tconcep.nombre CONCEP, ";
                                $cadena_sql.="tconcep.descripcion DESC_CONCEP, ";
                                $cadena_sql.="ttram.fecha_registro FEC_CONCEP, ";
                                $cadena_sql.="est.nombre EST_CONCEP, ";
                                $cadena_sql.="ttram.id_Ttramite ID_TRAM";
                                $cadena_sql.=" FROM ";
                                $cadena_sql.=$configuracion["prefijo"]."tipo_concepto tconcep";
                                $cadena_sql.=" INNER JOIN ";
                                $cadena_sql.=$configuracion["prefijo"]."tconcep_ttramite ttram";
                                $cadena_sql.=" ON tconcep.id_tconcep=ttram.id_tconcep ";
                                $cadena_sql.=" INNER JOIN ";
                                $cadena_sql.=$configuracion["prefijo"]."estado est ";
                                $cadena_sql.=" ON est.id_estado=ttram.estado ";
                                $cadena_sql.=" WHERE ";
                                $cadena_sql.="ttram.id_Ttramite=";
                                $cadena_sql.="'".$variable['id_tramite']."' ";
                                $cadena_sql.="ORDER BY tconcep.nombre ASC";
                       break; 
                   
                       case "listar_concep":

                                $cadena_sql="SELECT DISTINCT ";
                                $cadena_sql.="tconcep.id_tconcep ID_CONCEP,";
                                $cadena_sql.="tconcep.nombre CONCEP ";
                                $cadena_sql.=" FROM ";
                                $cadena_sql.=$configuracion["prefijo"]."tipo_concepto tconcep";
                                $cadena_sql.=" WHERE ";
                                $cadena_sql.="tconcep.estado=1 ";
                                $cadena_sql.="ORDER BY tconcep.nombre ASC";
                       break;   
                   
                       case "id_concep":

                                $cadena_sql="SELECT MAX(DISTINCT ";
                                $cadena_sql.="tconcep.id_tconcep)+1 ID_CONCEP ";
                                $cadena_sql.=" FROM ";
                                $cadena_sql.=$configuracion["prefijo"]."tipo_concepto tconcep";
                                $cadena_sql.=" WHERE ";
                                $cadena_sql.="tconcep.estado=1 ";
                       break; 
 
			default:
				$cadena_sql="";
				break;
		}//fin switch
		return $cadena_sql;
	}// fin funcion cadena_sql
	
	
}//fin clase sql_adminUsuario
?>

