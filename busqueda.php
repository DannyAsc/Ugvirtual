<html> 
<body> 
  
<?php 
if (!isset($buscar)){ 
      echo "Debe especificar una cadena a bucar"; 
      echo "</html></body> \n"; 
      exit; 
} 
$link = mysql_connect("localhost", "ugvirtual"); 
mysql_select_db("mydb", $link); 
$result = mysql_query("SELECT * FROM agenda WHERE nombre LIKE '%$buscar%' ORDER BY nombre", $link); 
if ($row = mysql_fetch_array($result)){ 
      echo "<table border = '1'> \n"; 
//Mostramos los nombres de las tablas 
echo "<tr> \n"; 
while ($field = mysql_fetch_field($result)){ 
            echo "<td>$field->name</td> \n"; 
} 
      echo "</tr> \n"; 
do { 
            echo "<tr> \n"; 
            echo "<td>".$row["id"]."</td> \n"; 
            echo "<td>".$row["nombre"]."</td> \n"; 
            echo "<td>".$row["direccion"]."</td> \n"; 
            echo "<td>".$row["telefono"]."</td> \n"; 
            echo "<td><a href='mailto:".$row["email"]."'>".$row["email"]."</a></td> \n"; 
            echo "</tr> \n"; 
      } while ($row = mysql_fetch_array($result)); 
            echo "</table> \n"; 
} else { 
echo "¡ No se ha encontrado ningún registro !"; 
} 
?> 
  
</body> 
</html> 