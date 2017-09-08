<?php require_once('Connections/conexion_libros.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE alumno SET nombre_alumno=%s, contrasena_alumno=%s WHERE clave_alumno=%s",
                       GetSQLValueString($_POST['nombre_alumno'], "text"),
                       GetSQLValueString($_POST['contrasena_alumno'], "text"),
                       GetSQLValueString($_POST['clave_alumno'], "int"));

  mysql_select_db($database_conexion_libros, $conexion_libros);
  $Result1 = mysql_query($updateSQL, $conexion_libros) or die(mysql_error());

  $updateGoTo = "Ingresar_Alumno_Nuevo.php";
//te manda a la mims tabla principal
 //$updateGoTo = "tabla.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_conexion_libros, $conexion_libros);
$valor = $_GET['clave_alumno'];
$query_modificar_consulta = "SELECT * FROM alumno where clave_alumno=$valor";
$modificar_consulta = mysql_query($query_modificar_consulta, $conexion_libros) or die(mysql_error());
$row_modificar_consulta = mysql_fetch_assoc($modificar_consulta);
$totalRows_modificar_consulta = mysql_num_rows($modificar_consulta);
?>
<!DOCTYPE html>
<html>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  <title>"Tabla Modificar Libros"</title>
  <!--CSS PARA MIS TABLAS-->
  <style>
  table, td{border: 1px solid black;}
  </style>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table>
    <tr>
      <td>Clave Alumno:</td>
      <td><?php echo $row_modificar_consulta['clave_alumno']; ?></td>
    </tr>
    <tr>
      <td>Nombre Alumno:</td>
      <td><input type="text" name="nombre_alumno" value="<?php echo $row_modificar_consulta['nombre_alumno']; ?>" size="32"></td>
    </tr>
    <tr>
      <td>Contrase&ntilde;a Alumno:</td>
      <td><input type="text" name="contrasena_alumno" value="<?php echo $row_modificar_consulta['contrasena_alumno']; ?>" size="32"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" value="Modificar Alumno"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="clave_alumno" value="<?php echo $row_modificar_consulta['clave_alumno']; ?>">

<p><a href="Ingresar_Alumno_Nuevo.php">Regresar</a></p>

</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($modificar_consulta);
?>

