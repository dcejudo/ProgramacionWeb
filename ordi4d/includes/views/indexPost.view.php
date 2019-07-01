<?php
require_once("header.inc.php");
?>

<!--Ubicado en el mismo header, se pone el manejo de sesión del usuario, además de su nombre.-->
<h1 class="has-text-right">Bienvenido:&nbsp;<?php echo $_SESSION["nombre"]?>. | <a href="lib/logout.php"> Cerrar Sesión &nbsp;</a><h1>
</section>
<!-- termina cabecera -->
<br />


  <div class="container">
  <!--Texto de "Blog Simple" que aparece después del header de manera estática.-->
    <p class="is-right"><h4 class="title is-h4 has-text-centered">Blog Simple</h4><p>

<!--BOTÓN PARA CREAR UN NUEVO POST.
        Al darle click, se le agrega la clase "is-active" a la modal, lo que hace que aparezca encima del resto de la página.-->
    <p class="has-text-right "><button class="button is-success is-medium" onclick="$('.modal').addClass('is-active');"> Crear Post</button></p>


<!--Se delimita el espacio en el que aparecerán los posts. 
        Todos los posts tendrán el mismo formato.-->
    <div class="columns">
      <div class="column is-half is-offset-one-quarter">

        <!--INICIO DE CICLO FOR.-->
        <?php
        
        /*IMPORTANTE:
             Cuando se ven todos los posts en el blog, realmente está corriendo "indexPost.php" y NO "indexPost.view.php" (este archivo).
                Se puede ver el URL para comprobar este hecho.
             Es importante saberlo, ya que, al referenciarse este archivo en "indexPost.php", la variable "todosPost" usada a continuación
             es una variable declarada en "indexPost.php", pero la función "require" nos permite utilizarla como variable local aquí.
             (Ver el comentario de dicha variable en su archivo para más información.)

             Como nota final, la variable "todosPost", como se autodescribe, contiene todos los posts de la base de datos, 
             y debido a que dichos posts están guardados en la BD como "post" (verlo en localhost/phpmyadmin para comprobar),
             el ciclo está formulado como se muestra a continuación. 
            (La variable "i" es simplemente el contador.)
             */
        $i=1;
        foreach($todosPost as $post):
        ?>

<!--INICIO DE BULMA CARD PARA LOS POSTS.-->
<div class="card">
  <header class="card-header">
    <p class="card-header-title">
    <!--Cada post recibirá su título de acuerdo a lo que hay en la base de datos.-->
      <?php echo $post->title;?>
    </p>
    <a href="#" class="card-header-icon" aria-label="more options">
      <span class="icon">
        <i class="fas fa-angle-down" aria-hidden="true"></i>
      </span>
    </a>
  </header>
  <div class="card-content">
    <div class="content">
    <!--Al igual que con el título, el contenido se desplegará en el bulma card de manera acorde.-->
      <?php echo $post->content;?>
      <br>
      <br>
      <!--Lo siguiente es simplemente la fecha de creación, que también está registrada en la base de datos para cada post.-->
      <time> <strong>Fecha de publicación:</strong> <?php echo $post->created;?></time>
    </div>
  </div>
  <footer class="card-footer">
  <?php
  /*El "if" que está a continuación valida las siguientes condiciones:
            -Si el id del autor del post en la base de datos es el mismo al id del que tiene la sesión iniciada,
                le dará acceso a las funciones de editar y borrar.
            -En caso contrario, dichos botones simplemente no aparecerán.
                De esta manera, el usuario puede editar y borrar sus propios posts, pero sólo ver los posts de los otros.*/
  if($post->idAutor==$_SESSION["id"]){
  ?>
        <p class= "card-footer-item"><span>

        <!--
                -------LÓGICA DEL BOTÓN DE EDITAR:-------

            -Cada post tiene su id único en la base de datos.
            -Por tanto, el valor "value" del botón es el id del post al que se le da click en editar.
            -Tal id se manda a la función "verificaEditar" en forma de parámetro. (Dicha función se encuentra más abajo en este archivo.)
            -Dicho parámetro se introduce en la función ".get()" de jQuery.
            -A su vez, se hace una llamada a "editarPost.php" usando el parámetro como el value de un key "id".
            -Dicho key "id" no debe de confudirse con el resto de menciones id que de este comentario.
                Más bien, es el key que se utiliza en "editarPost.php" al usar $_GET["id"]; para obtener el número identificador del post.

                Con esta lógica, el valor del id se pasa:
                    1) Del botón a la función "verificaEditar", 
                    2) De la función "verificaEditar" a la sentencia jQuery, 
                    3) De la sentencia jQuery a "editarPost.php",
                    4) De "editarPost.php" de vuelta a la función "verificaEditar" en forma de JSON
                        (ver comentarios de dicho documento para más detalles),
                    5) Se le hace parsing al JSON para poder usarse en la función "verificaEditar",
                    6) Los valores de los campos se obtienen del JSON y se introducen en la modal para su modificación,
                    7) El post a editar técnicamente se sobreescribe, pero debido a que su id no cambió gracias al que el proceso descrito
                        siempre lo mantiene, en términos prácticos sólamente se edita.
                        
        -->
        <button value="<?php echo $post->id;?>" onclick="verificaEditar($(this).val())" class="button is-primary"> Editar </button>

            <!--BOTÓN DE ELIMINAR.
                    La lógica de este botón es mucho más simple a la del botón de editar.
                    - Al darle click, se va a la función "verifica" y le manda como parámetro tanto el archivo "delete.php" como el id del post. 
                    - Debido a que no es buena práctica el borrar algo sin antes preguntarle al usuario si se está seguro,
                        se le pregunta si desea eliminar el registro.
                    - Cuando el usuario dice que si, se incrusta en el URL todo lo que está como parámetro de la función "verifica"
                        en la línea de código que le sigue a este bloque de comentario.
                        Por tanto, manda la información necesaria para que "delete.php" se encargue de eliminar el post de la BD.
                        
                (Función situada casi al final de este archivo, antes de "verificaEditar". Ver su descripción para más detalles.)
                (Ver el archivo "delete.php" para más información sobre el proceso de borrado del lado del controlador.)
                    -->
        &nbsp;&nbsp;<button onclick="verifica('delete.php?id=<?php echo $post->id;?>')" class="button is-danger"> Borrar </button></span>
    </p>
  <?php
  } 
  ?>
  </footer>
  <!--FIN DEL BULMA CARD.-->
