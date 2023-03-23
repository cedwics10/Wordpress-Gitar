<?php

/**
 * update_option : creation ou mise à jour d'une paire clé/valeur dans la table "options"
 * get_option : récupère une valeur à partir de sa clé
 * checked : affiche "checked" si égalité
 * get_pages : liste des pages
 * get_posts : liste des articles
 */
function createCheckbox($tab, $idSelected)
{
    foreach ($tab as $page) {
        $ck = in_array($page->ID, $idSelected) ? " checked " : "";
?>
        <input type="checkbox" <?= $ck ?> name="pages[]" id="id<?= $page->ID ?>" value="<?= $page->ID ?>"><label for="id<?= $page->ID ?>"><?= $page->post_title ?></label><br>
<?php }
}

if (isset($_POST["btsubmit"])) {
    update_option("promo_texte", $_POST["promo_texte"]);
    $pages = $_POST["pages"] ?? [];
    update_option("promo_posts", $pages);
}

$promo_texte = get_option("promo_texte");
$promo_posts = get_option("promo_posts");
if ($promo_posts === false) $promo_posts = [];


?>
<div class="wrap">
    <h1><span class="dashicons dashicons-visibility" style="font-size:32px"></span>&nbsp;&nbsp;Setup Promo</h1>
    <form method="post">
        <?php wp_editor($promo_texte, "promo_texte"); ?>
        <br>
        <h3>Liste des pages</h3>
        <?php
        //récupération des pages
        $pages = get_pages();
        createCheckbox($pages, $promo_posts);
        ?>
        <h3>Liste des articles</h3>
        <?php
        //récupération des artciles
        $articles = get_posts();
        createCheckbox($articles, $promo_posts);
        ?>
        <br>
        <input type="submit" name="btsubmit" value="envoyer">
    </form>
</div>