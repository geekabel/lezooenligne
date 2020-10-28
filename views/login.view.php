<?php ob_start(); ?>
<form method="POST" action="<?= URL ?>back/connexion">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <button type="submit" class="btn btn-primary">Valider</button>
</form>
<?php
$content = ob_get_clean(); /// recuperes le contenu dans le buffer
$titre = "Login";
require "views/commons/template.php";