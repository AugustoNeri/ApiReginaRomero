<?php
  require_once("phpClasses/connect.php");

  $sqlConsulta="select codigo_pedido,id_pedido,status,fabrica,horma,categoria,modelo,color,T22,T225,T23,T235,
  T24,T245,T25,T255,T26,T265,T27,T275,T28,T285,num_pares_mod,fechaEntrega,fechaPedido from pedidos order by fechaPedido asc";
  $salidaExcel="";
  $salidaExcel.='<table><tr><td>Fecha_pedido</td><td>Folio_pedido</td><td>Status</td><td>fabrica</td><td>horma</td>
  <td>Categoria</td><td>Modelo</td><td>Color</td><td>22</td><td>22.5</td>
  <td>23</td><td>23.5</td><td>24</td><td>24.5</td><td>25</td><td>25.5</td><td>26</td><td>26.5</td><td>27</td><td>27.5</td>
  <td>Total de pares</td>
  <td>28</td><td>28.5</td><td >Fecha_de_entrega</td><td></td></tr>';
  $resConsulta=mysqli_query($con,$sqlConsulta);
  while($rowConsulta=mysqli_fetch_assoc($resConsulta)){
        $salidaExcel.="<tr><td>".$rowConsulta['fechaPedido']."</td>
        <td>".$rowConsulta['id_pedido']."</td>
        <td>".$rowConsulta['status']."</td>
        <td>".$rowConsulta['fabrica']."</td>
        <td>".$rowConsulta['horma']."</td>
        <td>".$rowConsulta['categoria']."</td>
        <td>".$rowConsulta['modelo']."</td>
        <td>".$rowConsulta['color']."</td>
        <td>".$rowConsulta['T22']."</td>
        <td>".$rowConsulta['T225']."</td>
        <td>".$rowConsulta['T23']."</td>
        <td>".$rowConsulta['T235']."</td>
        <td>".$rowConsulta['T24']."</td>
        <td>".$rowConsulta['T245']."</td>
        <td>".$rowConsulta['T25']."</td>
        <td>".$rowConsulta['T255']."</td>
        <td>".$rowConsulta['T26']."</td>
        <td>".$rowConsulta['T265']."</td>
        <td>".$rowConsulta['T27']."</td>
        <td>".$rowConsulta['T275']."</td>
        <td>".$rowConsulta['T28']."</td>
        <td>".$rowConsulta['T285']."</td>
        <td>".$rowConsulta['num_pares_mod']."</td>
        <td>".$rowConsulta['fechaEntrega']."</td></tr>";
  }
  $salidaExcel.='</table>';
  header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="HistoricoPedidos.xls"');
header('Pragma: no-cache');
header('Expires:0');
echo $salidaExcel;



?>