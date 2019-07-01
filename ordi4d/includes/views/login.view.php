<?php
require_once("header.inc.php");
?>
</section>
<!-- termina cabecera -->
<br />
  <div class="container">
    <h4 class="title is-h4 has-text-centered">Ingresar al sistema</h4>
    <div class="columns">
      <div class="column is-half is-offset-one-quarter">
        <form action="logueo.php" method="POST">
          <div class="field">
            <label class="label">Correo</label>
            <div class="control">
              <input class="input" type="text" name="email" placeholder="e.g alexsmith@gmail.com">
            </div>
          </div>

          <div class="field">
            <label class="label">Contraseña</label>
            <div class="control">
              <input class="input" type="password" name="password" placeholder="Password">
            </div>
          </div>

          <div class="control">
            <button class="button is-medium is-primary">Entrar</button>
            </form>
          </div>
      </div>
    </div>
  </div>
  </div>
  <br />
<!-- termina cuerpo del documento -->
<?php
require_once("footer.inc.php");
?>