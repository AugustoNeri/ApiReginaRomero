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
                        <li><a class="active" href="usuarios.php">Usuarios</a></li>
                        <li><a href="inventario.php">Inventario</a></li>
                        <li><a href="ventas.php">Ventas</a></li>
                        <li><a  href="pedidos.php">Pedidos</a></li>
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
                <center><button class="btn btn-primary btn-sm "><i class="fa fa-search"></i>Buscar</button></center>
                    <label for="exampleFormControlInput1" class="form-label"><h4>Nombre</h4></label>
                    <div class="pedido">
                        <?php
                            if(isset($_GET['usuario'])){

                            echo "<input name='usuario' type='text' class='form-control' id='validationDefault01' value='".$_GET['usuario']."'>";
                            }else{
                            ?>
                                <input name="usuario" type="text" class="form-control" id="validationDefault01" value="" >
                            <?php
                            }
                            ?>
                    </div>
                                   
                    <label for="exampleFormControlInput1" class="form-label"><h4>Permisos</h4></label>
                    <div class="Modelo">
                        <select name="permiso" id="permiso" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <?php
                            if(isset($_GET['permiso'])){
                                echo '<option value="'.$_GET['permiso'].'">'.$_GET['permiso'].'</option>';
                            }
                        ?>
                            <option value="">Selecciona una categoria</option>
                            <option  value="rr1">(rr1)Editar todo</option>
                            <option  value="rr2">(rr2)Editar Inventario y Ventas</option>
                            <option  value="rr3">(rr3)Editar Pedidos</option>
                            <option  value="rr4">(rr4)Editar Llegadas</option>
                            <option  value="rr5">(rr5)Consulta</option>
                        </select>
                    </div>
                </form>
                
                
        </div>
        <div id="posts">
            <center> <h2>Usuarios</h2></center>
            <?php      
            if($_SESSION['permiso']=="rr1")
            {
            ?>
                  
                    <div class="row">
                        <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <!--<input type="hidden" name="importar" value="importar">-->
                                <input type="submit" class="btn fa fa-download btn-primary btn-sm" onclick = "location='a_usuarios.php'"  value="Creau nuevo usuario">
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <?php
            }
            ?>

            <?php

            if($_GET){
                $sqlUsuario="";
                if($_GET['usuario']!=""){
                    $sqlUsuario=" usuario like '%".$_GET['usuario']."%' ";
                }
                $sqlPermisos="";
                if($_GET['permiso']!=""){
                    $sqlPermisos=" permiso='".$_GET['permiso']."' ";
                }
                $sqlConsulta="select usuario,email,permiso from usuarios where ";
                if($_GET['usuario']!=""){
                    if($_GET['permiso']!=""){
                        $sqlConsulta.=$sqlUsuario;
                        $sqlConsulta.=$sqlPermisos;
                    }else{
                        $sqlConsulta.=$sqlUsuario;
                    }
                }else{
                    $sqlConsulta.=$sqlPermisos;
                }
                ?>
                <table>
                    <tr><td>USUARIO</td><td>EMAIL</td><td>PERMISOS</td></tr>
                <?php
              
               $resUsuario=mysqli_query($con,$sqlConsulta);
               if(!$resUsuario){
                echo mysqli_error($con);
               }
               while($row=mysqli_fetch_assoc($resUsuario)){
                echo "<tr><td>".$row['usuario']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['permiso']."</td>";
                echo "</tr>";
               }

               ?> 
                </table>
               <?php
              
            }else{
                ?>
                <table>
                    <tr><td>USUARIO</td><td>EMAIL</td><td>PERMISOS</td></tr>
                <?php
               $sqlConsulta="select usuario,email,permiso from usuarios";
               $resUsuario=mysqli_query($con,$sqlConsulta);
               if(!$resUsuario){
                echo mysqli_error($con);
               }
               while($row=mysqli_fetch_assoc($resUsuario)){
                echo "<tr><td>".$row['usuario']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['permiso']."</td> </tr>";
                
             
               }

               ?> 
                </table>
               <?php

            }

            ?>
           

        </div>
    </section>
   

</body>


</html>
<?php
}
?>