<?php ob_start(); ?>

<?php
$content = ob_get_clean(); /// recuperes le contenu dans le buffer
$titre = "Page d'administration";
require "views/commons/template.php";
