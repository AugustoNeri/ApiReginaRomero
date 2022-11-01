<?php
require_once("phpClasses/connect.php");
session_start();
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

                $("#cmbFabrica").change(function () {					
					$("#cmbFabrica option:selected").each(function () {
						fabrica = $(this).val();
                        if ( fabrica=="otro" ){
                            $("#txtFabrica").attr("disabled",false);
                        } else {
                            $("#txtFabrica").attr("disabled",true);
                        }       
					});
				})
			
                $("#cmbHorma").change(function () {					
					$("#cmbHorma option:selected").each(function () {
						horma = $(this).val();
                        
                        if ( horma=="otro" ){
                            $("#txtHorma").attr("disabled",false);
                        } else {
                            $("#txtHorma").attr("disabled",true);
                        }       
					});
				})
                $("#cmbModelo").change(function () {					
					$("#cmbModelo option:selected").each(function () {
						modelo = $(this).val();
						if ( modelo=="otro" ){
                            $("#txtModelo").attr("disabled",false);
                        } else {
                            $("#txtModelo").attr("disabled",true);
                        }       
					});
				})
                $("#cmbColor").change(function () {					
					$("#cmbColor option:selected").each(function () {
						color = $(this).val();
						if ( color=="otro" ){
                            $("#txtColor").attr("disabled",false);
                        } else {
                            $("#txtColor").attr("disabled",true);
                        }       
					});
				})


			});
	</script>

