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
                        <li><a href="inventario.php">Inventario</a></li>
                        <li><a href="ventas.php">Ventas</a></li>
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
                        <li><a href="inventario.php">Inventario</a></li>
                        <li><a href="ventas.php">Ventas</a></li>
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


        <div class="col-md-4"></div><div class="col-md-4"><p class="h1">Actualizar pedido</p></div><div class="col-md-4"></div>

                <?php
            if(isset($_GET['modificarPedido'])){
                
                $sqlConsulta="select codigo_pedido,num,id_pedido,status,fabrica,sucursal,horma,categoria,modelo,color,T22,T225,T23,T235,
                T24,T245,T25,T255,T26,T265,T27,T275,T28,T285,fechaEntrega,fechaPedido from pedidos 
                where codigo_pedido='".$_GET['codigoPedido']."'";

                $res=mysqli_query($con,$sqlConsulta);
                if(!$res){
                    echo "Fallor";
                    echo mysqli_error($con);
                }else{
                     $row=mysqli_fetch_assoc($res);
                ?>
                 <div class="col-md-3">
                        <input class="btn btn-primary btn-sm " type="submit" onclick = "location='pedidos.php'" value="Regresar">
                </div>
                <form class="row g-3" action="" method="get">
                    <input type='hidden' name='codigoPedido'  value="<?php echo $row['codigo_pedido']; ?>" >

                    <input type='hidden' name='num'  value="<?php echo $row['num']; ?>" >
                    <input type='hidden' name='txtIdPedido'  value="<?php echo $row['id_pedido']; ?>" >
                    <div class="col-md-4">
                        <label for="validationCustom04" class="form-label">Folio de pedido</label>
                        <input  type="text" class="form-control" value="<?php echo $row['id_pedido'];?>" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom04" class="form-label">Status</label>
                            <select name="cmbStatus" class="form-select" id="cmbStatus"  required>
                               
                                <option  value="<?php echo $row['status'];?>"><?php echo $row['status'];?> (Registroactual)</option>
                                <option  disabled value="">Seleccione un status</option>
                                <?php
                                    $sql="select status from statuspedidos order by status asc";
                                    $res=mysqli_query($con,$sql);
                                    if(!$res){
                                        echo "fallo";
                                    }else{
                                        while($rowStatus=mysqli_fetch_assoc($res)){
                                        echo '<option value="'.$rowStatus['status'].'">'.$rowStatus['status'].'</option>';
                                        }
                                    }

                                ?>
                            </select>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom04" class="form-label">Fabrica</label>
                            <select name="cmbFabrica" class="form-select" id="cmbFabrica"  required>
                                <option  value="<?php echo $row['fabrica'];?>"><?php echo $row['fabrica'];?> (Registroactual)</option>
                                <option  disabled value="">Seleccione una fabrica</option>
                                <?php
                                    $sql="select codigo,fabrica from fabricas order by fabrica asc";
                                    $res1=mysqli_query($con,$sql);
                                    if(!$res1){
                                        echo "fallo";
                                    }else{
                                        while($rowFabrica=mysqli_fetch_assoc($res1)){
                                        echo '<option value="'.$rowFabrica['codigo'].'">'.$rowFabrica['fabrica'].'</option>';
                                        }
                                    }

                                ?>
                            </select>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom04" class="form-label">Sucursal</label>
                            <select name="cmbSucursal" class="form-select" id="cmbSucursal" required>
                                <?php
                                $sqlSucursal="select codigo,sucursal from sucursalPedidos where codigo='".$row['sucursal']."'";
                                $resSuc=mysqli_query($con,$sqlSucursal);
                                $rowSuc=mysqli_fetch_assoc($resSuc)
                                ?>
                                
                                <option  value="<?php echo $rowSuc['codigo'];?>"><?php echo $rowSuc['sucursal'];?> (Registroactual)</option>
                                <option  disabled value="">Seleccione una fabrica</option>
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
                        <label for="validationCustom04" class="form-label">Numero de pedido
</label>
                        <input name="numPedido" id="numPedido"  type="number" class="form-control" value="<?php echo $row['num'];?>">
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom04" class="form-label">Horma</label>
                            <select name="cmbHorma"  class="form-select" id="cmbHorma" required>
                            <option  value="<?php echo $row['horma'];?>"><?php echo $row['horma'];?> (Registroactual)</option>
                                <option  disabled value="">Seleccione una horma</option>
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
                        <label for="validationCustom04" class="form-label">Categoria</label>
                            <select name="cmbCategoria" class="form-select" id="cmbCategoria" required>
                                <option  value="<?php echo $row['categoria'];?>"><?php echo $row['categoria'];?> (Registroactual)</option>
                                <option  disabled value="">Seleccione una categoria</option>
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
                        <input type='hidden' name='modelo' value="<?php echo $row['modelo']; ?>">
                        <label for="validationCustom04" class="form-label">Modelo</label>
                            <select name="cmbModelo" class="form-select" id="cmbModelo" required>
                                <option  value="<?php echo $row['modelo'];?>"><?php echo $row['modelo'];?> (Registroactual)</option>
                                <option  disabled value="">Seleccione un modelo</option>
                                <?php
                                $sql="select distinct(modelo) from tcat_modelo order by modelo asc";
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
                        <input type='hidden' name='color' value="<?php echo $row['color']; ?>">
                        <label for="validationCustom04" class="form-label">Color</label>
                            <select name="cmbColor" class="form-select" id="cmbColor" required>
                                <option  value="<?php echo $row['color'];?>"><?php echo $row['color'];?> (Registroactual)</option>
                                <option  disabled value="">Seleccione un modelo</option>
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
                    

                    <div class="col-md-4"><p class="h2">Tallas</p></div><div class="col-md-4"></div>


                    <div class="col-md-1"></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">22</label>
                        <input name="txt22" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['T22'];?>" >
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">22.5</label>
                        <input name="txt225"type="number" class="form-control" id="validationDefault01" value="<?php echo $row['T225'];?>" >
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">23</label>
                        <input name="txt23" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['T23'];?>" >
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">23.5</label>
                        <input name="txt235" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['T235'];?>" >
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">24</label>
                        <input name="txt24" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['T24'];?>" >
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">24.5</label>
                        <input name="txt245" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['T245'];?>" >
                    </div>


                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">25</label>
                        <input name="txt25" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['T25'];?>" >
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
                        <input name="txt255" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['T255'];?>" >
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">26</label>
                        <input name="txt26" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['T26'];?>" >
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">26.5</label>
                        <input name="txt265" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['T265'];?>" >
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">27</label>
                        <input name="txt27" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['T27'];?>" >
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">27.5</label>
                        <input name="txt275" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['T275'];?>" >
                    </div>


                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">28</label>
                        <input name="txt28" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['T28'];?>" >
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">28.5</label>
                        <input name="txt285" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['T285'];?>" >
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-4">
                </div>
                    <?php
                    $arraFechaP=explode('-',$row['fechaPedido']);
                    ?>
                    <div class="col-md-4"><h2>Fecha de Pedido</h2></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>

                    <div class="col-md-1"> 
                    <label for="validationCustom04" class="form-label">Dia</label>
                    <Select name="cmbDiaP" id="cmbDiaP" class="form-select" id="validationCustom04" required>
                        <option  value="<?php echo $arraFechaP[2];?>"><?php echo $arraFechaP[2];?> (Registroactual)</option>
                            <option  value="">Dia</option>
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
                        <label for="validationCustom04" class="form-label">Mes de entrega</label>
                        <select name="cmbMesP" class="form-select" id="validationCustom04" required>
                                <option  value="<?php echo $arraFechaP[1];?>"><?php
                                $mes="";
                                 switch ($arraFechaP[1]){
                                    case "01":
                                        $mes="ENERO";
                                        break;
                                    case "02":
                                        $mes="FEBRERO";
                                        break;
                                    case "03":
                                        $mes="MARZO";
                                        break;
                                    case "04":
                                        $mes="ABRIL";
                                        break;
                                    case "05":
                                        $mes="MAYO";
                                        break;
                                    case "06":
                                        $mes="JUNIO";
                                        break;
                                            
                                    case "07":
                                        $mes="JULIO";
                                        break;
                                    case "08":
                                        $mes="AGOSTO";
                                        break;
                                    case "09":
                                        $mes="SEPTIEMBRE";
                                        break;
                                    case "10":
                                        $mes="OCTUBRE";
                                        break;
                                    case "11":
                                        $mes="NOVIEMBRE";
                                        break;
                                    case "12":
                                        $mes="DICIEMBRE";
                                    break;
                                 }
                                 echo $mes;
                                 ?> (Registroactual)</option>
                                <option  value="">Seleccione un MES</option>
                                <option value="01">ENERO</option>
                                <option value="02">FEBRERO</option>
                                <option value="03">MARZO</option>
                                <option value="04">ABRIL</option>
                                <option value="05">MAYO</option>
                                <option value="06">JUNIO</option>
                                <option value="07">JULIO</option>
                                <option value="08">AGOSTO</option>
                                <option value="09">SEPTIEMBRE</option>
                                <option value="10">OCTUBRE</option>
                                <option value="11">NOVIEMBRE</option>
                                <option value="12">DICIEMBRE</option>

                            </select>
                    </div>
                    <div class="col-md-2">
                        <label for="validationCustom04" class="form-label">Año de entrega</label>
                            <select name="cmbAnioP" class="form-select" id="validationCustom04" required>
                                <option  value="<?php echo $arraFechaP[0];?>"><?php echo $arraFechaP[0];?> (Registroactual)</option>
                                <option  value="">Año</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                
                            </select>
                    </div>
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-4"></div>
                    <?php
                    $arraFechaE=explode('-',$row['fechaEntrega']);
                    ?>
                    <div class="col-md-4"><h2>Fecha de Entrega</h2></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>

                    <div class="col-md-1"> 
                    <label for="validationCustom04" class="form-label">Dia</label>
                    <Select name="cmbDiaE" id="cmbDiaE" class="form-select" id="validationCustom04" required>
                        <option  value="<?php echo $arraFechaE[2];?>"><?php echo $arraFechaE[2];?> (Registroactual)</option>
                            <option  value="">Dia</option>
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
                        <label for="validationCustom04" class="form-label">Mes de entrega</label>
                            <select name="cmbMesE" class="form-select" id="validationCustom04" required>
                                <option  value="<?php echo $arraFechaE[1];?>"><?php
                                $mes="";
                                 switch ($arraFechaE[1]){
                                    case "01":
                                        $mes="ENERO";
                                        break;
                                    case "02":
                                        $mes="FEBRERO";
                                        break;
                                    case "03":
                                        $mes="MARZO";
                                        break;
                                    case "04":
                                        $mes="ABRIL";
                                        break;
                                    case "05":
                                        $mes="MAYO";
                                        break;
                                    case "06":
                                        $mes="JUNIO";
                                        break;
                                            
                                    case "07":
                                        $mes="JULIO";
                                        break;
                                    case "08":
                                        $mes="AGOSTO";
                                        break;
                                    case "09":
                                        $mes="SEPTIEMBRE";
                                        break;
                                    case "10":
                                        $mes="OCTUBRE";
                                        break;
                                    case "11":
                                        $mes="NOVIEMBRE";
                                        break;
                                    case "12":
                                        $mes="DICIEMBRE";
                                    break;
                                 }
                                 echo $mes;
                                 ?> (Registroactual)</option>
                                <option  value="">Seleccione un MES</option>
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
                        <label for="validationCustom04" class="form-label">Año de entrega</label>
                            <select name="cmbAnioE" class="form-select" id="validationCustom04" required>
                                <option  value="<?php echo $arraFechaE[0];?>"><?php echo $arraFechaE[0];?> (Registroactual)</option>
                                <option  value="">Año</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                
                            </select>
                    </div>

                    <div class="col-md-3">
                       
                    </div>
                   
                    <div class="col-md-3">
                        <input class="btn btn-primary btn-sm " type="submit" name="actualizar" value="actualizar">
                    </div>
                    
                    <div class="col-md-3">
                    </div>
                </form>
        <?php
                }
            
                
            }
        ?>
            

            <?php
                if(isset($_GET['actualizar'])){
                    $query="Select MAX(num) as id from pedidos ";
                    $res=mysqli_query($con,$query);
                  
                    $status=strtoupper($_GET['cmbStatus']);
                    $fabrica=$_GET['cmbFabrica'];
                    $sucursal=$_GET['cmbSucursal'];
                   
                    $num=$_GET['numPedido'];
                    
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

                    $total=$t22+$t225+$t23+$t235+$t24+$t245+$t25+$t255+$t26+$t265+$t27+$t275+$t28+$t285;
                    $diaEntrega=$_GET['cmbDiaE'];
                    $mesEntrega=$_GET['cmbMesE'];
                    $anioEntrega=$_GET['cmbAnioE'];
                    $fechaEntrega=$anioEntrega."-".$mesEntrega."-".$diaEntrega;
                    $fechaPedido=$_GET['cmbAnioP']."-".$_GET['cmbMesP']."-".$_GET['cmbDiaP'];

                    $idPedido=$_GET['txtIdPedido'];
                    $arrayPedido=explode('_',$idPedido);
                    $auxFabrica=$arrayPedido[0];
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
                    if($fabrica!=$auxFabrica){
                        if($num<10){
                        $codigo=$fabrica."_".$mes.substr($anioEntrega,-2)."-00".$num."-".$sucursal;
                            
                        }
                        if($num>=10){
                            $codigo=$fabrica."_".$mes.substr($anioEntrega,-2)."-0".$num."-".$sucursal;
                        }
                        if($num>=100){
                            $codigo=$fabrica."_".$mes.substr($anioEntrega,-2)."-".$num."-".$sucursal;
                        }
                    }else{
                        $arrayPedido2=explode('-',$arrayPedido[1]);
                       
                        if($num<10){
                            $codigo=$fabrica."_".$mes.substr($anioEntrega,-2)."-00".$num."-".$sucursal;  
                        }
                        if($num>=10){
                            $codigo=$fabrica."_".$mes.substr($anioEntrega,-2)."-0".$num."-".$sucursal;
                        }
                        if($num>=100){
                            $codigo=$fabrica."_".$mes.substr($anioEntrega,-2)."-".$num."-".$sucursal;
                        }


                    }
                    $codPed=$codigo."_".$modelo."_".$color;
                    
                 
                   
                    $sqlPedidos="update pedidos set codigo_pedido='".$codPed."',num='".$num."',
                   id_pedido='".$codigo."',status='".$status."',fabrica='".$fabrica."',sucursal='".$sucursal."'
                     ,horma='".$horma."',categoria='".$categoria."',modelo='".$modelo."',color='".$color."',T22='".$t22."',T225='".$t225."',T23='".$t23."',
                     T235='".$t235."',T24='".$t24."',T245='".$t245."',T25='".$t25."',T255='".$t255."',T26='".$t26."',T265='".$t265."',T27='".$t27."'
                     ,T275='".$t275."',T28='".$t28."',T285='".$t285."',num_pares_mod='".$total."',fechaEntrega='".$fechaEntrega."',fechaPedido='".$fechaPedido."'
                     where codigo_pedido='".$_GET['codigoPedido']."'";
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
                                Error con la actualizacion  de datos.
                            </div>
                            </div>
                        <?php
                            echo  mysqli_error($con);          
                        }else{
                            ?>
                            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </symbol>

                            </svg>
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                <div>
                                    Datos actualizados con éxito.
                                </div>
                                <div class="col-md-3">
                                    <input class="btn btn-primary btn-sm " type="submit" onclick = "location='pedidos.php'" value="Regresar">
                                </div>
                            </div>

                        <?php
                            $status1="";
                            if($status=='PEDIDO EN FIRME')
                                $status1="DE ESPERA EN LLEGADA";

                            if($status=='PARCIAL')
                                $status1="PARCIAL";
                            
                            if($status=='ENTREGADO')
                                $status1="ENTREGADO";
                            if($status=='CANCELADO')
                                $status1="CANCELADO";
                            
                            $sqlLlegadas="update llegadas set codigo_pedido='".$codPed."',status='".$status1."'
                            where codigo_pedido='".$_GET['codigoPedido']."'"; 
                            $resLlegada=mysqli_query($con,$sqlLlegadas);
                            if (!$resLlegada){ 
                                ?>
                                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </symbol>    
                                </svg>
                                <div class="alert alert-danger d-flex align-items-center" role="alert">
    
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                <div>
                                    Error con la actualizacion  de datos.
                                </div>
                                </div>
                            <?php
                                echo  mysqli_error($con);          
                            }

                        }



                }
            ?>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>


</html>