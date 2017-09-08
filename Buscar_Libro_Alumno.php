<!DOCTYPE html>
<html>
<head>        
<meta charset="utf-8">
<title>Principal</title>
</head>
<body>
<p><a href="Principal2.php">Regresar</a></p>
</body>
</html>

<?php
$editFormAction = $_SERVER['PHP_SELF'];
//Aqui recibimos el envio post desde el formulario
//si no hay envio no se hace nada, en este caso
if( $_POST['buscar']  != "" ){
//conectamos con MYSQL
mysql_connect("localhost","root1","123");
//seleccionamos la base de datos "prueba"
mysql_query("use ugvirtual;");
//Utilizamos la funcion mysql_query() 
//para ejecutar la consulta SQL
//y la consulta se realiza de acuerdo 
//al termino de busqueda 
$queryPrimeraTabla = mysql_query("SELECT * from libros where titulo='".$_POST['buscar']."';");
//aqui comprobamos entonces si es mayor de cero 
if( mysql_num_rows($queryPrimeraTabla) > 0 ){
//Este codigo es el mismo de entradas anteriores
echo "<table border='1' cellpadding='4' cellspacing='0'>";
echo "<tr><td>Clave Libro</td><td>Titulo</td><td>Autor</td><td>Ruta</td></tr>";
while( $resultado = mysql_fetch_array($queryPrimeraTabla) ){
echo "<tr><td>";
echo $resultado['clave_libro'];
echo "<td></td>";
echo $resultado['titulo']; 
echo "<td></td>";
echo $resultado['autor'];
echo "<td></td>";
echo $resultado['ruta'];
}
echo "</table>";
}else{ //if( mysql_num_rows($queryPrimeraTabla) > 0 )
echo "<p />No se encontro <b>".$_POST['buscar']."</b> en la base de datos.";
} 
}
?>
