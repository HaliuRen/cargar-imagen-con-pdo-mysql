<?php
require "conexion.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cargar imagen con PHP PDO</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" >
</head>

<body>
<div class="container">
  <div class="card">
    <div class="card-header"> Lista de imagenes </div>
    <div class="card-body">
      <?php
	
	$stmt = $conn->prepare('select * from imagenes');
	$stmt->execute();
	$lista_imagenes = $stmt->fetchAll();

	foreach($lista_imagenes as $imagen) {
	?>
      <img class="img-thumbnail" src="./subidas/<?=$imagen['nombre']?>" title="<?=$imagen['nombre'] ?>" width='200' height='200'>
      <?php
	}
	?>
    </div>
  </div>
</div>
</body>
</html>
