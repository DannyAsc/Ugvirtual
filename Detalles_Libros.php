<?php require_once('Connections/conexion_libros.php'); ?><?php
$maxRows_DetailRS1 = 10;
$pageNum_DetailRS1 = 0;
if (isset($_GET['pageNum_DetailRS1'])) {
  $pageNum_DetailRS1 = $_GET['pageNum_DetailRS1'];
}
$startRow_DetailRS1 = $pageNum_DetailRS1 * $maxRows_DetailRS1;

mysql_select_db($database_conexion_libros, $conexion_libros);
$recordID = $_GET['recordID'];
$query_DetailRS1 = "SELECT * FROM libros WHERE clave_libro = '$recordID'";
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
    <td><strong>Clave Libro:</strong></td>
    <td><?php echo $row_DetailRS1['clave_libro']; ?> </td>
  </tr>
  <tr>
    <td><strong>Descripcion:</strong></td>
    <td><?php echo $row_DetailRS1['descripcion']; ?> </td>
  </tr>
  <tr>
    <td><strong>Titulo:</strong></td>
    <td><?php echo $row_DetailRS1['titulo']; ?> </td>
  </tr>
  <tr>
    <td><strong>Autor:</strong></td>
    <td><?php echo $row_DetailRS1['autor']; ?> </td>
  </tr>
  <tr>
    <td><strong>Categoria:</strong></td>
    <td><?php echo $row_DetailRS1['categoria']; ?> </td>
  </tr>
  <tr>
    <td><strong>A&ntilde;o Publicacion:</strong></td>
    <td><?php echo $row_DetailRS1['year_publicacion']; ?> </td>
  </tr>
 <tr>
    <td><strong>Ruta:</strong></td>
    <td><?php echo $row_DetailRS1['ruta']; ?> </td>
  </tr>
</table>
<p><a href="Libros_Totales.php">Regresar</a></p>
</body>
</html>

<?php
mysql_free_result($DetailRS1);
?>

<?php
//AQUI SE VISUALIZA EL PDF EN LA VENTANA DEL ADMINISTRADOR
$db = new mysqli('localhost', 'angelwha', 'whaangel8', 'BibliotecaVirtual');
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}
$db->query("SET NAMES 'utf8'");
 $query= "SELECT * FROM `libros`";
 $clave_libro = ""; $ruta = "";
        $result = $db->query($query);
        if ($result->num_rows>0){
          while($fila = $result->fetch_array()){
            $ruta = $fila['ruta'];
            $clave_libro = $fila['clave_libro'];
          }
        }
        echo "Nombre del Libro:",$ruta, '<br>';
       echo "<embed src='$ruta' width='500' height='300'>";
        //echo "<a href='$ruta'></a>";
?>