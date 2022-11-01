
<?php
//require_once("phpClasses/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/home.css">

    <title>Home</title>
</head>
<body background="img/background.jpg">
    <div class="container">
        <nav class="navbar">
            <div class="left">
                <a href="home.html"><img src="img/logo-header.png" alt=""></a> 
            </div>
        </nav>
        <div class="login_container">
            <div class="login_form">
                <h2>Iniciar Sesión</h2>
                <form action="phpClasses/access.php" method="POST">
                    <input type="email" name="email" placeholder="Correo electronico">
                    <input type="password" name="pass" placeholder="Contraseña" id="">
                    <input type="submit" class="submit" value="Iniciar Sesión">
                </form>
             
            </div>
        </div>
       
    </div>


</body>
</html>