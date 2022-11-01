<?php
    require_once("phpClasses/connect.php");
    require 'Classes/PHPExcel.php';

    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getProperties()->setCreator("Regina Romero")->setDescription("Reporte Inventario");
            
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->setTitle("Inventario");
    
    if($_GET['modelo']!=''){
        //Realikza las dimensiones de la columna
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);	
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);	
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);	
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        //Diseño del encabezado de la tabla
        $objPHPExcel->getActiveSheet()->setCellValue('A1','Sucursal');
        $objPHPExcel->getActiveSheet()->setCellValue('B1','MODELO');
        $objPHPExcel->getActiveSheet()->setCellValue('C1','COLOR');
        $objPHPExcel->getActiveSheet()->setCellValue('D1','TALLA');
        $objPHPExcel->getActiveSheet()->setCellValue('E1','CANTIDAD');
        if($_GET['color']!=''){
            if($_GET['talla']!=''){
                $fila=2;
                //busqueda por modelo,color y talla    
                $sucursalArray=$_GET['sucursal'];
                foreach($sucursalArray as $sucursal1){
                    $query="SELECT ".$sucursal1." from inventario where  ";
                    $query.=" modelo='".$_GET['modelo']."' and color='".$_GET['color']."' and talla=".$_GET['talla']."";
                   
                    $res=mysqli_query($con,$query);
                    if(!$res){
                        echo mysqli_error($con);
                    }else{
                        if(mysqli_num_rows($res)>0){ 
                            $contInventario=0;
                            while($row=mysqli_fetch_assoc($res)){
                                if($row[$sucursal1]=="not stocked"){
                                    $aux=0;
                                    $contInventario=$contInventario+$aux;
                                }else{
                                    $contInventario=$contInventario+$row[$sucursal1];
                                }
                                
                            }
                            if($contInventario>0){
                                $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila,$sucursal1);
                                $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila,$_GET['modelo']);
                                $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila,$_GET['color']);
                                $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila,$_GET['talla']);
                                $objPHPExcel->getActiveSheet()->setCellValue('E'.$fila,$contInventario);
                                $fila++;
                            }
                            
                        }
                    }
                }
            }else{                      //busqueda por modelo y color
                $sucursalArray=$_GET['sucursal'];
                $fila=2;
                foreach($sucursalArray as $sucursal1){
                    $modelo1 = $_GET['modelo'];
                    
                    $sql1 = "select distinct(talla)from inventario where modelo='".$_GET['modelo']."' and ".$sucursal1."!='0' and ".$sucursal1."!='not stocked' order by talla asc";
                    $resTalla=mysqli_query($con,$sql1);
                    if(!$resTalla){
                        echo mysqli_error($con);
                    }else{
                        $contModelo=0;
                        while($rowTalla=mysqli_fetch_assoc($resTalla)){
                            if(!$resTalla){
                                echo mysqli_error($con);
                            }else{
                                $query="SELECT ".$sucursal1." from inventario where  ";
                                $query.=" modelo='".$_GET['modelo']."' and color='".$_GET['color']."' and talla=".$rowTalla['talla']."";
                               
                                $res=mysqli_query($con,$query);
                                if(!$res){
                                    echo mysqli_error($con);
                                }else{
                                    if(mysqli_num_rows($res)>0){ 
                                        $contInventario=0;
                                        while($row=mysqli_fetch_assoc($res)){
                                            if($row[$sucursal1]=="not stocked"){
                                                $aux=0;
                                                $contInventario=$contInventario+$aux;
                                            }else{
                                                $contInventario=$contInventario+$row[$sucursal1];
                                                }
                                        }
                                        if($contInventario>0){
                                            $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila,$sucursal1);
                                            $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila,$_GET['modelo']);
                                            $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila,$_GET['color']);
                                            $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila,$rowTalla['talla']);
                                            $objPHPExcel->getActiveSheet()->setCellValue('E'.$fila,$contInventario);
                                            $fila++;
                                        }
                                        $contModelo=$contModelo+$contInventario;
                                    }
                                }
                            }
                        }
                    }
                    $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila,"Total de unidades por color");
                    $objPHPExcel->getActiveSheet()->setCellValue('E'.$fila,$contModelo);
                    $fila++;
                }
            }
        }else{
            if($_GET['talla']!=''){ //Busqueda por modelo y talla       
               $sucursalArray=$_GET['sucursal'];
                $fila=2;
                foreach($sucursalArray as $sucursal1){
                    $modelo1 = $_GET['modelo'];
                    $talla =    $_GET['talla'];
                    $sql1 = "select distinct(color)from inventario where modelo='".$_GET['modelo']."' and ".$sucursal1."!='0' and ".$sucursal1."!='not stocked' order by color asc";
                    $resColor=mysqli_query($con,$sql1);
                    if(!$resColor){
                        echo mysqli_error($con);
                    }else{
                        $contModelo=0;
                        while($rowColor=mysqli_fetch_assoc($resColor)){
                                $query="SELECT ".$sucursal1." from inventario where  ";
                                $query.=" modelo='".$_GET['modelo']."' and talla='".$_GET['talla']."' and color='".$rowColor['color']."' ";
                                
                                $res=mysqli_query($con,$query);
                                if(!$res){
                                    echo mysqli_error($con);
                                }else{
                                    if(mysqli_num_rows($res)>0){ 
                                        $contInventario=0;
                                        while($row=mysqli_fetch_assoc($res)){
                                            if($row[$sucursal1]=="not stocked"){
                                                $aux=0;
                                                $contInventario=$contInventario+$aux;
                                            }else{
                                                $contInventario=$contInventario+$row[$sucursal1];
                                                }
                                        }
                                        if($contInventario>0){
                                            $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila,$sucursal1);
                                            $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila,$_GET['modelo']);
                                            $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila,$rowColor['color']);
                                            $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila,$_GET['talla']);
                                            $objPHPExcel->getActiveSheet()->setCellValue('E'.$fila,$contInventario);
                                            $fila++;
                                        }
                                        $contModelo=$contModelo+$contInventario;
                                    }
                                }
                            
                        }
                    }
                    $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila,"Total de unidades por talla");
                    $objPHPExcel->getActiveSheet()->setCellValue('E'.$fila,$contModelo);
                    $fila++;
                }
            }else{          //Busqueda por modelo
                $fila=2;
                $sucursalArray=$_GET['sucursal'];
                foreach($sucursalArray as $sucursal1){                  
                    $modelo1 = $_GET['modelo'];                 
                    $contModelo=0;
                    $sql1 = "select distinct(color) from inventario where modelo='".$_GET['modelo']."'  order by color asc";
                    $resColor=mysqli_query($con,$sql1);
                    if(!$resColor){
                        echo mysqli_error($con);
                    }else{
                        $contModelo=0;
                        while($rowColor=mysqli_fetch_assoc($resColor)){
                            $sql2 = "select distinct(talla) from inventario where modelo='".$_GET['modelo']."'  order by talla asc";                                
                            $resTalla=mysqli_query($con,$sql2);
                            if(!$resTalla){
                                echo mysqli_error($con);
                            }else{
                                while($rowTalla=mysqli_fetch_assoc($resTalla)){
                                    $query="SELECT ".$sucursal1." from inventario where  ";
                                    $query.=" modelo='".$_GET['modelo']."' and talla='".$rowTalla['talla']."' and color='".$rowColor['color']."' ";
                                    
                                    $res=mysqli_query($con,$query);
                                    if(!$res){
                                        echo mysqli_error($con);
                                    }else{
                                        if(mysqli_num_rows($res)>0){ 
                                            $contInventario=0;
                                            while($row=mysqli_fetch_assoc($res)){
                                                if($row[$sucursal1]=="not stocked"){
                                                    $aux=0;
                                                    $contInventario=$contInventario+$aux;
                                                }else{
                                                    $contInventario=$contInventario+$row[$sucursal1];
                                                }
                                            }
                                            if($contInventario>0){
                                                $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila,$sucursal1);
                                                $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila,$_GET['modelo']);
                                                $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila,$rowColor['color']);
                                                $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila,$rowTalla['talla']);
                                                $objPHPExcel->getActiveSheet()->setCellValue('E'.$fila,$contInventario);
                                                $fila++;
                                            }       
                                            $contModelo=$contModelo+$contInventario;
                                        }
                                    }                 
                                }     
                            }
                        }
                    $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila,"Total de unidades por modelo");
                    $objPHPExcel->getActiveSheet()->setCellValue('E'.$fila,$contModelo);
                    $fila++;
                    }
                }
            }
        }
        
    }else{
        if($_GET['categoria']!=''){
            $sucursales=$_GET['sucursal'];
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $objPHPExcel->getActiveSheet()->setCellValue('A1','Sucursal');
            $objPHPExcel->getActiveSheet()->setCellValue('B1','Modelo');
            $objPHPExcel->getActiveSheet()->setCellValue('C1','cantidad');
            $fila=2;	
            foreach($sucursales as $sucursal1){
                     $sql="select distinct(modelo) from inventario order by modelo asc";
                     $res=mysqli_query($con,$sql);
                    if(!$res){
                         echo mysqli_error($con);
                  }else{
                        $contTotalCat=0;
                        while($row1=mysqli_fetch_assoc($res)){
                            if(($row1['modelo']!='')){
                                if($sucursal1=="phGeneral"){
                                    $query="SELECT phGlobal,phCoyoacan,phDurango,phEcommerce,phGuadalajara,
                                    phInterlomas,phPerisur,phPolanco,phPuebla,phQueretaro,phSantaFe,
                                    phSatelite from inventario where  ";
                                    $query.="modelo='".$row1['modelo']."' and categoria='".$_GET['categoria']."'";
                                    $res2=mysqli_query($con,$query);
                                    if(!$res2){
                                        echo mysqli_error($con);
                                    }else{
                                        if(mysqli_num_rows($res2)>0){
                                            $contInventario=0;
                                            while($row=mysqli_fetch_assoc($res2)){
                                                    if($row['phGlobal']=='not stocked' || $row['phCoyoacan']=='not stocked' || $row['phDurango']=='not stocked' || $row['phEcommerce']
                                                    =='not stocked' || $row['phGuadalajara']=='not stocked' || $row['phInterlomas']=='not stocked' || $row['']=='not stocked' || 
                                                    $row['phPerisur']=='not stocked' || $row['phPolanco']=='not stocked' || $row['phPuebla']=='not stocked' || $row['phPuebla']
                                                    =='not stocked' || $row['phQueretaro']=='not stocked' || $row['phGSantaFe']=='not stocked' || $row['phSatelite']=='not stocked'){
                                                        $aux=0;
                                                        $contInventario=$contInventario+$aux;
                                                    }else{
                                                        $contInventario=$contInventario+$row['phGlobal']+$row['phCoyoacan']+$row['phDurango']+$row['phEcommerce']
                                                        +$row['phGuadalajara']+$row['phInterlomas']+$row['']+$row['phPerisur']+$row['phPolanco']+$row['phPuebla']
                                                        +$row['phPuebla']+$row['phQueretaro']+$row['phGSantaFe']+$row['phSatelite'];
                                                    }
                                            }
                                            if($contInventario>0){
                                                ?>
                                                <tr><td><?php echo $row1['modelo'];?></td><td><?php echo $contInventario;?></td></tr><?php
                                                $contTotalCat=$contTotalCat+$contInventario;
                                            }
                                        }
                                    }
                                }else{
                                    $query="SELECT ".$sucursal1." from inventario where  ";
                                    $query.="modelo='".$row1['modelo']."' and categoria='".$_GET['categoria']."'";
                                    
                                    $res2=mysqli_query($con,$query);
                                    if(!$res2){
                                        echo mysqli_error($con);
                                    }else{
                                        if(mysqli_num_rows($res2)>0){
                                            $contInventario=0;
                                            while($row=mysqli_fetch_assoc($res2)){
                                                    if($row[$sucursal1]=="not stocked"){
                                                        $aux=0;
                                                        $contInventario=$contInventario+$aux;
                                                    }else{
                                                        $contInventario=$contInventario+$row[$sucursal1];
                                                    }
                                            }
                                            if($contInventario>0){
                                                $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila,$sucursal1);
                                                $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila,$row1['modelo']);
                                                $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila,$contInventario);
                                                $fila++;
                                                $contTotalCat=$contTotalCat+$contInventario;
                                            }
                                        }                                               
                                    }
                                }
                            }    
                            
                        }
                        $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila,'');
                        $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila,'Total de unidades');
                        $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, $contTotalCat);
                        $fila++;
                    }
            }

        }else{                          //Busqueda por sucursal
            $sucursales=$_GET['sucursal'];
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $objPHPExcel->getActiveSheet()->setCellValue('A1','Sucursal');
            $objPHPExcel->getActiveSheet()->setCellValue('B1','Categoria');
            $objPHPExcel->getActiveSheet()->setCellValue('C1','Cantidad');
            $fila=2;	
            foreach($sucursales as $sucursal1){
                    
                     $sql="select distinct(categoria) from inventario order by categoria asc";
                     $res=mysqli_query($con,$sql);
                    if(!$res){
                         echo mysqli_error($con);
                    }else{
                         $contTotalCat=0;
                         while($row1=mysqli_fetch_assoc($res)){
                            
                            $sql1="select categoria from categorias where codigo='".$row1['categoria']."' ";
                            $res1=mysqli_query($con,$sql1);
                            if(!$res1){
                                echo mysqli_error($con);
                            }
                            $row2=mysqli_fetch_assoc($res1);
                           
                            if(($row1['categoria']!='') && $row2['categoria']!=''){
                                    if($sucursal1=="phGeneral"){
                                        $query="SELECT phGlobal,phCoyoacan,phDurango,phEcommerce,phGuadalajara,
                                        phInterlomas,phPerisur,phPolanco,phPuebla,phQueretaro,phSantaFe,
                                        phSatelite from inventario where  ";
                                        $query.="categoria='".$row1['categoria']."' ";
                                        $res2=mysqli_query($con,$query);
                                        if(!$res2){
                                            echo mysqli_error($con);
                                        }else{
                                            $contInventario=0;
                                            while($row=mysqli_fetch_assoc($res2)){
                                                    if($row['phGlobal']=='not stocked' || $row['phCoyoacan']=='not stocked' || $row['phDurango']=='not stocked' || $row['phEcommerce']
                                                    =='not stocked' || $row['phGuadalajara']=='not stocked' || $row['phInterlomas']=='not stocked' || $row['']=='not stocked' || 
                                                    $row['phPerisur']=='not stocked' || $row['phPolanco']=='not stocked' || $row['phPuebla']=='not stocked' || $row['phPuebla']
                                                    =='not stocked' || $row['phQueretaro']=='not stocked' || $row['phGSantaFe']=='not stocked' || $row['phSatelite']){
                                                        $aux=0;
                                                        $contInventario=$contInventario+$aux;
                                                    }else{
                                                        $contInventario=$contInventario+$row['phGlobal']+$row['phCoyoacan']+$row['phDurango']+$row['phEcommerce']
                                                        +$row['phGuadalajara']+$row['phInterlomas']+$row['']+$row['phPerisur']+$row['phPolanco']+$row['phPuebla']
                                                        +$row['phPuebla']+$row['phQueretaro']+$row['phGSantaFe']+$row['phSatelite'];
                                                    }
                                            }
                                            if($contInventario>0){
                                                ?>
                                                <tr><td><?php echo $row2['categoria'];?></td><td><?php echo $contInventario;?></td><?php
                                                $contTotalCat=$contTotalCat+$contInventario;
                                                echo $contInventario;
                                            }
                                        }
                                    }else{
                                        $query="SELECT ".$sucursal1." from inventario where  ";
                                        $query.="categoria='".$row1['categoria']."' ";
                                        $res2=mysqli_query($con,$query);
                                        if(!$res2){
                                            echo mysqli_error($con);
                                        }else{
                                            if(mysqli_num_rows($res2)>0){
                                                $contInventario=0;
                                                while($row=mysqli_fetch_assoc($res2)){
                                                        if($row[$sucursal1]=="not stocked"){
                                                            $aux=0;
                                                            $contInventario=$contInventario+$aux;
                                                        }else{
                                                            $contInventario=$contInventario+$row[$sucursal1];
                                                        }
                                                }
                                                if($contInventario>0){
                                                    $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila,$sucursal1);
                                                    $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila,$row2['categoria']);
                                                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila,$contInventario);
                                                    $fila++;
                                                    $contTotalCat=$contTotalCat+$contInventario;
                                                }
                                            }else{
                                                echo "NO se encontraron resultados";
                                            }                                         
                                        }
                                    }
                            }    
                           
                        }
                        
                        $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila,'');
                        $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila,'Total de unidades');
                        $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, $contTotalCat);
                        $fila++;
                    }
            }   

        }
    }
    header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="ReporteInventario.xls"');
			header('Cache-Control: max-age=0');

			
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');	
			$objWriter->save('php://output');
    
?>