
<html>
	<head>
        <meta charset="UTF-8">
		<title>HTML5 File API</title>
         <!-- bootstrap CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		 <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
         <!-- bootstrap -->
         <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <script type="text/javascript">
        
            window.onload = function(){
                // Escuchador de evento change del input file
                document.getElementById("fichero").addEventListener('change', ficheroSeleccionado, false);
            };
	     function ficheroSeleccionado(evt) {
            var ficheros = evt.target.files;
            // Tan solo procesaremos el primer fichero
            var fichero = ficheros[0];
            var reader = new FileReader();
            console.log(fichero);
            if(fichero.type.match('image/jpeg') || fichero.type.match('image/jpg')|| fichero.type.match('image/gif') || fichero.type.match('image/bmp') ){
                $('#error').html("");
                $('#error').hide();
                leerImagen(reader, fichero);
            }
             else {
                $('#error').html("Extensión de imagen invalida");
                $('#error').show();
                $('#img').attr("src", "");
                $('#fichero').val("");
            }
        }

            function leerImagen(reader, fichero) {
                 reader.onloadend = function (ievt) {
                     if (ievt.target.readyState == FileReader.DONE) {
                         previsualizarImagen(ievt.target);
                    }
                 };
                 reader.readAsDataURL(fichero);
            }
            
             function previsualizarImagen(filereader) {
                 var datauri = filereader.result;
                 $('#img').attr("src", datauri);
             }
   		 </script>

	</head>
	<body>
        <div class="jumbotron">
            <div class="container">
                <h1>Cargar foto con HTML5 File API</h1>
                <h3>Previsualización sin usar Ajax permite al usuario probar varias imagenes y solo guardar en el servidor la elegida sin tener que
                borrar o pisar otras imagenes del mismo usuario. Con File Api es posible pedirle al usuario que suba archivos y leer el contenido de esos
                archivos sin tener que ir al servidor</h3>
                </br>
                <h3 class="label label-default">Registrate</h3>
                </br></br>
                <form enctype="multipart/form-data" method="post" action="gestion.php">
                <!-- Primera validación de el cliente con atributo required de html5-->
                <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email" required="required">
               </div>
               <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"  name="password" required="required">
                </div>
                <label>Archivo</label>
                </br>
                <input type="file" name="fichero" id="fichero" multiple data-min-file-count="1" required="required" accept="image/*"/>
                </br>
                </br>
                <label>Preview</label>
                <div id="error" class='alert alert-danger' role='alert' style="display:none"></div>
                </br>
                <img class="img-thumbnail" name = "imagen" id = "img" src="" alt="Imagen aqui" width="280" height="250">
                </br>
                <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
	</body>
</html>