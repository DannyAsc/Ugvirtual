<?php require_once('Connections/conexion_libros.php'); ?><?php
$maxRows_DetailRS1 = 10;
$pageNum_DetailRS1 = 0;
if (isset($_GET['pageNum_DetailRS1'])) {
  $pageNum_DetailRS1 = $_GET['pageNum_DetailRS1'];
}
$startRow_DetailRS1 = $pageNum_DetailRS1 * $maxRows_DetailRS1;

mysql_select_db($database_conexion_libros, $conexion_libros);
$recordID = $_GET['recordID'];
$query_DetailRS1 = "SELECT * FROM alumno WHERE clave_alumno = '$recordID'";
$query_limit_DetailRS1 = sprintf("%s LIMIT %d, %d", $query_DetailRS1, $startRow_DetailRS1, $maxRows_DetailRS1);
$DetailRS1 = mysql_query($query_limit_DetailRS1, $conexion_libros) or die(mysql_error());
$row_DetailRS1 = mysql_fetch_assoc($DetailRS1);

if (isset($_GET['totalRows_DetailRS1'])) {
  $totalRows_DetailRS1 = $_GET['totalRows_DetailRS1'];
} else {
  $all_DetailRS1 = mysql_query($query_DetailRS1);
  $totalRows_DetailRS1 = mysql_num_rows($all_DetailRS1);
}
$totalPages_DetailRS1 = ceil($totalRows_DetailRS1/$maxRows_DetailRS1)-1;
?>
<!DOCTYPE html>
<html>
<head>        
<meta charset="utf-8">
<title>Detalles Libros</title>
<!--CSS PARA MIS TABLAS-->
  <style>
  table, td{border: 1px solid black;}
  </style>
</head>
<body>
<table>
  <tr>
    <td><strong>Clave Alumno:</strong></td>
    <td><?php echo $row_DetailRS1['clave_alumno']; ?> </td>
  </tr>
  <tr>
    <td><strong>Nombre Alumno:</strong></td>
    <td><?php echo $row_DetailRS1['nombre_alumno']; ?> </td>
  </tr>
  <tr>
    <td><strong>Contrase&ntilde;a:</strong></td>
    <td><?php echo $row_DetailRS1['contrasena_alumno']; ?> </td>
  </tr>
  
</table>
<p><a href="Alumnos_Totales.php">Regresar</a></p>
</body>
</html>

<?php
mysql_free_result($DetailRS1);
?>
