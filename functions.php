<?php
/**
 *
 * Include all of our needed Classes and scripts
 */

// Useful global constants
define( 'SLIME_VERSION', '1.1.0' );

if ( ! defined( 'SCRIPT_DEBUG' ) ) {
	define( 'SCRIPT_DEBUG', true ); // Enable script debug by default. Should be disabled in production
}

require_once 'includes/Slime/class-slime.php';         // Slime Classes
require_once 'includes/Slime.php';            // Theme Class

/**
 * Instantiate our classes, kick the theme in gear.
 */

$theme = new Slime();
