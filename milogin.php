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
$nombre = $_POST['usuarios'];
$clave = $_POST['clave'];

$sql = "SELECT * FROM usuarios WHERE user = '$nombre' and clave = '$clave' and estado = 'a'";
$result = $conexion->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);
if ($row['estado']=='a') { 
    echo '<script language="javascript">alert("BIENVENIDO SU USUARIO ESTA ACTIVO!!");location.href ="principal.php";</script>';
}
if ($result->num_rows > 0) {     
  
    $_SESSION['loggedin'] = true;
    $_SESSION['usuario'] = $nombre;
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
    echo '<script language="javascript">alert("Bienvenido!!");location.href ="principal.php";</script>';
 } else { 
   echo '<script language="javascript">alert("USUARIO y PASSWORD INCORRECTA!!");location.href ="inicio.php";</script>';
 }
 mysqli_close($conexion); 
 ?>