</head>
<body>
    <section id="global">
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
                        <li><a  href="ventas.php">Ventas</a></li>
                        <li><a class="active" href="pedidos.php">Pedidos</a></li>
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
                        <li><a  href="ventas.php">Ventas</a></li>
                        <li><a class="active" href="pedidos.php">Pedidos</a></li>
                        <li><a   href="llegadas.php">Llegadas</a></li>
                        <li><a href="login.php">Cerrar Sesion</a></li>
                    </ul>
                </nav>
        <?php
            }
        ?>
        </header>
        <div class="content">
        <div class="row">


        <div class="col-md-4"></div><div class="col-md-4"><p class="h1">Añadir un pedido</p></div><div class="col-md-4"></div>
            <form class="row g-3" action="" method="get">
               
                <div class="col-md-4">
                    <label for="validationCustom04" class="form-label">Fabrica</label>
                        <select name="cmbFabrica" class="form-select" id="cmbFabrica"  required>
                            <option selected disabled value="">Selecciona una fabrica</option>
                            <?php
                                $sql="select codigo,fabrica from fabricas order by fabrica asc";
                                $res=mysqli_query($con,$sql);
                                if(!$res){
                                    echo "fallo";
                                }else{
                                    while($rowFabrica=mysqli_fetch_assoc($res)){
                                    echo '<option value="'.$rowFabrica['codigo'].'">'.$rowFabrica['fabrica'].'</option>';
                                    }
                                }

                            ?>
                            <option value="otro">Otro</option>
                        </select>
                </div>
                <div class="col-md-4">
                    <label for="validationCustom04" class="form-label">Nombre de la fabrica</label>
                    <input name="txtFabrica" id="txtFabrica"  type="number" class="form-control" disabled>
                </div>
                <div class="col-md-4">
                    <label for="validationCustom04" class="form-label">Sucursal*</label>
                        <select name="cmbSucursal" class="form-select" id="cmbSucursal" required>
                            <option selected disabled value="">Selecciona una sucursal</option>
                            <?php
                                $sql="select codigo,sucursal from sucursalpedidos order by sucursal asc";
                                $res=mysqli_query($con,$sql);
                                if(!$res){
                                    echo "fallo";
                                }else{
                                    while($rowSucursal=mysqli_fetch_assoc($res)){
                                    echo '<option value="'.$rowSucursal['codigo'].'">'.$rowSucursal['sucursal'].'</option>';
                                    }
                                }

                            ?>
                        </select>
                </div> 
                <div class="col-md-4">
                    <label for="validationCustom04" class="form-label">Numero de pedido*</label>
                    <input name="txtNum" id="txtNum"  type="number" class="form-control" >
                </div>

                <div class="col-md-4">
                    <label for="validationCustom04" class="form-label">Categoria*</label>
                        <select name="cmbCategoria" class="form-select" id="cmbCategoria" required>
                            <option selected disabled value="">Selecciona una categoria</option>
                            <?php
                                $sql="select categoria from categorias order by categoria asc";
                                $res=mysqli_query($con,$sql);
                                if(!$res){
                                    echo "fallo";
                                }else{
                                    while($rowCategoria=mysqli_fetch_assoc($res)){
                                    echo '<option value="'.$rowCategoria['categoria'].'">'.$rowCategoria['categoria'].'</option>';
                                    }
                                }

                            ?>

                        </select>
                </div>
                <div class="col-md-4">
                    <label for="validationCustom04" class="form-label">Horma*</label>
                        <select name="cmbHorma"  class="form-select" id="cmbHorma" required>
                            <option selected disabled value="">Selecciona una horma</option>
                            <?php
                                $sql="select tipo from horma order by tipo asc";
                                $res=mysqli_query($con,$sql);
                                if(!$res){
                                    echo "fallo";
                                }else{
                                    while($rowHorma=mysqli_fetch_assoc($res)){
                                    echo '<option value="'.$rowHorma['tipo'].'">'.$rowHorma['tipo'].'</option>';
                                    }
                                }

                            ?>
                            <option value="otro">Otro</option>
                        </select>
                </div>
                <div class="col-md-4">
                    <label for="validationCustom04" class="form-label">Nombre de la Horma</label>
                    <input name="txtHorma" id="txtHorma"  type="text" class="form-control" disabled>
                </div>

                
                <div class="col-md-4">
                    <label for="validationCustom04" class="form-label">Modelo*</label>
                        <select name="cmbModelo" class="form-select" id="cmbModelo" required>
                            <option selected disabled value="">Selecciona una modelo</option>
                            <?php
                                $sql="select distinct(modelo) from catmodelos order by modelo asc";
                                $res=mysqli_query($con,$sql);
                                if(!$res){
                                    echo "fallo";
                                }else{
                                    while($rowModelo=mysqli_fetch_assoc($res)){
                                    echo '<option value="'.$rowModelo['modelo'].'">'.$rowModelo['modelo'].'</option>';
                                    }
                                }

                            ?>
                            <option value="otro">Otro</option>

                        </select>
                </div>
                <div class="col-md-4">
                    <label for="validationCustom04" class="form-label">Nombre del Modelo</label>
                    <input  name="txtModelo" id="txtModelo" type="text" class="form-control" placeholder="Nombre del modelo"  disabled>
                </div>
                <div class="col-md-4">
                    <label for="validationCustom04" class="form-label">Color*</label>
                        <select name="cmbColor" class="form-select" id="cmbColor" required>
                            <option selected disabled value="">Selecciona un color</option>
                            <?php
                                $sql="select color from color order by color asc";
                                $res=mysqli_query($con,$sql);
                                if(!$res){
                                    echo "fallo";
                                }else{
                                    while($rowColor=mysqli_fetch_assoc($res)){
                                    echo '<option value="'.$rowColor['color'].'">'.$rowColor['color'].'</option>';
                                    }
                                }

                            ?>
                            <option value="otro">Otro</option>
                        </select>
                </div>
                <div class="col-md-4">
                    <label for="validationCustom04" class="form-label">Nombre del color</label>
                    <input name="txtColor" id="txtColor" type="text" class="form-control" id="validationDefault01" value="" disabled>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
               

                <div class="col-md-4"><p class="h2">Tallas</p></div><div class="col-md-4"></div>


                <div class="col-md-1"></div>
                <div class="col-md-1"></div>
                <div class="col-md-1">
                    <label for="validationCustom04" class="form-label">22</label>
                    <input name="txt22" type="number" class="form-control" id="validationDefault01" value="" min="0">
                </div>
                <div class="col-md-1">
                    <label for="validationCustom04" class="form-label">22.5</label>
                    <input name="txt225"type="number" class="form-control" id="validationDefault01" value="" min="0">
                </div>
                <div class="col-md-1">
                    <label for="validationCustom04" class="form-label">23</label>
                    <input name="txt23" type="number" class="form-control" id="validationDefault01" value="" min="0">
                </div>
                <div class="col-md-1">
                    <label for="validationCustom04" class="form-label">23.5</label>
                    <input name="txt235" type="number" class="form-control" id="validationDefault01" value="" min="0">
                </div>
                <div class="col-md-1">
                    <label for="validationCustom04" class="form-label">24</label>
                    <input name="txt24" type="number" class="form-control" id="validationDefault01" value="" min="0">
                </div>
                <div class="col-md-1">
                    <label for="validationCustom04" class="form-label">24.5</label>
                    <input name="txt245" type="number" class="form-control" id="validationDefault01" value="" min="0">
                </div>


                <div class="col-md-1">
                    <label for="validationCustom04" class="form-label">25</label>
                    <input name="txt25" type="number" class="form-control" id="validationDefault01" value="" min="0">
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-1">
                    <label for="validationCustom04" class="form-label">25.5</label>
                    <input name="txt255" type="number" class="form-control" id="validationDefault01" value="" min="0">
                </div>
                <div class="col-md-1">
                    <label for="validationCustom04" class="form-label">26</label>
                    <input name="txt26" type="number" class="form-control" id="validationDefault01" value="" min="0">
                </div>
                <div class="col-md-1">
                    <label for="validationCustom04" class="form-label">26.5</label>
                    <input name="txt265" type="number" class="form-control" id="validationDefault01" value="" min="0">
                </div>
                <div class="col-md-1">
                    <label for="validationCustom04" class="form-label">27</label>
                    <input name="txt27" type="number" class="form-control" id="validationDefault01" value="" min="0">
                </div>
                <div class="col-md-1">
                    <label for="validationCustom04" class="form-label">27.5</label>
                    <input name="txt275" type="number" class="form-control" id="validationDefault01" value="" min="0">
                </div>


                <div class="col-md-1">
                    <label for="validationCustom04" class="form-label">28</label>
                    <input name="txt28" type="number" class="form-control" id="validationDefault01" value="" min="0">
                </div>
                <div class="col-md-1">
                    <label for="validationCustom04" class="form-label">28.5</label>
                    <input name="txt285" type="number" class="form-control" id="validationDefault01" value="" min="0">
                </div>
                <div class="col-md-2">
                </div>
                <div class="col-md-4">
                </div>
                <div class="col-md-4"><h2>Fecha de Pedido</h2></div>
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>


                <div class="col-md-1"> 
                    <label for="validationCustom04" class="form-label">Dia*</label>
                    <Select name="cmbDiaP" id="cmbDia" class="form-select" id="validationCustom04" required>
                            <?php
                            if(isset($_GET['cmbDia'])){
                                echo '<option value="'.$_GET['cmbDia'].'">'.$_GET['cmbDia'].'</option>';
                            }
                            ?>
                            <option selected disabled value="">Dia</option>
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
                <div class="col-md-2">
                    <label for="validationCustom04" class="form-label">Mes*</label>
                        <select name="cmbMesP" class="form-select" id="validationCustom04" required>
                            <option selected disabled value="">Selecciona un Mes</option>
                            <option value="01">Enero</option>
                            <option value="02">Febrero</option>
                            <option value="03">Marzo</option>
                            <option value="04">Abril</option>
                            <option value="05">Mayo</option>
                            <option value="06">Junio</option>
                            <option value="07">Julio</option>
                            <option value="08">Agosto</option>
                            <option value="09">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>

                        </select>
                </div>
                <div class="col-md-2">
                    <label for="validationCustom04" class="form-label">Año*</label>
                        <select name="cmbAnioP" class="form-select" id="validationCustom04" required>
                            <option selected disabled value="">Año</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            
                        </select>
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-4">
                </div>
                <div class="col-md-4"><h2>Fecha de Estimada llegada</h2></div>
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>


                <div class="col-md-1"> 
                    <label for="validationCustom04" class="form-label">Dia*</label>
                    <Select name="cmbDia" id="cmbDia" class="form-select" id="validationCustom04" required>
                            <?php
                            if(isset($_GET['cmbDia'])){
                                echo '<option value="'.$_GET['cmbDia'].'">'.$_GET['cmbDia'].'</option>';
                            }
                            ?>
                            <option selected disabled value="">Dia</option>
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
                <div class="col-md-2">
                    <label for="validationCustom04" class="form-label">Mes*</label>
                        <select name="cmbMes" class="form-select" id="validationCustom04" required>
                            <option selected disabled value="">Selecciona un Mes</option>
                                <option value="01">Enero</option>
                                <option value="02">Febrero</option>
                                <option value="03">Marzo</option>
                                <option value="04">Abril</option>
                                <option value="05">Mayo</option>
                                <option value="06">Junio</option>
                                <option value="07">Julio</option>
                                <option value="08">Agosto</option>
                                <option value="09">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>

                        </select>
                </div>
                <div class="col-md-2">
                    <label for="validationCustom04" class="form-label">Año*</label>
                        <select name="cmbAnio" class="form-select" id="validationCustom04" required>
                            <option selected disabled value="">Año</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            
                        </select>
                </div>
                <div class="col-md-3">
                </div>


                <div class="col-md-4">
                </div>
                <div class="col-md-3">
                    <input class="btn btn-primary btn-sm " type="submit" name="guardar" value="Guardar">
                </div>
                <div class="col-md-3">
                    
                </div>
                <div class="col-md-3">
                </div>
            </form>

            <?php
                if(isset($_GET['guardar'])){
                    $query="Select MAX(num) as id from pedidos ";
                    $res=mysqli_query($con,$query);
                    $num=$_GET['txtNum'];
                  

                  
                    $status="PEDIDO EN FIRME";
                    $fabrica=$_GET['cmbFabrica'];
                    $sucursal=$_GET['cmbSucursal'];
                    if($sucursal=="Hechura"){
                        $sucursal=$_GET['txtHechura'];
                    }
                    $categoria=$_GET['cmbCategoria'];
                    $horma=$_GET['cmbHorma'];
                    if($horma=="otro"){
                        $horma=$_GET['txtHorma'];
                        $query="Select MAX(codigo) as id from horma ";
                        $res=mysqli_query($con,$query);
                        $id=0;
                        if(!$res){
                            echo "No se importo bien los datos";
                            //echo mysqli_erno();
                        }else{
                            $row=mysqli_fetch_assoc($res);
                            if($row['id']==''){
                                $id=1;
                            }else{ 
                                $id=$row['id'];
                                $id=$id+1;
                            }
                        } 
                        $sqlHorma="INSERT INTO horma(codigo,tipo) VALUES ('".$id."','".$horma."')";
                        $resHorma=mysqli_query($con,$sqlHorma);
                        if (!$resHorma){ 
                            echo  mysqli_error($con);
                            
                        }


                    }


                    $modelo=$_GET['cmbModelo'];
                    if($modelo=="otro"){
                        $modelo=$_GET['txtModelo'];
                        $sql="update modelos set id=id+1";
                        $res=mysqli_query($con,$sql);
                        if(!$res){
                            echo "Fallo";
                            echo  mysqli_error($con);
                        }else{
                            $sqlModelo="insert into modelos(id,modelo) values ('1','".$modelo."')";

                            $resMod=mysqli_query($con,$sqlModelo);
                            if(!$resMod){
                                echo "Fallo";
                                echo  mysqli_error($con);
                            }
                        }

                    }
                    
                    $color=$_GET['cmbColor'];
                    if($color=="otro"){
                        $color=$_GET['txtColor'];

                        $query="Select MAX(codigo) as id from color ";
                        $res=mysqli_query($con,$query);
                        $id=0;
                        if(!$res){
                            echo "No se importo bien los datos";
                            //echo mysqli_erno();
                        }else{
                            $row=mysqli_fetch_assoc($res);
                            if($row['id']==''){
                                $id=1;
                            }else{ 
                                $id=$row['id'];
                                $id=$id+1;
                            }
                        } 
                        $sqlColor="INSERT INTO color(codigo,color) VALUES ('".$id."','".$color."')";
                        $resColor=mysqli_query($con,$sqlColor);
                        if (!$resColor){ 
                            echo  mysqli_error($con);
                            
                        }

                    }
                   
                    $t22=$_GET['txt22'];
                    if($t22=='')
                        $t22=0;
                    
                    $t225=$_GET['txt225'];
                    if($t225=='')
                        $t225=0;
                    
                    $t23=$_GET['txt23'];
                    if($t23=='')
                        $t23=0;
                    
                    $t235=$_GET['txt235'];
                    if($t235=='')
                        $t235=0;
                    
                    $t24=$_GET['txt24'];
                    if($t24=='')
                        $t24=0;

                    $t245=$_GET['txt245'];
                    if($t245=='')
                        $t245=0;

                    $t25=$_GET['txt25'];
                    if($t25=='')
                        $t25=0;

                    $t255=$_GET['txt255'];
                    if($t255=='')
                        $t255=0;

                    $t26=$_GET['txt26'];
                    if($t26=='')
                        $t26=0;

                    $t265=$_GET['txt265'];
                    if($t265=='')
                        $t265=0;

                    $t27=$_GET['txt27'];
                    if($t27=='')
                        $t27=0;

                    $t275=$_GET['txt275'];
                    if($t275=='')
                        $t275=0;

                    $t28=$_GET['txt28'];
                    if($t28=='')
                        $t28=0;

                    $t285=$_GET['txt285'];
                    if($t285=='')
                        $t285=0;


                    $query="Select MAX(num) as id from pedidos where fabrica='".$fabrica."'";
                    $res=mysqli_query($con,$query);
                   
                    $total=$t22+$t225+$t23+$t235+$t24+$t245+$t25+$t255+$t26+$t265+$t27+$t275+$t28+$t285;
                    $diaP=$_GET['cmbDiaP'];
                    $mesP=$_GET['cmbMesP'];
                    $anioP=$_GET['cmbAnioP'];

                    $fechaPedido=$anioP."-".$mesP."-".$diaP;
                   

                    $diaEntrega=$_GET['cmbDia'];
                    $mesEntrega=$_GET['cmbMes'];
                    $anioEntrega=$_GET['cmbAnio'];
                    $fechaEntrega=$anioEntrega."-".$mesEntrega."-".$diaEntrega;
                    $mes="";
                    switch($mesEntrega){
                        case "01":
                            $mes="ENE";
                            break;
                        case "02":
                            $mes="FEB";
                            break;
                        case "03":
                            $mes="MAR";
                            break;
                        case "04":
                            $mes="ABR";
                            break;
                        case "05":
                            $mes="MAY";
                            break;
                        case "06":
                            $mes="JUN";
                            break;
                                
                        case "07":
                            $mes="JUL";
                            break;
                        case "08":
                            $mes="AGO";
                            break;
                        case "09":
                            $mes="SEP";
                            break;
                        case "10":
                            $mes="OCT";
                            break;
                        case "11":
                            $mes="NOV";
                            break;
                        case "12":
                            $mes="DIC";
                        break;
                    }
                    $codigo="";
                    if($num<10){
                        $codigo=$fabrica."_".$mes.substr($anioEntrega,-2)."-00".$num."-".$sucursal;
                    }
                    if($num>=10){
                        $codigo=$fabrica."_".$mes.substr($anioEntrega,-2)."-0".$num."-".$sucursal;
                    }
                    if($num>=100){
                        $codigo=$fabrica."_".$mes.substr($anioEntrega,-2)."-".$num."-".$sucursal;
                    }

                    echo "El numero de folio es ".$codigo;
                    $codigoPed=$codigo."_".$modelo."_".$color;
                    
                    $sqlPedidos="INSERT INTO pedidos(codigo_pedido,num,id_pedido,status,fabrica,sucursal,horma,categoria,modelo,color,
                    T22,T225,T23,T235,T24,T245,T25,T255,T26,T265,T27,T275,T28,T285,num_pares_mod,fechaEntrega,fechaPedido)  VALUES ('".$codigoPed."','".$num."','".$codigo."','".$status."','".$fabrica."','".$sucursal."'
                     ,'".$horma."','".$categoria."','".$modelo."','".$color."','".$t22."','".$t225."','".$t23."','".$t235."'
                     ,'".$t24."','".$t245."','".$t25."','".$t255."','".$t26."','".$t265."','".$t27."'
                     ,'".$t275."','".$t28."','".$t285."','".$total."','".$fechaEntrega."','".$fechaPedido."')";
                     //var_dump($sqlPedidos);
                        $resPedidos=mysqli_query($con,$sqlPedidos);
                        if (!$resPedidos){ 
                            ?>
                            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </symbol>    
                            </svg>
                            <div class="alert alert-danger d-flex align-items-center" role="alert">

                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                                Error con la insercion de datos.
                            </div>
                            </div>
                        <?php
                            echo  mysqli_error($con);          
                        }else{

                              
                        $sqlllegadas="INSERT INTO llegadas(codigo_pedido,status,
                        T22,T225,T23,T235,T24,T245,T25,T255,T26,T265,T27,T275,T28,T285)  VALUES ('".$codigoPed."','DE ESPERA EN LLEGADA','0','0','0','0'
                         ,'0','0','0','0','0','0','0','0','0','0')";
                         $resllegadas=mysqli_query($con,$sqlllegadas);
                         if (!$resllegadas){ 
                            ?>
                            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </symbol>    
                            </svg>
                            <div class="alert alert-danger d-flex align-items-center" role="alert">

                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                                Error con la insercion de datos.
                            </div>
                            </div>
                        <?php
                            echo  mysqli_error($con);          
                        }
                            ?>
                            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </symbol>

                            </svg>
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                <div>
                                    Se insertaron los datos correctamente.
                                </div>
                            </div>
                            <div>
                                ¿Deseas añadir otra variante del modelo <?php echo $modelo?> al mismo pedido?
                            </div>
                           
                            <div class="col-md-3">
                                <form action="a_oPedido.php" method="get">
                                    <input type='hidden' name='codigo_pedido'  value="<?php echo $codigoPed; ?>" >
                                    <input type='hidden' name='numero_pedido'  value="<?php echo $codigo; ?>" >

                                    
                                    <input class="btn btn-success btn-sm" name="aOtroPedido" type="submit"  value="Si">

                                </form>
                                
                            </div>
                            <div class="col-md-3">
                                <input class="btn btn-danger btn-sm " type="submit" onclick = "location='pedidos.php'" value="Regresar">
                            </div>
                        <?php
                        }

                      

                }
            ?>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>


</html>