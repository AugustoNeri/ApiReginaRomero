<?php
require_once("phpClasses/connect.php");

session_start();
if(isset ($_SESSION['email'])) {
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
				$("#cmbSucursal").change(function () {					
					$("#cmbSucursal option:selected").each(function () {
						sucursal = $(this).val();
                        if ( sucursal=="H" ){
                            $("#txtHechura").attr("disabled",false);
                        } else {
                            $("#txtHechura").attr("disabled",true);
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
                        <li><a href="inventario.php">Inventario</a></li>
                        <li><a href="ventas.php">Ventas</a></li>
                        <li><a  href="pedidos.php">Pedidos</a></li>
                        <li><a class="active" href="llegadas.php">Llegadas</a></li>
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
                        <li><a href="pedidos.php">Pedidos</a></li>
                        <li><a class="active"  href="llegadas.php">Llegadas</a></li>
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
                
                $sqlConsulta="select llegadas.codigo_pedido,id_pedido,llegadas.status,fabrica,sucursal,horma,categoria,modelo,
                color,llegadas.t22,llegadas.t225,llegadas.t23,llegadas.t235,llegadas.t24,llegadas.t245,llegadas.t25,llegadas.t255,
                llegadas.t26,llegadas.t265,llegadas.t27,llegadas.t275,llegadas.t28,llegadas.t285,num_pares_mod,
               fechallegada,fechaEntrega,fechaPedido from llegadas inner join pedidos on llegadas.codigo_pedido=pedidos.codigo_pedido 
               where llegadas.codigo_pedido='".$_GET['codigoPedido']."'";

                $res=mysqli_query($con,$sqlConsulta);
                if(!$res){
                    echo "Fallor";
                }else{
                     $row=mysqli_fetch_assoc($res);
                ?>
                 <div class="col-md-3">
                        <input class="btn btn-primary btn-sm " type="submit" onclick = "location='llegadas.php'" value="Regresar">
                </div>
                <form class="row g-3" action="" method="get">
                    <input type='hidden' name='codigoPedido'  value="<?php echo $row['codigo_pedido']; ?>" >

                    <input type='hidden' name='txtIdPedido'  value="<?php echo $row['id_pedido']; ?>" >
                    <div class="col-md-4">
                        <label for="validationCustom04" class="form-label">Codigo del pedido</label>
                        <input  name="txtStatus" id="codPed" type="text" class="form-control" value="<?php echo $row['id_pedido']; ?>"  disabled>

                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom04" class="form-label">Status</label>
                        <input  name="txtStatus" id="txtStatus" type="text" class="form-control" value="<?php echo $row['status']; ?>"  disabled>

                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom04" class="form-label">Fabrica</label>
                        <input  name="txtFabrica" id="txtFabrica" type="text" class="form-control" value="<?php echo $row['fabrica']; ?>"  disabled>

                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom04" class="form-label">Sucursal</label>
                        <input  name="txtSucursal" id="txtSucursal" type="text" class="form-control" value="<?php echo $row['sucursal']; ?>"  disabled>
                    </div> 
                    
                    <div class="col-md-4">
                        <label for="validationCustom04" class="form-label">Horma</label>
                        <input  name="txtHorma" id="txtHorma" type="text" class="form-control" value="<?php echo $row['horma']; ?>"  disabled>
                    </div>


                    <div class="col-md-4">
                        <label for="validationCustom04" class="form-label">Categoria</label>
                        <input  name="txtCategoria" id="txtCategoria" type="text" class="form-control" value="<?php echo $row['categoria']; ?>"  disabled>
                    </div>
                    <div class="col-md-4">
                        <input type='hidden' name='modelo' value="<?php echo $row['modelo']; ?>">
                        <label for="validationCustom04" class="form-label">Modelo</label>
                        <input  name="txtModelo" id="txtModelo" type="text" class="form-control" value="<?php echo $row['modelo']; ?>"  disabled>    
                    </div>
                   
                    <div class="col-md-4">
                        <label for="validationCustom04" class="form-label">Color</label>
                        <input type='hidden' name='color' value="<?php echo $row['color']; ?>">
                        <input  name="txtColor" id="txtColor" type="text" class="form-control" value="<?php echo $row['color']; ?>"  disabled>
                    </div>
                    
                   
                    
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                    

                    <div class="col-md-4"><p class="h2">Tallas</p></div><div class="col-md-4"></div>


                    <div class="col-md-1"></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">22</label>
                        <input name="txt22" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['t22'];?>" >
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">22.5</label>
                        <input name="txt225"type="number" class="form-control" id="validationDefault01" value="<?php echo $row['t225'];?>" >
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">23</label>
                        <input name="txt23" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['t23'];?>" >
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">23.5</label>
                        <input name="txt235" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['t235'];?>" >
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">24</label>
                        <input name="txt24" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['t24'];?>" >
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">24.5</label>
                        <input name="txt245" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['t245'];?>" >
                    </div>


                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">25</label>
                        <input name="txt25" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['t25'];?>" >
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
                        <input name="txt255" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['t255'];?>" >
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">26</label>
                        <input name="txt26" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['t26'];?>" >
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">26.5</label>
                        <input name="txt265" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['t265'];?>" >
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">27</label>
                        <input name="txt27" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['t27'];?>" >
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">27.5</label>
                        <input name="txt275" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['t275'];?>" >
                    </div>


                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">28</label>
                        <input name="txt28" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['t28'];?>" >
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">28.5</label>
                        <input name="txt285" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['t285'];?>" >
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4"></div>
                    <?php
                    $arraFechaL=explode('-',$row['fechallegada']);
                    
                    ?>
                    <div class="col-md-4"><h2>Fecha de llegada</h2></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">Dia</label>
                        <Select name="cmbDia" id="cmbDia" class="form-select" id="validationCustom04" required>
                            <option  value="<?php echo  $arraFechaL[2];?>"><?php echo  $arraFechaL[2];;?> (Registroactual)</option>                              
                            <option disabled value="">Dia</option>
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
                        <label for="validationCustom04" class="form-label">Mes</label>
                        <select name="cmbMes" class="form-select" id="validationCustom04" required>
                                <option  value="<?php echo $arraFechaL[1];?>"><?php
                                $mes="";
                                 switch ($arraFechaL[1]){
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
                        <label for="validationCustom04" class="form-label">Año</label>
                        <select name="cmbAnio" class="form-select" id="validationCustom04" required>
                                <option  value="<?php echo $arraFechaL[0];?>"><?php echo $arraFechaL[0];?> (Registroactual)</option>
                                <option  value="">Año</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                
                            </select>
                    </div>
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4"><p class="h2">Tallas(Complementos)</p></div><div class="col-md-4"></div>


                    <div class="col-md-1"></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">22</label>
                        <input name="txt22com" type="number" class="form-control" id="validationDefault01" value="0" >
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">22.5</label>
                        <input name="txt225com"type="number" class="form-control" id="validationDefault01" value="0" >
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">23</label>
                        <input name="txt23com" type="number" class="form-control" id="validationDefault01"  value="0">
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">23.5</label>
                        <input name="txt235com" type="number" class="form-control" id="validationDefault01"  value="0">
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">24</label>
                        <input name="txt24com" type="number" class="form-control" id="validationDefault01" value="0">
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">24.5</label>
                        <input name="txt245com" type="number" class="form-control" id="validationDefault01"  value="0">
                    </div>


                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">25</label>
                        <input name="txt25com" type="number" class="form-control" id="validationDefault01" value="0">
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
                        <input name="txt255com" type="number" class="form-control" id="validationDefault01"  value="0">
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">26</label>
                        <input name="txt26com" type="number" class="form-control" id="validationDefault01" value="0">
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">26.5</label>
                        <input name="txt265com" type="number" class="form-control" id="validationDefault01"  value="0">
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">27</label>
                        <input name="txt27com" type="number" class="form-control" id="validationDefault01"  value="0">
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">27.5</label>
                        <input name="txt275com" type="number" class="form-control" id="validationDefault01"  value="0">
                    </div>


                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">28</label>
                        <input name="txt28com" type="number" class="form-control" id="validationDefault01"  value="0">
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">28.5</label>
                        <input name="txt285com" type="number" class="form-control" id="validationDefault01"  value="0">
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-4"></div>
                    
                    <div class="col-md-4"><h2>Fecha de llegada</h2></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">Dia</label>
                        <Select name="cmbDiaCom" id="cmbDiaCom" class="form-select" id="validationCustom04" >
                                <option  selected value="">Dia</option>
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
                        <label for="validationCustom04" class="form-label">Mes</label>
                            <select name="cmbMesCom" class="form-select" id="validationCustom04" >
                                <option selected value="">Selecciona un Mes</option>
                                
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
                        <label for="validationCustom04" class="form-label">Año</label>
                            <select name="cmbAnioCom" class="form-select" id="validationCustom04" >
                                <option selected value="">Año</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>
                    </div>
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4"><p class="h2">Tallas(Adicionales)</p></div><div class="col-md-4"></div>

                    <div class="col-md-1"></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">22</label>
                        <input name="txt22adi" type="number" class="form-control" id="validationDefault01"  value="0">
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">22.5</label>
                        <input name="txt225adi"type="number" class="form-control" id="validationDefault01"  value="0">
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">23</label>
                        <input name="txt23adi" type="number" class="form-control" id="validationDefault01"  value="0">
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">23.5</label>
                        <input name="txt235adi" type="number" class="form-control" id="validationDefault01"  value="0">
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">24</label>
                        <input name="txt24adi" type="number" class="form-control" id="validationDefault01" value="0">
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">24.5</label>
                        <input name="txt245adi" type="number" class="form-control" id="validationDefault01"  value="0">
                    </div>


                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">25</label>
                        <input name="txt25adi" type="number" class="form-control" id="validationDefault01" value="0">
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
                        <input name="txt255adi" type="number" class="form-control" id="validationDefault01"  value="0">
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">26</label>
                        <input name="txt26adi" type="number" class="form-control" id="validationDefault01" value="0">
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">26.5</label>
                        <input name="txt265adi" type="number" class="form-control" id="validationDefault01" value="0" >
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">27</label>
                        <input name="txt27adi" type="number" class="form-control" id="validationDefault01"  value="0">
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">27.5</label>
                        <input name="txt275adi" type="number" class="form-control" id="validationDefault01"  value="0">
                    </div>


                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">28</label>
                        <input name="txt28adi" type="number" class="form-control" id="validationDefault01"  value="0">
                    </div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">28.5</label>
                        <input name="txt285adi" type="number" class="form-control" id="validationDefault01" value="0" >
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-4"></div>


                    <div class="col-md-4"><h2>Fecha de llegada</h2></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-1">
                        <label for="validationCustom04" class="form-label">Dia</label>
                        <Select name="cmbDiaadi" id="cmbDia" class="form-select" id="validationCustom04" >
                                <?php
                                if(isset($_GET['cmbDia'])){
                                    echo '<option value="'.$_GET['cmbDia'].'">'.$_GET['cmbDia'].'</option>';
                                }
                                ?>
                                <option selected value="">Dia</option>
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
                        <label for="validationCustom04" class="form-label">Mes</label>
                            <select name="cmbMesadi" class="form-select" id="validationCustom04" >
                                <option selected value="">Selecciona un Mes</option>
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
                        <label for="validationCustom04" class="form-label">Año</label>
                            <select name="cmbAnioadi" class="form-select" id="validationCustom04" >
                                <option selected value="">Año</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                
                            </select>
                    </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-3"></div>
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
                    $idPedido=$_GET['txtIdPedido'];
                    $modelo=$_GET['modelo'];
                    $color=$_GET['color'];
                    
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

                    
                    $t22com=$_GET['txt22com'];
                    if($t22com=='')
                        $t22com=0;
                    
                    $t225com=$_GET['txt225com'];
                    if($t225com=='')
                        $t225com=0;
                    
                    $t23com=$_GET['txt23com'];
                    if($t23com=='')
                        $t23com=0;
                    
                    $t235com=$_GET['txt235com'];
                    if($t235com=='')
                        $t235com=0;
                    
                    $t24com=$_GET['txt24com'];
                    if($t24com=='')
                        $t24com=0;

                    $t245com=$_GET['txt245com'];
                    if($t245com=='')
                        $t245com=0;

                    $t25com=$_GET['txt25com'];
                    if($t25com=='')
                        $t25com=0;

                    $t255com=$_GET['txt255com'];
                    if($t255com=='')
                        $t255com=0;

                    $t26com=$_GET['txt26com'];
                    if($t26com=='')
                        $t26com=0;

                    $t265com=$_GET['txt265com'];
                    if($t265com=='')
                        $t265com=0;

                    $t27com=$_GET['txt27com'];
                    if($t27com=='')
                        $t27com=0;

                    $t275com=$_GET['txt275com'];
                    if($t275com=='')
                        $t275com=0;

                    $t28com=$_GET['txt28com'];
                    if($t28com=='')
                        $t28com=0;

                    $t285com=$_GET['txt285com'];
                    if($t285com=='')
                        $t285com=0;

                    $t22adi=$_GET['txt22adi'];
                    if($t22adi=='')
                        $t22adi=0;
                    
                    $t225adi=$_GET['txt225adi'];
                    if($t225adi=='')
                        $t225adi=0;
                    
                    $t23adi=$_GET['txt23adi'];
                    if($t23adi=='')
                        $t23adi=0;
                    
                    $t235adi=$_GET['txt235adi'];
                    if($t235adi=='')
                        $t235adi=0;
                    
                    $t24adi=$_GET['txt24adi'];
                    if($t24adi=='')
                        $t24adi=0;

                    $t245adi=$_GET['txt245adi'];
                    if($t24adi=='')
                        $t24adi=0;

                    $t25adi=$_GET['txt25adi'];
                    if($t25adi=='')
                        $t25com=0;

                    $t255adi=$_GET['txt255adi'];
                    if($t255adi=='')
                        $t255adi=0;

                    $t26adi=$_GET['txt26adi'];
                    if($t26adi=='')
                        $t26adi=0;

                    $t265adi=$_GET['txt265adi'];
                    if($t265adi=='')
                        $t265adi=0;

                    $t27adi=$_GET['txt27adi'];
                    if($t27adi=='')
                        $t27adi=0;

                    $t275adi=$_GET['txt275adi'];
                    if($t275adi=='')
                        $t275adi=0;

                    $t28adi=$_GET['txt28adi'];
                    if($t28adi=='')
                        $t28adi=0;

                    $t285adi=$_GET['txt285adi'];
                    if($t285adi=='')
                        $t285adi=0;
                   
                 
                    $t22=$t22+$t22com+$t22adi;
                    $t225=$t225+$t225com+$t225adi;
                    $t23=$t23+$t23com+$t23adi;
                    $t235=$t235+$t235com+$t235adi;             
                    $t24=$t24+$t24com+$t24adi;
                    $t245=$t245+$t245com+$t245adi;
                    $t25=$t25+$t25com+$t25adi;
                    $t255=$t255+$t255com+$t255adi;
                    $t26=$t26+$t26com+$t26adi;
                    $t265=$t265+$t265com+$t265adi;
                    $t27=$t27+$t27com+$t27adi;
                    $t275=$t275+$t275com+$t275adi;
                    $t28=$t28+$t28com+$t28adi;
                    $t285=$t285+$t285com+$t285adi;
                    $diaEstimado="";
                    $mesEstimado="";
                    $anioEstimado="";
                    if($_GET['cmbDia']!='' && $_GET['cmbMes']!='' && $_GET['cmbAnio']!=''){
                        $diaEstimado=$_GET['cmbDia'];
                        $mesEstimado=$_GET['cmbMes'];
                        $anioEstimado=$_GET['cmbAnio'];
                    }
                    if($_GET['cmbDiaCom']!='' && $_GET['cmbMesCom']!='' && $_GET['cmbAnioCom']!=''){
                        $diaEstimado=$_GET['cmbDiaCom'];
                        $mesEstimado=$_GET['cmbMesCom'];
                        $anioEstimado=$_GET['cmbAnioCom'];
                    }
                    if($_GET['cmbDiaadi']!='' && $_GET['cmbMesadi']!='' && $_GET['cmbAnioadi']!=''){
                        $diaEstimado=$_GET['cmbDiaadi'];
                        $mesEstimado=$_GET['cmbMesadi'];
                        $anioEstimado=$_GET['cmbAnioadi'];
                    }
                    $fechallegada=$anioEstimado."-".$mesEstimado."-".$diaEstimado;
                    $contTallas=$t22+$t225+$t23+$t235+$t24+$t245+$t25+$t255+$t26+$t265+$t27+$t275+$t28+$t285;
                    var_dump($contTallas);
                    $conPedidos="select num_pares_mod from pedidos  where id_pedido='".$idPedido."' and modelo='".$modelo."' and color='".$color."' ";
                    $resPed=mysqli_query($con,$conPedidos);
                    $rowPed=mysqli_fetch_assoc($resPed);
                    $status="";
                    if($contTallas<$rowPed['num_pares_mod']){
                        $status="PARCIAL";
                    }
                    if($contTallas>=$rowPed['num_pares_mod']){
                        $status="ENTREGADO";
                    }
                
                    
                    
                 

                    $sqlPedidos="update llegadas set status='".$status."',T22='".$t22."',T225='".$t225."',T23='".$t23."',
                     T235='".$t235."',T24='".$t24."',T245='".$t245."',T25='".$t25."',T255='".$t255."',T26='".$t26."',T265='".$t265."',T27='".$t27."'
                     ,T275='".$t275."',T28='".$t28."',T285='".$t285."',fechallegada='".$fechallegada."' where codigo_pedido='".$_GET['codigoPedido']."' ";
                     
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
                            $sqlPedidos="update pedidos set status='".$status."' where codigo_pedido='".$_GET['codigoPedido']."' ";
                            $resPedidos=mysqli_query($con,$sqlPedidos);
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
                                    <input class="btn btn-primary btn-sm " type="submit" onclick = "location='llegadas.php'" value="Regresar">
                                </div>
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

<?php
}
?>