<?php
  require_once("phpClasses/connect.php");
  require 'Classes/PHPExcel.php';

  $objPHPExcel = new PHPExcel();
  $objPHPExcel->getProperties()->setCreator("Regina Romero")->setDescription("Reporte Inventario");
          
  $objPHPExcel->setActiveSheetIndex(0);
  $objPHPExcel->getActiveSheet()->setTitle("Pedidos");
  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(30);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(10);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(10);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(20);

  
  //Diseño del encabezado de la tabla
 
  $objPHPExcel->getActiveSheet()->setCellValue('A1','FOLIO');
  $objPHPExcel->getActiveSheet()->setCellValue('B1','STATUS');
  $objPHPExcel->getActiveSheet()->setCellValue('C1','CATEGORIA');
  $objPHPExcel->getActiveSheet()->setCellValue('D1','HORMA');
  $objPHPExcel->getActiveSheet()->setCellValue('E1','MODELO');
  $objPHPExcel->getActiveSheet()->setCellValue('F1','COLOR');
  $objPHPExcel->getActiveSheet()->setCellValue('G1','TOTAL_PARES');
  $objPHPExcel->getActiveSheet()->setCellValue('H1','22');
  $objPHPExcel->getActiveSheet()->setCellValue('I1','22,5');
  $objPHPExcel->getActiveSheet()->setCellValue('J1','23');
  $objPHPExcel->getActiveSheet()->setCellValue('K1','23,5');
  $objPHPExcel->getActiveSheet()->setCellValue('L1','24');
  $objPHPExcel->getActiveSheet()->setCellValue('M1','24,5');
  $objPHPExcel->getActiveSheet()->setCellValue('N1','25');
  $objPHPExcel->getActiveSheet()->setCellValue('O1','25,5');
  $objPHPExcel->getActiveSheet()->setCellValue('P1','26');
  $objPHPExcel->getActiveSheet()->setCellValue('Q1','26,5');
  $objPHPExcel->getActiveSheet()->setCellValue('R1','27');
  $objPHPExcel->getActiveSheet()->setCellValue('S1','27,5');
  $objPHPExcel->getActiveSheet()->setCellValue('T1','28');
  $objPHPExcel->getActiveSheet()->setCellValue('U1','28,5');
  $objPHPExcel->getActiveSheet()->setCellValue('V1','FECHA ESTIMADA DE ENTREGA');
  $objPHPExcel->getActiveSheet()->setCellValue('W1','FECHA DE PEDIDO');

  $sqlConsulta="";
 
  $sqlConsulta="select id_pedido,status,horma,categoria,modelo,color,T22,T225,T23,T235,
  T24,T245,T25,T255,T26,T265,T27,T275,T28,T285,num_pares_mod,dia_entrega,mes_entrega,anio_entrega from pedidos order by ";

  $resConsulta=mysqli_query($con,$sqlConsulta);
  if(!$resConsulta)
  {
      echo mysqli_error($con);
  }
  $fila=2;

  while($rowConsulta=mysqli_fetch_assoc($resConsulta)){

    $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila,$rowConsulta['id_pedido']);
    if($rowConsulta['status']=="PARCIAL"){
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila,$rowConsulta['status']);
    }
    if($rowConsulta['status']=="ENTREGADO"){
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila,$rowConsulta['status']);
    }
    if($rowConsulta['status']=="POSIBLE RESURTIDO"){
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila,$rowConsulta['status']);
    }
    if($rowConsulta['status']=="PEDIDO EN FIRME"){
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila,$rowConsulta['status']);
    }
    if($rowConsulta['status']=="SIN RESURTIDO"){
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila,$rowConsulta['status']);
    }
    if($rowConsulta['status']=="CANCELADO"){
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila,$rowConsulta['status']);
    }
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila,$rowConsulta['horma']);
    $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila,$rowConsulta['categoria']);
    $objPHPExcel->getActiveSheet()->setCellValue('E'.$fila,$rowConsulta['modelo']);
    $objPHPExcel->getActiveSheet()->setCellValue('F'.$fila,$rowConsulta['color']);
    $objPHPExcel->getActiveSheet()->setCellValue('G'.$fila,$rowConsulta['num_pares_mod']);
    $objPHPExcel->getActiveSheet()->setCellValue('H'.$fila,$rowConsulta['T22']);
    $objPHPExcel->getActiveSheet()->setCellValue('I'.$fila,$rowConsulta['T225']);
    $objPHPExcel->getActiveSheet()->setCellValue('J'.$fila,$rowConsulta['T23']);
    $objPHPExcel->getActiveSheet()->setCellValue('K'.$fila,$rowConsulta['T235']);
    $objPHPExcel->getActiveSheet()->setCellValue('L'.$fila,$rowConsulta['T24']);
    $objPHPExcel->getActiveSheet()->setCellValue('M'.$fila,$rowConsulta['T245']);
    $objPHPExcel->getActiveSheet()->setCellValue('N'.$fila,$rowConsulta['T25']);
    $objPHPExcel->getActiveSheet()->setCellValue('O'.$fila,$rowConsulta['T255']);
    $objPHPExcel->getActiveSheet()->setCellValue('P'.$fila,$rowConsulta['T26']);
    $objPHPExcel->getActiveSheet()->setCellValue('Q'.$fila,$rowConsulta['T265']);
    $objPHPExcel->getActiveSheet()->setCellValue('R'.$fila,$rowConsulta['T27']);
    $objPHPExcel->getActiveSheet()->setCellValue('S'.$fila,$rowConsulta['T275']);
    $objPHPExcel->getActiveSheet()->setCellValue('T'.$fila,$rowConsulta['T28']);
    $objPHPExcel->getActiveSheet()->setCellValue('U'.$fila,$rowConsulta['T285']);
    $objPHPExcel->getActiveSheet()->setCellValue('V'.$fila,$rowConsulta['dia_entrega']." de ".$rowConsulta['mes_entrega']." de ".$rowConsulta['anio_entrega']);
    $objPHPExcel->getActiveSheet()->setCellValue('W'.$fila,$rowConsulta['fechaPedido']);

    $fila++; 
   

}
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="HistoricoPedidos.xls"');
header('Cache-Control: max-age=0');


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');	
$objWriter->save('php://output');

?>