<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="estilo.css">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximun-scale=1, minimun-scale=1">
<title>MI LOGIN</title>
<style>
input[type=text], input[type=password] input[type=email]{
    width: 10%;
    padding: 10px 12px;
    margin: 4px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #0000FF;
    color: white;
    padding: 14px 20px;
    margin: 5px 0;
    border: none;
    cursor: pointer;
    width: 21%;
}

.imgcontainer {
    text-align: center;
    margin: 27px 0 12px 0;
}

img.avatar {
    width: 10%;
    border-radius: 20%;
}

.container {
    padding: 24px;
}
</style>
</head>
<body style="background-color:#f5eb46;">
	
<h1 align="center">INICIAR SESION</h1>
<form action="milogin.php" method="post">
 <div class="imgcontainer">
    <img src="user3.png" alt="" class="">
  </div>
  <div class="container" align="center">
    <label><b>NOMBRES:</b></label>
    <input type="text" name="Nombres" id="nom_usu"><br>
    <label><b>USUARIO:</b></label>
    <input type="text" placeholder=&#128100; name="usuarios" id="nombre"></br>
    <label><b>CLAVE:</b></label>
    <input type="password" placeholder=&#128273; name="clave" id="clave"></br>
    <label for=""><b>Email:</b></label>
    <input type="email" name="email" id="email"><br>
    <button  type="submit">REGISTRARSE</button>
		<p><a align="center" class ="links" href="index.php">Regresar</a></p>
  </div>
</form>

</body>
</html>