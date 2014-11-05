<?
/*
 ############################################################################
#    UNIVERSIDAD DISTRITAL Francisco Jose de Caldas                        #
#    Desarrollo Por:                                                       #
#    Jairo Lavado Hernandez 2013                                           #
#    jlavadoh@correo.udistrital.edu.co                                     #
#    Copyright: Vea el archivo EULA.txt que viene con la distribucion      #
############################################################################
*/
/****************************************************************************

reporteadorHtml.class.php

Jairo Lavado 
Copyright (C) 2013

Última revisión 8 de Abril de 2013

******************************************************************************
* @subpackage
* @package	clase
* @copyright
* @version      0.1
* @author      	
* @link		
* @description  Clase para la ageneración automatica de Reportes HTML
*******************************************************************************
*******************************************************************************
*******************************************************************************

*Atributos
*
*@access private
*@param  $conexion_id
*		Identificador del enlace a la base de datos
*******************************************************************************


*/

/*****************************************************************************
 *Métodos
*
*@access public
*
******************************************************************************
* @USAGE
*
*
*
*/

class  reporteador
{
	
	/**
	 * @name repoteador
	 * constructor
	 */
	function reporteador()
	{


	}
/**
*Funcion que apartir de los datos crea el reporte
* @return type
*/

function mostrarReporte($configuracion,$registro,$nombre,$titulo)
	{   
            //var_dump($registro);exit;
            include_once($configuracion["raiz_documento"].$configuracion["clases"]."/encriptar.class.php");
            $indice = $configuracion["host"].$configuracion["site"]."/index.php?";
            $cripto = new encriptar();
            //resuelve el nombre de los alias para usar el la cabecera
             foreach($registro[0] as $ali=>$value)
                        { if(!is_numeric($ali))
                              {$cabecera[$ali]=$ali;}
                        }        
            //lamar barra de progreso             
           $this->barra_carga();             
           $total_reg=$registro?count($registro):0;    
           $a=1;
           //termina barra            
                        
            ?>

            <link rel="stylesheet" href="<? echo $configuracion["host"].$configuracion["site"].$configuracion["plugins"];?>/jPages-master/css/jPages.css">
            <script src="<? echo $configuracion["host"].$configuracion["site"].$configuracion["plugins"];?>/jPages-master/js/jPages.js"></script>
            <script src="<? echo $configuracion["host"].$configuracion["site"].$configuracion["plugins"];?>/jquery/js/base64_encode.js"></script>
            <!-- permite la paginacion-->        
            <script>
                    $(function (){
                        $("div.holder").jPages({
                        containerID : "<?echo $nombre;?>",
                        previous : "←",
                        next : "→",
                        perPage : <? echo $configuracion["registro"]?>,
                        delay : 20
                        });
                    });
            </script>
            </script>
            <!-- permite exporta a hoja de calculo-->
             <script type='text/javascript'>//<![CDATA[ 
                $(window).load(function(){
                $("#btnExport").click(function(e) {
	    window.open('data:application/vnd.ms-excel;base64,' + encodeURIComponent($.base64.encode($('#dvData').html())));
	    e.preventDefault();
                });
                });//]]>  
 
            </script>
            
            
            <table width="100%" align="center" border="0" cellpadding="10"  cellspacing="0">
                    <tbody>
                            <tr>
                                    <td>
                                            <table width="100%" border="0" align="center" cellpadding="5 px" cellspacing="1px">
                                                    <tr>
                                                            <td><center> <div class="holder"></div></center>
                                                                <!--input type="button" id="btnExport" value=" Exportar a Excel " /-->
                                                                <button name="boton" type="submit" id="btnExport">
                                                                    <img src="<? echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"];?>/excel2.jpg" width="25" height="25" >
                                                                    <br>Exportar
                                                                </button>
                                                                <div id="dvData">
                                                                    <table class="bordered" width="100%">
                                                                        <tr class='cuadro_color'>
                                                                            <th colspan='<? echo count($cabecera);?>' class='titulo_th'> <? echo strtoupper($titulo);?> </th>
                                                                       </tr> 
                                                                        <tr class='cuadro_color'>
                                                                            <? foreach($cabecera as $cab=>$value)
                                                                                        { ?><th  class='subtitulo_th'> <?echo ucfirst(strtolower(str_replace('_',' ',$cabecera[$cab])));?> </th>
                                                                                          <?
                                                                                        }
                                                                            ?>
                                                                       </tr> 
                                                                       <tbody id="<?echo $nombre;?>">
                                                                         <?         foreach ($registro as $key => $value)
                                                                                        {//inicia llenado de la barra
                                                                                            $porcentaje = $a * 100 / $total_reg; //saco mi valor en porcentaje
                                                                                            echo "<script>callprogress(".round($porcentaje).",".$a.",".$total_reg.")</script>"; //llamo a la función JS(JavaScript) para actualizar el progreso
                                                                                            flush(); //con esta funcion hago que se muestre el resultado de inmediato y no espere a terminar todo el bucle
                                                                                            ob_flush();
                                                                                            $a++;
                                                                                            //termina el llenado de la barra
                                                                                         ?><tr><?
                                                                                                foreach($cabecera as $cab=>$value)
                                                                                                    { ?><td class='texto_elegante estilo_td' ><?
                                                                                                        //$dato=(strtolower(substr($cabecera[$cab],0,5))=='valor'?isset($registro[$key][$cabecera[$cab]])?number_format($registro[$key][$cabecera[$cab]],2, ',', '.'):'':isset($registro[$key][$cabecera[$cab]])?$registro[$key][$cabecera[$cab]]:'');
                                                                                                        if (isset($registro[$key][$cabecera[$cab]]) && strtolower(substr($cabecera[$cab],0,5))=='valor')
                                                                                                            {$dato=number_format($registro[$key][$cabecera[$cab]],2, '.', ',');}
                                                                                                        elseif (!isset($registro[$key][$cabecera[$cab]]))
                                                                                                             {$dato='SD';}    
                                                                                                        else{ $dato=$registro[$key][$cabecera[$cab]];}
                                                                                                        echo "&nbsp;".$dato."&nbsp;";
                                                                                                        ?></td><?
                                                                                                    } 
                                                                                        ?></tr><?
                                                                                        }//fin for
                                                                          ?>
                                                                    </table>
                                                                    </div>  
                                                                    <center>
                                                                            <div class="holder"></div>
                                                                    </center>
                                                            </td>
                                                    </tr>
                                                    </tbody>
                                            </table>

