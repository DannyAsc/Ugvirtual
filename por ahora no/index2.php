<?php
	// Create connection(host, user, password, database name)
	$cnn = mysqli_connect("localhost", "root1", "123", "ugvirtual");		
	
	if (mysqli_connect_errno())
		die("<br><br>ERROR: No se logro la conexion a la base de datos...<br><br><br>" . mysqli_connect_error());
?>

<!DOCTYPE html>
<html>
<head>        
<link href="estilo.css" rel="stylesheet" type="text/css">
<meta charset="utf-8">
	<title>Login</title>
	<style>
		.row1{ background-color:#0FFFFF;height:20px;font-size:20px;}
		.row0{ background-color:#0AAAAA;height:20px;font-size:20px;}
		#tablaUsuarios{width:800px;border:1px;border-collapse:collapse;}
	</style>	
</head>    
<body class="body2">

	<?php	
		if ( $cnn ){
	?>	
			<!-- Mostrar lista de todos los usuarios -->
			<table id="tablaUsuarios">
			<?php			
				if( $rs = mysqli_query($cnn, "SELECT * FROM alumno")) {				
				
				//mensaje de cuantos usuarios son los registrados
					//echo "<tr><td colspan='4'><b>Hay ", mysqli_num_rows($rs), " usuarios registrados:</b></td></tr>\n";
				
//aqui se imprimen cada uno de los elementos o campos de la tabla de los usuarios registrados
				/*
					$cont=0;
					while( $row = mysqli_fetch_array($rs) ){				
						echo "<tr class='row", $cont%2, "'>";
						echo "<td style='width=100px;'>",$row['id_usuario'], "</td>";
						echo "<td style='width=500px;'>",$row['nombre'], "</td>";
						echo "<td style='width=100px;'>",$row['username'], "</td>";
						echo "<td style='width=100px;'>",$row['password'], "</td>";
						echo "</tr>\n";
						$cont++;
					}		
					*/
					//libera la memoria 
					mysqli_free_result($rs);
				}else{
					die("<br><br>ERROR: No se ejecuto con exito la consulta sql...<br><br><br>" . mysqli_error($cnn));
				}
			?>		
			</table>
	
			<br>
			<br>
  <div class="login">
			<!-- Formulario inicio de sesion -->
			<form  name="Principal"  method="post"> 
				<fieldset style="text-align:right;width:600px;">
					<h1><b>INGRESA TUS DATOS ALUMNO</b></h1><br><br><br>
					<b>Usuario:</b> <input type="text" name="clave_alumno" size="50" autofocus><br>
					<b>Contrase&ntilde;a:</b> <input type="password" name="contrasena_alumno" size="50"><br>
					<br><br>
                   <input type="submit" name="butSubmit" value="Entrar" class="input3">
                   <p><a href="Ayuda2.php">Ayuda</a></p>

			<br>
			<br>
			
			<!-- Validar alumno -->
			<?php	
				if( isset($_POST['butSubmit']) ){
					$sql = "SELECT * FROM alumno WHERE clave_alumno='" .  $_POST['clave_alumno'] . "' and contrasena_alumno='" .  $_POST['contrasena_alumno'] . "'";
					
					if( $rs = mysqli_query($cnn, $sql)) {				
				
						if(mysqli_num_rows($rs)){
						
							$row = mysqli_fetch_array($rs);
							 header('Location: Principal2.php');
							//header('Location: Ventana_Alumnos.php');
							//echo "<p><b>BIENVENIDO ", $row['nombre'], "</b></p>";
						    //include 'Principal.php';
						}else{
							echo "<p style='color:red;'><b>NO HAY NINGUN USUARIO CON clave_alumno='", $_POST['clave_alumno'], "' y contrasena_alumno='", $_POST['contrasena_alumno'],"'</b></p>";
						}
						
						//con esto se muestra la consulta consultada
						//echo "<br><hr><br>Consulta ejecutada:<br><br><b>", $sql, "</b>";
						//mysqli_free_result($rs);
					}else{
						die("<br><br>ERROR: No se ejecuto con exito la consulta sql...<br><br><br>" . mysqli_error($cnn));
					}
				}
			?>	
	</div>
					   <br>

<p><a class ="links" href="index.php">Regresar</a></p>
	<?php
			// Close database connection
			mysqli_close($cnn);
		} else echo "<br><br><br><b>ERROR: </b>No hay conexion con la base de datos...";		
	?>

</body>
</html>