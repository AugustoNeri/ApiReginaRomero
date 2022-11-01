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
                        <li><a class="active" href="usuarios.php">Usuarios</a></li>
                        <li><a  href="inventario.php">Inventario</a></li>
                        <li><a  href="ventas.php">Ventas</a></li>
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
        <div class="content">
        <div class="row">


        <div class="col-md-4"></div><div class="col-md-4"><p class="h1">Añadir un usuario</p></div><div class="col-md-4"></div>
            <form class="row g-3" action="" method="get">
               
               
                <div class="col-md-6">
                    <label for="validationCustom04" class="form-label">Correo electronico</label>
                    <input name="email" id="email"  type="email" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom04" class="form-label">Nombre</label>
                    <input name="name" id="name"  type="text" class="form-control"  required>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom04" class="form-label">Apellido</label>
                    <input name="apellido" id="apellido"  type="text" class="form-control"  required>
                </div>
               
                <div class="col-md-6">
                    <label for="validationCustom04" class="form-label">Permiso</label>
                        <select name="cmbPermiso" class="form-select" id="cmbPermiso" required>
                            <option selected disabled value="">Selecciona una categoria</option>
                            <option  value="rr1">Editar todo</option>
                            <option  value="rr2">Editar Inventario y Ventas</option>
                            <option  value="rr3">Editar Pedidos</option>
                            <option  value="rr4">Editar Llegadas</option>
                            <option  value="rr5">Consulta</option>
                        </select>
                </div>
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <input class="btn btn-primary btn-sm " type="submit" name="guardar" value="Guardar">
                </div>
                <div class="col-md-4">
                    
                </div>
               
            </form>

            <?php
                if(isset($_GET['guardar'])){
                    $email=strtoupper($_GET['email']);
                    $nombre=strtoupper($_GET['name']);
                    $apellido=strtoupper($_GET['apellido']);
                    $usuario=$nombre." ".$apellido;
                   $pass="rr22_".substr($nombre,0,1).strtolower($apellido);
                    $permiso=$_GET['cmbPermiso'];
                 
                        $sqlUsuario="insert into usuarios (email,usuario,password,permiso) value
                        ('".$email."','".$usuario."','".$pass."','".$permiso."')";
                        $resusuarios=mysqli_query($con,$sqlUsuario);
                        if (!$resusuarios){ 
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
                        }?>
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
                            <div>
                              La contraseña es <?php  echo $pass; ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                                <input class="btn btn-danger btn-sm " type="submit" onclick = "location='usuarios.php'" value="Regresar">
                            </div>
                        <?php
                  




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