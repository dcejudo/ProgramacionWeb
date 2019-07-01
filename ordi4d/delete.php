<?php 
// Inicializar la configuración del sitio.
require_once('includes/config.inc.php');


//Una variable local llamada "id" obtiene el id del botón de borrar.
//(Ver indexPost.view.php línea 43.)
        $id=$_GET["id"];

//Se crea un nuevo objeto "Post" (ver "post.model.php") con el nombre "delPost".
//NO SE CREA UN OBJETO EN LA BASE DE DATOS. 
//Solamente se instancia una clase para después poder hacer una sentencia SQL que hará la eliminación del post.
        $delPost=new Post();

//Al atributo "id" del objeto "delPost" (ver "post.model.php" línea 5) se le asigna la variable local "id".
//Se podría poner directamente el "$_GET["id"]" de la línea 8, pero es mejor una variable local, ya que es método "GET".
        $delPost->id=$id;

//Se invoca la función "delete" del objeto "delpost" (ver post.model.php línea 165)
        $delPost->delete();

//Se redirige a "indexPost.php"; en otras palabras, el inicio del blog.
//El blog aparecerá con todos los posts, menos el que se eliminó con el código de este archivo.
//El post queda completamente eliminado de la base de datos, y por tanto del "indexPost.php".
        redirect_to("indexPost.php");

?>