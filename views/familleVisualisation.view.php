<?php ob_start(); ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#ID</th>
            <th scope="col">Familles</th>
            <th scope="col">Description</th>
            <th scope="col" colspan="2">actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($familles as $famille) : ?>
            <?php if (empty($_POST['famille_id']) || $_POST['famille_id'] !== $famille['famille_id']) : ?>
                <tr>
                    <td><?= $famille['famille_id'] ?></td>
                    <td><?= $famille['famille_libelle'] ?></td>
                    <td><?= $famille['famille_description'] ?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="famille_id" value="<?= $famille['famille_id'] ?>">
                            <button class="btn btn-warning">Modifier</button>
                        </form>

                    </td>
                    <td>
                        <form action="<?= URL ?>/back/familles/validationSuppression" method="post" onsubmit="return confirm('etes-vous sur de vouloir supprimer cette famille?');">
                            <input type="hidden" name="famille_id" value="<?= $famille['famille_id'] ?>">
                            <button class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php else : ?>
                <form action="<?= URL ?>/back/familles/validationModification" method="post">
                    <tr>
                        <td><?= $famille['famille_id'] ?></td>
                        <td><input type="text" name="famille_libelle" class="form-control" id="famille_libelle" value="<?= $famille['famille_libelle'] ?>"></td>
                        <td><textarea name="famille_description" class="form-control" id="" rows="3"><?= $famille['famille_description'] ?></textarea></td>
                        <td></td>
                        <td colspan="2">
                            <input type="hidden" name="famille_id" value="<?= $famille['famille_id'] ?>">
                            <button class="btn btn-primary">Valider</button>
                        </td>
                    </tr>
                </form>
            <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
$content = ob_get_clean(); /// recuperes le contenu dans le buffer
$titre = "Page d'affichage des familles";
require "views/commons/template.php";
