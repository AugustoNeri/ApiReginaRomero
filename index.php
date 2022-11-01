<?php
session_start();
if(isset ($_SESSION['email'])) {
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <title>Regina Romero</title>
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
        <!--Contenido-->
        <div id="content-img">

            <center><img src="img/img1.jpg" alt=""></center>
        </div>
    </section>
</body>

</html>
<?php
}
?>