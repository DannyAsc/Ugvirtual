<?php
session_start();
?>
<?php
$host_db = "localhost";
$user_db = "root1";
$pass_db = "123";
$db_name = "ugvirtual";

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}
$nombre = $_POST['Nombres'];
$usuario = $_POST['usuarios'];
$clave = $_POST['clave'];
$email = $_POST['email'];


$sql = "INSERT INTO usuarios(nombre, user, clave, estado, email, privilegio) values ('$nombre', '$usuario', '$clave', 'a', '$email', '2')";
if ($conexion->query($sql) === true){
    echo '<script language="javascript">alert("USUARIO REGISTRADO!!");location.href ="principal.php";</script>';
}else{
    echo "Error: " . $sql . "<br>" . $conexion->error;
}
 mysqli_close($conexion); 
 ?>