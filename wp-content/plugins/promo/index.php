<?php
/*
Plugin Name: Promo
Plugin URI: http://wordpress.org/plugins/promo/
Description: Permet d'afficher un message sur certaines pages.
Author: Gilles
Version: 1.0.0
Author URI: http://gilles/
*/

//Ajouter une entrée de menu dans le tableau de bord
add_action("admin_menu", "charger_menu_promo");

function charger_menu_promo()
{
    add_menu_page("Setup Promo", "promo", "administrator", "menu_promo", "fct_page_promo");
}

//fonction qui s'execute quand on clique sur l'item de menu
function fct_page_promo()
{
    require "promo.php";
}

//Déclénche une fonction avant l'affichage de l'entete de page.
add_action('get_header', 'affiche_promo');

function affiche_promo()
{
    $promo_posts = get_option("promo_posts");
    if (in_array(get_the_ID(), $promo_posts))
        echo nl2br(get_option("promo_texte"));
}
