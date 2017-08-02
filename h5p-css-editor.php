<?php
/*
Plugin Name: H5P CSS Editor
Plugin URI: 
Description: This plugin allow you to change the style of your H5P editor to match the style of your site.
Author: Ian Howatson
Version: 1.0
Text Domain: h5p-css-editor
Author URI: 
Date: 02/03/2017

Copyright 2017 Ian Howatson  (email : ian@howatson.net)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
function h5p_css_editor(&$styles, $libraries, $mode) {
	if ($mode === 'editor') {
		$styles[] = (object) array(
			'path' => plugins_url() . '/h5p-css-editor/h5p-css-editor.css',
			'version' => '?ver=0.1'
		);
	}
}
add_action('h5p_alter_library_styles', 'h5p_css_editor', 10, 3);
add_action('admin_menu', 'h5p_css_editor_submenu');
function h5p_css_editor_submenu() {
	add_menu_page('H5P CSS Editor', 'H5P CSS Editor', 'manage_options', 'hp5-css-editor', 'h5p_css_editor_callback');
	//add_submenu_page( 'h5p', 'H5P CSS Editor', 'H5P CSS Editor', 'manage_options', 'custompage', 'h5p_css_editor_callback');
}
function h5p_css_editor_callback() {
	if(isset($_POST['h5p-css-file'])) file_put_contents(plugin_dir_path(__FILE__).'h5p-css-editor.css', $_POST['h5p-css-file']); 
	$css_file = file_get_contents(plugin_dir_path(__FILE__).'h5p-css-editor.css');
	?>
	<h2><?php _e('CSS Editor', 'h5p-css-editor'); ?></h2>
	<form enctype="multipart/form-data" method="post" action="#" >
		<table class="table form-table mdocs-settings-table">
			<tr>
				<td>
					<textarea rows="75" cols="100%" name="h5p-css-file"><?php echo $css_file; ?></textarea><br>
					<input style="margin:15px;" type="submit" class="button-primary" value="<?php _e('Save Changes','memphis-documents-library') ?>" />
				</td>
			</tr>
		</table>
	</form>
	<?php
}
?>