<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conexion_libros = "localhost";
$database_conexion_libros = "ugvirtual";
$username_conexion_libros = "root1";
$password_conexion_libros = "123";
$conexion_libros = mysql_pconnect($hostname_conexion_libros, $username_conexion_libros, $password_conexion_libros) or trigger_error(mysql_error(),E_USER_ERROR); 
?>