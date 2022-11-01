<?php
  require_once("phpClasses/connect.php");
  
  $sqlFecha="";
  $salidaExcel="";
  $salidaExcel.='<table>
  <tr><td>Fecha pedido</td><td>No pedido</td><td>Status</td><td>Fábrica</td><td>Sucursal</td><td>Horma</td>
  <td>Categoria</td><td>Modelo</td><td>Color</td><td>22</td><td>22.5</td>
  <td>23</td><td>23.5</td><td>24</td><td>24.5</td><td>25</td><td>25.5</td><td>26</td><td>26.5</td><td>27</td><td>27.5</td>
  <td>28</td><td>28.5</td><td>Total</td><td>Fecha_de_llegada</td><td>Fecha_estimada_de_llegada</td><td>Diferencia</td><td>%</td></tr>';
    if($_GET['dia']!='' &&$_GET['mes']!='' &&$_GET['anio']!=''){
        $sqlFecha="AND fechaPedido='".$_GET['dia']."/".$_GET['mes']."/".$_GET['anio']."' ";   
    }
    $sqlIdPedido="";
    if($_GET['pedido']!=""){
        $sqlIdPedido=" id_pedido='".$_GET['pedido']."' ";
    }
 
    $sqlConsulta="";
    if($_GET['status']!=''){
        if($_GET['modelo']!=''){
            if($_GET['pedido']!=""){
                $sqlConsulta="select llegadas.codigo_pedido,id_pedido,llegadas.status,fabrica,sucursal,horma,categoria,modelo,
                color,llegadas.t22,llegadas.t225,llegadas.t23,llegadas.t235,llegadas.t24,llegadas.t245,llegadas.t25,llegadas.t255,
                llegadas.t26,llegadas.t265,llegadas.t27,llegadas.t275,llegadas.t28,llegadas.t285,num_pares_mod
               fechallegada,fechaEntrega,fechaPedido from llegadas inner join pedidos on llegadas.codigo_pedido=pedidos.codigo_pedido  where llegadas.status='".$_GET['status']."' and modelo='".$_GET['modelo']."'
                 and ".$sqlIdPedido." ".$sqlFecha." ";

            }else{
                $sqlConsulta="select llegadas.codigo_pedido,id_pedido,llegadas.status,fabrica,sucursal,horma,categoria,modelo,
                color,llegadas.t22,llegadas.t225,llegadas.t23,llegadas.t235,llegadas.t24,llegadas.t245,llegadas.t25,llegadas.t255,
                llegadas.t26,llegadas.t265,llegadas.t27,llegadas.t275,llegadas.t28,llegadas.t285,num_pares_mod
               fechallegada,fechaEntrega,fechaPedido from llegadas inner join pedidos on llegadas.codigo_pedido=pedidos.codigo_pedido where llegadas.status='".$_GET['status']."' and modelo='".$_GET['modelo']."'
                ".$sqlFecha." ";
            }
        }else{
            if($_GET['pedido']!=""){
                $sqlConsulta="select llegadas.codigo_pedido,id_pedido,llegadas.status,fabrica,sucursal,horma,categoria,modelo,
                color,llegadas.t22,llegadas.t225,llegadas.t23,llegadas.t235,llegadas.t24,llegadas.t245,llegadas.t25,llegadas.t255,
                llegadas.t26,llegadas.t265,llegadas.t27,llegadas.t275,llegadas.t28,llegadas.t285,num_pares_mod
               fechallegada,fechaEntrega,fechaPedido from llegadas inner join pedidos on llegadas.codigo_pedido=pedidos.codigo_pedido where llegadas.status='".$_GET['status']."'
                 and ".$sqlIdPedido." ".$sqlFecha." ";

            }else{
                $sqlConsulta="select llegadas.codigo_pedido,id_pedido,llegadas.status,fabrica,sucursal,horma,categoria,modelo,
                color,llegadas.t22,llegadas.t225,llegadas.t23,llegadas.t235,llegadas.t24,llegadas.t245,llegadas.t25,llegadas.t255,
                llegadas.t26,llegadas.t265,llegadas.t27,llegadas.t275,llegadas.t28,llegadas.t285,num_pares_mod
               fechallegada,fechaEntrega,fechaPedido from llegadas inner join pedidos on llegadas.codigo_pedido=pedidos.codigo_pedido where llegadas.status='".$_GET['status']."' 
                 ".$sqlFecha." ";
            }
        }
      }else{
        if($_GET['modelo']!=''){
            if($_GET['pedido']!=""){
                $sqlConsulta="select llegadas.codigo_pedido,id_pedido,llegadas.status,fabrica,sucursal,horma,categoria,modelo,
                color,llegadas.t22,llegadas.t225,llegadas.t23,llegadas.t235,llegadas.t24,llegadas.t245,llegadas.t25,llegadas.t255,
                llegadas.t26,llegadas.t265,llegadas.t27,llegadas.t275,llegadas.t28,llegadas.t285,num_pares_mod
               fechallegada,fechaEntrega,fechaPedido from llegadas inner join pedidos on llegadas.codigo_pedido=pedidos.codigo_pedido where modelo='".$_GET['modelo']."'
                 and ".$sqlIdPedido." ".$sqlFecha." ";

            }else{
                $sqlConsulta="select llegadas.codigo_pedido,id_pedido,llegadas.status,fabrica,sucursal,horma,categoria,modelo,
                color,llegadas.t22,llegadas.t225,llegadas.t23,llegadas.t235,llegadas.t24,llegadas.t245,llegadas.t25,llegadas.t255,
                llegadas.t26,llegadas.t265,llegadas.t27,llegadas.t275,llegadas.t28,llegadas.t285,num_pares_mod
               fechallegada,fechaEntrega,fechaPedido from llegadas inner join pedidos on llegadas.codigo_pedido=pedidos.codigo_pedido where modelo='".$_GET['modelo']."'
               ".$sqlFecha." ";
            }
        }else{
            if($_GET['pedido']!=""){
                $sqlConsulta="select llegadas.codigo_pedido,id_pedido,llegadas.status,fabrica,sucursal,horma,categoria,modelo,
                color,llegadas.t22,llegadas.t225,llegadas.t23,llegadas.t235,llegadas.t24,llegadas.t245,llegadas.t25,llegadas.t255,
                llegadas.t26,llegadas.t265,llegadas.t27,llegadas.t275,llegadas.t28,llegadas.t285,num_pares_mod
               fechallegada,fechaEntrega,fechaPedido from llegadas inner join pedidos on llegadas.codigo_pedido=pedidos.codigo_pedido where ".$sqlIdPedido." ".$sqlFecha." ";

            }else{
                $sqlConsulta="select llegadas.codigo_pedido,id_pedido,llegadas.status,fabrica,sucursal,horma,categoria,modelo,
                color,llegadas.t22,llegadas.t225,llegadas.t23,llegadas.t235,llegadas.t24,llegadas.t245,llegadas.t25,llegadas.t255,
                llegadas.t26,llegadas.t265,llegadas.t27,llegadas.t275,llegadas.t28,llegadas.t285,num_pares_mod
               fechallegada,fechaEntrega,fechaPedido from llegadas inner join pedidos on llegadas.codigo_pedido=pedidos.codigo_pedido where ".$sqlFecha." ";
            }
        }

      }
  $resConsulta=mysqli_query($con,$sqlConsulta);
  if(!$resConsulta)
  {
      echo mysqli_error($con);
  }
 

  while($rowConsulta=mysqli_fetch_assoc($resConsulta)){
    $salidaExcel.="<tr><td>".$rowConsulta['fechaPedido']."</td>
    <td>".$rowConsulta['id_pedido']."</td>
    <td>".$rowConsulta['status']."</td>
    <td>".$rowConsulta['fabrica']."</td>
    <td>".$rowConsulta['sucursal']."</td>
    <td>".$rowConsulta['horma']."</td>
    <td>".$rowConsulta['categoria']."</td>
    <td>".$rowConsulta['modelo']."</td>
    <td>".$rowConsulta['color']."</td>
    <td>".$rowConsulta['t22']."</td>
    <td>".$rowConsulta['t225']."</td>
    <td>".$rowConsulta['t23']."</td>
    <td>".$rowConsulta['t235']."</td>
    <td>".$rowConsulta['t24']."</td>
    <td>".$rowConsulta['t245']."</td>
    <td>".$rowConsulta['t25']."</td>
    <td>".$rowConsulta['t255']."</td>
    <td>".$rowConsulta['t26']."</td>
    <td>".$rowConsulta['t265']."</td>
    <td>".$rowConsulta['t27']."</td>
    <td>".$rowConsulta['t275']."</td>
    <td>".$rowConsulta['t28']."</td>
    <td>".$rowConsulta['t285']."</td>";
    $contUnidades=$rowConsulta['t22']+$rowConsulta['t225']+$rowConsulta['t23']+$rowConsulta['t235']+$rowConsulta['t24']+$rowConsulta['t245']+
    $rowConsulta['t25']+$rowConsulta['t255']+$rowConsulta['t26']+$rowConsulta['t265']+$rowConsulta['t27']+
    $rowConsulta['t275']+$rowConsulta['t28']+$rowConsulta['t285'];
    $salidaExcel.="<td>".$contUnidades."</td>";
    if($rowConsulta['fechallegada']!='0000-00-00'){
        $salidaExcel.="<td>".$rowConsulta['fechallegada']."</td>";
    }else{
        $salidaExcel.="<td></td>";
    }
    $salidaExcel.="<td>".$rowConsulta['fechaEntrega']."</td>";
    $sqlConPedido="select num_pares_mod from pedidos where codigo_pedido='".$rowConsulta['codigo_pedido']."'";
    $resConPedidos=mysqli_query($con,$sqlConPedido);
    $rowConPedidos=mysqli_fetch_assoc($resConPedidos);
    $diferencia=$rowConPedidos['num_pares_mod']-$contUnidades;
    $salidaExcel.="<td>".$diferencia."</td>";
    if($rowConPedidos['num_pares_mod']!=0){
        $shere=($contUnidades/$rowConPedidos['num_pares_mod'])*100;
        $salidaExcel.="<td>".number_format($shere,2)."%</td>";
   }
   $salidaExcel.="</tr>";
}
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="HistoricoLlegadas.xls"');
header('Pragma: no-cache');
header('Expires:0');
echo $salidaExcel;
?>