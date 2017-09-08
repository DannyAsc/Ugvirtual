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
  $updateSQL = sprintf("UPDATE libros SET descripcion=%s, titulo=%s, autor=%s, categoria=%s, 
    year_publicacion=%s, ruta=%s WHERE clave_libro=%s",
                       GetSQLValueString($_POST['descripcion'], "text"),
                       GetSQLValueString($_POST['titulo'], "text"),
                       GetSQLValueString($_POST['autor'], "text"),
                       GetSQLValueString($_POST['categoria'], "text"),
                       GetSQLValueString($_POST['year_publicacion'], "date"),
                       GetSQLValueString($_POST['ruta'], "text"),
                       GetSQLValueString($_POST['clave_libro'],"int"));

  mysql_select_db($database_conexion_libros, $conexion_libros);
  $Result1 = mysql_query($updateSQL, $conexion_libros) or die(mysql_error());

  $updateGoTo = "Ingresar_Libro_Nuevo.php";
//te manda a la mims tabla principal
 //$updateGoTo = "tabla.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_conexion_libros, $conexion_libros);
$valor = $_GET['clave_libro'];
$query_modificar_consulta = "SELECT * FROM libros where clave_libro=$valor";
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
      <td>Clave Libro:</td>
      <td><?php echo $row_modificar_consulta['clave_libro']; ?></td>
    </tr>
    <tr>
      <td>Descripcion:</td>
      <td><input type="text" name="descripcion" value="<?php echo $row_modificar_consulta['descripcion']; ?>" size="32"></td>
    </tr>
    <tr>
      <td>Titulo:</td>
      <td><input type="text" name="titulo" value="<?php echo $row_modificar_consulta['titulo']; ?>" size="32"></td>
    </tr>
    <tr>
      <td>Autor:</td>
      <td><input type="text" name="autor" value="<?php echo $row_modificar_consulta['autor']; ?>" size="32"></td>
    </tr>
    <tr>
      <td>Categoria:</td>
      <td><input type="text" name="categoria" value="<?php echo $row_modificar_consulta['categoria']; ?>" size="32"></td>
    </tr>
    <tr>
      <td>Año Publicacion:</td>
      <td><input type="text" name="year_publicacion" value="<?php echo $row_modificar_consulta['year_publicacion']; ?>" size="32"></td>
    </tr>
 <tr>
      <td>Ruta:</td>
      <td><input type="file" name="ruta" value="<?php echo $row_modificar_consulta['ruta']; ?>" size="32"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" value="Modificar Libro"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="clave_libro" value="<?php echo $row_modificar_consulta['clave_libro']; ?>">
  
<p><a href="Ingresar_Libro_Nuevo.php">Regresar</a></p>
</form>
<p>&nbsp;</p>
</body>
</html>

<?php
mysql_free_result($modificar_consulta);
?>

