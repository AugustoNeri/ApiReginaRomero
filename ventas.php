<?php
require_once("phpClasses/connect.php");
if (!function_exists('str_contains')) {
    function str_contains ($haystack,$needle)
    {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }
}

function str_starts_with ( $haystack, $needle ) {
    return strpos( $haystack , $needle ) === 0;
  }

function str_ends_with($haystack, $needle) {
    $length = strlen($needle);
    return $length > 0 ? substr($haystack, -$length) === $needle : true;
}

session_start();
if(isset ($_SESSION['email'])){
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Estilos-->
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <link rel="stylesheet" type="text/css" href="css/stylesDropdown.css">

    
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
        <script language="javascript" >
                $(document).ready(function(){
                    $("#categoria").change(function () {					
                        $("#categoria option:selected").each(function () {
                            categoria = $(this).val();
                            $.get("phpClasses/getModeloVentas.php", { categoria: categoria }, function(data){
                                $("#modelo").html(data);
                            });            
                        });
                    })
                    $("#coleccion").change(function () {					
                        $("#coleccion option:selected").each(function () {
                            coleccion = $(this).val();
                            categoria = $("#categoria option:selected").val();
                            if(categoria!=''){
                                $.get("phpClasses/getModelobyColeccionCat.php", { coleccion: coleccion,categoria:categoria }, function(data){
                                $("#modelo").html(data);
                                });      
                            }else{
                                $.get("phpClasses/getModelobyColeccion.php", { coleccion: coleccion}, function(data){
                                $("#modelo").html(data);
                                }); 
                            }
                                
                        });
                    })

                    $("#modelo").change(function () {					
                        $("#modelo option:selected").each(function () {
                            modelo = $(this).val();
                            $.get("phpClasses/getColorVentas.php", { modelo: modelo }, function(data){
                                $("#color").html(data);
                            });

                        });
                    })
                    $("#modelo").change(function () {					
                        $("#modelo option:selected").each(function () {
                            modelo = $(this).val();
                            $.get("phpClasses/getTallasVentas.php", { modelo: modelo }, function(data){
                                $("#talla").html(data);
                            });
                            
                        });
                    })


                });
        </script>

    </head>

    <body>
    
        <section id="global">
            <!--cABEZERA-->
            <header>
                <div id="logo">
                    <img src="img/logo-header.png" alt="">
                </div>
                <div class="clearfix"></div>
                <?php
            if($_SESSION['permiso']=="rr1"){
        ?>
                <nav id="menu1">
                    <ul> 
                        <li><p class="active"><?php echo $_SESSION['usuario'];?></p></li>
                        <li><a href="usuarios.php">Usuarios</a></li>
                        <li><a  href="inventario.php">Inventario</a></li>
                        <li><a class="active" href="ventas.php">Ventas</a></li>
                        <li><a  href="pedidos.php">Pedidos</a></li>
                        <li><a  href="llegadas.php">Llegadas</a></li>
                        <li><a href="login.php">Cerrar Sesion</a></li>
                    </ul>
            </nav>
        <?php
            }else{
                ?>
                <nav id="menu">
                    <ul> 
                        <li><p class="active"><?php echo $_SESSION['usuario'];?></p></li>
                        <li><a  href="inventario.php">Inventario</a></li>
                        <li><a class="active" href="ventas.php">Ventas</a></li>
                        <li><a href="pedidos.php">Pedidos</a></li>
                        <li><a   href="llegadas.php">Llegadas</a></li>
                        <li><a href="login.php">Cerrar Sesion</a></li>
                    </ul>
                </nav>
        <?php
            }
        ?>
            </header>
            <!--Contenido-->
            <section id="content">
                <?php
                    include 'phpClasses/inventario.php';
                    
                ?>	
                <div id="sidebar">
                    
                    <form action="" method="GET">
                    <center><button class="btn btn-primary btn-sm "><i class="fa fa-search"></i> Generar Reporte</button></center>
                    <label for="exampleFormControlInput1" class="form-label"><h5>Fecha de inicio (obligatorio)</h5></label>
                        <div class="row">
                            <div class="col-md-4">
                            <Select name="cmbDiaI" id="cmbDiaI">
                                <?php
                                if(isset($_GET['cmbDiaI'])){
                                    echo '<option value="'.$_GET['cmbDiaI'].'">'.$_GET['cmbDiaI'].'</option>';
                                }
                                ?>
                                <option value="">Dia</option>
                                <?php
                                for($i=1;$i<=31;$i++){
                                    if($i<10)
                                        echo '<option value="0'.$i.'">0'.$i.'</option>';
                                    else{
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                }
                                
                                ?>
                            </Select> 
                            </div>
                            <div class="col-md-4">
                                <Select name="cmbMesI" id="cmbMesI">
                                <?php
                                if(isset($_GET['cmbMesI'])){
                                    echo '<option value="'.$_GET['cmbMesI'].'">'.$_GET['cmbMesI'].'</option>';
                                }
                                ?>
                                    <option value="">Mes</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </Select>
                            </div>
                            <div class="col-md-4">
                                <Select name="cmbAnioI" id="cmbAnioI">
                                    <?php
                                    if(isset($_GET['cmbAnioI'])){
                                        echo '<option value="'.$_GET['cmbAnioI'].'">'.$_GET['cmbAnioI'].'</option>';
                                    }
                                    ?>
                                    <option>A??o</option>
                                    <?php
                                    $query="SELECT anio FROM anios order by anio asc";
                                    $res=mysqli_query($con,$query);
                                    if(!$res){
                                        echo "fallo";
                                    }else{
                                        while($row=mysqli_fetch_assoc($res)){
                                        echo '<option value="'.$row['anio'].'">'.$row['anio'].'</option>';
                                        }
                                    }
                                    ?>
                                </Select>
                            </div>

                        </div>

                        <label for="exampleFormControlInput1" class="form-label"><h5>Fecha de t??rmino (obligatorio)</h5></label>
                        <div class="row">
                            <div class="col-md-4">
                            <Select name="cmbDiaF" id="cmbDiaF">
                            <?php
                                if(isset($_GET['cmbDiaF'])){
                                    echo '<option value="'.$_GET['cmbDiaF'].'">'.$_GET['cmbDiaF'].'</option>';
                                }
                                ?>
                                <option value="">Dia</option>
                                <?php
                                for($i=1;$i<=31;$i++){
                                    if($i<10)
                                        echo '<option value="0'.$i.'">0'.$i.'</option>';
                                    else{
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                }
                                
                                ?>
                            </Select>
                            </div>
                            <div class="col-md-4">
                                <Select name="cmbMesF" id="cmbMesF">
                                <?php
                                if(isset($_GET['cmbMesF'])){
                                    echo '<option value="'.$_GET['cmbMesF'].'">'.$_GET['cmbMesF'].'</option>';
                                }
                                ?>
                                    <option value="">Mes</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </Select>
                            </div>
                            <div class="col-md-4">
                                <Select name="cmbAnioF" id="cmbAnioF">
                                <?php
                                if(isset($_GET['cmbAnioF'])){
                                    echo '<option value="'.$_GET['cmbAnioF'].'">'.$_GET['cmbAnioF'].'</option>';
                                }
                                ?>
                                    <option>A??o</option>
                                    <?php
                                    $query="SELECT anio FROM anios order by anio asc";
                                    $res=mysqli_query($con,$query);
                                    if(!$res){
                                        echo "fallo";
                                    }else{
                                        while($row=mysqli_fetch_assoc($res)){
                                        echo '<option value="'.$row['anio'].'">'.$row['anio'].'</option>';
                                        }
                                    }
                                    ?>
                                </Select>
                            </div>

                        </div>
                        <label for="exampleFormControlInput1" class="form-label"><h5>Sucursales(obligatorio)</h5></label>
                        <div class="sucursal">
                            <?php 
                                $sql="select distinct(pos_location_name) from ventas order by pos_location_name asc";
                                $res=mysqli_query($con,$sql);
                                if(!$res){
                                    echo mysqli_error($con);
                                }else{
                                    if(mysqli_num_rows($res)>0){
                                        while($row=mysqli_fetch_assoc($res)){
                                            $sucursalChecked=[];
                                            if(isset($_GET['sucursal']))
                                                $sucursalChecked=$_GET['sucursal'];
                                            ?>
                                            <div class="col-100">
                                            <input type="checkbox" class="sucursal" name ="sucursal[]" value="<?= $row["pos_location_name"]; ?>"  
                                            <?php if(in_array($row["pos_location_name"], $sucursalChecked)){ echo "checked"; } ?>> <?= $row["pos_location_name"]; ?>
                                            </div>
                                            <?php
                                        }
                                    
                                            ?>
                                            <div class="col-100">
                                                <input type="checkbox" class="sucursal" name ="sucursal[]" value="PH Total"  
                                                <?php
                                                
                                                if(in_array("PH Total",$sucursalChecked )){ echo "checked"; } ?>>PH Total
                                                </div>
                                            <div class="col-100">
                                                <input type="checkbox" class="sucursal" name ="sucursal[]" value="no PH"  
                                            <?php
                                                if(in_array("no PH",$sucursalChecked )){ echo "checked"; } ?>>no PH
                                            </div>
                                            <?php                                        
                                    }
                                }
                            ?>
                            
                            
                        </div>
                        <label for="exampleFormControlInput1" class="form-label"><h4>Categoria</h4></label>
                        <div class="categorias">     
                            <select name="categoria" id="categoria" class="form-select form-select-sm" aria-label=".form-select-sm example">>
                            <?php 
                                $sql="select distinct(product_type) from ventas order by product_type asc";
                                $res=mysqli_query($con,$sql);
                                if(!$res){
                                    echo mysqli_error($con);
                                }else{
                                    if(isset($_GET['categoria'])){
                                        $sql="select distinct(product_type) from ventas where product_type='".$_GET['categoria']."'";
                                        $res1=mysqli_query($con, $sql);
                                        if (!$res1){ 
                                            echo  mysqli_error($con);
                                            
                                        }else{
                                            $row1=mysqli_fetch_assoc($res1);
                                            echo "<option value='".$row1['product_type']."'>".$row1['product_type']."</option>";
                                        }
                                    }
                                    echo "<option value=''>Seleccione una categoria</option>";
                                    if(mysqli_num_rows($res)>0){
                                        while($row=mysqli_fetch_assoc($res)){
                                            if($row['product_type']!='')
                                            echo "<option value='".$row['product_type']."'>".$row['product_type']."</option>";

                                        }
                                    }
                                }
                            ?>
                            </select>
                        </div>

                        <label for="exampleFormControlInput1" class="form-label"><h4>Colecci??n</h4></label>
                        <div class="categorias">     
                            <select name="coleccion" id="coleccion" class="form-select form-select-sm" aria-label=".form-select-sm example">>
                            <?php 
                                $sql="select distinct(coleccion) from ventas order by coleccion asc";
                                $res=mysqli_query($con,$sql);
                                if(!$res){
                                    echo mysqli_error($con);
                                }else{
                                    if(isset($_GET['coleccion'])){
                                        $sql="select distinct(coleccion) from ventas where coleccion='".$_GET['coleccion']."'";
                                        $res1=mysqli_query($con, $sql);
                                        if (!$res1){ 
                                            echo  mysqli_error($con);
                                            
                                        }else{
                                            $row1=mysqli_fetch_assoc($res1);
                                            echo "<option value='".$row1['coleccion']."'>".$row1['coleccion']."</option>";
                                        }
                                    }
                                    echo "<option value=''>Seleccione una coleccion</option>";
                                    if(mysqli_num_rows($res)>0){
                                        while($row=mysqli_fetch_assoc($res)){
                                            if($row['coleccion']!='')
                                            echo "<option value='".$row['coleccion']."'>".$row['coleccion']."</option>";

                                        }
                                    }
                                }
                            ?>
                            </select>
                        </div>
                        
                        <label for="exampleFormControlInput1" class="form-label"><h4>Modelo</h4></label>
                        <div class="modelo">     
                                <select name="modelo" id="modelo" class="form-select form-select-sm" aria-label=".form-select-sm example">>
                                <?php
                                    if(isset($_GET['modelo'])){
                                        echo "<option value='".$_GET['modelo']."'>".$_GET['modelo']."</option>";
                                    }
                                ?>
                                <option value="">Seleccione un modelo</option>
                                <?php 
                                    if(isset($_GET['categoria'])){
                                        $sql="select DISTINCT(modelo) from ventas where product_type='".$_GET['categoria']."'AND (net_quantity!=0 OR total_sales!=0) order by modelo asc ";
                                        $result=mysqli_query($con, $sql);
                                        if (!$result){ 
                                            echo  mysqli_error($con);  
                                        }else{
                                            
                                            while($row=mysqli_fetch_assoc($result)){
                                                echo "<option value='".$row['modelo']."'>".$row['modelo']."</option>";
                                                //var_dump($html);die();
                                            }
                                        }
                                    }
                                ?>
                                </select>    
                        </div>
                        <label for="exampleFormControlInput1" class="form-label"><h4>Colores</h4></label>
                        <div class="colores">  
                            <div id="container-color">
                                <select name="color" id="color" class="form-select form-select-sm" aria-label=".form-select-sm example">>
                                <?php
                                if(isset($_GET['color'])){
                                        echo "<option value='".$_GET['color']."'>".$_GET['color']."</option>";
                                    }
                                ?>
                                <option value="">Seleccione un color</option>
                            <?php
                                
                                if(isset($_GET['modelo'])){
                                        $sql="select Distinct(color) from ventas where modelo='".$_GET['modelo']."'AND (net_quantity!=0 OR total_sales!=0) order by color asc";
                                        $result=mysqli_query($con, $sql);
                                        if (!$result){ 
                                            echo  mysqli_error($con);
                                            
                                        }else{
                                            $row1=mysqli_fetch_assoc($result);
                                            echo "<option value='".$row1['color']."'>".$row1['color']."</option>";
                                        }
                                    }
                                    echo "<option value=''>Seleccione un color</option>";
                                    while($row=mysqli_fetch_assoc($result)){
                                        echo "<option value='".$row['color']."'>".$row['color']."</option>";
                                        //var_dump($html);die();
                                    }
                                
                            ?>
                                </select>
                            </div>
                        </div>
                        <label for="exampleFormControlInput1" class="form-label"><h4>Tallas</h4></label>
                        <div class="talla">
                            <select name="talla" id="talla" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                    <?php
                                        if(isset($_GET['talla'])){
                                            echo "<option value='".$_GET['talla']."'>".$_GET['talla']."</option>";
                                        }
                                    ?>
                                        <option value="">Seleccione una talla</option>
                                        <?php
                                
                                if(isset($_GET['modelo'])){
                                        $sql="select Distinct(talla) from ventas where modelo='".$_GET['modelo']."'AND (net_quantity!=0 OR total_sales!=0) order by talla asc";
                                        $result=mysqli_query($con, $sql);
                                        if (!$result){ 
                                            echo  mysqli_error($con);
                                            
                                        }else{
                                            $row1=mysqli_fetch_assoc($result);
                                            echo "<option value='".$row1['talla']."'>".$row1['talla']."</option>";
                                        }
                                    }
                                    echo "<option value=''>Seleccione un color</option>";
                                    while($row=mysqli_fetch_assoc($result)){
                                        echo "<option value='".$row['talla']."'>".$row['talla']."</option>";
                                        //var_dump($html);die();
                                    }
                                
                            ?>

                            </select>
                                
                        </div>             
                    </form>
                </div>

                <div id="posts">
                    <center> <h2>VENTAS</h2></center>      
                        <div class="row">
                            <div class="col-md-4"></div>
                            <
                            <div class="col-md-4">
                                <h3>Importar ventas</h3>
                            </div>
                            <div class="col-md-4"></div>
                            
                        </div>
                        <form action="ventas.php" name="importar" method="POST" enctype="multipart/form-data" >
                            <div class="row">
                                <div class="col-md-4"></div>
                                
                                <div class="col-md-4">
                                    <input type="file" name="file" data-buttonText="Seleccione el archivo" >
                                </div>
                                <div class="col-md-4"></div>
                            
                                
                            </div>

                            <div class="row">
                                <div class="col-md-4"></div>
                                
                                <div class="col-md-4">
                                        <!--<input type="hidden" name="importar" value="importar">-->
                                        <input class="btn btn-primary btn-sm " type="submit" name="importar"value="Importar">
                                </div>
                                <div class="col-md-4"></div>
                                
                            </div>
                        </form>
                        


                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                            <form action="excelVentas.php" method="get">
                                <input type="hidden" name="cmbDiaI" value="<?= $_GET["cmbDiaI"];?>"> 
                                <input type="hidden" name="cmbMesI" value="<?= $_GET["cmbMesI"];?>"> 
                                <input type="hidden" name="cmbAnioI" value="<?= $_GET["cmbAnioI"];?>"> 
                                <input type="hidden" name="cmbDiaF" value="<?= $_GET["cmbDiaF"];?>"> 
                                <input type="hidden" name="cmbMesF" value="<?= $_GET["cmbMesF"];?>"> 
                                <input type="hidden" name="cmbAnioF" value="<?= $_GET["cmbAnioF"];?>">
                                
                            <?php
                                if(isset($sucursalChecked)){
                                foreach($sucursalChecked as $sucursal){
                                ?>
                                <input type="hidden" name ="sucursal[]" value="<?= $sucursal; ?>">                           
                                <?php }	
                                }
                                ?>

                                <input type="hidden" name="categoria" value="<?= $_GET["categoria"];?>"> 
                                <input type="hidden" name="modelo" value="<?= $_GET["modelo"]; ?>">
                                <input type="hidden" name="color" value="<?= $_GET["color"]; ?>">
                                <input type="hidden" name="talla" value="<?= $_GET["talla"]; ?>">
                                <input type="hidden" name="coleccion" value="<?= $_GET["coleccion"]; ?>">
                                <input type="submit" class="btn btn-primary btn-sm fa fa-download" value="Exportar reporte a Excel">
                            </form>
                                
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                            <!-- <button class="btn"><i class="fa fa-search"></i> Generar Reporte</button>-->
                            </div>
                            <div class="col-md-4"></div>
                        </div>

                        
                
                
                    <!--Cargar los post desde JS-->
                    <div id="ctable" class="searchInventario">
                <?php
                if(!isset($_GET['sucursal'])){
                echo "<center><h5>Debe de escoger al menos una sucursal</h5></center>";
                }else{
                        $fechaInicio="";
                        $fechaFin="";
                        $sqlFecha='';
                        if($_GET['cmbDiaI']=='' && $_GET['cmbDiaF']==''){
                            $fechaInicio=$_GET['cmbAnioI']."-".$_GET['cmbMesI']."-01";
                            $fechaFin=$_GET['cmbAnioF']."-".$_GET['cmbMesF']."-31";  
                            $sqlFecha= "AND fecha between '".$fechaInicio."' AND '".$fechaFin."' ";
                        }
                        if($_GET['cmbDiaI']!=''&& $_GET['cmbDiaF']!=''){
                            $fechaInicio=$_GET['cmbAnioI']."-".$_GET['cmbMesI']."-".$_GET['cmbDiaI'];
                            $fechaFin=$_GET['cmbAnioF']."-".$_GET['cmbMesF']."-".$_GET['cmbDiaF']; 
                            $sqlFecha= "AND fecha between '".$fechaInicio."' AND '".$fechaFin."' ";
                        }
                        if($_GET['cmbDiaI']!=''&& $_GET['cmbDiaF']==''){
                            $fechaInicio=$_GET['cmbAnioI']."-".$_GET['cmbMesI']."-".$_GET['cmbDiaI'];
                            $fechaFin=$_GET['cmbAnioF']."-".$_GET['cmbMesF']."-31";  
                            $sqlFecha= "AND fecha between '".$fechaInicio."' AND '".$fechaFin."' ";
                        }
                        if($_GET['cmbDiaI']==''&& $_GET['cmbDiaF']!=''){
                            $fechaInicio=$_GET['cmbAnioI']."-".$_GET['cmbMesI']."-01";
                            $fechaFin=$_GET['cmbAnioF']."-".$_GET['cmbMesF'].$_GET['cmbDiaF'];  
                            $sqlFecha= "AND fecha between '".$fechaInicio."' AND '".$fechaFin."' ";
                        }
                        $arrayPH=['PH Coyoac??n','PH Durango','PH Ecommerce'
                        ,'PH Guadalajara','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite'];
                        $auxtotalUSuc=0;
                        $auxtotalDSuc=0;
                        $sqlSuc="select total_sales,net_quantity from ventas where (total_sales!=0 or net_quantity!=0) and pos_location_name NOT IN ('PH Coyoac??n','PH Durango','PH Ecommerce'
                        ,'PH Guadalajara','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite')";
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
                        $sqlPHSuc="select total_sales,net_quantity from ventas where (total_sales!=0 or net_quantity!=0) and pos_location_name IN ('PH Coyoac??n','PH Durango','PH Ecommerce'
                        ,'PH Guadalajara','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite')";
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
                        $auxConUnidad=0;

                        $sqlColeccion='';

                        if($_GET['coleccion']!=''){
                            $sqlColeccion=" AND coleccion='".$_GET['coleccion']."'";
                        }
                    if($_GET['cmbMesI']!=''&& $_GET['cmbMesF']!=''){
                        if($_GET['modelo']!=''){
                            if($_GET['color']!=''){
                                if($_GET['talla']!=''){//Busqueda por modelo,color y talla
                                    $sucursales=$_GET['sucursal'];
                                    foreach($sucursales as $sucursal){
                                        $auxtotalU=0;
                                        $sqlSuc1="";
                                        if($sucursal=="PH Total" ||in_array($sucursal,$arrayPH) ){        
                                            if(in_array($sucursal,$arrayPH)){
                                                $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name='".$sucursal."' and product_type='".$_GET['categoria']."' and modelo='".$_GET['modelo']."' and color='".$_GET['color']."' and talla='".$_GET['talla']."' ".$sqlColeccion." ".$sqlFecha." ";
                                            }else{

                                                $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name IN ('PH Coyoac??n','PH Durango','PH Ecommerce','PH Guadalajara',
                                                'PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite') and product_type='".$_GET['categoria']."' and modelo='".$_GET['modelo']."' and color='".$_GET['color']."' and talla='".$_GET['talla']."' ".$sqlColeccion." ".$sqlFecha." ";
                                            }
                                            
                                        }else{
                                            if($sucursal="no PH"){
                                                $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name NOT IN ('PH Coyoac??n','PH Durango','PH Ecommerce','PH Guadalajara',
                                                'PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite') and product_type='".$_GET['categoria']."' and modelo='".$_GET['modelo']."' and color='".$_GET['color']."' and talla='".$_GET['talla']."' ".$sqlColeccion." ".$sqlFecha." ";
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
                                        ?>
                                        <table>
                                            <tr><td>Modelo</td><td>Color</td><td>Talla</td><<td>Cantidad de unidades</td><td>Total de la venta</td><td>% Unidades Sucursal</td>
                                        <?php
                                            if($sucursal!="PH Total"&&$sucursal!="no PH"){
                                                if(in_array($sucursal,$arrayPH)){
                                                    echo "<td>% en Unidades Total / PH </td>";
                                                }else{
                                                    echo "<td>% en Unidades Total / noPH </td>";
                                                }
                                            }
                                            ?>
                                            <td>% en Unidades sobre toda la venta </td>
                                        </tr>
                                        <?php
                                        echo "<p><h2>".$sucursal."</h2></p>";
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
                                            $sql3="select net_quantity,total_sales,coleccion from ventas where pos_location_name IN ('PH Coyoac??n','PH Durango'
                                            ,'PH Guadalajara','PH Ecommerce','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite') and  product_type='".$_GET['categoria']."'  and  
                                            modelo='".$_GET['modelo']."' and talla='".$_GET['talla']."' and color='".$_GET['color']."' ".$sqlColeccion." ".$sqlFecha." ";    
                                        }else{
                                            if($sucursal=="no PH"){
                                                $sql3="select net_quantity,total_sales,coleccion from ventas where pos_location_name NOT IN ('PH Coyoac??n','PH Durango'
                                                ,'PH Guadalajara','PH Ecommerce','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite') and  product_type='".$_GET['categoria']."' and  
                                                modelo='".$_GET['modelo']."' and talla='".$_GET['talla']."' and color='".$_GET['color']."' ".$sqlColeccion." ".$sqlFecha." ";    
                                            }else{
                                                    $sql3="select net_quantity,total_sales,coleccion from ventas where pos_location_name='".$sucursal."' and  product_type='".$_GET['categoria']."'  and  
                                                modelo='".$_GET['modelo']."' and talla='".$_GET['talla']."' and color='".$_GET['color']."' ".$sqlColeccion." ".$sqlFecha." ";
                                            }

                                            
                                        }
                                        $res3=mysqli_query($con,$sql3);
                                        if(!$res3){
                                            echo mysqli_error($con);
                                        }else{
                                            if(mysqli_num_rows($res3)>0){
                                                while($row2=mysqli_fetch_assoc($res3)){
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
                                                
                                                echo "<tr><td>".$_GET['modelo']."</td>
                                                <td>".$_GET['color']."</td>
                                                <td>".$_GET['talla']."</td>
                                                <td>".number_format($conUnidades)."</td>
                                                <td>$".number_format($conVenta,2)."</td>";

                                                echo "<td>".$shereUnidadesSuc."%</td>";
                                                if($sucursal!="PH Total"&&$sucursal!="no PH"){
                                                    echo "<td>".$shereUnidades."%</td>";
                                                    
                                                }
                                                echo "<td>".$totalShereVenta."%</td>";
                                                echo "</tr>";
                                            }                                          
                                        }
                                        echo "<tr><td>Total en sucursal</td>
                                        <td><td><td>".number_format($conTotUnidades)."</td>
                                        <td>$".number_format($conTotVentas,2)."</td>
                                        <td>".$TotalShereUniSuc."%</td>";
                                        if($sucursal!="PH Total"&&$sucursal!="no PH"){
                                            echo "<td>".$conShereUnidades."%</td>";
                                        }
                                        echo "<td>".$contotalShereVenta."%</td></tr>";

                                    }
                                }else{//Busqueda por modelo y color
                                    $sucursales=$_GET['sucursal'];
                                    foreach($sucursales as $sucursal){
                                        $auxtotalU=0;
                                        $sqlSuc1="";
                                        if($sucursal=="PH Total" ||in_array($sucursal,$arrayPH) ){        
                                            if(in_array($sucursal,$arrayPH)){
                                                $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name='".$sucursal."' and product_type='".$_GET['categoria']."' and modelo='".$_GET['modelo']."' and color='".$_GET['color']."' ".$sqlColeccion." ".$sqlFecha." ";
                                            }else{

                                                $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name IN ('PH Coyoac??n','PH Durango','PH Ecommerce','PH Guadalajara',
                                                'PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite') and product_type='".$_GET['categoria']."' and modelo='".$_GET['modelo']."' and color='".$_GET['color']."' ".$sqlColeccion." ".$sqlFecha." ";
                                            }
                                            
                                        }else{
                                            if($sucursal="no PH"){
                                                $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name NOT IN ('PH Coyoac??n','PH Durango','PH Ecommerce','PH Guadalajara',
                                                'PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite') and product_type='".$_GET['categoria']."' and modelo='".$_GET['modelo']."' and color='".$_GET['color']."' ".$sqlColeccion." ".$sqlFecha." ";
                                            }else{
                                                $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name='".$sucursal."' and product_type='".$_GET['categoria']."' and modelo='".$_GET['modelo']."' and color='".$_GET['color']."' ".$sqlColeccion." ".$sqlFecha." ";

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
                                        ?>
                                        <table>
                                            <tr><td>Modelo</td><td>Color</td><td>Talla</td><<td>Cantidad de unidades</td><td>Total de la venta</td><td>% Unidades Sucursal</td>
                                        <?php
                                            if($sucursal!="PH Total"&&$sucursal!="no PH"){
                                                if(in_array($sucursal,$arrayPH)){
                                                    echo "<td>% en Unidades Total / PH </td>";
                                                }else{
                                                    echo "<td>% en Unidades Total / noPH </td>";
                                                }
                                            }
                                            ?>
                                            <td>% en Unidades sobre toda la venta </td>
                                        </tr>
                                        <?php
                                        echo "<p><h2>".$sucursal."</h2></p>";
                                        $conTotUnidades=0;
                                        $conTotVentas=0;
                                        $conShereUnidades=0;
                                        $TotalShereUniSuc=0;
                                        $contotalShereVenta=0;
                                        $sqlCol="select distinct(talla) from ventas where modelo='".$_GET['modelo']."' and net_quantity!=0 or total_sales!=0 order by color asc";
                                        $res1=mysqli_query($con,$sqlCol);
                                        if(!$res1){
                                            echo mysqli_error($con);
                                        }else{
                                            while($row1=mysqli_fetch_assoc($res1)){
                                                $conUnidades=0;
                                                $conVenta=0;
                                                $shereUnidades=0;
                                                $shereUnidadesSuc=0;
                                                $totalShereVenta=0;
                                                $sql3='';
                                                if($sucursal=="PH Total"){
                                                    $sql3="select net_quantity,total_sales,coleccion from ventas where pos_location_name IN ('PH Coyoac??n','PH Durango'
                                                    ,'PH Guadalajara','PH Ecommerce','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite') and  product_type='".$_GET['categoria']."' and  
                                                    modelo='".$_GET['modelo']."' and talla='".$row1['talla']."' and color='".$_GET['color']."' ".$sqlColeccion." ".$sqlFecha." ";    
                                                }else{
                                                    if($sucursal=="no PH"){
                                                        $sql3="select net_quantity,total_sales,coleccion from ventas where pos_location_name NOT IN ('PH Coyoac??n','PH Durango'
                                                        ,'PH Guadalajara','PH Ecommerce','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite') and  product_type='".$_GET['categoria']."'  and  
                                                        modelo='".$_GET['modelo']."' and talla='".$row1['talla']."' and color='".$_GET['color']."' ".$sqlColeccion." ".$sqlFecha." ";    
                                                    }else{
                                                        $sql3="select net_quantity,total_sales,coleccion from ventas where pos_location_name='".$sucursal."' and  product_type='".$_GET['categoria']."' and  
                                                        modelo='".$_GET['modelo']."' and talla='".$row1['talla']."' and color='".$_GET['color']."' ".$sqlColeccion." ".$sqlFecha." ";
                                                    }
                                                    
                                                }
                                                $res3=mysqli_query($con,$sql3);
                                                if(!$res3){
                                                    echo mysqli_error($con);
                                                }else{
                                                    if(mysqli_num_rows($res3)>0){
                                                        while($row2=mysqli_fetch_assoc($res3)){
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

                                                        echo "<tr><td>".$_GET['modelo']."</td>
                                                        <td>".$_GET['color']."</td>
                                                        <td>".$row1['talla']."</td>
                                                        <td>".number_format($conUnidades)."</td>
                                                        <td>$".number_format($conVenta,2)."</td>";

                                                        echo "<td>".$shereUnidadesSuc."%</td>";
                                                        if($sucursal!="PH Total"&&$sucursal!="no PH"){
                                                            echo "<td>".$shereUnidades."%</td>";
                                                            
                                                        }
                                                        echo "<td>".$totalShereVenta."%</td>";
                                                        echo "</tr>";
                                                    }                                          
                                                }
                                            }
                                            
                                            echo "<tr><td>Total en sucursal</td>
                                            <td><td><td>".number_format($conTotUnidades)."</td>
                                            <td>$".number_format($conTotVentas,2)."</td>
                                            <td>".$TotalShereUniSuc."%</td>";
                                            if($sucursal!="PH Total"&&$sucursal!="no PH"){
                                                echo "<td>".$conShereUnidades."%</td>";
                                            }
                                            echo "<td>".$contotalShereVenta."%</td></tr>";
                                        }
                                    }
                                } 
                            }else{
                                if($_GET['talla']!=''){//Busqueda por modelo y talla
                                    $sucursales=$_GET['sucursal'];
                                    foreach($sucursales as $sucursal){
                                        $auxtotalU=0;
                                        $sqlSuc1='';
                                        if($sucursal=="PH Total" ||in_array($sucursal,$arrayPH) ){        
                                            if(in_array($sucursal,$arrayPH)){
                                                $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name='".$sucursal."' and modelo='".$_GET['modelo']."' and talla='".$_GET['talla']."' ".$sqlColeccion." ".$sqlFecha." ";
                                            }else{

                                                $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name IN ('PH Coyoac??n','PH Durango','PH Ecommerce','PH Guadalajara',
                                                'PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite') and modelo='".$_GET['modelo']."' and talla='".$_GET['talla']."' ".$sqlColeccion." ".$sqlFecha." ";
                                            }
                                            
                                        }else{
                                            if($sucursal=="no PH"){
                                                $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name NOT IN ('PH Coyoac??n','PH Durango','PH Ecommerce','PH Guadalajara',
                                                'PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite') and modelo='".$_GET['modelo']."' and talla='".$_GET['talla']."' ".$sqlColeccion." ".$sqlFecha." ";
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
                                        ?>
                                        <table>
                                            <tr><td>Modelo</td><td>Color</td><td>Talla</td><<td>Cantidad de unidades</td><td>Total de la venta</td><td>% Unidades Sucursal</td>
                                        <?php
                                            if($sucursal!="PH Total" && $sucursal!="no PH"){
                                                if(in_array($sucursal,$arrayPH)){
                                                    echo "<td>% en Unidades Total / PH </td>";
                                                }else{
                                                    echo "<td>% en Unidades Total / noPH </td>";
                                                }
                                            }
                                            ?>
                                            <td>% en Unidades sobre toda la venta </td>
                                        </tr>
                                        <?php
                                        echo "<p><h2>".$sucursal."</h2></p>";
                                        $conTotUnidades=0;
                                        $conTotVentas=0;
                                        $conShereUnidades=0;
                                        $TotalShereUniSuc=0;
                                        $contotalShereVenta=0;
                                        $sqlCol="select distinct(color) from ventas where modelo='".$_GET['modelo']."' and product_type='".$_GET['categoria']."' and net_quantity!=0 or total_sales!=0 order by color asc";
                                        $res1=mysqli_query($con,$sqlCol);
                                        if(!$res1){
                                            echo mysqli_error($con);
                                        }else{
                                            while($row1=mysqli_fetch_assoc($res1)){
                                                $conUnidades=0;
                                                $conVenta=0;
                                                $shereUnidades=0;
                                                $shereUnidadesSuc=0;
                                                $totalShereVenta=0;
                                                $sql3='';
                                                if($sucursal=="PH Total"){
                                                    $sql3="select net_quantity,total_sales,coleccion from ventas where pos_location_name IN ('PH Coyoac??n','PH Durango'
                                                    ,'PH Guadalajara','PH Ecommerce','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite') and  product_type='".$_GET['categoria']."'  and  
                                                    modelo='".$_GET['modelo']."' and talla='".$_GET['talla']."' and color='".$row1['color']."' ".$sqlColeccion." ".$sqlFecha." ";    
                                                }else{
                                                    if($sucursal=="no PH"){
                                                        $sql3="select net_quantity,total_sales,coleccion from ventas where pos_location_name NOT IN ('PH Coyoac??n','PH Durango'
                                                        ,'PH Guadalajara','PH Ecommerce','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite')and  product_type='".$_GET['categoria']."' and  
                                                        modelo='".$_GET['modelo']."' and talla='".$_GET['talla']."' and color='".$row1['color']."' ".$sqlColeccion." ".$sqlFecha." ";    
                                                    }else{
                                                        $sql3="select net_quantity,total_sales,coleccion from ventas where pos_location_name='".$sucursal."' and  product_type='".$_GET['categoria']."' and  
                                                    modelo='".$_GET['modelo']."' and talla='".$_GET['talla']."' and color='".$row1['color']."' ".$sqlColeccion." ".$sqlFecha." ";
                                                    }
                                                    
                                                }

                                                $res3=mysqli_query($con,$sql3);
                                                if(!$res3){
                                                    echo mysqli_error($con);
                                                }else{
                                                    if(mysqli_num_rows($res3)>0){
                                                        while($row3=mysqli_fetch_assoc($res3)){
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

                                                        echo "<tr><td>".$_GET['modelo']."</td>
                                                        <td>".$row1['color']."</td>
                                                        <td>".$_GET['talla']."</td>
                                                        <td>".number_format($conUnidades)."</td>
                                                        <td>$".number_format($conVenta,2)."</td>";

                                                        echo "<td>".$shereUnidadesSuc."%</td>";
                                                        if($sucursal!="PH Total" && $sucursal!="no PH"){
                                                            echo "<td>".$shereUnidades."%</td>";
                                                            
                                                        }
                                                        echo "<td>".$totalShereVenta."%</td>";
                                                        echo "</tr>";
                                                    }                                          
                                                }
                                            }
                                            echo "<tr><td>Total en sucursal</td>
                                            <td><td><td>".number_format($conTotUnidades)."</td>
                                            <td>$".number_format($conTotVentas,2)."</td>
                                            <td>".$TotalShereUniSuc."%</td>";
                                            if($sucursal!="PH Total" && $sucursal!="no PH"){
                                                echo "<td>".$conShereUnidades."%</td>";
                                            }
                                            echo "<td>".$contotalShereVenta."%</td></tr>";
                                        }

                                    }
                                }else{//Busqueda por modelo
                                    $sucursales=$_GET['sucursal'];
                                    foreach($sucursales as $sucursal){
                                        $auxtotalU=0;
                                    $auxtotalD=0;
                                    $sqlSuc='';
                                    if($sucursal=="PH Total" ||in_array($sucursal,$arrayPH) ){        
                                        if(in_array($sucursal,$arrayPH)){
                                            $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name='".$sucursal."' and modelo='".$_GET['modelo']."' ".$sqlColeccion." ".$sqlFecha." ";
                                        }else{

                                            $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name IN ('PH Coyoac??n','PH Durango','PH Ecommerce','PH Guadalajara',
                                            'PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite') and modelo='".$_GET['modelo']."' ".$sqlColeccion." ".$sqlFecha." ";
                                        }
                                        
                                    }else{
                                        if($sucursal=="no PH"){
                                            $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name NOT IN ('PH Coyoac??n','PH Durango','PH Ecommerce','PH Guadalajara',
                                            'PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite') and modelo='".$_GET['modelo']."' ".$sqlColeccion." ".$sqlFecha." ";
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
                                    ?>
                                        <table>
                                            <tr><td>Modelo</td><td>Color</td><<td>Cantidad de unidades</td><td>Total de la venta</td><td>% Unidades Sucursal</td>
                                        <?php
                                            if($sucursal!="PH Total" && $sucursal!="no PH"){
                                                if(in_array($sucursal,$arrayPH)){
                                                    echo "<td>% en Unidades Total / PH </td>";
                                                }else{
                                                    echo "<td>% en Unidades Total / noPH </td>";
                                                }
                                            }
                                            
                                            
                                            ?>
                                        
                                        <td>% en Unidades sobre toda la venta </td>
                                    </tr>
                                    <?php
                                        echo "<p><h2>".$sucursal."</h2></p>";
                                        $conTotUnidades=0;
                                        $conTotVentas=0;
                                        $conShereUnidades=0;
                                        $TotalShereUniSuc=0;
                                        $contotalShereVenta=0;
                                            
                                        $sqlTal="select distinct(color) from ventas where modelo='".$_GET['modelo']."' 
                                            and (net_quantity!=0 or total_sales!=0) order by color asc,talla asc";
                                        $res2=mysqli_query($con,$sqlTal);
                                        if(!$res1){
                                            echo mysqli_error($con);
                                        }else{
                                            while($row2=mysqli_fetch_assoc($res2)){
                                                
                                                $conUnidades=0;
                                                $conVenta=0;
                                                $shereUnidades=0;
                                                $shereUnidadesSuc=0;
                                                $totalShereVenta=0;
                                                if($sucursal=="PH Total"){
                                                    $sql3="select net_quantity,total_sales,coleccion from ventas where pos_location_name IN ('PH Coyoac??n','PH Durango'
                                                    ,'PH Guadalajara','PH Ecommerce','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite') and  product_type='".$_GET['categoria']."' and  
                                                    modelo='".$_GET['modelo']."' and color='".$row2['color']."' ".$sqlColeccion." ".$sqlFecha." ";
                                                    
                                                }else{
                                                    if($sucursal=="no PH"){
                                                        $sql3="select net_quantity,total_sales,coleccion from ventas where pos_location_name NOT IN ('PH Coyoac??n','PH Durango'
                                                        ,'PH Guadalajara','PH Ecommerce','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite') and  product_type='".$_GET['categoria']."' and  
                                                        modelo='".$_GET['modelo']."' and color='".$row2['color']."' ".$sqlColeccion." ".$sqlFecha." ";
                                                        
                                                    }else{
                                                        $sql3="select net_quantity,total_sales,coleccion from ventas where pos_location_name='".$sucursal."' and   product_type='".$_GET['categoria']."' and 
                                                        modelo='".$_GET['modelo']."'  and color='".$row2['color']."' ".$sqlColeccion." ".$sqlFecha." ";
                                                    }
                                                }
                                                $res3=mysqli_query($con,$sql3);
                                                if(!$res3){
                                                    echo mysqli_error($con);
                                                }else{
                                                    if(mysqli_num_rows($res3)>0){
                                                        while($row3=mysqli_fetch_assoc($res3)){
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
                                                        
                                                        echo "<tr><td>".$_GET['modelo']."</td>";
                                                        echo "<td>".$row2['color']."</td>";
                                                        
                                                        echo "<td>".number_format($conUnidades)."</td>";
                                                        echo "<td>$".number_format($conVenta,2)."</td>";

                                                        echo "<td>".$shereUnidadesSuc."%</td>";
                                                        if($sucursal!="PH Total" && $sucursal!="no PH" ){
                                                            echo "<td>".$shereUnidades."%</td>";
                                                            
                                                        }
                                                        echo "<td>".$totalShereVenta."%</td>";
                                                        echo "</tr>";
                                                    }                                          
                                                }
                                            }
                                        }
                                        echo "<tr><td>Total en sucursal</td>
                                        <td><td>".number_format($conTotUnidades)."</td>
                                        <td>$".number_format($conTotVentas,2)."</td>
                                        <td>".$TotalShereUniSuc."%</td>";
                                        if($sucursal!="PH Total" && $sucursal!="no PH" ){
                                            echo "<td>".$conShereUnidades."%</td>";
                                        }
                                        echo "<td>".$contotalShereVenta."%</td></tr>";

                                    }
                                } 
                            } 
                        }else{                       
                            if($_GET['categoria']!=''){//Busqueda por sucursal y categoria
                                $sucursales=$_GET['sucursal'];
                                foreach($sucursales as $sucursal){
                                    $auxtotalU=0;
                                    $auxtotalD=0;
                                    $sqlSuc='';
                                    if($sucursal=="PH Total" ||in_array($sucursal,$arrayPH) ){        
                                        if(in_array($sucursal,$arrayPH)){
                                            $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name='".$sucursal."' and product_type='".$_GET['categoria']."' ".$sqlColeccion." ".$sqlFecha." ";
                                        }else{

                                            $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name IN ('PH Coyoac??n','PH Durango','PH Ecommerce','PH Guadalajara',
                                            'PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite') and product_type='".$_GET['categoria']."' ".$sqlColeccion." ".$sqlFecha." ";
                                        }
                                        
                                    }else{
                                        if($sucursal=="no PH"){
                                            $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name NOT IN ('PH Coyoac??n','PH Durango','PH Ecommerce','PH Guadalajara',
                                            'PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite') and product_type='".$_GET['categoria']."' ".$sqlColeccion." ".$sqlFecha." ";
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
                                    ?>
                                    <table>
                                        <tr><td>Modelo</td><td>Cantidad de unidades</td><td>Total de la venta</td><td>% Unidades Sucursal</td>
                                        <?php
                                            if($sucursal!="PH Total" && $sucursal!="no PH"){
                                                if(in_array($sucursal,$arrayPH)){
                                                    echo "<td>% en Unidades Total / PH </td>";
                                                }else{
                                                    echo "<td>% en Unidades Total / noPH </td>";
                                                }
                                            }
                                            
                                            
                                            ?>
                                        
                                        <td>% en Unidades sobre toda la venta </td>
                                    </tr>
                                    <?php


                                    echo "<p><h2>".$sucursal."</h2></p>";
                                    $sqlMod="select distinct(modelo) from ventas where net_quantity!=0 or total_sales!=0 order by product_type asc, modelo asc";
                                    $res1=mysqli_query($con,$sqlMod);
                                    
                                    $conTotUnidades=0;
                                    $conTotVentas=0;
                                    $conShereUnidades=0;
                                    $TotalShereUniSuc=0;
                                    $contotalShereVenta=0;
                                    if(!$res1){
                                        echo mysqli_error($con);
                                    }else{
                                        while($row1=mysqli_fetch_assoc($res1)){
                                            $conUnidades=0;
                                            $conVenta=0;
                                            $shereUnidades=0;
                                            $shereUnidadesSuc=0;
                                            $totalShereVenta=0;
                                            $sql2='';
                                            if($sucursal=="PH Total"){
                                                $sql2="select net_quantity,total_sales,coleccion from ventas where pos_location_name IN ('PH Coyoac??n','PH Durango'
                                                ,'PH Guadalajara','PH Ecommerce','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite') and  
                                                    product_type='".$_GET['categoria']."' and modelo='".$row1['modelo']."' ".$sqlColeccion." ".$sqlFecha." ";
                                                
                                            }else{
                                                if($sucursal=="no PH"){
                                                    $sql2="select net_quantity,total_sales,coleccion from ventas where pos_location_name NOT IN ('PH Coyoac??n','PH Durango'
                                                    ,'PH Guadalajara','PH Ecommerce','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite') and  
                                                        product_type='".$_GET['categoria']."' and modelo='".$row1['modelo']."' ".$sqlColeccion." ".$sqlFecha." ";
                                                    
                                                }else{
                                                    $sql2="select net_quantity,total_sales,coleccion from ventas where pos_location_name='".$sucursal."' and  
                                                product_type='".$_GET['categoria']."' and modelo='".$row1['modelo']."' ".$sqlColeccion." ".$sqlFecha." ";
                                                }                                   
                                            }
                                            $res2=mysqli_query($con,$sql2);
                                            if(!$res2){
                                                echo mysqli_error($con);
                                            }else{
                                                if(mysqli_num_rows($res2)>0){
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
                                                    
                                                    echo "<tr><td>".$row1['modelo']."</td>
                                                    <td>".number_format($conUnidades)."</td>
                                                    <td>$".number_format($conVenta,2)."</td>";

                                                    echo "<td>".$shereUnidadesSuc."%</td>";
                                                    if($sucursal!="PH Total" && $sucursal!="no PH"){
                                                        echo "<td>".$shereUnidades."%</td>";
                                                        
                                                    }
                                                    echo "<td>".$totalShereVenta."%</td>";
                                                    echo "</tr>";
                                                }                                          
                                            }
                                        }
                                        echo "<tr><td>Total en sucursal</td>
                                        <td>".number_format($conTotUnidades)."</td>
                                        <td>$".number_format($conTotVentas,2)."</td>
                                        <td>".$TotalShereUniSuc."%</td>";
                                        if($sucursal!="PH Total" && $sucursal!="no PH"){
                                            echo "<td>".$conShereUnidades."%</td>";
                                        }
                                        echo "<td>".$contotalShereVenta."%</td></tr>";
                                    }

                                }
                            }else{//Busqueda por sucursal 
                                
                                $sucursales=$_GET['sucursal'];
                                    foreach($sucursales as $sucursal){
                                        $auxtotalU=0;
                                        $auxtotalD=0;
                                        $sqlSuc='';
                                        if($sucursal=="PH Total" ||in_array($sucursal,$arrayPH) ){        
                                            if(in_array($sucursal,$arrayPH)){
                                                $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name='".$sucursal."' ".$sqlColeccion." ".$sqlFecha." ";
                                            }else{

                                                $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name IN ('PH Coyoac??n','PH Durango','PH Ecommerce','PH Guadalajara',
                                                'PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite') ".$sqlColeccion." ".$sqlFecha." ";
                                            }
                                            
                                        }else{
                                            if($sucursal=="no PH"){
                                                $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name NOT IN ('PH Coyoac??n','PH Durango','PH Ecommerce','PH Guadalajara',
                                                'PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite') ".$sqlFecha." ";
                                            }else{
                                                $sqlSuc1="select net_quantity from ventas where net_quantity!=0 and pos_location_name='".$sucursal."' ".$sqlColeccion." ".$sqlFecha." ";
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
                                        ?>
                                        <table>
                                            <tr><td>Categoria</td><td>Cantidad de unidades</td><td>Total de la venta</td><td>% Unidades Sucursal</td>
                                            <?php
                                                if($sucursal!="PH Total" && $sucursal!="no PH"){
                                                    if(in_array($sucursal,$arrayPH)){
                                                    echo "<td>% en Unidades Total / PH </td>";
                                                    }else{
                                                        echo "<td>% en Unidades Total / noPH </td>";
                                                    }
                                                }
                                                
                                                
                                            ?>
                                            
                                            <td>% en Unidades sobre toda la venta </td>
                                        </tr>
                                        <?php
                                        echo "<p><h2>".$sucursal."</h2></p>";
                                        $sqlCat="select distinct(product_type) from ventas where net_quantity!=0 or total_sales!=0 order by product_type asc";
                                        $res1=mysqli_query($con,$sqlCat);
                                        
                                        $conTotUnidades=0;
                                        $conTotVentas=0;
                                        $conShereUnidades=0;
                                        $TotalShereUniSuc=0;
                                        $totalShereVenta=0;
                                        $contotalShereVenta=0;
                                        
            
                                        if(!$res1){
                                            echo mysqli_error($con);
                                        }else{
                                            while($row1=mysqli_fetch_assoc($res1)){
                                                $conUnidades=0;
                                                $conVenta=0;
                                                $shereUnidades=0;
                                                $shereUnidadesSuc=0;
                                                $totalShereVenta=0;
                                                $sql2="";
                                                if($sucursal=="PH Total"){
                                                    $sql2="select net_quantity,total_sales,coleccion from ventas where pos_location_name IN ('PH Coyoac??n','PH Durango'
                                                    ,'PH Guadalajara','PH Ecommerce','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite') and  
                                                    product_type='".$row1['product_type']."' ".$sqlColeccion." ".$sqlFecha." ";
                                                    
                                                }else{
                                                    if($sucursal=="no PH"){
                                                        $sql2="select net_quantity,total_sales,coleccion from ventas where pos_location_name NOT IN ('PH Coyoac??n','PH Durango'
                                                        ,'PH Guadalajara','PH Ecommerce','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite') and  
                                                        product_type='".$row1['product_type']."' ".$sqlColeccion." ".$sqlFecha." ";
                                                    }else{
                                                        $sql2="select net_quantity,total_sales,coleccion from ventas where pos_location_name='".$sucursal."' and  
                                                        product_type='".$row1['product_type']."' ".$sqlColeccion." ".$sqlFecha." ";
                                                    }
                                                
                                                }
                                            
                                                //echo $sql2;
                                            //var_dump($sql2);
                                                $res2=mysqli_query($con,$sql2);
                                                if(!$res2){
                                                    echo mysqli_error($con);
                                                }else{
                                                    if(mysqli_num_rows($res2)>0){
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
                                                        //Calcula el total del % de las unidades sobre toda la venta
                                                        $contotalShereVenta=$contotalShereVenta+$totalShereVenta;

                                                        $totalUniVenta=$totalUniVenta+$conUnidades;
                                                        $totalDinero=$totalDinero+$conVenta;                                     
                                                        $totalPorcenUniVen=$totalPorcenUniVen+$totalShereVenta;


                                                        echo "<tr><td>".$row1['product_type']."</td>
                                                        <td>".number_format($conUnidades)."</td>
                                                        <td>$".number_format($conVenta,2)."</td>";
                                                        echo "<td>".$shereUnidadesSuc."%</td>";
                                                        if($sucursal!="PH Total" && $sucursal!="no PH"){
                                                            echo "<td>".$shereUnidades."%</td>";
                                                            
                                                        }
                                                        echo "<td>".$totalShereVenta."%</td>";
                                                        echo "</tr>";



                                                    }                                          
                                                }
                                            }
                                            echo "<tr><td>Total en sucursal</td>
                                            <td>".number_format($conTotUnidades)."</td>
                                            <td>$".number_format($conTotVentas,2)."</td>
                                            <td>".$TotalShereUniSuc."%</td>";
                                            if($sucursal!="PH Total" && $sucursal!="no PH"){
                                                echo "<td>".$conShereUnidades."%</td>";
                                            }
                                            echo "<td>".$contotalShereVenta."%</td></tr>";
                                            $auxConUnidad=$conTotUnidades;
                                        }




                                    }
                                
                            }   
                        }
                        ?>
                        </table>

                        <h2>Ventas por coleccion</h2>
                        <?php
                            $porCr=$conCR/$totalUniVenta*100;
                            $porPV=$conPV/$totalUniVenta*100;
                            $porOI=$conOI/$totalUniVenta*100;

                            
                        ?>
                        <table>
                            <tr><td>Colecci??n</td><td>Cantidad</td><td>%</td></tr>
                            <tr><td>Colecci??n Regina Romero</td><td><?php echo $conCR;?></td><td><?php echo number_format($porCr,2);?>%</td></tr>
                            <tr><td>Primavera Verano</td><td><?php echo $conPV;?></td><td><?php echo number_format($porPV,2);?>%</td></tr>
                            <tr><td>Oto??o Invierno</td><td><?php echo $conOI;?></td><td><?php echo number_format($porOI,2);?>%</td></tr>
                            <?php
                            $totalColec=$conCR+$conPV+$conOI;
                        //var_dump($totalColec);
                            $totalPorCole=$porCr+$porPV+$porOI; 
                            $difTotal=$totalUniVenta-$totalColec;


                            if($difTotal>0){
                                $totalColec=$totalColec+$difTotal;
                                $auxPor=$difTotal/$totalColec;
                            ?> 
                            <tr><td>Otros</td><td><?php echo $difTotal;?></td><td><?php echo number_format($auxPor,2);?>%</td></tr>
                            <?php
                            }
                            ?>
                            
                            <tr><td>Total</td><td><?php echo $totalColec;?></td><td><?php echo number_format($totalPorCole,2);?>%</td></tr>
                        </table>
                        <h2>Total de la busqueda</h2>
            
                        <table>
                            
                        <?php
                        //Encabezxado de la tabla del total de la busqueda
                            
                        if($_GET['categoria']!='')
                        echo "<tr><td><b>Categoria</td><td>".$_GET['categoria']."</td></tr>";
                    if($_GET['modelo']!='')
                        echo "<tr><td><b>Modelo</td><td>".$_GET['modelo']."</td></tr>";
                    if($_GET['color']!='')
                        echo "<tr><td>Color</td><td>".$_GET['color']."</td></tr>";
                    if($_GET['talla']!='')
                        echo "<tr><td>Talla</td><td>".$_GET['talla']."</td></tr>";
                    
                    echo "<tr><td>Total de unidades</td><td>".number_format($totalUniVenta)."</td></tr>";
                    echo "<tr><td>Total de dinero</td><td>$".number_format($totalDinero,2)."</td></tr>";
                    $porModeloCat=0;
                    $sqlMod="select net_quantity from ventas where product_type='".$_GET['categoria']."' and (net_quantity!=0) ".$sqlFecha."";
                    $resMod=mysqli_query($con,$sqlMod);
                    if(!$resMod){
                        echo mysqli_error($con);
                    }else{
                        $contCat=0;
                        while($rowCat=mysqli_fetch_assoc($resMod)){
                            $contCat=$contCat+$rowCat['net_quantity'];
                        }
                        
                    }
                    $porModeloCat=$totalUniVenta/$contCat*100;
                    if($_GET['modelo']!=''){
                        echo "<tr><td>%UnidadesModelo/categoria</td><td>".number_format($porModeloCat,2)."%</td></tr>";
                    }
                    $porColorTalla=0;
                    $sqlMod="select net_quantity from ventas where modelo='".$_GET['modelo']."' and (net_quantity!=0) ".$sqlFecha."";
                    $resMod=mysqli_query($con,$sqlMod);
                    if(!$resMod){
                        echo mysqli_error($con);
                    }else{
                        $contModelo=0;
                        while($rowModelo=mysqli_fetch_assoc($resMod)){
                            $contModelo=$contModelo+$rowModelo['net_quantity'];
                        }
                    }


                    $bPH=false;
                    $bnPH=false;
                    $arrayPH=['PH Coyoac??n','PH Durango','PH Ecommerce'
                    ,'PH Guadalajara','PH Interlomas','PH Perisur'
                    ,'PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??','PH Sat??lite','PH Total'];
                    $arraynPH=['AL SOLE PUNTA MITA','Draft Orders','Eventos'
                                ,'Liverpool','Monte L??bano 250','Rich Returns'
                                ,'Shopify Mobile','www.reginaromero.com','no PH'];

                    
                    foreach($arrayPH as $aPH){
                        if(in_array($aPH,$sucursalChecked)){
                            $bPH=true;
                        }
                    }
                    foreach($arraynPH as $anPH){
                        if(in_array($anPH,$sucursalChecked)){
                            $bnPH=true;
                        }
                    }
                    
                    if($_GET['modelo']!=''){
                        $sqlModCatSucPH="select net_quantity from ventas where modelo='".$_GET['modelo']."' 
                        and (net_quantity!=0) and pos_location_name IN ('PH Coyoac??n','PH Durango','PH Ecommerce'
                        ,'PH Guadalajara','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??'
                        ,'PH Sat??lite') ".$sqlFecha."";
                        $resModCatSucPH=mysqli_query($con,$sqlModCatSucPH);
                        $contModCatSuc=0;
                        if(!$resModCatSucPH){
                            echo mysqli_error($con);
                        }else{
                            
                            while($rowModelo1=mysqli_fetch_assoc($resModCatSucPH)){
                                $contModCatSuc=$contModCatSuc+$rowModelo1['net_quantity'];
                            }
                        }
                        var_dump($contModCatSuc);
                        if($bPH==true){
                            $porModeloPH=$totalUniVenta/$contModCatSuc*100;
                            echo"<tr><td>%unidades/categoria PH</td><td>".number_format($porModeloPH,2)."</td></tr>";
                        }

                        $sqlModCatSucPH="select net_quantity from ventas where modelo='".$_GET['modelo']."' 
                        and (net_quantity!=0) and pos_location_name NOT IN ('PH Coyoac??n','PH Durango','PH Ecommerce'
                        ,'PH Guadalajara','PH Interlomas','PH Perisur','PH Polanco','PH Puebla','PH Quer??taro','PH Santa F??'
                        ,'PH Sat??lite') ".$sqlFecha."";
                        $resModCatSuc=mysqli_query($con,$sqlModCatSucPH);
                        $contModCatSucnoPH=0;
                        if(!$resModCatSucPH){
                            echo mysqli_error($con);
                        }else{
                            
                            while($rowModelo2=mysqli_fetch_assoc($resModCatSuc)){
                                $contModCatSucnoPH=$contModCatSucnoPH+$rowModelo2['net_quantity'];
                            }
                        }
                        var_dump($contModCatSucnoPH);
                        if($bnPH==true){
                            $porModelonoPH=$totalUniVenta/$contModCatSucnoPH*100;
                            echo"<tr><td>%unidades/categoria noPH</td><td>".number_format($porModelonoPH,2)."%</td></tr>";
                        }
                        $porColorTalla=$totalUniVenta/$contModelo*100;
                        if($_GET['color']!=''||$_GET['talla']!=''){

                            if($_GET['color']!=''&&$_GET['talla']!=''){//Modelo, color y talla
                                echo "<tr><td>%ColorTalla/modelo</td><td>".number_format($porColorTalla,2)."%</td></tr>";

                            }
                            if($_GET['color']!=''&&$_GET['talla']==''){//modelo y color
                                echo "<tr><td>%Color/modelo</td><td>".number_format($porColorTalla,2)."%</td></tr>";

                            }
                            if($_GET['color']==''&&$_GET['talla']!=''){//modelo y talla
                                echo "<tr><td>%Talla/modelo</td><td>".number_format($porColorTalla,2)."%</td></tr>";

                            }
                        }
                    }
                    echo "<tr><td>Total % sobre la venta</td><td>".$totalPorcenUniVen."%</td></tr>";
                    

                    ?>
                    
                    </table>
                    <?php
                    }else{
                        ?>
                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </symbol>    
                        </svg>
                        <div class="alert alert-danger d-flex align-items-center" role="alert">

                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                        <div>
                            Error! Seleccione una fecha.
                        </div>
                        </div>
                    <?php
                    }

                

                    

                            
                    
                }
            
                
                //ODIGO PARA IMPORTAR ARCHIVOS
                if(isset($_POST['importar'])){
                    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values',
                    'application/octet-stream', 'application/vnd.ms-excel', 
                    'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 
                    'application/vnd.msexcel', 'text/plain');
                    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes)){
                        if(is_uploaded_file($_FILES['file']['tmp_name'])){   
                            $csv_file = fopen($_FILES['file']['tmp_name'], 'r');           
                            fgetcsv($csv_file);            
                            // get data records from csv file

                                $query="Select MAX(id_venta) as id from ventas ";
                                $res=mysqli_query($con,$query);
                                $id=0;
                                if(!$res){
                                    echo "No se importo bien los datos";
                                    echo  mysqli_error($con);
                                }else{
                                    $row=mysqli_fetch_assoc($res);
                                    if($row['id']==''){
                                        $id=1;
                                    }else{ 
                                        $id=$row['id'];
                                        $id=$id+1;
                                    }
                                } 

                                    
                            while(($columna = fgetcsv($csv_file)) !== FALSE){

                                // Check if employee already exists with same email
                                        if($columna[9]!=0||$columna[10]!=0){
                                            //Codigo para obtener el nombre del modelo a traves de titulo del producto
                                            if($columna[0]!=''){

                                                $sqlModelo="select modelo from modelos where modelo != 'REGINA'";
                                                $modelo="";
                                                $resModelo=mysqli_query($con,$sqlModelo);
                                                $b=0;
                                                while($arrayModelos=mysqli_fetch_assoc($resModelo)){ 
                                                    if(str_starts_with($columna[0],$arrayModelos['modelo'])){
                                                        if(str_starts_with($columna[0],"STELLA")){
                                                            $modelo="STELLA 75";
                                                            $b=1;
                                                            break;
                                                        }
                                                        if(str_starts_with($columna[0],"BOSTON")){
                                                            $b=1;
                                                            break;
                                                        }
                                                        else{
                                                            $modelo=$arrayModelos['modelo'];
                                                            $b=1;
                                                            break;
                                                        }
                                                                                            
                                                    }else{
                                                        if(str_ends_with($columna[0],$arrayModelos['modelo'])){
                                                            if(str_ends_with($columna[0],"M1980")){
                                                                $modelo="M1980";
                                                                $b=1;
                                                                break;
                                                            }else{
                                                                $modelo=$arrayModelos['modelo'];
                                                                $b=1;
                                                                break;
                                                            }
                                                        }
                                                    } 
                                                }
                                                if($b==0){
                                                    $sqlModelo="select modelo from modelos";
                                                    $modelo="";
                                                    $resModelo=mysqli_query($con,$sqlModelo);
                                                    while($arrayModelos=mysqli_fetch_assoc($resModelo)){ 
                                                        if(str_contains($columna[0],$arrayModelos['modelo'])){
                                                            
                                                            $modelo=$arrayModelos['modelo'];
                                                            break;
                                                        }
                                                    }
                                                }
                                            }else{
                                                $modelo="NA";
                                            }

                                            if(str_contains($columna[3],'/')){
                                                $colorTalla= explode(' / ',$columna[3]);
                                                $color=strtoupper($colorTalla[0]);
                                                
                                                //var_dump($colorTalla);
                                                $talla="";
                                                $talla=$colorTalla[1];
                                            }else{
                                                $color=strtoupper($columna[3]);
                                                $talla='';

                                            }
                                            
                                            $fecha_venta=$columna[6];
                                            if(str_contains($columna[6],'/')){
                                                $fecha=explode('/',$columna[6]);
                                                $dia=$fecha[0];
                                                $mes=$fecha[1];
                                                $anio=$fecha[2];
                                                $fecha_venta=$anio.'-'.$mes.'-'.$dia;
                                                
                                            }
                                            //var_dump($fecha_venta);
                                            
                                            $posLocation="";
                                            if($columna[2]==''){
                                                if($columna[4]=="Draft Orders"){
                                                    $posLocation="Draft Orders";
                                                }
                                                if($columna[4]=="Yuju"){
                                                    $posLocation="Liverpool";
                                                }
                                                if($columna[4]=="Shopify Mobile for Android"||$columna[4]=="Shopify Mobile for iPhone"||$columna[4]=="Shopify Web" ){
                                                    $posLocation="Shopify Mobile";
                                                }
                                                if($columna[4]=="Rich Returns"){
                                                    $posLocation="Rich Returns";
                                                }
                                                if($columna[4]=="Online Store"){
                                                    $posLocation="www.reginaromero.com";
                                                }
                                            }else{
                                                $posLocation=$columna[2];
                                            }

                                            $coleccion="";
                                            $sku=$columna[8];
                                            if($sku!=''){
                                                $sku1=explode('_',$sku);
                                                if(str_starts_with($sku1[2],"FW")){
                                                    $coleccion="OI";
                                                }
                                                elseif(str_starts_with($sku1[2],"SS")||str_starts_with($sku1[2],"RT")){
                                                    $coleccion="PV";
                                                }
                                                elseif(str_starts_with($sku1[2],"CR")){
                                                    $coleccion="CR";
                                                }else{
                                                    if(str_starts_with($sku1[2],"RR")||str_starts_with($sku1[2],"BC")){
                                                        $sqlColeccion="select coleccion from catmodelos where modelo='".$modelo."' and variante like '%".$color."%'";
                                                        $resColeccion=mysqli_query($con,$sqlColeccion);
                                                        if(!$resColeccion){
                                                            //echo  mysqli_error($con);
                                                        }
                                                        $rowColeccion=mysqli_fetch_assoc($resColeccion);
                                                        $coleccion1=$rowColeccion['coleccion'];
                                                        $coleccion=$coleccion1;
                                                    }else{
                                                        $sqlColeccion="select coleccion from catmodelos where modelo='".$modelo."' and variante like '%".$color."%'";
                                                        $resColeccion=mysqli_query($con,$sqlColeccion);
                                                        if(!$resColeccion){
                                                            //echo  mysqli_error($con);
                                                        }
                                                        $rowColeccion=mysqli_fetch_assoc($resColeccion);
                                                        $coleccion1=$rowColeccion['coleccion'];
                                                        $coleccion=$coleccion1;
                                                    }
                                                    
                                                }
                                            }
                                            
                                        
                                            $sql1 = "INSERT INTO  ventas (product_title,modelo,product_type,color,talla,
                                            pos_location_name,fecha,sku,coleccion,net_quantity,
                                            total_sales,id_venta) VALUES
                                            ('".$columna[0]."','".$modelo."','".$columna[1]."','".$color."','".$talla."',
                                            '".$posLocation."','".$fecha_venta."','".$sku."','".$coleccion."','".$columna[9]."',
                                            '".$columna[10]."','".$id."')";
                                            
                                            $result=mysqli_query($con, $sql1);
                                            if (!$result){ 
                                                //echo  mysqli_error($con);
                                                
                                            }else{
                                            
                                            }
                                        }
                                    
                                
                            }            
                            fclose($csv_file);
                            $import_status = '?import_status=success';
                            echo "<h4>El archivo se importo con exito<h4>";
                        }else{
                            $import_status = '?import_status=error';
            
                        }
                    }else{
            
                    }
                }


                ?>
                    </div>

                </div>
            
                <div class="clearfix"></div>
            </section>
        </section>
        
    </body>
    <!--Jquery-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>     
    <!--Bootstrap-->
    <!--Scripts-->
    <!--Codigo en JavaScipt-->
    <script type="text/javascript" src="js/main.js">
    </script>

</html>
<?php
}


   

?>

