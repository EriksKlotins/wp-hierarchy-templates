<?php

$theme = wp_get_theme();
$textdomain = $theme->get('TextDomain');


$themeRoot = get_theme_root();

//**** Create child theme folder
$themePath = $themeRoot.'/'.$textdomain.'-child';
mkdir($themePath,0777,true);


//** Create style.css
$data = array(
 '/*',
 'Theme Name: '.  $theme->get('Name').' Child',
 'Theme URI: #',  
 'Description: ', 
 'Author: ',      
 'Author URI: #',
 'Template: '.$textdomain,
 'Version: 1.0.0',
 'Tags: ',
 'Text Domain: '. $textdomain.'-child',
 '*/',
 '/* *************************** */',
 '@import url("../'.$textdomain.'/style.css");'

);
file_put_contents($themeRoot.'/'.$textdomain.'-child/style.css', implode(chr(10).chr(13), $data));


//**** Create TEMPLATES folder
$themePath = $themeRoot.'/'.$textdomain.'-child/templates';
mkdir($themePath,0777,true);

//** Create index.mustache
$data = array(
 'insert mustache content here'
);
file_put_contents($themeRoot.'/'.$textdomain.'-child/templates/index.mustache', implode(chr(10).chr(13), $data));


//** create functions.php */
$className = ucfirst($textdomain).'Child';
$data = array(
	'<?php',
	'',
	'ini_set("display_errors",true);',
	'error_reporting(E_ALL);',
	'',
	'include_once(ABSPATH."wp-admin/includes/plugin.php");',
	'if(!is_plugin_active("wp-mustache/wp-mustache.php"))',
	'{',
	'include dirname(__FILE__)."/../../plugins/wp-mustache/wp-mustache.php";',
	'}',
	'',
	'class '.$className.' extends WTFHierarchyTemplates',
	'{',
	'',
	'protected function get_404_template() 	{ return parent::get_404_template(); }',
	'protected function get_search_template() { return parent::get_search_template(); }',
	'protected function get_front_page_template()',
	'{',
	'// to render mustache template',
	'// global $wp_query;',
	'// $m = new Mustache(get_stylesheet_directory()."/templates");',
	'// echo $m->render("index", $wp_query);',
	'// die()',
	'',
	'return parent::get_front_page_template();',
	'}',
	'protected function get_home_template() { return parent::get_home_template(); }',
	'protected function get_post_type_archive_template() { return parent::get_taxonomy_template(); }',
	'protected function get_taxonomy_template() { return parent::get_404_template(); }',
	'protected function get_attachment_template() { return parent::et_attachment_template(); }',
	'protected function get_single_template() { return parent::get_single_template(); }',
	'protected function get_category_template() { return parent::get_category_template(); }',
	'protected function get_author_template() { return parent::get_author_template(); }',
	'protected function get_date_template() { return parent::get_date_template(); }',
	'protected function get_archive_template() { return parent::get_archive_template(); }',
	'protected function get_comments_popup_template() { return parent::get_comments_popup_template(); }',
	'protected function get_paged_template() { return parent::get_paged_template(); }',
	'protected function get_index_template() { return parent::get_index_template(); }',
	'}',
	'new '.$className.'();'

);
file_put_contents($themeRoot.'/'.$textdomain.'-child/functions.php', implode(chr(10).chr(13), $data));




switch_theme($textdomain.'-child');
