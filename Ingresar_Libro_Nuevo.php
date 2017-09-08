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
  $insertSQL = sprintf("INSERT INTO libros (clave_libro, descripcion, titulo, autor, categoria, 
    year_publicacion, ruta) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['clave_libro'], "int"),
                       GetSQLValueString($_POST['descripcion'], "text"),
                       GetSQLValueString($_POST['titulo'], "text"),
                       GetSQLValueString($_POST['autor'], "text"),
                       GetSQLValueString($_POST['categoria'], "text"),
                       GetSQLValueString($_POST['year_publicacion'], "date"),
                       GetSQLValueString($_POST['ruta'], "text"));

  mysql_select_db($database_conexion_libros, $conexion_libros);
  $Result1 = mysql_query($insertSQL, $conexion_libros) or die(mysql_error());

  $insertGoTo = "Ingresar_Libro_Nuevo.php";
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
$query_consulta_libros = "SELECT * FROM libros";
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
<h1 class="titulo">Administrar libros</h1><br>
</div>
<div class="centrotabla2">
<table>

<form action="Buscar_Libro.php" method="post"> 
<input type="submit" name="butSubmit" value="Buscar Libro" class="input5">
<input type="text" name="buscar" size="24">
</form>

<br><br>

<tr>
    <td><div><strong>Clave</strong></div>
    <td><div><strong>Descripcion</strong></div>
    <td><div><strong>Titulo</strong></div>
    <td><div><strong>Autor</strong></div>
    <td><div><strong>Categoria</strong></div>
    <td><div><strong>Año Publicacion</strong></div>
    <td colspan="2"><div><strong>Ruta</strong></div></td>

  <?php do { ?>

<body class="body">

  <tr>
      <td><?php echo $row_consulta_libros['clave_libro']; ?></td>
      <td><?php echo $row_consulta_libros['descripcion']; ?></td>
      <td><?php echo $row_consulta_libros['titulo']; ?></td>
      <td><div><?php echo $row_consulta_libros['autor']; ?></div></td>
      <td><div><?php echo $row_consulta_libros['categoria']; ?></div></td>
      <td><div><?php echo $row_consulta_libros['year_publicacion']; ?></div></td>
      <td><div><?php echo $row_consulta_libros['ruta']; ?></div></td>
      <td><a href="Modificar_Libro_Nuevo.php?clave_libro=<?php echo $row_consulta_libros['clave_libro']; ?>">Modificar</a></td>
      <td><a href="Borrar_Libro_Nuevo.php?clave_libro=<?php echo $row_consulta_libros['clave_libro']; ?>">Eliminar</a></td>
<?php } while ($row_consulta_libros = mysql_fetch_assoc($consulta_libros)); ?>

</table>
</div>
<br>
<form method="post" name="form1" action="Ingresar_Libro_Nuevo.php">
<table class="centrotabla2">
<div class="libro">
<?php
//AQUI SE VISUALIZA EL PDF EN LA VENTANA DEL ADMINISTRADOR
$db = new mysqli('localhost', 'root1', '123', 'ugvirtual');
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
       echo "<embed src='$ruta' width='830' height='650'>";
        //echo "<a href='$ruta'></a>";
?>
<br>
</div>

<br>
<div class="centrotabla2">
  <tr> 
      <td>Clave Libro:</td>
      <td><input type="text" name="clave_libro" value="" size="24"></td>
    </tr>
    <tr> 
      <td>Descripcion:</td>
      <td><input type="text" name="descripcion" value="" size="24"></td>
  </tr> 
    <tr> 
      <td>Titulo:</td>
      <td><input type="text" name="titulo" value="" size="24"></td>
  </tr> 
    <tr> 
      <td>Autor:</td>
      <td><input type="text" name="autor" value="" size="24"></td>
  </tr> 
    <tr> 
      <td>Categoria:</td>
      <td><input type="text" name="categoria" value="" size="24"></td>
      </tr>

     <tr> 
      <td>Año Publicacion:</td>
      <td><input type="text" name="year_publicacion" value="" size="24"></td>
      </tr>

      <tr> 
      <td>Ruta:</td>
   <td><input type="file" name="ruta" value="" size="24"></td>-
      </tr>

      <td><input type="submit" value="Ingresar Libro"></td>  
      <input type="hidden" name="MM_insert" value="form1">
</table>
<br>
<a class="a" href="Principal.php">Regresar </a>&nbsp;&nbsp;&nbsp;
<a class="a" href="Libros_Totales.php">Ver libros</a><br>
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
