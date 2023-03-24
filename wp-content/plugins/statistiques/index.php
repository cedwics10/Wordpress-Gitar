<?php
/*
Plugin Name: stats
Plugin URI: http://wordpress.org/plugins/onlinestats/
Description: Permet d'afficher un message sur certaines pages.
Author: Cedwics10
Version: 1.0.0
Author URI: http://cedwicsten/
*/

function multiexplode($delimiters, $string)
{

    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}

include 'Statistiques.php';

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


function affiche_stats()
{
    $mesStats = new Statistiques();
    $mesStats->computeStats();
    $mesStats->afficherStats();
    $mesStats->jsButton();
}
