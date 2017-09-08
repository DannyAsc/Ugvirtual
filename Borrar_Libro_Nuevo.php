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

if ((isset($_GET['clave_libro'])) && ($_GET['clave_libro'] != "")) {
  $deleteSQL = sprintf("DELETE FROM libros WHERE clave_libro=%s",
                       GetSQLValueString($_GET['clave_libro'], "text"));

  mysql_select_db($database_conexion_libros, $conexion_libros);
  $Result1 = mysql_query($deleteSQL, $conexion_libros) or die(mysql_error());

  $deleteGoTo = "Ingresar_Libro_Nuevo.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
?>
<!DOCTYPE html>
<html>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  <title>"Borrar Libros"</title>
<body>

</body>
</html>
