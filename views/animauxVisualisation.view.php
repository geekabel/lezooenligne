<?php ob_start(); ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#ID</th>
            <th scope="col">Animaux</th>
            <th scope="col">Description</th>
            <th scope="col">Image</th>
            <th scope="col" colspan="2">actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($animaux as $animal) : ?>
            <tr>
                <td><?= $animal['animal_id'] ?></td>
                <td><?= $animal['animal_nom'] ?></td>
                <td><?= $animal['animal_description'] ?></td>
                <td><img src="<?= $animal['animal_images'] ?>" alt="par defaut"></td>
                <td>
                    <a href="<?= URL ?>/back/animaux/modification/<?= $animal['animal_id'] ?>" class="btn btn-warning">Modifier</a>
                </td>
                <td>
                    <form action="<?= URL ?>/back/animaux/validationSuppression" method="post" onsubmit="return confirm('êtes-vous sur de vouloir supprimer cette animaux?');">
                        <input type="hidden" name="animal_id" value="<?= $animal['animal_id'] ?>">
                        <button class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
$content = ob_get_clean(); /// recuperes le contenu dans le buffer
$titre = "Page d'affichage des Animaux";
require "views/commons/template.php";
