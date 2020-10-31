<?php ob_start(); ?>
<form method="POST" action="<?= URL ?>back/animaux/modificationValidation" enctype="multipart/form-data">
    <div class="form-group">
        <label for="animal_nom">Nom de l'animal</label>
        <input type="text" class="form-control" id="animal_nom" name="animal_nom" value="<?= $animal['animal_nom'] ?>">
    </div>
    <div class="form-group">
        <label for="animal_description">Description</label>
        <textarea class="form-control" name="animal_description" id="animal_description" rows="3"><?= $animal['animal_description'] ?></textarea>
    </div>
    <div class="form-group">
        <label for="image">Image :</label>
        <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <div class="form-group">
        <label for="image">Familles :</label>
        <select class="form-control" name="famille_id" value="">
            <option></option>
            <?php foreach ($familles as $famille) : ?>
                <option value="<?= $famille['famille_id'] ?>" <?php if ($famille['famille_id'] === $animal['famille_id']) echo "selected"; ?>>
                    <?= $famille['famille_id'] ?> - <?= $famille['famille_libelle'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="row no-gutters">
        <div class="col-1"></div>
        <?php foreach ($continents as $continent) : ?>
            <div class="form-group form-check col-2">
                <input type="checkbox" class="form-check-input" id="continent" name="continent-<?= $continent['continent_id'] ?>" 
                <?php if (in_array($continent['continent_id'], $tabContinents))
                    echo "checked";    
                    ?>
                    >
                <label class="form-check-label" for="exampleCheck1"><?= $continent['continent_libelle'] ?></label>
            </div>
        <?php endforeach; ?>
        <div class="col-1"></div>
    </div>
    <button type="submit" class="btn btn-primary">Modifier</button>
</form>
<?php
$content = ob_get_clean(); /// recuperes le contenu dans le buffer
$titre = "Page de modification de l'animal: " . $animal['animal_nom'];
require "views/commons/template.php";
