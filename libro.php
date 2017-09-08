<?php
echo "<embed src='ejemplo.pdf'  width='830' height='650'>";

$db = new mysqli('localhost', 'root1', '123', 'ugvirtual');
//7$db = new mysqli('localhost',  'innova16_2013', 'municipio.2013','innova16_bolsa');
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}
$db->query("SET NAMES 'utf8'");
 $query= "SELECT * FROM `pdf`";
 $nombre = ""; $path = "";
        $result = $db->query($query);
        if ($result->num_rows>0){
          while($fila = $result->fetch_array()){
            $path = $fila['path'];
            $nombre = $fila['id_pdf'];
          }
        }
 //       echo "agregando libro:";
        echo "<embed src='$path' width='150' height='160'>";
		
?>
<p><a align="center" class ="links" href="index.php">Regresar</a></p>
<include>
</include>