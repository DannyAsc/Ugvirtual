<?php require_once('Connections/conexion_libros.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_libros_consulta = 10;
$pageNum_libros_consulta = 0;
if (isset($_GET['pageNum_libros_consulta'])) {
  $pageNum_libros_consulta = $_GET['pageNum_libros_consulta'];
}
$startRow_libros_consulta = $pageNum_libros_consulta * $maxRows_libros_consulta;

mysql_select_db($database_conexion_libros, $conexion_libros);
$query_libros_consulta = "SELECT * FROM libros";
$query_limit_libros_consulta = sprintf("%s LIMIT %d, %d", $query_libros_consulta, $startRow_libros_consulta, $maxRows_libros_consulta);
$libros_consulta = mysql_query($query_limit_libros_consulta, $conexion_libros) or die(mysql_error());
$row_libros_consulta = mysql_fetch_assoc($libros_consulta);

if (isset($_GET['totalRows_libros_consulta'])) {
  $totalRows_libros_consulta = $_GET['totalRows_libros_consulta'];
} else {
  $all_libros_consulta = mysql_query($query_libros_consulta);
  $totalRows_libros_consulta = mysql_num_rows($all_libros_consulta);
}
$totalPages_libros_consulta = ceil($totalRows_libros_consulta/$maxRows_libros_consulta)-1;

$queryString_libros_consulta = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_libros_consulta") == false && 
        stristr($param, "totalRows_libros_consulta") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_libros_consulta = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_libros_consulta = sprintf("&totalRows_libros_consulta=%d%s", $totalRows_libros_consulta, $queryString_libros_consulta);
?>

<!DOCTYPE html>
<html>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  <title>"Total Libros"</title>
  <!--CSS PARA MIS TABLAS-->
  <style>
  table, td{border: 1px solid black;}
  </style>
  <p><b>DETALLES DE LOS LIBROS</b></p>
<table>
  <tr>
    <td>IdLibro
    <td>Nombre</td>
 
  <?php do { ?>
    <tr>
      <td><?php echo $row_libros_consulta['clave_libro']; ?>&nbsp; </td>
      <td><a href="Detalles_Libros.php?recordID=<?php echo $row_libros_consulta['clave_libro']; ?>"> <?php echo $row_libros_consulta['descripcion']; ?>&nbsp; </a> </td>

    <?php } while ($row_libros_consulta = mysql_fetch_assoc($libros_consulta)); ?>

  
    <?php if ($pageNum_libros_consulta > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_libros_consulta=%d%s", $currentPage, 0, $queryString_libros_consulta); ?>">Primero</a>
          <?php } // Show if not first page ?>
   
    <?php if ($pageNum_libros_consulta > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_libros_consulta=%d%s", $currentPage, max(0, $pageNum_libros_consulta - 1), $queryString_libros_consulta); ?>">Anterior</a>
          <?php } // Show if not first page ?>
    
    <?php if ($pageNum_libros_consulta < $totalPages_libros_consulta) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_libros_consulta=%d%s", $currentPage, min($totalPages_libros_consulta, $pageNum_libros_consulta + 1), $queryString_libros_consulta); ?>">Siguiente</a>
          <?php } // Show if not last page ?>
    
    <?php if ($pageNum_libros_consulta < $totalPages_libros_consulta) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_libros_consulta=%d%s", $currentPage, $totalPages_libros_consulta, $queryString_libros_consulta); ?>">Último</a>
          <?php } // Show if not last page ?>   
  </tr>
</table>
Registros <?php echo ($startRow_libros_consulta + 1) ?> a <?php echo min($startRow_libros_consulta + $maxRows_libros_consulta, $totalRows_libros_consulta) ?> de <?php echo $totalRows_libros_consulta ?>

<p><a href="Ingresar_Libro_Nuevo.php">Regresar</a></p>
</body>
</html>
<?php
mysql_free_result($libros_consulta);
?>
