<html>
	<head>
        <meta charset="UTF-8">
		<title>AJAX</title>
         <!-- bootstrap CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		 <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
         <!-- bootstrap -->
         <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
         <script type="text/javascript">
             function volver(){
                 window.history.back();
             }
         </script>
    </head>
    <body>

<?php

if(isset($_POST['email']) && $_POST['password'])
{
$email = $_POST['email'];
$pass = $_POST['password'];

$btnError =  "<input type='button' class='btn btn-primary' onclick= 'volver()' value='Volver a Sign in'></input>";

if(isset($_FILES['fichero']))
	{
		if(!$_FILES['fichero']['error'])
		{

			$NOMEXT=explode(".", $_FILES['fichero']['name']);
			$EXT=end($NOMEXT);
			$arrayDeExtValida = array("jpg", "jpeg", "gif", "bmp");  //defino antes las extensiones que seran validas

			if(!in_array($EXT, $arrayDeExtValida))
			{
			   echo "<div class='alert alert-danger' role='alert'>Archivo de extension no valida</div></br>";
			   echo $btnError;
			}
			else
			{
    			$tamanio=$_FILES['fichero']['size'];
    			if($tamanio>1024000)
    			{
    				echo "Error: archivo muy grande!"."<br>";
    				echo $btnError;
    			}
    			else
    			{
    			
    			$ruta=getcwd();  //ruta actual del archivo en el servidor
    			$ruta=$ruta."/Fotos/";
    			
    			//Si quiero usar el nombre original de la foto
    			//$nomarch=$NOMEXT[0].".".$EXT;  // no olvidar el "." separador de nombre/ext
    			// sino uso el usuario o email
    			move_uploaded_file($_FILES['fichero']['tmp_name'], $ruta.$email.".".$EXT);
    			
    			echo "<div class='alert alert-info' role='alert'> Foto Guardada con éxito en carpeta Fotos del servidor.
    			</br>
    			Deben escribir código de guardado de usuario
    			</div>";
    			}
			}
		}
		else
		{
			echo "Error: ".$_FILES['fichero']['error'];
			echo "<br>";
			echo $btnError;
		}
	}
	else
    {
		echo "<div class='alert alert-danger' role='alert'>Error no cargó archivo</div></br>";
		echo $btnError;
    }
}
else
{
      echo "<div class='alert alert-danger' role='alert'>Debe ingresar mail y password</div>";
      echo $btnError;
}

?>

	</body>
</html>