</div>
<br>
        
        <?php
         $i++;
        endforeach;
        ?>
        <!--FIN DEL CICLO FOR.-->
        </div>
      </div>
    </div>
  </div>
  </div>
  <br />

  <!--MODAL BULMA -->
  <div class="modal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Modal title</p>

      <!--BOTÓN DE CERRAR MODAL (Ubicado arriba a la derecha de la misma)-->
      <button class="delete" aria-label="close" onclick="$('.modal').removeClass('is-active');"></button>
    </header>
    <section class="modal-card-body">
    <form action="crearPost.php" method="POST">

      <!-- CAMPO TÍTULO ... -->
      <div class="field">
  <label class="label" >Título</label>
  <div class="control">
  <!--Se le da el id "title" para poder identificarlo de manera única cuando se requiera que despliegue información
            en el proceso de edición de posts.-->
    <input class="input" type="text" placeholder="Text input" name="title" id="title">
  </div>
</div>

        <!-- CAMPO CONTENIDO ... -->
<div class="field">
  <label class="label">Contenido</label>
  <div class="control">
  <!--Tal como con el id previo, a éste se le asigna el id "content" para que despliegue el contenido a editar cuando se necesite.-->
    <textarea class="textarea" placeholder="Textarea" name="content" id="content"></textarea>
  </div>
</div>
</section>

    <footer class="modal-card-foot">

    <!--BOTÓN DE PUBLICAR.-->

    <!--IMPORTANTE: CONTIENE DOS INPUTS TIPO "hidden".
            -El primero de estos dos es para que, al publicar un post, el id del usuario que lo hace se mantenga.
                Sin ese input, no tendría manera de asignarle el post al usuario, y por lo tanto el post no se crearía.-->
        <input type="hidden" name="idAutor" id="idAutor" value="<?php echo $_SESSION["id"];?>">
      <button class="button is-success" type="submit">Publicar</button>
        <!--El segundo existe ya que el mismo botón de publicar se utilizará para editar posts.
               El id del post en cuestión se guardará en ese input, y se validará en "crearPost.php".
               Dicho archivo tiene una función que usa el valor de "idEdit" para sobreescribir un post ya existente. 
            Para mayor claridad de este asunto, se puede inspeccionar la modal de cuando se crea un post nuevo, 
            y compararlo a cuando se edita un post ya existente.
                Cuando se crea uno nuevo, el input de la línea que sigue de este bloque de comentario no tiene valor.
                Cuando se edita uno existente, dentro del mismo input aparece el valor del post que queremos editar.-->
      <input type="hidden" id="idEdit" name="idEdit">

      <!--BOTÓN DE CANCELAR.
      Tiene exactamente la misma función que la "x" arriba a la derecha de la modal.-->
      <button class="button" onclick="$('.modal').removeClass('is-active');" >Cancelar</button>
    </footer>
    </form>
  </div>
