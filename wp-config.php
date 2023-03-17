<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'gitare' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'zb w|M VdZ5# %!a`~pc+*EPV$E7>i$TH;DxL4hX+N5X_?0^qdFIm{so(K+nn%G=' );
define( 'SECURE_AUTH_KEY',  'cDdfF|rBDBwEPaL#3c;b.@[]Td2xXtM&3WUVL4fl27L+G3:y<i;CRCBm!$[._6SW' );
define( 'LOGGED_IN_KEY',    '60 BtDLTG&28$a|+]I=~y)O%#(XSmG0HzvcLOvi>{,&x/D`Cd7dZ?|dGgm8_419H' );
define( 'NONCE_KEY',        'qLjyr?r)cua&@QI8qFrw*9dBC{}k8WSGX7n:SYFqnsC^~TC]D{oWW_:}(S&9hD4R' );
define( 'AUTH_SALT',        'eNXtC^i,7e[O[KeE)]K%OvF`:%-0MV4V=0#%ZN|&rjaEp!D#@6@KnL?.HkTX/n&t' );
define( 'SECURE_AUTH_SALT', '-(1(jX#fN?2Xrqhv~(V(kdRV..oOOtrRSm.-&ydX4iV8ncb^y$^=_u[:O?*+,wsk' );
define( 'LOGGED_IN_SALT',   '!#a&^Y*cb|xB.:s;kiX|%.(E^{R_[[}ELx[Ax0+DESx_FvFCOti[brfA8sPbh;<G' );
define( 'NONCE_SALT',       'As24Xy/{6Sz;2|+MCSnrR/)ykVm|t,b/3:,^RDG<L[(R6j[o<im7z71]>+UC(m9#' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'git_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
