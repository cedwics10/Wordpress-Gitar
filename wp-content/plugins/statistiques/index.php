<?php
/*
Plugin Name: stats
Plugin URI: http://wordpress.org/plugins/onlinestats/
Description: Permet d'afficher un message sur certaines pages.
Author: Cedwics10
Version: 1.0.0
Author URI: http://cedwicsten/
*/

//Ajouter une entrée de menu dans le tableau de bord
add_action("admin_menu", "charger_menu_stats");

function charger_menu_stats()
{
    add_menu_page("Setup stats", "stats", "administrator", "menu_stats", "fct_page_stats");
}

//fonction qui s'execute quand on clique sur l'item de menu
function fct_page_stats()
{
    require "stats.php";
}

//Déclénche une fonction avant l'affichage de l'entete de page.
add_action('get_header', 'affiche_stats');

function multiexplode($delimiters, $string)
{

    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}

function affiche_stats()
{
    $dir  = 'C:\Portfolio\gitare\wp-content\plugins\statistiques\\';
    $mots_inutiles = explode("\ r\n", trim(file_get_contents(dirname(__FILE__) . '/mots_inutiles.txt')));

    $contenu = get_the_content();
    switch (get_post_type()) {
        case 'page':
            $type = "la page";
            break;
        case 'post':
            $type = "l'article";
            break;
        default:
            $type = 'inconnu';
            break;
    }

    echo "<div id='stats'>Ici les statistiques de $type !<br /><br />";


    $occurences = [];
    echo 'Longueur du texte : ' . strlen($contenu) . '<br />';

    $phrase_page = explode('.', $contenu);
    $occ_phrases_page = array_fill(0, count($phrase_page), 0);

    $mots_page = multiexplode([',', ' ', '.', ')', '('], $contenu);

    foreach ($mots_page as $mot) {
        if (in_array($mot, $mots_inutiles)) {
            continue;
        }
        $occurences[$mot] = $occurences[$mot] ?? 0;
        $occurences[$mot]++;
    }

    foreach ($phrase_page as $id => $phrase) {
        $mots = explode(' ', $phrase);
        foreach ($mots as $mot) {
            if (in_array($mot, $mots_inutiles)) {
                continue;
            }
            $occ_phrases_page[$id]++;
        }
    };

    arsort($occ_phrases_page, SORT_NUMERIC);
    foreach ($occ_phrases_page as $phrase => $occ) {
        echo "Phrase #$phrase : $occ, ";
    }
    echo '<br />';

    arsort($occurences, SORT_NUMERIC);

    echo 'Les 10 mots les plus utilisés de l\'article : ';

    $nbMots = 10;
    $i = 1;
    foreach ($occurences as $mot => $nbOccurence) {
        echo "$mot ($nbOccurence),";
        if ($i == 10) break;
        $i++;
    }

    echo '</pre>';

    echo '</div>';
}
