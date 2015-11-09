<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'itpeople');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'root');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'x@6FY5PTx+!!aymERQd j@aC(:L?m_2J+X0NNSHHs;|Dqdqc,)rWs`GOBq-D.x8:'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_KEY', 'qzu_wdhuzN({wLH$e5v?(-z-L2%c50sTZ<I4-u6~yf2#+[E$~MBfe.Eo**|+LY _'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_KEY', '$3b?+m<@X)HTli5>VSM}xj(uAF2vHp`oyntevG{]8X-;et-<$q~MIvG?!y|@W?OG'); // Cambia esto por tu frase aleatoria.
define('NONCE_KEY', 'Wf]7*KmwPua:eROCfzg62)z^iK-%EfQF&tx+pll#i|R)rziLqyU2)y:|~ik|)?Vd'); // Cambia esto por tu frase aleatoria.
define('AUTH_SALT', 'PV-IJHQZHSKjHQX-UFvy}YY|1(YE{<0tMHpkLw(zx*eppjua1pk{>,;:QzPNHC*:'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_SALT', 'L-5c,/C%bDHWG%!MvCg/8Vixhfw.@vT5~e;YisR`8rIH+|=wD>Rs_7oEt@E+,[rz'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_SALT', '.N>$]vf<x!cd+aoJw3g:^.@|;Oj1CGJ%-K;J*I+5`ndn9d*=}r}n,HLlrHDQ~pFv'); // Cambia esto por tu frase aleatoria.
define('NONCE_SALT', 'r,gw~QJ.>|sZ]Uw4YG:*WXr4-3TClm?k:Y^e]]{;WNt|;I|~X^xtR7RjyY8Z-u]d'); // Cambia esto por tu frase aleatoria.
/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';

/**
 * Idioma de WordPress.
 *
 * Cambia lo siguiente para tener WordPress en tu idioma. El correspondiente archivo MO
 * del lenguaje elegido debe encontrarse en wp-content/languages.
 * Por ejemplo, instala ca_ES.mo copiándolo a wp-content/languages y define WPLANG como 'ca_ES'
 * para traducir WordPress al catalán.
 */
define ('WPLANG', 'es_ES');

/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
?>
