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
                        <li><a class="active" href="pedidos.php">Pedidos</a></li>
                        <li><a href="llegadas.php">Llegadas</a></li>
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
                        <li><a href="llegadas.php">Llegadas</a></li>
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
                        <label for="exampleFormControlInput1" class="form-label"><h5>Fecha de Pedido</h5></label>
                            <div class="row">
                            
                            <div class="col-md-4">
                                <Select name="cmbDia" id="cmbDia" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                    <?php
                                    if(isset($_GET['cmbDia'])){
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
                                    <option  value="">Año</option>
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
                                            $sql="select status from statuspedidos order by status asc";
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
                        
                        
                            <label for="exampleFormControlInput1" class="form-label"><h4># pedido</h4></label>
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
                             $sql="select modelo from modelos order by modelo asc";
                             $res=mysqli_query($con,$sql);
                             if(!$res){
                                 echo mysqli_error($con);
                             }else{
                                 if(isset($_GET['horma'])){
                                     $sql="select modelo from modelos where modelo='".$_GET['modelos']."'";
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
                    <center> <h2>PEDIDOS</h2></center>      
                   
            <?php
            if($_SESSION['permiso']=="rr1" ||$_SESSION['permiso']=="rr3" )
            {
            ?>
                     <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                        <center><h3>Cargar transferencias</h3></center>
                        </div>
                        <div class="col-md-2"></div>
                        
                    </div>
                    <form action="pedidos.php" name="importar" method="post" enctype="multipart/form-data" >
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <input class="form-control" type="file" name="file" data-buttonText="Seleccione el archivo" >
                            </div> 
                        
                            <div class="col-md-2"></div>
                            
                        </div>

                        <div class="row">
                            <div class="col-md-4"></div>
                                <div class="col-md-4">
                                        <!--<input type="hidden" name="importar" value="importar">-->
                                        <input class="btn btn-primary btn-lg " type="submit" name="importar"value="Importar">
                                </div>
                            <div class="col-md-4"></div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <!--<input type="hidden" name="importar" value="importar">-->
                                <input type="submit" class="btn fa fa-download btn-primary btn-sm" onclick = "location='a_pedidos.php'"  value="Añadir un pedido">
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <?php
            }
                    if($_GET){
                        ?>
                        <form action="excel_PedidosCon.php" method="get">
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                        <!--<input type="hidden" name="importar" value="importar">-->
                                        <input type="hidden" name="dia"  value="<?php echo $_GET['cmbDia']; ?>">
                                        <input type="hidden" name="mes"  value="<?php echo $_GET['cmbMes']; ?>">
                                        <input type="hidden" name="anio"  value="<?php echo $_GET['cmbAnio']; ?>">
                                        <input type="hidden" name="idPedido"  value="<?php echo $_GET['idPedido']; ?>">
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
                        <form action="excelPedidosv2.php" method="get">
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
                        if($_GET['cmbDia']!='' ||$_GET['cmbMes']!='' || $_GET['cmbAnio']!=''){
                            if($_GET['cmbAnio']!=''){
                                if($_GET['cmbMes']!=''){
                                    if($_GET['cmbDia']!=''){
                                        $sqlFecha=" fechaPedido='".$_GET['cmbAnio']."-".$_GET['cmbMes']."-".$_GET['cmbDia']."' ";
                                    }else{
                                        $sqlFecha=" fechaPedido BETWEEN '".$_GET['cmbAnio']."-".$_GET['cmbMes']."-01' AND '".$_GET['cmbAnio']."-".$_GET['cmbMes']."-31'";
                                    }
                                }else{
                                    echo "Debe de escoger seleccionar el mes";
                                }
                            }else{
                                echo "Debe de escoger seleccionar el año";
                            }
                        }
                        
                            ?>
                            <table>
                            <tr><td>Fecha_pedido</td><td>Folio_pedido</td><td>Status</td>
                            <td>Categoria</td><td>Modelo</td><td>Color</td><td>22</td><td>22.5</td>
                            <td>23</td><td>23.5</td><td>24</td><td>24.5</td><td>25</td><td>25.5</td><td>26</td><td>26.5</td><td>27</td><td>27.5</td>
                            
                            <td>28</td><td>28.5</td><td>Total de pares</td><td >Fecha_de_entrega</td><td></td></tr>
                            <?php
                            $sqlIdPedido="";
                            if($_GET['idPedido']!=""){
                                $sqlIdPedido=" id_pedido='".$_GET['idPedido']."' ";
                            }
                            $sqlConsulta="";


                            if($_GET['status']!=''){
                                if($_GET['modelo']!=''){
                                    if($_GET['idPedido']!=""){
                                        $sqlConsulta="select codigo_pedido,id_pedido,status,fabrica,horma,categoria,modelo,color,T22,T225,T23,T235,
                                        T24,T245,T25,T255,T26,T265,T27,T275,T28,T285,num_pares_mod,fechaEntrega,fechaPedido from pedidos where status='".$_GET['status']."' and modelo='".$_GET['modelo']."'
                                        and ".$sqlIdPedido." AND ".$sqlFecha." order by fechaPedido asc";

                                    }else{
                                        $sqlConsulta="select codigo_pedido,id_pedido,status,fabrica,horma,categoria,modelo,color,T22,T225,T23,T235,
                                        T24,T245,T25,T255,T26,T265,T27,T275,T28,T285,num_pares_mod,fechaEntrega,fechaPedido from pedidos where status='".$_GET['status']."' and modelo='".$_GET['modelo']."'
                                        AND  ".$sqlFecha." order by fechaPedido asc";
                                    }
                                }else{
                                    if($_GET['idPedido']!=""){
                                        $sqlConsulta="select codigo_pedido,id_pedido,status,fabrica,horma,categoria,modelo,color,T22,T225,T23,T235,
                                        T24,T245,T25,T255,T26,T265,T27,T275,T28,T285,num_pares_mod,fechaEntrega,fechaPedido from pedidos where status='".$_GET['status']."'
                                        and ".$sqlIdPedido."  AND  ".$sqlFecha." order by fechaPedido asc";

                                    }else{
                                        $sqlConsulta="select codigo_pedido,id_pedido,status,fabrica,horma,categoria,modelo,color,T22,T225,T23,T235,
                                        T24,T245,T25,T255,T26,T265,T27,T275,T28,T285,num_pares_mod,fechaEntrega,fechaPedido from pedidos where status='".$_GET['status']."' 
                                        AND  ".$sqlFecha." order by fechaPedido asc";
                                    }
                                }
                            }else{
                                if($_GET['modelo']!=''){
                                    if($_GET['idPedido']!=""){
                                        $sqlConsulta="select codigo_pedido,id_pedido,status,fabrica,horma,categoria,modelo,color,T22,T225,T23,T235,
                                        T24,T245,T25,T255,T26,T265,T27,T275,T28,T285,num_pares_mod,fechaEntrega,fechaPedido from pedidos where modelo='".$_GET['modelo']."'
                                        and ".$sqlIdPedido."  AND  ".$sqlFecha." order by fechaPedido asc";

                                    }else{
                                        $sqlConsulta="select codigo_pedido,id_pedido,status,fabrica,horma,categoria,modelo,color,T22,T225,T23,T235,
                                        T24,T245,T25,T255,T26,T265,T27,T275,T28,T285,num_pares_mod,fechaEntrega,fechaPedido from pedidos where modelo='".$_GET['modelo']."'
                                        AND  ".$sqlFecha." order by fechaPedido asc";
                                    }
                                }else{
                                    if($_GET['idPedido']!=""){
                                        $sqlConsulta="select codigo_pedido,id_pedido,status,fabrica,horma,categoria,modelo,color,T22,T225,T23,T235,
                                        T24,T245,T25,T255,T26,T265,T27,T275,T28,T285,num_pares_mod,fechaEntrega,fechaPedido from pedidos where ".$sqlIdPedido."  AND  ".$sqlFecha." order by fechaPedido asc";

                                    }else{
                                        $sqlConsulta="select codigo_pedido,id_pedido,status,fabrica,horma,categoria,modelo,color,T22,T225,T23,T235,
                                        T24,T245,T25,T255,T26,T265,T27,T275,T28,T285,num_pares_mod,fechaEntrega,fechaPedido from pedidos where ".$sqlFecha." order by fechaPedido asc";
                                    }
                                }
                            }
                           
                            $resConsulta=mysqli_query($con,$sqlConsulta);
                            if(!$resConsulta)
                            {
                                echo mysqli_error($con);
                            }
                            while($rowConsulta=mysqli_fetch_assoc($resConsulta)){
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
                                if($rowConsulta['status']=="PEDIDO EN FIRME"){
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
                                echo "<td>".$rowConsulta['T22']."</td>";
                                echo "<td>".$rowConsulta['T225']."</td>";
                                echo "<td>".$rowConsulta['T23']."</td>";
                                echo "<td>".$rowConsulta['T235']."</td>";
                                echo "<td>".$rowConsulta['T24']."</td>";
                                echo "<td>".$rowConsulta['T245']."</td>";
                                echo "<td>".$rowConsulta['T25']."</td>";
                                echo "<td>".$rowConsulta['T255']."</td>";
                                echo "<td>".$rowConsulta['T26']."</td>";
                                echo "<td>".$rowConsulta['T265']."</td>";
                                echo "<td>".$rowConsulta['T27']."</td>";
                                echo "<td>".$rowConsulta['T275']."</td>";
                                echo "<td>".$rowConsulta['T28']."</td>";
                                echo "<td>".$rowConsulta['T285']."</td>";
                                echo "<td>".$rowConsulta['num_pares_mod']."</td>";
                                echo "<td>".$rowConsulta['fechaEntrega']."</td>";
                            
                                if($_SESSION['permiso']=="rr1" ||$_SESSION['permiso']=="rr3" ){
                                    echo "<td><form method='get' action='modPedido.php'>
                                        <input type='hidden' name='codigoPedido' value='".$rowConsulta["codigo_pedido"]."'>
                                     
                                        <input  name='modificarPedido' class='btn btn-primary btn-sm' type='submit' value='Modificar'> 
                                        </form></td></tr>";
                                }else{
                                    echo "<td></td></tr>";
                                }


                            }
                        

                    }else{

                        ?>
                        <table>
                            <tr><td>Fecha_pedido</td><td>Folio_pedido</td><td>Status</td>
                            <td>Categoria</td><td>Modelo</td><td>Color</td><td>22</td><td>22.5</td>
                            <td>23</td><td>23.5</td><td>24</td><td>24.5</td><td>25</td><td>25.5</td><td>26</td><td>26.5</td><td>27</td><td>27.5</td>
                            
                            <td>28</td><td>28.5</td><td>Total de pares</td><td >Fecha_de_entrega</td><td></td></tr>
                            <?php
                            $sqlConsulta="select codigo_pedido,id_pedido,status,fabrica,horma,categoria,modelo,color,T22,T225,T23,T235,
                            T24,T245,T25,T255,T26,T265,T27,T275,T28,T285,num_pares_mod,fechaEntrega,fechaPedido from pedidos order by fechaPedido asc";

                            $resConsulta=mysqli_query($con,$sqlConsulta);
                            if (!$resConsulta){ 
                                ?>
                                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </symbol>    
                                </svg>
                                <div class="alert alert-danger d-flex align-items-center" role="alert">

                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                <div>
                                    Error en la consulta de datoss
                                </div>
                                </div>
                            <?php
                                echo  mysqli_error($con);          
                            }else{
                                while($rowConsulta=mysqli_fetch_assoc($resConsulta)){
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
                                    if($rowConsulta['status']=="PEDIDO EN FIRME"){
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
                                    echo "<td>".$rowConsulta['T22']."</td>";
                                    echo "<td>".$rowConsulta['T225']."</td>";
                                    echo "<td>".$rowConsulta['T23']."</td>";
                                    echo "<td>".$rowConsulta['T235']."</td>";
                                    echo "<td>".$rowConsulta['T24']."</td>";
                                    echo "<td>".$rowConsulta['T245']."</td>";
                                    echo "<td>".$rowConsulta['T25']."</td>";
                                    echo "<td>".$rowConsulta['T255']."</td>";
                                    echo "<td>".$rowConsulta['T26']."</td>";
                                    echo "<td>".$rowConsulta['T265']."</td>";
                                    echo "<td>".$rowConsulta['T27']."</td>";
                                    echo "<td>".$rowConsulta['T275']."</td>";
                                    echo "<td>".$rowConsulta['T28']."</td>";
                                    echo "<td>".$rowConsulta['T285']."</td>";
                                    echo "<td>".$rowConsulta['num_pares_mod']."</td>";
                                    echo "<td>".$rowConsulta['fechaEntrega']."</td>";
                                
                                    if($_SESSION['permiso']=="rr1" ||$_SESSION['permiso']=="rr3" ){
                                        echo "<td><form method='get' action='modPedido.php'>
                                            <input type='hidden' name='codigoPedido' value='".$rowConsulta["codigo_pedido"]."'>
                                         
                                            <input  name='modificarPedido' class='btn btn-primary btn-sm' type='submit' value='Modificar'> 
                                            </form></td></tr>";
                                    }else{
                                        echo "<td></td></tr>";
                                    }

                                }

                            }

                            ?>

                            
                        </table>
                        <?php

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

                                        
                                while(($columna = fgetcsv($csv_file)) !== FALSE){
                                        if($columna[2]!=''){
                                            $numeroPedido=$columna[2];
                                            $status="PEDIDO EN FIRME";
                                            $arrPedido=explode('_',$columna[2]);
                                            $fabrica=$arrPedido[0];
                                            $arrPedido1=explode('-',$columna[2]);
                                            $sucursal=$arrPedido1[2];
                                            $num=$arrPedido1[1];
                                            $horma=strtoupper($columna[3]);
                                            $categoria=strtoupper($columna[4]);
                                            $modelo=strtoupper($columna[5]);
                                            $color=strtoupper($columna[6]);
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
                                            $fechaEntrega=$anio."-".$mes."-".$dia;
                                            $arrFechaP=explode('/',$columna[0]);
                                            $diaP=$arrFechaP[0];
                                            $mesP=$arrFechaP[1];
                                            $anioP=$arrFechaP[2];
                                            $fechaPedido=$anioP."-".$mesP."-".$diaP;

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
                                            $codigo_pedido=$numeroPedido."_".$modelo."_".$color;

                                            $sqlPedidos="INSERT INTO pedidos(codigo_pedido,num,id_pedido,status,fabrica,sucursal,horma,categoria,modelo,color,
                                            T22,T225,T23,T235,T24,T245,T25,T255,T26,T265,T27,T275,T28,T285,num_pares_mod,fechaEntrega,fechaPedido)  
                                            VALUES ('".$codigo_pedido."','".$num."','".$numeroPedido."','".$status."','".$fabrica."','".$sucursal."'
                                            ,'".$horma."','".$categoria."','".$modelo."','".$color."','".$t22."','".$t225."','".$t23."','".$t235."'
                                            ,'".$t24."','".$t245."','".$t25."','".$t255."','".$t26."','".$t265."','".$t27."'
                                            ,'".$t275."','".$t28."','".$t285."','".$total."','".$fechaEntrega."','".$fechaPedido."')";
                                            $resPedidos=mysqli_query($con, $sqlPedidos);
                                            if (!$resPedidos){ 
                                                echo  mysqli_error($con);
                                                
                                            }else{
                                                $sqlllegadas="INSERT INTO llegadas(codigo_pedido,status,
                                                T22,T225,T23,T235,T24,T245,T25,T255,T26,T265,T27,T275,T28,T285)
                                                 VALUES ('".$codigo_pedido."','DE ESPERA EN LLEGADA','0','0','0','0'
                                                ,'0','0','0','0','0','0','0','0','0','0')";
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
