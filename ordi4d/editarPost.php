<?php
// Inicializar la configuración del sitio.
require_once('includes/config.inc.php');

/*Una variable local llamada "id" obtiene el id del botón de editar.
    Sin embargo, no se obtiene directamente de dicho botón en "indexPost.view.php" línea 42.
        Se obtiene por medio de la función "verificaEditar" del archivo ya mencionado. 
        */

$id=$_GET["id"];


/*La función "getById" en post.model.php obtiene un post de la base de datos con el parámetro del ID.
*/ 
$editPost= Post::getById($id);

// Returns the JSON representation of a value

// json_encode( mixed $value [, int $options = 0 [, int $depth = 512 ]]): string
// <?php
// function json_encode ($value, $options = 0, $depth = 512) {}
echo json_encode($editPost);


?>