                                    </td>
                            </tr>
                    </tbody>
            </table>
   
            <?
	}
        
        
function barra_carga() {
         ?>
         <html><head>
                <font size="2px"><b>Cargando Registros</b></font><br>
                <script language="javascript">
                //Creo una función que imprimira en la hoja el valor del porcentanje asi como el relleno de la barra de progreso
                function callprogress(vValor,vItem,vTotal){
                 document.getElementById("getprogress").innerHTML = vItem+' de '+vTotal+' - '+vValor ;
                 document.getElementById("getProgressBarFill").innerHTML = '<div class="ProgressBarFill" style="width: '+vValor+'%;"></div>';
                }
                </script>
                <style type="text/css">
                /* Ahora creo el estilo que hara que aparesca el porcentanje y relleno del mismoo*/
                  .ProgressBar     { width: 90%; border: 1px solid black; background: #eef; height: 2em; display: block; }
                  .ProgressBarText { position: absolute; font-size: 1.75em; width: 90%; text-align: center; font-weight: bold; }
                  .ProgressBarFill { height: 100%; background: #aae; display: block; overflow: visible; }
                </style>
            </head>
        <body>
        <!-- Ahora creo la barra de progreso con etiquetas DIV -->
         <div class="ProgressBar">
              <div class="ProgressBarText"><span id="getprogress"></span>&nbsp;% </div>
              <div id="getProgressBarFill"></div>
            </div>
        </body>    
      <?        
        }   


}//Fin de la clase html
?>
