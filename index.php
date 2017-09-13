<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>        
<meta charset="utf-8">
<title>Inicio</title>	
<link href="estilo.css" rel="stylesheet" type="text/css">
		
</head>    
<body class="librotablet">
 
  <header>
     <span style="color: white; font-size: 25px;" class="header"><a href="index.php">UG Store</a></span>
     <span class="header"><a href="Principal2.php">Tienda</a></span>
     <form name="buscador" action="libro.php" method="POST" ALIGN="center" id="buscador">
		<input style="color: blue; font-size: 25px; "  type="submit" name="butSubmit" value="Buscar Libro" >
		<input style="color: blue; font-size: 25px; "  type="text" name="buscar" size="24" id="text_busc">
	 </form>
          <label class="header" style="color: blue; font-size: 25px;">  </label>
		<ul class="regi" >
       <span>   <li >
       <?php 
           
    if (isset($_SESSION['usuario'])) {
        echo "$_SESSION[usuario]";
    echo '<a href="cerrar_sesion.php"> Cerrar Sesion</a>';
    }else{
    echo '<a href="inicio.php">LOGEARSE / REGISTRARSE</a>';
  }
?>
     <!-- <a href="inicio.php" >LOGEARSE / REGISTRARSE</a> --> </li> </span>

	 
      </ul>
 </header>
	</form>	  
 
 
  
  <div id="banner">
      <!--<h1>BIENVENIDO A SU TIENDA EN LINEA</h1><br>-->
  
  </div>
	
		<div id="header" hidden="hidden">
			<nav> <!-- Aqui estamos iniciando la nueva etiqueta nav -->
				<ul class="nav">
					<li><a href="">Ver</a></li>
					<li><a href="">Servicios</a>
						<ul>
							<li><a href="">Libro</a></li>
							<li><a href="">PDF</a></li>
							<li><a href="">EPUB</a></li>
								<ul>
									<li><a href="">Submenu1</a></li>
									<li><a href="">Submenu2</a></li>
									<li><a href="">Submenu3</a></li>
									<li><a href="">Submenu4</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li><a href="">Acerca de</a>
						<ul>
							<li><a href="">Submenu1</a></li>
							<li><a href="">Submenu2</a></li>
							<li><a href="">Submenu3</a></li>
							<li><a href="">Submenu4</a></li>
						</ul>
					</li>
					<li><a href="">Contacto</a></li>
				</ul>
			</nav><!-- Aqui estamos cerrando la nueva etiqueta nav -->
		</div>
	
	<!-- -----------------Galeria-------------------------------- -->
	
	<div id="servicios">
              <div>
                  <img src="Galeria-Libros/C-C++%202015.jpg" alt="">
                  <h4>C/C++ 2015</h4>
              </div>
              <div>
                  <img src="Galeria-Libros/Microsoft-Word.JPG" alt="">
                  <h4>Microsoft Word 2016</h4>
              </div>
              <div>
                  <img src="Galeria-Libros/Android-2013.jpg" alt="">
                  <h4>Android 2013</h4>
              </div>
              <div>
                  <img src="Galeria-Libros/Excel-2016.jpg" alt="">
                  <h4>Excel 2016</h4>
              </div>
              <div>
                  <img src="Galeria-Libros/Programacion-estructurada-C.jpg" alt="">
                  <h4>Prog Estrucutrada en C</h4>
              </div>
              <div>
                  <img src="Galeria-Libros/Java.jpg" alt="">
                  <h4>Java</h4>
              </div>
              <div>
                  <img src="Galeria-Libros/Android4.jpg" alt="">
                  <h4>Android 4</h4>
              </div>
              <div>
                  <img src="Galeria-Libros/Perl.jpg" alt="">
                  <h4>Perl</h4>
              </div>
              <div>
                  <img src="Galeria-Libros/PHP-y-MySQL.jpg" alt="">
                  <h4>PHP y MySQL</h4>
              </div>
              <div>
                  <img src="Galeria-Libros/clean-code.jpg" alt="">
                  <h4>Clean Code</h4>
              </div>
              <div>
                  <img src="Galeria-Libros/Java-for-Games.jpg" alt="">
                  <h4>Java For Game</h4>
              </div>
              <div>
                  <img src="Galeria-Libros/Python3.jpg" alt="">
                  <h4>Python 3</h4>
              </div>
              <div>
                  <img src="Galeria-Libros/gestionando-gestores.jpg" alt="">
                  <h4>Managing Managers</h4>
              </div>
          </div>
		  
<!-- --------------------------------Fin de Galeria----------------------------------- -->
	
	<br>
 <div>
                  <img src="libro.jpg" alt="">
                  <h4>Tus Mejores ediciones</h4>
              </div>

</body>
</html>