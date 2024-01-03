<?php
/**
 * Slime Base Class
 *
 * Where is all starts. Includes all of our Classes
 *
 * @package Slime
 * @since   1.0
 */

namespace Slime;

require_once 'class-options.php';

/**
 * Class Core
 */
class Core {

	/**
	 * Construct
	 */
	public function __construct() {
		$slime_option   = new Options();

		add_action( 'admin_menu', array( $this, 'admin_menu' ), 999 );
	}

	/**
	 * Remove Editor submenu option in admin
	 */
	public function admin_menu() {
		remove_submenu_page( 'themes.php', 'theme-editor.php' );
	}
}