</div>

<!--FIN DEL MODAL BULMA-->

<!--INICIO DEL CÓDIGO JAVASCRIPT-->
<script>

  //Código JavaScript de verificación para eliminar.
function verifica(ruta){
    if(confirm("¿Desea eliminar este registro?")){
        /*Debido a que la variable "ruta" es el parámetro con toda la sentencia GET para borrar el post en cuestión,
            la siguiente línea sólo le permite correrlo y así hacer la función de borrado que se explicó arriba. */
        window.location.href=ruta;
    }
}

  //Código JavaScript para editar un post.
function verificaEditar(idPost){
     //El comentario de la siguiente línea sólo se remueve para verificar que llegue la variable a la función.
     //alert(idPost);

     /*El método $.get() es un método de jQuery.
        De acuerdo a la página oficial, es un método para cargar datos del servidor con un request tipo GET.

      Lo primero que se hace es llamar al archivo "editarPost.php" con el parámetro {id=idPost}.
            -idPost es en sí el parametro que le llega a la función "verificaEditar".
            -Dicho idPost se incrusta dentro de un array, y en una variable "id" que se utilizará en editarPost.php.
              OJO: LLeva el nombre "id" porque en editarPost.php es ese el nombre de la variable que recibe el archivo.
                Para mayor claridad, checar la línea de código de editarPost.php que está después de "require_once();"  */
    $.get( "editarPost.php", { id: idPost} )
/*Todo que está dentro de ".done()" se realiza una vez que se termina de ejecutar el $.get() de la línea anterior.
    Esto quiere decir que realiza la función "function(data)". */ 
  .done(

    /*EL parámetro "data" es lo que recibe de "editarPost.php".
      Al ver dicho "editarPost.php", nos damos cuenta que envía toda a información del post a editar en forma de JSON.
      Como explicación breve, un JSON es simplemente un objeto que contiene llaves (keys) y el valor asociado a cada una de esas llaves.
        Se explica de manera muy sencilla aquí: https://ed.team/comunidad/que-es-un-json */
    function( data ) {

      /*En una nueva variable local llamada "json" (en minúsculas para que no se confunda con lo ya explicado de JSON) 
        se guardan los datos recibidos de "editarPost.php". 
          "JSON.parse()" es una función de JavaScript para poder utilizar una variable con formato JSON de manera adecuada. */
      var json= JSON.parse(data);

      /*La siguiente línea de código no es necesaria, pero es útil para ver qué le está llegando a la variable "json".
        Al abrir la consola en el navegador, veremos exactamente los mismos datos de la modal, pero en forma de JSON.
          De hecho, se verán más datos, ya que entre ellos está, por ejemplo, el id del usuario para la correcta reasignación del post una vez que se edite.*/
      console.log(json);
    
    /*------INICIO DE LLAMADAS A LA MODAL POR MEDIO DE JQUERY.------- 
    Las líneas que contienen un signo "#" llaman a la modal por medio de su identificador único que, como sabemos, no se puede repetir en un mismo HTML. 
    La única que varía es la última, que llama a la modal por medio de su clase.*/

      //En el campo del título, se agrega lo que está en la variable "json" con la llave "title".
      $("#title").val(json.title);

      //En el campo del contenido, se agrega lo que está en la variable "json" con la llave "content".
      $("#content").val(json.content);

      /*En el input escondido "idEdit" del botón de publicar (ya explicado en su apartado) se le agrega el id del post a editar.
          Para reiterar, se hace de esta manera para que "sobreescriba" (edite) el mismo post y no haga uno nuevo ni edite otro diferente que ya exista.
          La siguiente es una línea opcional para ver qué id tiene el post que estamos editando. Se ve en la consola.*/
      //console.log(json.id);
      $("#idEdit").val(json.id);
          
      /* Se le agrega la clase "is-active" a la modal.
      De acuerdo a la documentación de Bulma, esta es la manera de hacer que la modal aparezca encima de la página, ya que por defecto está escondida.
        Cabe notar que el hacer aparecer la modal es el último paso.
         Primero se llena la modal con la información requerida, y después se presenta al usuario ya con los datos a editar. */
      $(".modal").addClass("is-active");

      /*------FIN DE LLAMADAS A LA MODAL POR MEDIO DE JQUERY.------- */
    }

    );
}
</script>

<!-- termina cuerpo del documento -->
<?php
require_once("footer.inc.php");
?>