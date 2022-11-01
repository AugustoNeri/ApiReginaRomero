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
                $("#modelo").change(function () {					
					$("#modelo option:selected").each(function () {
						modelo = $(this).val();
						$.get("phpClasses/getColorPedidos.php", { modelo: modelo }, function(data){
							$("#color").html(data);
						});

					});
				})
                $("#modelo").change(function () {					
					$("#modelo option:selected").each(function () {
						modelo = $(this).val();
						$.get("phpClasses/getTallasPedidos.php", { modelo: modelo }, function(data){
							$("#talla").html(data);
						});
                        
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

        <div id="sidebar">
                <form class="row g-3" action="" method="get">
                <center><button class="btn btn-primary btn-sm "><i class="fa fa-search"></i> Generar Reporte</button></center>
                <label for="exampleFormControlInput1" class="form-label"><h5>Fecha de Pedido (Obligatorio)</h5></label>
                <div class="row">
                        <div class="col-md-4">
                        <Select name="cmbDia" id="cmbDia" class="form-select form-select-sm" aria-label=".form-select-sm example">
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
                            <Select name="cmbMes" id="cmbMes"  class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <?php
                            if(isset($_GET['cmbMes'])){
                                echo '<option value="'.$_GET['cmbMes'].'">'.$_GET['cmbMes'].'</option>';
                            }
                            ?>
                                        <option value="">Mes</option>
                                        <option   value="01">ENERO</option>
                                        <option   value="02">FEBRERO</option>
                                        <option   value="03">MARZO</option>
                                        <option   value="04">ABRIL</option>
                                        <option   value="05">MAYO</option>
                                        <option   value="06">JUNIO</option>
                                        <option   value="07">JULIO</option>
                                        <option   value="08">AGOSTO</option>
                                        <option   value="09">SEPTIEMBRE</option>
                                        <option   value="10">OCTUBRE</option>
                                        <option   value="11">NOVIEMBRE</option>
                                        <option   value="12">DICIEMBRE</option>
                            </Select>
                        </div>
                        <div class="col-md-4">
                             <Select name="cmbAnio" id="cmbAnio"  class="form-select form-select-sm" aria-label=".form-select-sm example">
                                <?php
                                if(isset($_GET['cmbMes'])){
                                    echo '<option value="'.$_GET['cmbAnio'].'">'.$_GET['cmbAnio'].'</option>';
                                }
                                ?>
                                <option value="">Año</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </Select>
                        </div>

                    </div>
                    <label for="exampleFormControlInput1" class="form-label"><h4>Status</h4></label>
                    <div class="Status">
                        <select name="status" id="status" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                <?php
                                    $sql="select status from statusllegadas order by status asc";
                                    $res=mysqli_query($con,$sql);
                                    if(!$res){
                                        echo mysqli_error($con);
                                    }else{
                                        if(isset($_GET['sucursal'])){
                                            $sql="select status from statuspedidos where status='".$_GET['status']."'";
                                            $res1=mysqli_query($con, $sql);
                                            if (!$res1){ 
                                                echo  mysqli_error($con);
                                                
                                            }else{
                                                $row1=mysqli_fetch_assoc($res1);
                                                echo "<option value='".$row1['status']."'>".$row1['status']."</option>";
                                            }
                                        }
                                        echo "<option value=''>Seleccione una status</option>";
                                        if(mysqli_num_rows($res)>0){
                                            while($row=mysqli_fetch_assoc($res)){
                                                if($row['status']!='')
                                                echo "<option value='".$row['status']."'>".$row['status']."</option>";
        
                                            }
                                        }
                                    }  
                        ?>
                        </select>
                    </div>
                     
                    <label for="exampleFormControlInput1" class="form-label"><h4>FOLIO pedido</h4></label>
                    <div class="pedido">
                    <?php
                        if(isset($_GET['idPedido'])){

                        echo "<input name='idPedido' type='text' class='form-control' id='validationDefault01' value='".$_GET['idPedido']."'>";
                        }else{
                        ?>
                            <input name="idPedido" type="text" class="form-control" id="validationDefault01" value="" >
                        <?php
                        }
                        ?>
                    </div>
                                   
                    <label for="exampleFormControlInput1" class="form-label"><h4>Modelo</h4></label>
                    <div class="Modelo">
                        <select name="modelo" id="modelo" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <?php
                             $sql="select distinct(modelo) from pedidos order by modelo asc";
                             $res=mysqli_query($con,$sql);
                             if(!$res){
                                 echo mysqli_error($con);
                             }else{
                                 if(isset($_GET['horma'])){
                                     $sql="select distinct(modelo) from pedidos where modelo='".$_GET['modelos']."'";
                                     $res1=mysqli_query($con, $sql);
                                     if (!$res1){ 
                                         echo  mysqli_error($con);
                                         
                                     }else{
                                         $row1=mysqli_fetch_assoc($res1);
                                         echo "<option value='".$row1['modelo']."'>".$row1['modelo']."</option>";
                                     }
                                 }
                                 echo "<option value=''>Seleccione una modelo</option>";
                                 if(mysqli_num_rows($res)>0){
                                     while($row=mysqli_fetch_assoc($res)){
                                         if($row['modelo']!='')
                                         echo "<option value='".$row['modelo']."'>".$row['modelo']."</option>";
 
                                     }
                                 }
                             }
                            ?>
                        </select>
                    </div>
                </form>
                
                
        </div>
        <div id="posts">
            <center> <h2>LLEGADAS</h2></center>      
        
            <?php
            if($_GET){
                ?>
                <form action="excel_llegadasCon.php" method="get">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                                <!--<input type="hidden" name="importar" value="importar">-->
                                <input type="hidden" name="dia"  value="<?php echo $_GET['cmbDia']; ?>">
                                <input type="hidden" name="mes"  value="<?php echo $_GET['cmbMes']; ?>">
                                <input type="hidden" name="anio"  value="<?php echo $_GET['cmbAnio']; ?>">
                                <input type="hidden" name="pedido"  value="<?php echo $_GET['idPedido']; ?>">
                                <input type="hidden" name="modelo"  value="<?php echo $_GET['modelo']; ?>">
                                <input type="hidden" name="status"  value="<?php echo $_GET['status']; ?>">
                                <input type="submit" class="fa fa-download btn btn-primary btn-sm " value="Exportar reporte a Excel">
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </form>
                <?php

            }else{
                ?>
                <form action="excel_llegadas.php" method="get">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                                <input type="submit" class="fa fa-download btn btn-primary btn-sm " value="Exportar reporte a Excel">
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </form>
                <?php

            }
            ?>
                

            <?php

            if($_GET){
                $sqlFecha="";
                $b=0;
                if($_GET['cmbDia']!='' &&$_GET['cmbMes']!='' &&$_GET['cmbAnio']!=''){
                         
                    $sqlFecha=" fechaPedido='".$_GET['cmbAnio']."-".$_GET['cmbMes']."-".$_GET['cmbDia']."' ";
                    $b=1;
                }
               
                    ?>
                    <table>
                          <tr><td>Fecha_pedido</td><td>No_pedido</td><td>Status</td>
                          <td>Categoria</td><td>Modelo</td><td>Color</td><td>22</td><td>22.5</td>
                          <td>23</td><td>23.5</td><td>24</td><td>24.5</td><td>25</td><td>25.5</td><td>26</td><td>26.5</td><td>27</td><td>27.5</td>
                          <td>28</td><td>28.5</td><td>Total</td><td>Fecha_estimada_de_llegada</td><td>Fecha_de_llegada</td><td>Diferencia</td><td>%</td></tr>
                    
                      <?php
                      $sqlIdPedido="";
                      if($_GET['idPedido']!=""){
                        $sqlIdPedido=" id_pedido='".$_GET['idPedido']."' ";
                      }
                      $sqlConsulta="";
                      if($_GET['status']!=''){
                        if($_GET['modelo']!=''){
                            if($_GET['idPedido']!=""){
                                $sqlConsulta="select llegadas.codigo_pedido,id_pedido,llegadas.status,fabrica,sucursal,horma,categoria,modelo,
                                color,llegadas.t22,llegadas.t225,llegadas.t23,llegadas.t235,llegadas.t24,llegadas.t245,llegadas.t25,llegadas.t255,
                                llegadas.t26,llegadas.t265,llegadas.t27,llegadas.t275,llegadas.t28,llegadas.t285,num_pares_mod,
                               fechallegada,fechaEntrega,fechaPedido from llegadas inner join pedidos on llegadas.codigo_pedido=pedidos.codigo_pedido  where llegadas.status='".$_GET['status']."' and modelo='".$_GET['modelo']."'
                                 and ".$sqlIdPedido." AND ".$sqlFecha." ";

                            }else{
                                $sqlConsulta="select llegadas.codigo_pedido,id_pedido,llegadas.status,fabrica,sucursal,horma,categoria,modelo,
                                color,llegadas.t22,llegadas.t225,llegadas.t23,llegadas.t235,llegadas.t24,llegadas.t245,llegadas.t25,llegadas.t255,
                                llegadas.t26,llegadas.t265,llegadas.t27,llegadas.t275,llegadas.t28,llegadas.t285,num_pares_mod,
                               fechallegada,fechaEntrega,fechaPedido from llegadas inner join pedidos on llegadas.codigo_pedido=pedidos.codigo_pedido where llegadas.status='".$_GET['status']."' and modelo='".$_GET['modelo']."'
                                 AND ".$sqlFecha." ";
                            }
                        }else{
                            if($_GET['idPedido']!=""){
                                $sqlConsulta="select llegadas.codigo_pedido,id_pedido,llegadas.status,fabrica,sucursal,horma,categoria,modelo,
                                color,llegadas.t22,llegadas.t225,llegadas.t23,llegadas.t235,llegadas.t24,llegadas.t245,llegadas.t25,llegadas.t255,
                                llegadas.t26,llegadas.t265,llegadas.t27,llegadas.t275,llegadas.t28,llegadas.t285,num_pares_mod,
                               fechallegada,fechaEntrega,fechaPedido from llegadas inner join pedidos on llegadas.codigo_pedido=pedidos.codigo_pedido where llegadas.status='".$_GET['status']."'
                                 and ".$sqlIdPedido."  AND  ".$sqlFecha." ";

                            }else{
                                $sqlConsulta="select llegadas.codigo_pedido,id_pedido,llegadas.status,fabrica,sucursal,horma,categoria,modelo,
                                color,llegadas.t22,llegadas.t225,llegadas.t23,llegadas.t235,llegadas.t24,llegadas.t245,llegadas.t25,llegadas.t255,
                                llegadas.t26,llegadas.t265,llegadas.t27,llegadas.t275,llegadas.t28,llegadas.t285,num_pares_mod,
                               fechallegada,fechaEntrega,fechaPedido from llegadas inner join pedidos on llegadas.codigo_pedido=pedidos.codigo_pedido where llegadas.status='".$_GET['status']."' 
                               AND  ".$sqlFecha." ";
                            }
                        }
                      }else{
                        if($_GET['modelo']!=''){
                            if($_GET['idPedido']!=""){
                                $sqlConsulta="select llegadas.codigo_pedido,id_pedido,llegadas.status,fabrica,sucursal,horma,categoria,modelo,
                                color,llegadas.t22,llegadas.t225,llegadas.t23,llegadas.t235,llegadas.t24,llegadas.t245,llegadas.t25,llegadas.t255,
                                llegadas.t26,llegadas.t265,llegadas.t27,llegadas.t275,llegadas.t28,llegadas.t285,num_pares_mod,
                               fechallegada,fechaEntrega,fechaPedido from llegadas inner join pedidos on llegadas.codigo_pedido=pedidos.codigo_pedido where modelo='".$_GET['modelo']."'
                                 and ".$sqlIdPedido."  AND  ".$sqlFecha." order by fechaPedido asc";

                            }else{
                                $sqlConsulta="select llegadas.codigo_pedido,id_pedido,llegadas.status,fabrica,sucursal,horma,categoria,modelo,
                                color,llegadas.t22,llegadas.t225,llegadas.t23,llegadas.t235,llegadas.t24,llegadas.t245,llegadas.t25,llegadas.t255,
                                llegadas.t26,llegadas.t265,llegadas.t27,llegadas.t275,llegadas.t28,llegadas.t285,num_pares_mod,
                               fechallegada,fechaEntrega,fechaPedido from llegadas inner join pedidos on llegadas.codigo_pedido=pedidos.codigo_pedido where modelo='".$_GET['modelo']."'
                                AND ".$sqlFecha." order by fechaPedido asc";
                            }
                        }else{
                            if($_GET['idPedido']!=""){
                                $sqlConsulta="select llegadas.codigo_pedido,id_pedido,llegadas.status,fabrica,sucursal,horma,categoria,modelo,
                                color,llegadas.t22,llegadas.t225,llegadas.t23,llegadas.t235,llegadas.t24,llegadas.t245,llegadas.t25,llegadas.t255,
                                llegadas.t26,llegadas.t265,llegadas.t27,llegadas.t275,llegadas.t28,llegadas.t285,num_pares_mod,
                               fechallegada,fechaEntrega,fechaPedido from llegadas inner join pedidos on llegadas.codigo_pedido=pedidos.codigo_pedido where ".$sqlIdPedido."  AND ".$sqlFecha." 
                               order by fechaPedido asc";

                            }else{
                                $sqlConsulta="select llegadas.codigo_pedido,id_pedido,llegadas.status,fabrica,sucursal,horma,categoria,modelo,
                                color,llegadas.t22,llegadas.t225,llegadas.t23,llegadas.t235,llegadas.t24,llegadas.t245,llegadas.t25,llegadas.t255,
                                llegadas.t26,llegadas.t265,llegadas.t27,llegadas.t275,llegadas.t28,llegadas.t285,num_pares_mod,
                               fechallegada,fechaEntrega,fechaPedido from llegadas inner join pedidos on llegadas.codigo_pedido=pedidos.codigo_pedido where ".$sqlFecha." 
                               order by fechaPedido asc";
                            }
                        }

                      }
                      //var_dump($sqlConsulta);
                      $resConsulta=mysqli_query($con,$sqlConsulta);
                      if(!$resConsulta)
                      {
                          echo mysqli_error($con);
                      }
                      while($rowConsulta=mysqli_fetch_assoc($resConsulta)){
                        $contUnidades=0;
                        echo "<tr><td>".$rowConsulta['fechaPedido']."</td>";
    
                        echo "<td>".$rowConsulta['id_pedido']."</td>";
    
                        if($rowConsulta['status']=="PARCIAL"){
                            echo "<td bgcolor='#F7AD0F'>".$rowConsulta['status']."</td>";
                        }
                        if($rowConsulta['status']=="ENTREGADO"){
                            echo "<td bgcolor='#63F70F'>".$rowConsulta['status']."</td>";
                        }
                        if($rowConsulta['status']=="POSIBLE RESURTIDO"){
                            echo "<td bgcolor='#0FF7EC'>".$rowConsulta['status']."</td>";
                        }
                        if($rowConsulta['status']=="DE ESPERA EN LLEGADA"){
                            echo "<td bgcolor='#0FF7C2'>".$rowConsulta['status']."</td>";
                        }
                        if($rowConsulta['status']=="SIN RESURTIDO"){
                            echo "<td bgcolor='#B8B8B8' color='white'>".$rowConsulta['status']."</td>";
                        }
                        if($rowConsulta['status']=="CANCELADO"){
                            echo "<td bgcolor='red' ><font color='white'>".$rowConsulta['status']."</font></td>";
                        }
                       
                        echo "<td>".$rowConsulta['categoria']."</td>";
                        echo "<td>".$rowConsulta['modelo']."</td>";
                        echo "<td>".$rowConsulta['color']."</td>";
                        echo "<td>".$rowConsulta['t22']."</td>";
                        echo "<td>".$rowConsulta['t225']."</td>";
                        echo "<td>".$rowConsulta['t23']."</td>";
                        echo "<td>".$rowConsulta['t235']."</td>";
                        echo "<td>".$rowConsulta['t24']."</td>";
                        echo "<td>".$rowConsulta['t245']."</td>";
                        echo "<td>".$rowConsulta['t25']."</td>";
                        echo "<td>".$rowConsulta['t255']."</td>";
                        echo "<td>".$rowConsulta['t26']."</td>";
                        echo "<td>".$rowConsulta['t265']."</td>";
                        echo "<td>".$rowConsulta['t27']."</td>";
                        echo "<td>".$rowConsulta['t275']."</td>";
                        echo "<td>".$rowConsulta['t28']."</td>";
                        echo "<td>".$rowConsulta['t285']."</td>";
                        $contUnidades=$rowConsulta['t22']+$rowConsulta['t225']+$rowConsulta['t23']+$rowConsulta['t235']+$rowConsulta['t24']+$rowConsulta['t245']+
                        $rowConsulta['t25']+$rowConsulta['t255']+$rowConsulta['t26']+$rowConsulta['t265']+$rowConsulta['t27']+
                        $rowConsulta['t275']+$rowConsulta['t28']+$rowConsulta['t285'];
                        
                        echo "<td>".$contUnidades."</td>";
                      
                        echo "<td>".$rowConsulta['fechaEntrega']."</td>";
                        if($rowConsulta['fechallegada']!='0000-00-00'){
                            echo "<td>".$rowConsulta['fechallegada']."</td>";
                        }else{
                            
                            echo "<td></td>";
                        }
                        
                        
                        $diferencia=$rowConsulta['num_pares_mod']-$contUnidades;
                       
                        echo "<td>".$diferencia."</td>";
                        if($rowConPedidos['num_pares_mod']!=0){
                             $shere=($contUnidades/$rowConPedidos['num_pares_mod'])*100;
                            echo "<td>".number_format($shere,2)."%</td>";
                        }
                       
                       
                        echo "<td><form method='get' action='modllegadas.php'>
                                  <input type='hidden' name='codigoPedido' value='".$rowConsulta["codigo_pedido"]."'>
                              
                                  <input  name='modificarPedido' class='btn btn-primary btn-sm' type='submit' value='Modificar'> 
                                  </form></td></tr>";	
    
                    }


            }else{
                $sqlConsulta="select llegadas.codigo_pedido,id_pedido,llegadas.status,fabrica,sucursal,horma,categoria,modelo,
                color,llegadas.t22,llegadas.t225,llegadas.t23,llegadas.t235,llegadas.t24,llegadas.t245,llegadas.t25,llegadas.t255,
                llegadas.t26,llegadas.t265,llegadas.t27,llegadas.t275,llegadas.t28,llegadas.t285,num_pares_mod,
               fechallegada,fechaEntrega,fechaPedido from llegadas inner join pedidos on llegadas.codigo_pedido=pedidos.codigo_pedido 
               order by fechaPedido asc";

                ?>
                <table>
                    <tr><td>Fecha_pedido</td><td>No_pedido</td><td>Status</td>
                    <td>Categoria</td><td>Modelo</td><td>Color</td><td>22</td><td>22.5</td>
                    <td>23</td><td>23.5</td><td>24</td><td>24.5</td><td>25</td><td>25.5</td><td>26</td><td>26.5</td><td>27</td><td>27.5</td>
                    <td>28</td><td>28.5</td><td>Total</td><td>Fecha_estimada_de_llegada</td><td>Fecha_de_llegada</td><td>Diferencia</td><td>%</td></tr>
              
             
                <?php
                $resConsulta=mysqli_query($con,$sqlConsulta);
                while($rowConsulta=mysqli_fetch_assoc($resConsulta)){
                    $contUnidades=0;
                    echo "<tr><td>".$rowConsulta['fechaPedido']."</td>";

                    echo "<td>".$rowConsulta['id_pedido']."</td>";

                    if($rowConsulta['status']=="PARCIAL"){
                        echo "<td bgcolor='#F7AD0F'>".$rowConsulta['status']."</td>";
                    }
                    if($rowConsulta['status']=="ENTREGADO"){
                        echo "<td bgcolor='#63F70F'>".$rowConsulta['status']."</td>";
                    }
                    if($rowConsulta['status']=="POSIBLE RESURTIDO"){
                        echo "<td bgcolor='#0FF7EC'>".$rowConsulta['status']."</td>";
                    }
                    if($rowConsulta['status']=="DE ESPERA EN LLEGADA"){
                        echo "<td bgcolor='#0FF7C2'>".$rowConsulta['status']."</td>";
                    }
                    if($rowConsulta['status']=="SIN RESURTIDO"){
                        echo "<td bgcolor='#B8B8B8' color='white'>".$rowConsulta['status']."</td>";
                    }
                    if($rowConsulta['status']=="CANCELADO"){
                        echo "<td bgcolor='red' ><font color='white'>".$rowConsulta['status']."</font></td>";
                    }
                    echo "<td>".$rowConsulta['categoria']."</td>";
                    echo "<td>".$rowConsulta['modelo']."</td>";
                    echo "<td>".$rowConsulta['color']."</td>";
                    echo "<td>".$rowConsulta['t22']."</td>";
                    echo "<td>".$rowConsulta['t225']."</td>";
                    echo "<td>".$rowConsulta['t23']."</td>";
                    echo "<td>".$rowConsulta['t235']."</td>";
                    echo "<td>".$rowConsulta['t24']."</td>";                
                    echo "<td>".$rowConsulta['t245']."</td>";
                    echo "<td>".$rowConsulta['t25']."</td>";
                    echo "<td>".$rowConsulta['t255']."</td>";
                    echo "<td>".$rowConsulta['t26']."</td>";
                    echo "<td>".$rowConsulta['t265']."</td>";
                    echo "<td>".$rowConsulta['t27']."</td>";
                    echo "<td>".$rowConsulta['t275']."</td>";
                    echo "<td>".$rowConsulta['t28']."</td>";
                    echo "<td>".$rowConsulta['t285']."</td>";
                    $contUnidades=$rowConsulta['t22']+$rowConsulta['t225']+$rowConsulta['t23']+$rowConsulta['t235']+$rowConsulta['t24']+$rowConsulta['t245']+
                    $rowConsulta['t25']+$rowConsulta['t255']+$rowConsulta['t26']+$rowConsulta['t265']+$rowConsulta['t27']+
                    $rowConsulta['t275']+$rowConsulta['t28']+$rowConsulta['t285'];
                    
                    echo "<td>".$contUnidades."</td>";
                   
                    //echo "<td>".$rowConsulta['fechallegada']."</td>";
                    echo "<td>".$rowConsulta['fechaEntrega']."</td>";
                    if($rowConsulta['fechallegada']!='0000-00-00'){
                        echo "<td>".$rowConsulta['fechallegada']."</td>";
                    }else{
                        
                        echo "<td></td>";
                    }
                    
                    $sqlConPedido="select num_pares_mod from pedidos where codigo_pedido='".$rowConsulta['codigo_pedido']."'";
                    $resConPedidos=mysqli_query($con,$sqlConPedido);
                    $rowConPedidos=mysqli_fetch_assoc($resConPedidos);
                    $diferencia=$rowConPedidos['num_pares_mod']-$contUnidades;
                   
                    echo "<td>".$diferencia."</td>";
                    if($rowConPedidos['num_pares_mod']!=0){
                         $shere=($contUnidades/$rowConPedidos['num_pares_mod'])*100;
                        echo "<td>".number_format($shere,2)."%</td>";
                    }
                   
                   
                    echo "<td><form method='get' action='modllegadas.php'>
                              <input type='hidden' name='codigoPedido' value='".$rowConsulta["codigo_pedido"]."'>
                          
                              <input  name='modificarPedido' class='btn btn-primary btn-sm' type='submit' value='Modificar'> 
                              </form></td></tr>";	

                }
                echo "   </table>";

            }

            ?>
            <?php
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
                                if($columna[2]!=''){
                                    $numeroPedidO=$columna[2];

                                    
                                    $status="PEDIDO EN FIRME";
                                    $arrPedido=explode('_',$columna[2]);
                                    $fabrica=$arrPedido[0];
                                    $arrPedido1=explode('-',$columna[2]);
                                    $sucursal=$arrPedido1[2];
                                    $numPedido=$arrPedido1[1];
                                    $horma=$columna[3];
                                    $categoria=$columna[4];
                                    $modelo=$columna[5];
                                    $color=$columna[6];
                                    $t22=$columna[7];
                                    if($t22=='')
                                        $t22=0;
                                    
                                    $t225=$columna[8];
                                    if($t225=='')
                                        $t225=0;
                                    
                                    $t23=$columna[9];
                                    if($t23=='')
                                        $t23=0;
                                    
                                    $t235=$columna[10];
                                    if($t235=='')
                                        $t235=0;
                                    
                                    $t24=$columna[11];
                                    if($t24=='')
                                        $t24=0;

                                    $t245=$columna[12];
                                    if($t245=='')
                                        $t245=0;

                                    $t25=$columna[13];
                                    if($t25=='')
                                        $t25=0;

                                    $t255=$columna[14];
                                    if($t255=='')
                                        $t255=0;

                                    $t26=$columna[15];
                                    if($t26=='')
                                        $t26=0;

                                    $t265=$columna[16];
                                    if($t265=='')
                                        $t265=0;

                                    $t27=$columna[17];
                                    if($t27=='')
                                        $t27=0;

                                    $t275=$columna[18];
                                    if($t275=='')
                                        $t275=0;

                                    $t28=$columna[19];
                                    if($t28=='')
                                        $t28=0;

                                    $t285=$columna[20];
                                    if($t285=='')
                                        $t285=0;

                                    $arrFecha=explode('/',$columna[1]);
                                    $dia=$arrFecha[0];
                                    $mes=$arrFecha[1];
                                    $anio=$arrFecha[2];
                                    switch($mes){
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
                                    $total=$columna[21];

                                    $sqlPedidos="INSERT INTO pedidos(num,id_pedido,status,fabrica,sucursal,horma,categoria,modelo,color,
                                    T22,T225,T23,T235,T24,T245,T25,T255,T26,T265,T27,T275,T28,T285,num_pares_mod,dia_entrega,
                                    mes_entrega,anio_entrega)  VALUES ('".$numPedido."','".$numeroPedidO."','".$status."','".$fabrica."','".$sucursal."'
                                    ,'".$horma."','".$categoria."','".$modelo."','".$color."','".$t22."','".$t225."','".$t23."','".$t235."'
                                    ,'".$t24."','".$t245."','".$t25."','".$t255."','".$t26."','".$t265."','".$t27."'
                                    ,'".$t275."','".$t28."','".$t285."','".$total."','".$dia."','".$mes."','".$anio."')";
                                    $resPedidos=mysqli_query($con, $sqlPedidos);
                                    if (!$resPedidos){ 
                                        echo  mysqli_error($con);
                                        
                                    }else{
                                        $sqlllegadas="INSERT INTO llegadas(id_pedido,status,fabrica,sucursal,horma,categoria,modelo,color,
                                        T22,T225,T23,T235,T24,T245,T25,T255,T26,T265,T27,T275,T28,T285,diaEstimada,
                                        mesEstimado,anioEstimado)  VALUES ('".$numeroPedidO."','EN ESPERA EN LLEGADA','".$fabrica."','".$sucursal."'
                                        ,'".$horma."','".$categoria."','".$modelo."','".$color."','0','0','0','0'
                                        ,'0','0','0','0','0','0','0','0','0','0','".$dia."','".$mes."','".$anio."')";
                                        $resllegadas=mysqli_query($con,$sqlllegadas);
                                        if (!$resllegadas){
                                            echo  mysqli_error($con);     
                                        }

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
    </section>
   

</body>


</html>
<?php
}
?>