<?php

require_once("phpClasses/connect.php");
require 'Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Regina Romero")->setDescription("Reporte Ventas");

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle("Ventas");

if (!isset($_GET['sucursal'])) {
    echo "<h4>Debe de escoger al menos una sucursal</h4>";
} else {
    $fechaInicio = "";
    $fechaFin = "";
    $sqlFecha = '';
    if ($_GET['cmbDiaI'] == '' && $_GET['cmbDiaF'] == '') {
        $fechaInicio = $_GET['cmbAnioI'] . "-" . $_GET['cmbMesI'] . "-01";
        $fechaFin = $_GET['cmbAnioF'] . "-" . $_GET['cmbMesF'] . "-31";
        $sqlFecha = "AND fecha between '" . $fechaInicio . "' AND '" . $fechaFin . "' ";
    }
    if ($_GET['cmbDiaI'] != '' && $_GET['cmbDiaF'] != '') {
        $fechaInicio = $_GET['cmbAnioI'] . "-" . $_GET['cmbMesI'] . "-" . $_GET['cmbDiaI'];
        $fechaFin = $_GET['cmbAnioF'] . "-" . $_GET['cmbMesF'] . "-" . $_GET['cmbDiaF'];
        $sqlFecha = "AND fecha between '" . $fechaInicio . "' AND '" . $fechaFin . "' ";
    }
    if ($_GET['cmbDiaI'] != '' && $_GET['cmbDiaF'] == '') {
        $fechaInicio = $_GET['cmbAnioI'] . "-" . $_GET['cmbMesI'] . "-" . $_GET['cmbDiaI'];
        $fechaFin = $_GET['cmbAnioF'] . "-" . $_GET['cmbMesF'] . "-31";
        $sqlFecha = "AND fecha between '" . $fechaInicio . "' AND '" . $fechaFin . "' ";
    }
    if ($_GET['cmbDiaI'] == '' && $_GET['cmbDiaF'] != '') {
        $fechaInicio = $_GET['cmbAnioI'] . "-" . $_GET['cmbMesI'] . "-01";
        $fechaFin = $_GET['cmbAnioF'] . "-" . $_GET['cmbMesF'] . $_GET['cmbDiaF'];
        $sqlFecha = "AND fecha between '" . $fechaInicio . "' AND '" . $fechaFin . "' ";
    }
    $arrayPH=['PH Coyoacán','PH Durango','PH Ecommerce'
                ,'PH Guadalajara','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite'];
    $auxtotalUSuc=0;
    $auxtotalDSuc=0;
    $sqlSuc="select total_sales,net_quantity from ventas where (total_sales!=0 or net_quantity!=0) and pos_location_name NOT IN ('PH Coyoacán','PH Durango','PH Ecommerce'
    ,'PH Guadalajara','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite')";
    $resSuc=mysqli_query($con,$sqlSuc);
    if(!$resSuc){
        echo mysqli_error($con);
    }else{
        if(mysqli_num_rows($resSuc)>0){
            while($row=mysqli_fetch_assoc($resSuc)){
                $auxtotalUSuc=$auxtotalUSuc+$row['net_quantity'];
                $auxtotalDSuc=$auxtotalDSuc+$row['total_sales'];

            }
        }
    }

    $auxtotalDPH=0;
    $auxtotalUPH=0;
    $sqlPHSuc="select total_sales,net_quantity from ventas where (total_sales!=0 or net_quantity!=0) and pos_location_name IN ('PH Coyoacán','PH Durango','PH Ecommerce'
    ,'PH Guadalajara','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite')";
    $resSucPH=mysqli_query($con,$sqlPHSuc);
    if(!$resSucPH){
        echo mysqli_error($con);
    }else{
        if(mysqli_num_rows($resSucPH)>0){
            while($rowPH=mysqli_fetch_assoc($resSucPH)){
                $auxtotalUPH=$auxtotalUPH+$rowPH['net_quantity'];
                $auxtotalDPH=$auxtotalDPH+$rowPH['total_sales'];

            }
        }
    }
    $auxTotalTotal=$auxtotalUPH+$auxtotalUSuc;
    $totalUniVenta=0;
    $totalDinero=0;
    $totalPorcenUniVen=0;


    $conCR=0;
    $conPV=0;
    $conOI=0;
    $fila = 1;

    $sqlColeccion='';

    if($_GET['coleccion']!=''){
        $sqlColeccion=" AND coleccion='".$_GET['coleccion']."'";
    }
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);

    if ($_GET['modelo'] != '') {
        if ($_GET['color'] != '') {
            if ($_GET['talla'] != '') { //Busqueda por modelo,color y talla
                $sucursales = $_GET['sucursal'];
                foreach ($sucursales as $sucursal) {
                    $auxtotalU=0;
                    $sqlSuc1="";
                    if($sucursal=="PH Total" ||in_array($sucursal,$arrayPH) ){        
                        if(in_array($sucursal,$arrayPH)){
                            $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name='".$sucursal."' and product_type='".$_GET['categoria']."' and modelo='".$_GET['modelo']."' and color='".$_GET['color']."' and talla='".$_GET['talla']."' ".$sqlColeccion." ".$sqlFecha." ";
                        }else{

                            $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name IN ('PH Coyoacán','PH Durango','PH Ecommerce','PH Guadalajara',
                            'PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite') and product_type='".$_GET['categoria']."' and modelo='".$_GET['modelo']."' and color='".$_GET['color']."' and talla='".$_GET['talla']."' ".$sqlColeccion." ".$sqlFecha." ";
                        }
                        
                    }else{
                        if($sucursal="no PH"){
                            $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name NOT IN ('PH Coyoacán','PH Durango','PH Ecommerce','PH Guadalajara',
                            'PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite') and product_type='".$_GET['categoria']."' and modelo='".$_GET['modelo']."' and color='".$_GET['color']."' and talla='".$_GET['talla']."' ".$sqlColeccion." ".$sqlFecha." ";
                        }else{
                            $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name='".$sucursal."' and product_type='".$_GET['categoria']."' and modelo='".$_GET['modelo']."' and color='".$_GET['color']."' and talla='".$_GET['talla']."' ".$sqlColeccion." ".$sqlFecha." ";

                        }
                    }
                    $resSuc1=mysqli_query($con,$sqlSuc1);
                    if(!$resSuc1){
                        echo mysqli_error($con);
                    }else{
                        if(mysqli_num_rows($resSuc1)>0){
                            while($row=mysqli_fetch_assoc($resSuc1)){
                                $auxtotalU=$auxtotalU+$row['net_quantity'];                
                            }
                        }
                    }
                   

                    $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, 'Sucursal');
                    $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, 'Modelo');
                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, 'Color');
                    $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, 'Talla');
                    $objPHPExcel->getActiveSheet()->setCellValue('E'.$fila, 'Cantidad unidades');
                    $objPHPExcel->getActiveSheet()->setCellValue('F'.$fila, 'Total de la venta');
                    $objPHPExcel->getActiveSheet()->setCellValue('G'.$fila, '% deunidades sucursal');
                    $objPHPExcel->getActiveSheet()->setCellValue('H'.$fila, '% deunidades sobre toda la venta');
                    $band=0;
                    if($sucursal!="PH Total" && $sucursal!="no PH"){
                        if(in_array($sucursales,$arrayPH)){
                            $objPHPExcel->getActiveSheet()->setCellValue('I'.$fila, '% deunidades Total/PH');
                    
                        }else{
                            $objPHPExcel->getActiveSheet()->setCellValue('I'.$fila, '% deunidades Total/ no PH');
                    
                        }
                        $band=1;
                    }
                    if($band==1){
                        $objPHPExcel->getActiveSheet()->setCellValue('J'.$fila, '% en Unidades sobre toda la venta ');
    
                    }else{
                        $objPHPExcel->getActiveSheet()->setCellValue('I'.$fila, '% en Unidades sobre toda la venta ');
    
                    }
                    $fila++;
                    $conTotUnidades=0;
                    $conTotVentas=0;
                    $conShereUnidades=0;
                    $TotalShereUniSuc=0;
                    $contotalShereVenta=0;

                    $conUnidades=0;
                    $conVenta=0;
                    $shereUnidades=0;
                    $shereUnidadesSuc=0;
                    $totalShereVenta=0;
                    $sql3='';
                    if($sucursal=="PH Total"){
                        $sql3="select net_quantity,total_sales,coleccion from ventas where pos_location_name IN ('PH Coyoacán','PH Durango'
                        ,'PH Guadalajara','PH Ecommerce','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite') and  product_type='".$_GET['categoria']."'  and  
                        modelo='".$_GET['modelo']."' and talla='".$_GET['talla']."' and color='".$_GET['color']."' ".$sqlColeccion." ".$sqlFecha." ";    
                    }else{
                        if($sucursal=="no PH"){
                            $sql3="select net_quantity,total_sales,coleccion from ventas where pos_location_name NOT IN ('PH Coyoacán','PH Durango'
                            ,'PH Guadalajara','PH Ecommerce','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite') and  product_type='".$_GET['categoria']."' and  
                            modelo='".$_GET['modelo']."' and talla='".$_GET['talla']."' and color='".$_GET['color']."' ".$sqlColeccion." ".$sqlFecha." ";    
                        }else{
                                $sql3="select net_quantity,total_sales,coleccion from ventas where pos_location_name='".$sucursal."' and  product_type='".$_GET['categoria']."'  and  
                            modelo='".$_GET['modelo']."' and talla='".$_GET['talla']."' and color='".$_GET['color']."' ".$sqlColeccion." ".$sqlFecha." ";
                        }

                        
                    }
                    $res3 = mysqli_query($con, $sql3);
                    if (!$res3) {
                        echo mysqli_error($con);
                    } else {
                        if (mysqli_num_rows($res3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($res3)) {
                               //Cantidad de unidades
                               $conUnidades=$conUnidades+$row3['net_quantity'];
                               //Total de la venta
                               $conVenta=$conVenta+$row3['total_sales'];
                               if($row3['coleccion']=="CR"){
                                   $conCR=$conCR+$row3['net_quantity'];
                               }
                               if($row3['coleccion']=="PV"){
                                   $conPV=$conPV+$row3['net_quantity'];
                               } 
                               if($row3['coleccion']=="OI"){
                                   $conOI=$conOI+$row3['net_quantity'];
                               }
                            }
                             //% de unidades sobre una sucursal o sobre el propio PH 
                             $shereUnidadesSuc=number_format($conUnidades/$auxtotalU*100,2);
                                            
                             if($sucursal=="PH Total"&&in_array($sucursal,$arrayPH)){
                                 // % unidades  sobre el PH o no PH 
                                 $shereUnidades=number_format($conUnidades/$auxtotalUPH*100,2);
                                 
                             }else{
                                 // % unidades  sobre el PH
                                 $shereUnidades=number_format($conUnidades/$auxtotalUSuc*100,2);                                                       
                             }
                             //Shere unidades sobre toda la venta
                             $totalShereVenta=number_format($conUnidades/$auxTotalTotal*100,2);                                                   
                             //Total de unidades 
                             $conTotUnidades=$conTotUnidades+$conUnidades;
                             //Total de unidades
                             $conTotVentas=$conTotVentas+$conVenta;
                             //Total de % de la unidades de sucursal
                             $TotalShereUniSuc=number_format( $TotalShereUniSuc+$shereUnidadesSuc,2);
                             //Calcula el total del % de las unidades sobre PH o noPH
                             $conShereUnidades=number_format($conShereUnidades+$shereUnidades,2);
                             //Calcula el total del % de las unidades sobre PH o noPH
                             $contotalShereVenta=$contotalShereVenta+$totalShereVenta;

                             $totalUniVenta=$totalUniVenta+$conUnidades;
                             $totalDinero=$totalDinero+$conVenta;                                     
                             $totalPorcenUniVen=$totalPorcenUniVen+$totalShereVenta;
                             
                            $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, $sucursal);
                            $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $_GET['modelo']);
                            $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $_GET['color']);
                            $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $_GET['talla']);
                            $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $conUnidades);
                            $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, "$".$conVenta);
                            $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $shereUnidadesSuc."%");
                            $band=0;
                            if($sucursal!="PH Total" && $sucursal!="no PH"){
                                $band=1;
                               $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $shereUnidades."%");
                            }
                            if($band==1){
                                $objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $totalShereVenta."%");
                            }else{
                                $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $totalShereVenta."%");
                            }
                            $fila++;
                        }
                    }
                    $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, 'Total');
                    $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $conTotUnidades);
                    $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, "$".$conTotVentas);
                    $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $TotalShereUniSuc."%");
                    $band=0;
                    if($sucursal!="PH Total" && $sucursal!="no PH"){
                        $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $conShereUnidades."%");
                        $band=1;
                     }
                    if($band==1){
                        $objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $totalShereVenta."%");
                    }else{
                        $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $totalShereVenta."%");
                    }
                    $fila+=2;
                }
            } else { //Busqueda por modelo y color
                $sucursales = $_GET['sucursal'];        
                foreach ($sucursales as $sucursal) {
                    $auxtotalU=0;
                    $sqlSuc1="";
                    if($sucursal=="PH Total" ||in_array($sucursal,$arrayPH) ){        
                        if(in_array($sucursal,$arrayPH)){
                            $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name='".$sucursal."' and product_type='".$_GET['categoria']."' and modelo='".$_GET['modelo']."' and color='".$_GET['color']."' ".$sqlColeccion." ".$sqlFecha." ";
                        }else{

                            $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name IN ('PH Coyoacán','PH Durango','PH Ecommerce','PH Guadalajara',
                            'PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite') and product_type='".$_GET['categoria']."' and modelo='".$_GET['modelo']."' and color='".$_GET['color']."' ".$sqlColeccion." ".$sqlFecha." ";
                        }
                        
                    }else{
                        if($sucursal="no PH"){
                            $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name NOT IN ('PH Coyoacán','PH Durango','PH Ecommerce','PH Guadalajara',
                            'PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite') and product_type='".$_GET['categoria']."' and modelo='".$_GET['modelo']."' and color='".$_GET['color']."' ".$sqlColeccion." ".$sqlFecha." ";
                        }else{
                            $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name='".$sucursal."' and product_type='".$_GET['categoria']."' and modelo='".$_GET['modelo']."' and color='".$_GET['color']."' ".$sqlColeccion." ".$sqlFecha." ";

                        }
                    }
                    if(!$resSuc1){
                        echo mysqli_error($con);
                    }else{
                        if(mysqli_num_rows($resSuc1)>0){
                            while($row=mysqli_fetch_assoc($resSuc1)){
                                $auxtotalU=$auxtotalU+$row['net_quantity'];                
                            }
                        }
                    }

                    $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, 'Sucursal');
                    $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, 'Modelo');
                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, 'Color');
                    $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, 'Talla');
                    $objPHPExcel->getActiveSheet()->setCellValue('E'.$fila, 'Total de unidades');
                    $objPHPExcel->getActiveSheet()->setCellValue('F'.$fila, 'Total de la venta');
                    $objPHPExcel->getActiveSheet()->setCellValue('G'.$fila, '% deunidades sucursal');
                    $objPHPExcel->getActiveSheet()->setCellValue('H'.$fila, '% deunidades');
                    $band=0;
                    if($sucursal!="PH Total" && $sucursal!="no PH"){
                        if(in_array($sucursales,$arrayPH)){
                            $objPHPExcel->getActiveSheet()->setCellValue('I'.$fila, '% deunidades Total/PH');
                    
                        }else{
                            $objPHPExcel->getActiveSheet()->setCellValue('I'.$fila, '% deunidades Total/ no PH');
                    
                        }
                        $band=1;
                    }
                    if($band==1){
                        $objPHPExcel->getActiveSheet()->setCellValue('J'.$fila, '% en Unidades sobre toda la venta ');
    
                    }else{
                        $objPHPExcel->getActiveSheet()->setCellValue('I'.$fila, '% en Unidades sobre toda la venta ');
    
                    }
                    $conTotUnidades=0;
                    $conTotVentas=0;
                    $conShereUnidades=0;
                    $TotalShereUniSuc=0;
                    $contotalShereVenta=0;
                    $sqlCol = "select distinct(talla) from ventas where modelo='" . $_GET['modelo'] . "' and net_quantity>0 or total_sales>0 order by color asc";
                    $res1 = mysqli_query($con, $sqlCol);
                    if (!$res1) {
                        echo mysqli_error($con);
                    } else {
                        while ($row1 = mysqli_fetch_assoc($res1)) {
                            $conUnidades=0;
                            $conVenta=0;
                            $shereUnidades=0;
                            $shereUnidadesSuc=0;
                            $totalShereVenta=0;
                            $sql3='';
                            if($sucursal=="PH Total"){
                                $sql3="select net_quantity,total_sales,coleccion from ventas where pos_location_name IN ('PH Coyoacán','PH Durango'
                                ,'PH Guadalajara','PH Ecommerce','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite') and  product_type='".$_GET['categoria']."' and  
                                modelo='".$_GET['modelo']."' and talla='".$row1['talla']."' and color='".$_GET['color']."' ".$sqlColeccion." ".$sqlFecha." ";    
                            }else{
                                if($sucursal=="no PH"){
                                    $sql3="select net_quantity,total_sales,coleccion from ventas where pos_location_name NOT IN ('PH Coyoacán','PH Durango'
                                    ,'PH Guadalajara','PH Ecommerce','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite') and  product_type='".$_GET['categoria']."'  and  
                                    modelo='".$_GET['modelo']."' and talla='".$row1['talla']."' and color='".$_GET['color']."' ".$sqlColeccion." ".$sqlFecha." ";    
                                }else{
                                    $sql3="select net_quantity,total_sales,coleccion from ventas where pos_location_name='".$sucursal."' and  product_type='".$_GET['categoria']."' and  
                                    modelo='".$_GET['modelo']."' and talla='".$row1['talla']."' and color='".$_GET['color']."' ".$sqlColeccion." ".$sqlFecha." ";
                                }
                                
                            }
                            if (!$res3) {
                                echo mysqli_error($con);
                            } else {
                                if (mysqli_num_rows($res3) > 0) {
                                    while ($row3 = mysqli_fetch_assoc($res3)) {
                                         //Cantidad de unidades
                                         $conUnidades=$conUnidades+$row2['net_quantity'];
                                         //Total de la venta
                                         $conVenta=$conVenta+$row2['total_sales'];
                                         if($row2['coleccion']=="CR"){
                                             $conCR=$conCR+$row2['net_quantity'];
                                         }
                                         if($row2['coleccion']=="PV"){
                                             $conPV=$conPV+$row2['net_quantity'];
                                         } 
                                         if($row2['coleccion']=="OI"){
                                             $conOI=$conOI+$row2['net_quantity'];
                                         }
                                    }
                                    //% de unidades sobre una sucursal o sobre el propio PH 
                                    $shereUnidadesSuc=number_format($conUnidades/$auxtotalU*100,2);
                                                    
                                    if($sucursal=="PH Total"&&in_array($sucursal,$arrayPH)){
                                        // % unidades  sobre el PH o no PH 
                                        $shereUnidades=number_format($conUnidades/$auxtotalUPH*100,2);
                                        
                                    }else{
                                        // % unidades  sobre el PH
                                        $shereUnidades=number_format($conUnidades/$auxtotalUSuc*100,2);                                                       
                                    }
                                    //Shere unidades sobre toda la venta
                                    $totalShereVenta=number_format($conUnidades/$auxTotalTotal*100,2);                                                   
                                    //Total de unidades 
                                    $conTotUnidades=$conTotUnidades+$conUnidades;
                                    //Total de unidades
                                    $conTotVentas=$conTotVentas+$conVenta;
                                    //Total de % de la unidades de sucursal
                                    $TotalShereUniSuc=number_format( $TotalShereUniSuc+$shereUnidadesSuc,2);
                                    //Calcula el total del % de las unidades sobre PH o noPH
                                    $conShereUnidades=number_format($conShereUnidades+$shereUnidades,2);
                                    //Calcula el total del % de las unidades sobre PH o noPH
                                    $contotalShereVenta=$contotalShereVenta+$totalShereVenta;

                                    $totalUniVenta=$totalUniVenta+$conUnidades;
                                    $totalDinero=$totalDinero+$conVenta;                                     
                                    $totalPorcenUniVen=$totalPorcenUniVen+$totalShereVenta;

                                    $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, $sucursal);
                                    $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $_GET['modelo']);
                                    $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $_GET['color']);
                                    $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $row1['talla']);
                                    $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $conUnidades);
                                    $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $conVenta);
                                    $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $shereUnidadesSuc);
                                    $band=0;
                                    if($sucursal!="PH Total" && $sucursal!="no PH"){
                                        $band=1;
                                       $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $shereUnidades);
                                    }
                                    if($band==1){
                                        $objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $totalShereVenta);
                                    }else{
                                        $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $totalShereVenta);
                                    }
                                    $fila++;
                                }
                            }
                        }
                        $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, 'Total');
                        $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $conTotUnidades);
                        $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $conTotVentas);
                        $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $TotalShereUniSuc);
                        $band=0;
                        if($sucursal!="PH Total" && $sucursal!="no PH"){
                            $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $conShereUnidades);
                            $band=1;
                         }
                        if($band==1){
                            $objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $totalShereVenta);
                        }else{
                            $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $totalShereVenta);
                        }
    
                        $fila+=2;
                    }
                }
            }
        } else {
            if ($_GET['talla'] != '') { //Busqueda por modelo y talla
                $sucursales = $_GET['sucursal'];                
                foreach ($sucursales as $sucursal) {
                    $auxtotalU=0;
                    $sqlSuc1='';
                    if($sucursal=="PH Total" ||in_array($sucursal,$arrayPH) ){        
                        if(in_array($sucursal,$arrayPH)){
                            $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name='".$sucursal."' and modelo='".$_GET['modelo']."' and talla='".$_GET['talla']."' ".$sqlColeccion." ".$sqlFecha." ";
                        }else{

                            $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name IN ('PH Coyoacán','PH Durango','PH Ecommerce','PH Guadalajara',
                            'PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite') and modelo='".$_GET['modelo']."' and talla='".$_GET['talla']."' ".$sqlColeccion." ".$sqlFecha." ";
                        }
                        
                    }else{
                        if($sucursal=="no PH"){
                            $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name NOT IN ('PH Coyoacán','PH Durango','PH Ecommerce','PH Guadalajara',
                            'PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite') and modelo='".$_GET['modelo']."' and talla='".$_GET['talla']."' ".$sqlColeccion." ".$sqlFecha." ";
                        }else{
                            $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name='".$sucursal."' and modelo='".$_GET['modelo']."' and talla='".$_GET['talla']."' ".$sqlColeccion." ".$sqlFecha." ";
                        }
                    }
                    
                    $resSuc1=mysqli_query($con,$sqlSuc1);
                    if(!$resSuc1){
                        echo mysqli_error($con);
                    }else{
                        if(mysqli_num_rows($resSuc1)>0){
                            while($row=mysqli_fetch_assoc($resSuc1)){
                                $auxtotalU=$auxtotalU+$row['net_quantity'];
                            }
                        }
                    }
                    
                    $conTotUnidades=0;
                    $conTotVentas=0;
                    $conShereUnidades=0;
                    $TotalShereUniSuc=0;
                    $contotalShereVenta=0;
                    $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, 'Sucursal');
                    $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, 'Modelo');
                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, 'Color');
                    $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, 'Talla');
                    $objPHPExcel->getActiveSheet()->setCellValue('E'.$fila, 'Total de unidades');
                    $objPHPExcel->getActiveSheet()->setCellValue('F'.$fila, 'Total de la venta');
                    $objPHPExcel->getActiveSheet()->setCellValue('G'.$fila, '% deunidades sucursal');
                    $objPHPExcel->getActiveSheet()->setCellValue('H'.$fila, '% deunidades');
                    $band=0;
                    if($sucursal!="PH Total" && $sucursal!="no PH"){
                        if(in_array($sucursales,$arrayPH)){
                            $objPHPExcel->getActiveSheet()->setCellValue('I'.$fila, '% deunidades Total/PH');
                    
                        }else{
                            $objPHPExcel->getActiveSheet()->setCellValue('I'.$fila, '% deunidades Total/ no PH');
                    
                        }
                        $band=1;
                    }
                    if($band==1){
                        $objPHPExcel->getActiveSheet()->setCellValue('J'.$fila, '% en Unidades sobre toda la venta ');
    
                    }else{
                        $objPHPExcel->getActiveSheet()->setCellValue('I'.$fila, '% en Unidades sobre toda la venta ');
    
                    }

                    $fila++;
                    $sqlCol = "select distinct(color) from ventas where modelo='" . $_GET['modelo'] . "' and net_quantity>0 or total_sales>0 order by color asc";
                    $res1 = mysqli_query($con, $sqlCol);
                    if (!$res1) {
                        echo mysqli_error($con);
                    } else {
                        while ($row1 = mysqli_fetch_assoc($res1)) {
                            $conUnidades=0;
                            $conVenta=0;
                            $shereUnidades=0;
                            $shereUnidadesSuc=0;
                            $totalShereVenta=0;
                            $sql3='';
                            if($sucursal=="PH Total"){
                                $sql3="select net_quantity,total_sales,coleccion from ventas where pos_location_name IN ('PH Coyoacán','PH Durango'
                                ,'PH Guadalajara','PH Ecommerce','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite') and  product_type='".$_GET['categoria']."'  and  
                                modelo='".$_GET['modelo']."' and talla='".$_GET['talla']."' and color='".$row1['color']."' ".$sqlColeccion." ".$sqlFecha." ";    
                            }else{
                                if($sucursal=="no PH"){
                                    $sql3="select net_quantity,total_sales,coleccion from ventas where pos_location_name NOT IN ('PH Coyoacán','PH Durango'
                                    ,'PH Guadalajara','PH Ecommerce','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite')and  product_type='".$_GET['categoria']."' and  
                                    modelo='".$_GET['modelo']."' and talla='".$_GET['talla']."' and color='".$row1['color']."' ".$sqlColeccion." ".$sqlFecha." ";    
                                }else{
                                    $sql3="select net_quantity,total_sales,coleccion from ventas where pos_location_name='".$sucursal."' and  product_type='".$_GET['categoria']."' and  
                                modelo='".$_GET['modelo']."' and talla='".$_GET['talla']."' and color='".$row1['color']."' ".$sqlColeccion." ".$sqlFecha." ";
                                }
                                
                            }
                            $res3 = mysqli_query($con, $sql3);
                            if (!$res3) {
                                echo mysqli_error($con);
                            } else {
                                if (mysqli_num_rows($res3) > 0) {
                                    while ($row3 = mysqli_fetch_assoc($res3)) {
                                         //Cantidad de unidades
                                         $conUnidades=$conUnidades+$row3['net_quantity'];
                                         //Total de la venta
                                         $conVenta=$conVenta+$row3['total_sales'];

                                         if($row3['coleccion']=="CR"){
                                             $conCR=$conCR+$row3['net_quantity'];
                                         }
                                         if($row3['coleccion']=="PV"){
                                             $conPV=$conPV+$row3['net_quantity'];
                                         } 
                                         if($row3['coleccion']=="OI"){
                                             $conOI=$conOI+$row3['net_quantity'];
                                         }
                                    }
                                    //% de unidades sobre una sucursal o sobre el propio PH 
                                    $shereUnidadesSuc=number_format($conUnidades/$auxtotalU*100,2);
                                            
                                    if($sucursal=="PH Total"||in_array($sucursal,$arrayPH)){
                                        // % unidades  sobre el PH o no PH 
                                        $shereUnidades=number_format($conUnidades/$auxtotalUPH*100,2);
                                        
                                    }else{
                                        // % unidades  sobre el PH
                                        $shereUnidades=number_format($conUnidades/$auxtotalUSuc*100,2);                                                       
                                    }
                                    //Shere unidades sobre toda la venta
                                    $totalShereVenta=number_format($conUnidades/$auxTotalTotal*100,2);                                                   
                                    //Total de unidades 
                                    $conTotUnidades=$conTotUnidades+$conUnidades;
                                    //Total de unidades
                                    $conTotVentas=$conTotVentas+$conVenta;
                                    //Total de % de la unidades de sucursal
                                    $TotalShereUniSuc=number_format( $TotalShereUniSuc+$shereUnidadesSuc,2);
                                    //Calcula el total del % de las unidades sobre PH o noPH
                                    $conShereUnidades=number_format($conShereUnidades+$shereUnidades,2);
                                    //Calcula el total del % de las unidades sobre PH o noPH
                                    $contotalShereVenta=$contotalShereVenta+$totalShereVenta;

                                    $totalUniVenta=$totalUniVenta+$conUnidades;
                                    $totalDinero=$totalDinero+$conVenta;                                     
                                    $totalPorcenUniVen=$totalPorcenUniVen+$totalShereVenta;

                                    $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, $sucursal);
                                    $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $_GET['modelo']);
                                    $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $row1['color']);
                                    $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $_GET['talla']);
                                    $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $conUnidades);
                                    $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, "$".$conVenta);
                                    $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $shereUnidadesSuc."%");
                                    
                                    $band=0;
                                    if($sucursal!="PH Total" && $sucursal!="no PH"){
                                        $band=1;
                                       $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $shereUnidades."%");
                                    }
                                    if($band==1){
                                        $objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $totalShereVenta."%");
                                    }else{
                                        $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $totalShereVenta."%");
                                    }
                                    $fila++;
                                }
                            }
                        }
                        $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, 'Total');
                        $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $conTotUnidades);
                        $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, "$".$conTotVentas);
                        $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $TotalShereUniSuc."%");
                        $band=0;
                        if($sucursal!="PH Total" && $sucursal!="no PH"){
                            $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $conShereUnidades."%");
                            $band=1;
                         }
                        if($band==1){
                            $objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $totalShereVenta."%");
                        }else{
                            $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $totalShereVenta."%");
                        }
    
                        $fila+=2;
                        
                    }
                }
            } else { //Busqueda por modelo
                $sucursales = $_GET['sucursal'];
                foreach ($sucursales as $sucursal) {
                    $auxtotalU=0;
                    $auxtotalD=0;
                    $sqlSuc='';
                    if($sucursal=="PH Total" ||in_array($sucursal,$arrayPH) ){        
                        if(in_array($sucursal,$arrayPH)){
                            $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name='".$sucursal."' and modelo='".$_GET['modelo']."' ".$sqlColeccion." ".$sqlFecha." ";
                        }else{

                            $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name IN ('PH Coyoacán','PH Durango','PH Ecommerce','PH Guadalajara',
                            'PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite') and modelo='".$_GET['modelo']."' ".$sqlColeccion." ".$sqlFecha." ";
                        }
                        
                    }else{
                        if($sucursal=="no PH"){
                            $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name NOT IN ('PH Coyoacán','PH Durango','PH Ecommerce','PH Guadalajara',
                            'PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite') and modelo='".$_GET['modelo']."' ".$sqlColeccion." ".$sqlFecha." ";
                        }else{
                            $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name='".$sucursal."' and modelo='".$_GET['modelo']."' ".$sqlColeccion." ".$sqlFecha." ";
                        }
                    }
                    
                    $resSuc1=mysqli_query($con,$sqlSuc1);
                    if(!$resSuc1){
                        echo mysqli_error($con);
                    }else{
                        if(mysqli_num_rows($resSuc1)>0){
                            while($row=mysqli_fetch_assoc($resSuc1)){
                                $auxtotalU=$auxtotalU+$row['net_quantity'];
                            }
                        }
                    }
                    
                    $conTotUnidades=0;
                    $conTotVentas=0;
                    $conShereUnidades=0;
                    $TotalShereUniSuc=0;
                    $contotalShereVenta=0;

                    $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, 'Sucursal');
                    $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, 'modelo');
                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, 'Color');
                    $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, 'Total de unidades');
                    $objPHPExcel->getActiveSheet()->setCellValue('E'.$fila, 'Total de la venta');
                    $objPHPExcel->getActiveSheet()->setCellValue('F'.$fila, '% deunidades sucursal');
                    $band=0;
                    if($sucursal!="PH Total" && $sucursal!="no PH"){
                        if(in_array($sucursales,$arrayPH)){
                            $objPHPExcel->getActiveSheet()->setCellValue('G'.$fila, '% deunidades Total/PH');
                    
                        }else{
                            $objPHPExcel->getActiveSheet()->setCellValue('G'.$fila, '% deunidades Total/ no PH');
                    
                        }
                        $band=1;
                    }
                    if($band==1){
                        $objPHPExcel->getActiveSheet()->setCellValue('H'.$fila, '% en Unidades sobre toda la venta ');
    
                    }else{
                        $objPHPExcel->getActiveSheet()->setCellValue('G'.$fila, '% en Unidades sobre toda la venta ');
    
                    }
    
                    $fila++;
                    $sqlTal = "select distinct(color) from ventas where modelo='" . $_GET['modelo'] . "' and net_quantity>0 or total_sales>0 order by color asc";
                    $res2 = mysqli_query($con, $sqlTal);
                    if (!$res2) {
                        echo mysqli_error($con);
                    } else {
                        while ($row2 = mysqli_fetch_assoc($res2)) {
                            $conUnidades=0;
                            $conVenta=0;
                            $shereUnidades=0;
                            $shereUnidadesSuc=0;
                            $totalShereVenta=0;
                            if($sucursal=="PH Total"){
                                $sql3="select net_quantity,total_sales,coleccion from ventas where pos_location_name IN ('PH Coyoacán','PH Durango'
                                ,'PH Guadalajara','PH Ecommerce','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite') and  product_type='".$_GET['categoria']."' and  
                                modelo='".$_GET['modelo']."' and color='".$row2['color']."' ".$sqlColeccion." ".$sqlFecha." ";
                                
                            }else{
                                if($sucursal=="no PH"){
                                    $sql3="select net_quantity,total_sales,coleccion from ventas where pos_location_name NOT IN ('PH Coyoacán','PH Durango'
                                    ,'PH Guadalajara','PH Ecommerce','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite') and  product_type='".$_GET['categoria']."' and  
                                    modelo='".$_GET['modelo']."' and color='".$row2['color']."' ".$sqlColeccion." ".$sqlFecha." ";
                                    
                                }else{
                                    $sql3="select net_quantity,total_sales,coleccion from ventas where pos_location_name='".$sucursal."' and   product_type='".$_GET['categoria']."' and 
                                    modelo='".$_GET['modelo']."'  and color='".$row2['color']."' ".$sqlColeccion." ".$sqlFecha." ";
                                }
                            }
                            $res3 = mysqli_query($con, $sql3);
                            if (!$res3) {
                                echo mysqli_error($con);
                            } else {
                                if (mysqli_num_rows($res3) > 0) {
                                    while ($row3 = mysqli_fetch_assoc($res3)) {
                                         //Cantidad de unidades
                                         $conUnidades=$conUnidades+$row3['net_quantity'];
                                         //Total de la venta
                                         $conVenta=$conVenta+$row3['total_sales'];

                                         
                                         if($row3['coleccion']=="CR"){
                                             $conCR=$conCR+$row3['net_quantity'];
                                         }
                                         if($row3['coleccion']=="PV"){
                                             $conPV=$conPV+$row3['net_quantity'];
                                         } 
                                         if($row3['coleccion']=="OI"){
                                             $conOI=$conOI+$row3['net_quantity'];
                                         }
                                    }
                                              //% de unidades sobre una sucursal o sobre el propio PH 
                                              $shereUnidadesSuc=number_format($conUnidades/$auxtotalU*100,2);
                                                
                                              if($sucursal=="PH Total"||in_array($sucursal,$arrayPH)){
                                                  // % unidades  sobre el PH o no PH 
                                                  $shereUnidades=number_format($conUnidades/$auxtotalUPH*100,2);
                                                  
                                              }else{
                                                  // % unidades  sobre el PH
                                                  $shereUnidades=number_format($conUnidades/$auxtotalUSuc*100,2);
                                                  
                                              }

                                              //Shere unidades sobre toda la venta
                                              $totalShereVenta=number_format($conUnidades/$auxTotalTotal*100,2);
                                              
                                              //Total de unidades 
                                              $conTotUnidades=$conTotUnidades+$conUnidades;
                                              //Total de unidades
                                              $conTotVentas=$conTotVentas+$conVenta;
                                              //Total de % de la unidades de sucursal
                                              $TotalShereUniSuc=number_format( $TotalShereUniSuc+$shereUnidadesSuc,2);
                                              //Calcula el total del % de las unidades sobre PH o noPH
                                              $conShereUnidades=number_format($conShereUnidades+$shereUnidades,2);
                                              //Calcula el total del % de las unidades sobre PH o noPH
                                              $contotalShereVenta=$contotalShereVenta+$totalShereVenta;

                                              $totalUniVenta=$totalUniVenta+$conUnidades;
                                              $totalDinero=$totalDinero+$conVenta;                                     
                                              $totalPorcenUniVen=$totalPorcenUniVen+$totalShereVenta;
                                              
                                    $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, $sucursal);
                                    $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $_GET['modelo']);
                                    $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $row2['color']);
                                    $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $conUnidades);
                                    $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, "$".$conVenta);
                                    $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $shereUnidadesSuc."%");
                                    
                                    $band=0;
                                    if($sucursal!="PH Total" && $sucursal!="no PH"){
                                        $band=1;
                                       $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $shereUnidades."%");
                                    }
                                    if($band==1){
                                        $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $totalShereVenta."%");
                                    }else{
                                        $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $totalShereVenta."%");
                                    }
                                    $fila++;
                                }
                            }
                        }
                    }

                    $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, 'Total');
                    $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $conTotUnidades);
                    $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, "$".$conTotVentas);
                    $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $TotalShereUniSuc."%");
                    $band=0;
                    if($sucursal!="PH Total" && $sucursal!="no PH"){
                        $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $conShereUnidades."%");
                        $band=1;
                     }
                    if($band==1){
                        $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $totalShereVenta."%");
                    }else{
                        $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $totalShereVenta."%");
                    }

                    $fila+=2;
                }
            }
        }
    } else {
        if ($_GET['categoria'] != '') { //Busqueda por sucursal y categoria

            $sucursales = $_GET['sucursal'];
            
            
            foreach ($sucursales as $sucursal) {
                $auxtotalU=0;
                $auxtotalD=0;
                $sqlSuc='';
                if($sucursal=="PH Total" ||in_array($sucursal,$arrayPH) ){        
                    if(in_array($sucursal,$arrayPH)){
                        $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name='".$sucursal."' and product_type='".$_GET['categoria']."' ".$sqlColeccion." ".$sqlFecha." ";
                    }else{

                        $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name IN ('PH Coyoacán','PH Durango','PH Ecommerce','PH Guadalajara',
                        'PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite') and product_type='".$_GET['categoria']."' ".$sqlColeccion." ".$sqlFecha." ";
                    }
                    
                }else{
                    if($sucursal=="no PH"){
                        $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name NOT IN ('PH Coyoacán','PH Durango','PH Ecommerce','PH Guadalajara',
                        'PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite') and product_type='".$_GET['categoria']."' ".$sqlColeccion." ".$sqlFecha." ";
                    }else{
                        $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name='".$sucursal."' and product_type='".$_GET['categoria']."' ".$sqlColeccion." ".$sqlFecha." ";
                    }
                    
                }
                $resSuc1=mysqli_query($con,$sqlSuc1);
                if(!$resSuc1){
                    echo mysqli_error($con);
                }else{
                    if(mysqli_num_rows($resSuc1)>0){
                        while($row=mysqli_fetch_assoc($resSuc1)){
                            $auxtotalU=$auxtotalU+$row['net_quantity'];
                        }
                    }
                }
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, 'Sucursal');
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, 'modelo');
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, 'Total de unidades');
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, 'Total de la venta');
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$fila, '% deunidades sucursal');
                $band=0;
                if($sucursal!="PH Total" && $sucursal!="no PH"){
                    if(in_array($sucursales,$arrayPH)){
                        $objPHPExcel->getActiveSheet()->setCellValue('F'.$fila, '% deunidades Total/PH');
                
                    }else{
                        $objPHPExcel->getActiveSheet()->setCellValue('F'.$fila, '% deunidades Total/ no PH');
                
                    }
                    $band=1;
                }
                if($band==1){
                    $objPHPExcel->getActiveSheet()->setCellValue('G'.$fila, '% en Unidades sobre toda la venta ');

                }else{
                    $objPHPExcel->getActiveSheet()->setCellValue('F'.$fila, '% en Unidades sobre toda la venta ');

                }

                $fila++;
                $sqlMod = "select distinct(modelo) from ventas where net_quantity>0 or total_sales>0 order by product_type asc";
                $res1 = mysqli_query($con, $sqlMod);

                $conTotUnidades=0;
                $conTotVentas=0;
                $conShereUnidades=0;
                $TotalShereUniSuc=0;
                $contotalShereVenta=0;
                if (!$res1) {
                    echo mysqli_error($con);
                } else {
                    while ($row1 = mysqli_fetch_assoc($res1)) {
                        $conUnidades=0;
                        $conVenta=0;
                        $shereUnidades=0;
                        $shereUnidadesSuc=0;
                        $totalShereVenta=0;
                        $sql2='';
                        if($sucursal=="PH Total"){
                            $sql2="select net_quantity,total_sales,coleccion from ventas where pos_location_name IN ('PH Coyoacán','PH Durango'
                            ,'PH Guadalajara','PH Ecommerce','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite') and  
                                product_type='".$_GET['categoria']."' and modelo='".$row1['modelo']."' ".$sqlColeccion." ".$sqlFecha." ";
                            
                        }else{
                            if($sucursal=="no PH"){
                                $sql2="select net_quantity,total_sales,coleccion from ventas where pos_location_name NOT IN ('PH Coyoacán','PH Durango'
                                ,'PH Guadalajara','PH Ecommerce','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite') and  
                                    product_type='".$_GET['categoria']."' and modelo='".$row1['modelo']."' ".$sqlColeccion." ".$sqlFecha." ";
                                
                            }else{
                                $sql2="select net_quantity,total_sales,coleccion from ventas where pos_location_name='".$sucursal."' and  
                            product_type='".$_GET['categoria']."' and modelo='".$row1['modelo']."' ".$sqlColeccion." ".$sqlFecha." ";
                            }                                   
                        }                        
                        $res2 = mysqli_query($con, $sql2);
                        if (!$res2) {
                            echo mysqli_error($con);
                        } else {
                            if (mysqli_num_rows($res2) > 0) {
                                while ($row2 = mysqli_fetch_assoc($res2)) {
                                     //Cantidad de unidades
                                     $conUnidades=$conUnidades+$row2['net_quantity'];
                                     //Total de la venta
                                     $conVenta=$conVenta+$row2['total_sales'];
                                     
                                     if($row2['coleccion']=="CR"){
                                         $conCR=$conCR+$row2['net_quantity'];
                                     }
                                     if($row2['coleccion']=="PV"){
                                         $conPV=$conPV+$row2['net_quantity'];
                                     } 
                                     if($row2['coleccion']=="OI"){
                                         $conOI=$conOI+$row2['net_quantity'];
                                     }
                                }
                                

                                  //% de unidades sobre una sucursal o sobre el propio PH 
                                  $shereUnidadesSuc=number_format($conUnidades/$auxtotalU*100,2);
                                
                                  if($sucursal=="PH Total"||in_array($sucursal,$arrayPH)){
                                      // % unidades  sobre el PH o no PH 
                                      $shereUnidades=number_format($conUnidades/$auxtotalUPH*100,2);
                                      
                                  }else{
                                      // % unidades  sobre el PH
                                      $shereUnidades=number_format($conUnidades/$auxtotalUSuc*100,2);
                                      
                                  }
  
                                     //% de unidades sobre una sucursal o sobre el propio PH 
                                     $shereUnidadesSuc=number_format($conUnidades/$auxtotalU*100,2);
                                                
                                     if($sucursal=="PH Total"||in_array($sucursal,$arrayPH)){
                                         // % unidades  sobre el PH o no PH 
                                         $shereUnidades=number_format($conUnidades/$auxtotalUPH*100,2);
                                         
                                     }else{
                                         // % unidades  sobre el PH
                                         $shereUnidades=number_format($conUnidades/$auxtotalUSuc*100,2);
                                         
                                     }

                                     //Shere unidades sobre toda la venta
                                     $totalShereVenta=number_format($conUnidades/$auxTotalTotal*100,2);
                                     
                                     //Total de unidades 
                                     $conTotUnidades=$conTotUnidades+$conUnidades;
                                     //Total de unidades
                                     $conTotVentas=$conTotVentas+$conVenta;
                                     //Total de % de la unidades de sucursal
                                     $TotalShereUniSuc=number_format( $TotalShereUniSuc+$shereUnidadesSuc,2);
                                     //Calcula el total del % de las unidades sobre PH o noPH
                                     $conShereUnidades=number_format($conShereUnidades+$shereUnidades,2);
                                     //Calcula el total del % de las unidades sobre PH o noPH
                                     $contotalShereVenta=$contotalShereVenta+$totalShereVenta;

                                     $totalUniVenta=$totalUniVenta+$conUnidades;
                                     $totalDinero=$totalDinero+$conVenta;                                     
                                     $totalPorcenUniVen=$totalPorcenUniVen+$totalShereVenta;
                                     
  
  
                                $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, $sucursal);
                                $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $row1['modelo']);
                                $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $conUnidades);
                                $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, "$".$conVenta);
                                $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $shereUnidadesSuc."%");
                                $band=0;
                                if($sucursal!="PH Total" && $sucursal!="no PH"){
                                    $band=1;
                                   $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $shereUnidades."%");
                                }
                                if($band==1){
                                    $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $totalShereVenta."%");
                                }else{
                                    $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $totalShereVenta."%");
                                }
                                
                                $fila++;
                            }
                        }
                    }
                    $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, 'Total');
                    $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $conTotUnidades);
                    $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila,"$". $conTotVentas);
                    $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $TotalShereUniSuc."%");
                    $band=0;
                    if($sucursal!="PH Total" && $sucursal!="no PH"){
                        $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $conShereUnidades."%");
                        $band=1;
                     }
                    
                     if($band==1){
                        $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $contotalShereVenta."%");

                     }else{
                        $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $contotalShereVenta."%");

                    }

                    $fila+=2;
                }
            }
        } else { //Busqueda por sucursal 

            $sucursales = $_GET['sucursal'];
            
            foreach ($sucursales as $sucursal) {
                
                $auxtotalU=0;
                $auxtotalD=0;
                $sqlSuc='';
                if($sucursal=="PH Total" ||in_array($sucursal,$arrayPH) ){        
                    if(in_array($sucursal,$arrayPH)){
                        $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name='".$sucursal."' ".$sqlColeccion." ".$sqlFecha." ";
                    }else{

                        $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name IN ('PH Coyoacán','PH Durango','PH Ecommerce','PH Guadalajara',
                        'PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite') ".$sqlColeccion." ".$sqlFecha." ";
                    }
                    
                }else{
                    if($sucursal=="no PH"){
                        $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name NOT IN ('PH Coyoacán','PH Durango','PH Ecommerce','PH Guadalajara',
                        'PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite') ".$sqlFecha." ";
                    }else{
                        $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name='".$sucursal."' ".$sqlColeccion." ".$sqlFecha." ";
                    }
                    
                }
                
                $resSuc1 = mysqli_query($con, $sqlSuc1);
                if (!$resSuc1) {
                    echo mysqli_error($con);
                } else {
                    if (mysqli_num_rows($resSuc1) > 0) {
                        while ($row = mysqli_fetch_assoc($resSuc1)) {
                            $auxtotalU = $auxtotalU + $row['net_quantity'];
                        }
                    }
                }


                $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, 'Sucursal');
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, 'Categoria');
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, 'Cantidad de unidades');
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, 'Total de venta');
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$fila, '% deunidades sucursal');
                $band=0;
                if($sucursal!="PH Total" && $sucursal!="no PH"){
                    if(in_array($sucursales,$arrayPH)){
                        $objPHPExcel->getActiveSheet()->setCellValue('F'.$fila, '% deunidades Total/PH');
                
                    }else{
                        $objPHPExcel->getActiveSheet()->setCellValue('F'.$fila, '% deunidades Total/ no PH');
                
                    }
                    $band=1;
                }
                if($band==1){
                    $objPHPExcel->getActiveSheet()->setCellValue('G'.$fila, '% en Unidades sobre toda la venta ');

                }else{
                    $objPHPExcel->getActiveSheet()->setCellValue('F'.$fila, '% en Unidades sobre toda la venta ');

                }

                $fila++;

                $sqlCat = "select distinct(product_type) from ventas where net_quantity!=0 or total_sales!=0 order by product_type asc";
                $res1 = mysqli_query($con, $sqlCat);

                $conTotUnidades=0;
                $conTotVentas=0;
                $conShereUnidades=0;
                $TotalShereUniSuc=0;
                $totalShereVenta=0;
                $contotalShereVenta=0;
                
                if (!$res1) {
                    echo mysqli_error($con);
                } else {
                    while ($row1 = mysqli_fetch_assoc($res1)) {
                        $conUnidades=0;
                        $conVenta=0;
                        $shereUnidades=0;
                        $shereUnidadesSuc=0;
                        $totalShereVenta=0;
                        $sql2="";
                        if($sucursal=="PH Total"){
                            $sql2="select net_quantity,total_sales,coleccion from ventas where pos_location_name IN ('PH Coyoacán','PH Durango'
                            ,'PH Guadalajara','PH Ecommerce','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite') and  
                            product_type='".$row1['product_type']."' ".$sqlColeccion." ".$sqlFecha." ";
                            
                        }else{
                            if($sucursal=="no PH"){
                                $sql2="select net_quantity,total_sales,coleccion from ventas where pos_location_name NOT IN ('PH Coyoacán','PH Durango'
                                ,'PH Guadalajara','PH Ecommerce','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Querétaro','PH Santa Fé','PH Satélite') and  
                                product_type='".$row1['product_type']."' ".$sqlColeccion." ".$sqlFecha." ";
                            }else{
                                $sql2="select net_quantity,total_sales,coleccion from ventas where pos_location_name='".$sucursal."' and  
                                product_type='".$row1['product_type']."' ".$sqlColeccion." ".$sqlFecha." ";
                            }
                        
                        }
                           
                        $res2 = mysqli_query($con, $sql2);
                        if (!$res2) {
                            echo mysqli_error($con);
                        } else {
                            if (mysqli_num_rows($res2) > 0) {
                                while($row2=mysqli_fetch_assoc($res2)){
                                    //Cantidad de unidades
                                    $conUnidades=$conUnidades+$row2['net_quantity'];
                                    //Total de la venta
                                    $conVenta=$conVenta+$row2['total_sales'];

                                    if($row2['coleccion']=="CR"){
                                        $conCR=$conCR+$row2['net_quantity'];
                                    }
                                    if($row2['coleccion']=="PV"){
                                        $conPV=$conPV+$row2['net_quantity'];
                                    } 
                                    if($row2['coleccion']=="OI"){
                                        $conOI=$conOI+$row2['net_quantity'];
                                    }
                                }
                                    //% de unidades sobre una sucursal o sobre el propio PH 
                                    $shereUnidadesSuc=number_format($conUnidades/$auxtotalU*100,2);
                                                
                                    if($sucursal=="PH Total"||in_array($sucursal,$arrayPH)){
                                        // % unidades  sobre el PH o no PH 
                                        $shereUnidades=number_format($conUnidades/$auxtotalUPH*100,2);
                                        
                                    }else{
                                        // % unidades  sobre el PH
                                        $shereUnidades=number_format($conUnidades/$auxtotalUSuc*100,2);
                                        
                                    }

                                    //Shere unidades sobre toda la venta
                                    $totalShereVenta=number_format($conUnidades/$auxTotalTotal*100,2);
                                    
                                    //Total de unidades 
                                    $conTotUnidades=$conTotUnidades+$conUnidades;
                                    //Total de unidades
                                    $conTotVentas=$conTotVentas+$conVenta;
                                    //Total de % de la unidades de sucursal
                                    $TotalShereUniSuc=number_format( $TotalShereUniSuc+$shereUnidadesSuc,2);
                                    //Calcula el total del % de las unidades sobre PH o noPH
                                    $conShereUnidades=number_format($conShereUnidades+$shereUnidades,2);
                                    //Calcula el total del % de las unidades sobre PH o noPH
                                    $contotalShereVenta=$contotalShereVenta+$totalShereVenta;

                                    $totalUniVenta=$totalUniVenta+$conUnidades;
                                    $totalDinero=$totalDinero+$conVenta;                                     
                                    $totalPorcenUniVen=$totalPorcenUniVen+$totalShereVenta;
                                    

                                $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, $sucursal);
                                $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $row1['product_type']);
                                $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $conUnidades);
                                $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, '$'.$conVenta);
                                $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $shereUnidadesSuc."%");
                                $band=0;
                                if($sucursal!="PH Total" && $sucursal!="no PH"){
                                    $band=1;
                                   $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $shereUnidades."%");
                                }
                                if($band==1){
                                    $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $totalShereVenta."%");
                                }else{
                                    $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $totalShereVenta."%");
                                }
                                
                                $fila++;
                            }
                        }
                    }
                    $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, 'Total');
                    $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $conTotUnidades);
                    $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, '$'.$conTotVentas);
                    $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $TotalShereUniSuc."%");
                    $band=0;
                    if($sucursal!="PH Total" && $sucursal!="no PH"){
                        $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $conShereUnidades."%");
                        $band=1;
                     }
                    
                     if($band==1){
                        $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $contotalShereVenta."%");

                     }else{
                        $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $contotalShereVenta."%");

                    }

                    $fila+=2;
                }
            }
        }
        $fila++;

      

        /*
        
        if($_GET['categoria']!=''){
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, 'Categoria');
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, 'Total de unidades');
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, 'Total de dinero');
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, 'Total sobre la venta');
        
            $fila++;
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $_GET['categoria']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $totalUniVenta);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $totalDinero);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $totalPorcenUniVen);
            $fila++;
        }
        
        
        if($_GET['modelo']!=''){
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, 'Categoria');
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, 'Modelo');
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, 'Total de unidades');
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, 'Total de dinero');
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, 'Total sobre la venta');
            $fila++;
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $_GET['categoria']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $_GET['modelo']);
            
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $totalUniVenta);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $totalDinero);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $totalPorcenUniVen);
            $fila++;
        }
            echo "<td>Modelo</td>";
        if($_GET['modelo']!='' && $_GET['color']!=''){
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, 'Categoria');
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, 'Modelo');
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, 'Color');
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, 'Total de unidades');
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, 'Total de dinero');
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, 'Total sobre la venta');
            $fila++;
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $_GET['categoria']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $_GET['modelo']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $_GET['color']);   
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $totalUniVenta);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $totalDinero);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $totalPorcenUniVen);
            $fila++;
        }
            echo "<td>Color</td>";
        if($_GET['modelo']!='' && $_GET['talla']!=''){
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, 'Categoria');
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, 'Modelo');
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, 'Talla');
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, 'Total de unidades');
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, 'Total de dinero');
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, 'Total sobre la venta');
            $fila++;
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $_GET['categoria']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $_GET['modelo']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $_GET['talla']);   
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $totalUniVenta);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $totalDinero);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $totalPorcenUniVen);
            $fila++;
        }
            
        if($_GET['modelo']!='' && $_GET['color']!='' && $_GET['talla']!=''){
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, 'Categoria');
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, 'Modelo');
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, 'Color');
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, 'Talla');
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, 'Total de unidades');
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, 'Total de dinero');
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, 'Total sobre la venta');
            $fila++;
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $_GET['categoria']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $_GET['modelo']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $_GET['color']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $_GET['talla']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $totalUniVenta);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $totalDinero);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $totalPorcenUniVen);
            $fila++;
        }

        */
        
    }


    $porCr=number_format($conCR/$totalUniVenta*100,2);
    $porPV=number_format($conPV/$totalUniVenta*100,2);
    $porOI=number_format($conOI/$totalUniVenta*100,2);

    $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, 'Coleccion');
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, 'Cantidad');
    $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, '%');
    $fila++;

    $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, 'Coleccion Regina Romero');
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, ''.$conCR);
    $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, ''.$porCr."%");
    $fila++;

    $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, 'Primavera Veraqno');
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, ''.$conPV);
    $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, ''.$porPV."%");
    $fila++;

    $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, 'Otoño Invierno');
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, ''.$conOI);
    $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, ''.$porOI."%");
    $fila++;
    $totalColec=$conCR+$conPV+$conOI;
    //var_dump($totalColec);
     $totalPorCole=$porCr+$porPV+$porOI; 
     $difTotal=$totalUniVenta-$totalColec;


     if($difTotal>0){
         $totalColec=$totalColec+$difTotal;
         $auxPor=number_format($difTotal/$totalColec,2);
         $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, 'Otros');
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, ''.$difTotal);
        $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, ''.$auxPor."%");
        $fila++;
     }
     $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, 'Total');
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, ''.$totalColec);
    $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, ''.$totalPorCole."%");
    $fila+=2;


    $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, 'Total de la busqueda');
    $fila++;


    if($_GET['categoria']!=''){
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, 'Categoria');
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, 'Total de unidades');
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, 'Total de dinero');
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, 'Total sobre la venta');
    
        $fila++;
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $_GET['categoria']);
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $totalUniVenta);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $totalDinero);
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $totalPorcenUniVen);
        $fila++;
    }elseif($_GET['modelo']!=''){
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, 'Categoria');
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, 'Modelo');
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, 'Total de unidades');
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, 'Total de dinero');
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, 'Total sobre la venta');
        $fila++;
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $_GET['categoria']);
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $_GET['modelo']);
        
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $totalUniVenta);
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $totalDinero);
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $totalPorcenUniVen);
        $fila++;
    }elseif($_GET['modelo']!='' && $_GET['color']!=''){
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, 'Categoria');
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, 'Modelo');
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, 'Color');
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, 'Total de unidades');
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, 'Total de dinero');
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, 'Total sobre la venta');
        $fila++;
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $_GET['categoria']);
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $_GET['modelo']);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $_GET['color']);   
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $totalUniVenta);
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $totalDinero);
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $totalPorcenUniVen);
        $fila++;
    }elseif($_GET['modelo']!='' && $_GET['talla']!=''){
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, 'Categoria');
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, 'Modelo');
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, 'Talla');
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, 'Total de unidades');
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, 'Total de dinero');
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, 'Total sobre la venta');
        $fila++;
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $_GET['categoria']);
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $_GET['modelo']);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $_GET['talla']);   
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $totalUniVenta);
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $totalDinero);
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $totalPorcenUniVen);
        $fila++;
    }elseif($_GET['modelo']!='' && $_GET['color']!='' && $_GET['talla']!=''){
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, 'Categoria');
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, 'Modelo');
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, 'Color');
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, 'Talla');
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, 'Total de unidades');
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, 'Total de dinero');
        $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, 'Total sobre la venta');
        $fila++;
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $_GET['categoria']);
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $_GET['modelo']);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $_GET['color']);
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $_GET['talla']);
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $totalUniVenta);
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $totalDinero);
        $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $totalPorcenUniVen);
        $fila++;
    }
}
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="ReporteVentas.xls"');
header('Cache-Control: max-age=0');


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

    ?>