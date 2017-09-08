<?php require_once('Connections/conexion_libros.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO alumno (clave_alumno, nombre_alumno, contrasena_alumno) VALUES (%s, %s,%s)",
                       GetSQLValueString($_POST['clave_alumno'], "int"),
                       GetSQLValueString($_POST['nombre_alumno'], "text"),
                       GetSQLValueString($_POST['contrasena_alumno'], "text"));

  mysql_select_db($database_conexion_libros, $conexion_libros);
  $Result1 = mysql_query($insertSQL, $conexion_libros) or die(mysql_error());

  $insertGoTo = "Ingresar_Alumno_Nuevo.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$maxRows_consulta_libros = 10;
$pageNum_consulta_libros = 0;
if (isset($_GET['pageNum_consulta_libros'])) {
  $pageNum_consulta_libros = $_GET['pageNum_consulta_libros'];
}
$startRow_consulta_libros = $pageNum_consulta_libros * $maxRows_consulta_libros;

mysql_select_db($database_conexion_libros, $conexion_libros);
$query_consulta_libros = "SELECT * FROM alumno";
$query_limit_consulta_libros = sprintf("%s LIMIT %d, %d", $query_consulta_libros, $startRow_consulta_libros, $maxRows_consulta_libros);
$consulta_libros = mysql_query($query_limit_consulta_libros, $conexion_libros) or die(mysql_error());
$row_consulta_libros = mysql_fetch_assoc($consulta_libros);

if (isset($_GET['totalRows_consulta_libros'])) {
  $totalRows_consulta_libros = $_GET['totalRows_consulta_libros'];
} else {
  $all_consulta_libros = mysql_query($query_consulta_libros);
  $totalRows_consulta_libros = mysql_num_rows($all_consulta_libros);
}
$totalPages_consulta_libros = ceil($totalRows_consulta_libros/$maxRows_consulta_libros)-1;

$queryString_consulta_libros = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_consulta_libros") == false && 
        stristr($param, "totalRows_consulta_libros") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_consulta_libros = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_consulta_libros = sprintf("&totalRows_consulta_libros=%d%s", $totalRows_consulta_libros, $queryString_consulta_libros);
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link href="estilo.css" rel="stylesheet" type="text/css">
  
  <title>"Tabla Libros"</title>
  <!--CSS PARA MIS TABLAS-->
  <style>
  table, td{border: 1px solid black;}

  </style>
  </head>

<div class="arriba"><br>
<h1 class="titulo">Administrar alumnos</h1><br>
</div>
<div class="centrotabla">
<table>

<form action="Buscar_Alumno.php" method="post"> 
<input type="submit" name="butSubmit" value="Buscar Alumno" class="input5">
<input type="text" name="buscar" size="24">
</form>
<br><br>

<tr>
    <td><div><strong>Clave</strong></div>
    <td><div><strong>Nombre</strong></div>
    <td colspan="2"><div><strong>Contraseña</strong></div></td>

  <?php do { ?>
<!-- AQUI SE VEN LOS ALUMNOS REGISTRADOS -->
<body class="body">
  <tr>
      <td><?php echo $row_consulta_libros['clave_alumno']; ?></td>
      <td><?php echo $row_consulta_libros['nombre_alumno']; ?></td>
      <td><?php echo $row_consulta_libros['contrasena_alumno']; ?></td>
      <td><a class="a" href="Modificar_Alumno_Nuevo.php?clave_alumno=<?php echo $row_consulta_libros['clave_alumno']; ?>">Modificar</a></td>
      <td><a class="a" href="Borrar_Alumno_Nuevo.php?clave_alumno=<?php echo $row_consulta_libros['clave_alumno']; ?>">Eliminar</a></td>
    
    <?php } while ($row_consulta_libros = mysql_fetch_assoc($consulta_libros)); ?>

</table>
</div>
<br>
<div class="centrotabla">

<form method="post" name="form1" action="Ingresar_Alumno_Nuevo.php">
  <table>
  <tr> 
      <td>Clave Alumno:</td>
      <td><input type="text" name="clave_alumno" value="" size="24"></td>
    </tr>
    <tr> 
      <td>Nombre Alumno:</td>
      <td><input type="text" name="nombre_alumno" value="" size="24"></td>
  </tr> 
    <tr> 
      <td>Contrase&ntilde;a Alumno:</td>
      <td><input type="text" name="contrasena_alumno" value="" size="24"></td>
  </tr> 
      <td><input type="submit" value="Ingresar Alumno"></td> 
      <input type="hidden" name="MM_insert" value="form1" size="24">
</form>
<br>
</table>
<br>
<a href="Principal.php">Regresar</a>
<a href="Alumnos_Totales.php">Ver Alumnos Registrados</a><br>
<br>
</div>

</html>

    <?php if ($pageNum_consulta_libros > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_consulta_libros=%d%s", $currentPage, 0, $queryString_consulta_libros); ?>">Primero</a>
          <?php } // Show if not first page ?>
    
    <?php if ($pageNum_consulta_libros > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_consulta_libros=%d%s", $currentPage, max(0, $pageNum_consulta_libros - 1), $queryString_consulta_libros); ?>">Anterior</a>
          <?php } // Show if not first page ?>
    
        <?php if ($pageNum_consulta_libros < $totalPages_consulta_libros) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_consulta_libros=%d%s", $currentPage, min($totalPages_consulta_libros, $pageNum_consulta_libros + 1), $queryString_consulta_libros); ?>">Siguiente</a>
          <?php } // Show if not last page ?>
    
  <?php if ($pageNum_consulta_libros < $totalPages_consulta_libros) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_consulta_libros=%d%s", $currentPage, $totalPages_consulta_libros, $queryString_consulta_libros); ?>">&Uacute;ltimo</a>
          <?php } // Show if not last page ?>

<?php
mysql_free_result($consulta_libros);
?>
