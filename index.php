<?php
//Incluimos el fichero de conexión a MySQL
require "conexion.php";
	
if(isset($_POST['submit'])) {

	// Contamos la cantidad de imagenes
	$countfiles = count($_FILES['files']['name']);
	
	// Declaración preparada de la consulta SQL
	$query = "INSERT INTO imagenes (nombre,image) VALUES(?,?)";

	$statement = $conn->prepare($query);

	// Generamos el bucle de todos los archivos
	for($i = 0; $i < $countfiles; $i++) {

		// Extraemos en variable el nombre de archivo
		$filename = $_FILES['files']['name'][$i];
	
		// Designamos la carpeta de subida
		$target_file = 'subidas/'.$filename;
	
		// Obtenemos la extension del archivo
		$file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
			
		$file_extension = strtolower($file_extension);
	
		// Validamos la extensión de la imagen
		$valid_extension = array("png","jpeg","jpg", "pdf");
	
		if(in_array($file_extension, $valid_extension)) {

			// Subimos la imagen al servidor
			if(move_uploaded_file(
				$_FILES['files']['tmp_name'][$i],
				$target_file)
			) {

				// Ejecutamos la consulta SQL
				$statement->execute(
					array($filename,$target_file));
			}
		}
	}
	
	$respuesta = "Carga de archivos correctamente";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content=
		"width=device-width, initial-scale=1.0">
<title>Cargar imagen con PHP PDO</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" >
</head>

<body>
<div class="container"> <br>
  <div class="alert alert-primary" role="alert">
    <h4>Cargar imagen con PHP PDO</h4>
  </div>
  <?php
  if(isset($respuesta)){
 echo ' <div class="alert alert-success" role="alert"> '.$respuesta.'</div>'; 
  }?>
  
  <div class="card">
    <div class="card-header"> Subir imagenes </div>
    <div class="card-body">
      <form method='post' action='' enctype='multipart/form-data'>
        <div class="input-group mb-3">
          <div class="input-group-prepend"> <span class="input-group-text" id="inputGroupFileAddon01">Cargar</span> </div>
          <div class="custom-file">
            <input type='file' class="custom-file-input" id="inputGroupFile01" name='files[]' multiple />
            <label class="custom-file-label" for="inputGroupFile01">Seleccione...</label>
          </div>
        </div>
        <input class="btn btn-primary" type='submit' value='Cargar Imagen' name='submit' />
        <a href="ver.php" class="btn btn-success">Ver imagenes</a>
      </form>
    </div>
  </div>
</div>
</body>
</html>