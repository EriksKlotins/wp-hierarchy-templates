<?php

/**
 * Plugin Name:  WTF WP hierarchy templates
 * Plugin URI:   http://wtf.lv
 * Description:  WTF WP hierarchy templates
 * Version:      0.1
 * Author:       WTF
 * Author URI:   http://wtf.lv
 * License:      commercial
 * Text Domain:  wtf-hierarchy-templates
 */



register_activation_hook( __FILE__, 'WTFHierarchyTemplates_activate' );


function WTFHierarchyTemplates_activate() 
{

   include 'classes/wtf-hierarchy-templates-install.php';
}

class WTFHierarchyTemplates
{
	public function __construct()
	{
		add_filter( 'template_include', array($this,'routing'), 99 );

		// mustache plagina errors

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		if(!is_plugin_active('wp-mustache/wp-mustache.php'))
		{
			function my_admin_notice()
			{
		    	?>
		    	<div class="error">
		        	<p><?php echo 'Nepieciešams mustache plugins!'; ?></p>
		    	</div>
		    	<?php
			}
			add_action( 'admin_notices', 'my_admin_notice' );
		}
	}
	
	public function routing($file)
	{
		if     ( is_404()            && $template = $this->get_404_template()            ) :
		elseif ( is_search()         && $template = $this->get_search_template()         ) :
		elseif ( is_front_page()     && $template = $this->get_front_page_template()     ) :
		elseif ( is_home()           && $template = $this->get_home_template()           ) :
		elseif ( is_post_type_archive() && $template = $this->get_post_type_archive_template() ) :
		elseif ( is_tax()            && $template = $this->get_taxonomy_template()       ) :
		elseif ( is_attachment()     && $template = $this->get_attachment_template()     ) :
			remove_filter('the_content', 'prepend_attachment');
		elseif ( is_single()         && $template = $this->get_single_template()         ) :
		elseif ( is_page()           && $template = $this->get_page_template()           ) :
		elseif ( is_category()       && $template = $this->get_category_template()       ) :
		elseif ( is_tag()            && $template = $this->get_tag_template()            ) :
		elseif ( is_author()         && $template = $this->get_author_template()         ) :
		elseif ( is_date()           && $template = $this->get_date_template()           ) :
		elseif ( is_archive()        && $template = $this->get_archive_template()        ) :
		elseif ( is_comments_popup() && $template = $this->get_comments_popup_template() ) :
		elseif ( is_paged()          && $template = $this->get_paged_template()          ) :
		else :
			$template = get_index_template();
		endif;
		return $template;
	}

	/**
	 * Te ir overraidotas defaultās tēmas lietas
	 */

	protected function get_404_template() 	{ return get_404_template(); }
	protected function get_search_template() { return get_search_template(); }
	protected function get_front_page_template() { return get_front_page_template(); }
	protected function get_home_template() { return get_home_template(); }
	protected function get_post_type_archive_template() { return get_taxonomy_template(); }
	protected function get_taxonomy_template() { return get_404_template(); }
	protected function get_attachment_template() { return get_attachment_template(); }
	protected function get_single_template() { return get_single_template(); }
	protected function get_category_template() { return get_category_template(); }
	protected function get_author_template() { return get_author_template(); }
	protected function get_date_template() { return get_date_template(); }
	protected function get_archive_template() { return get_archive_template(); }
	protected function get_comments_popup_template() { return get_comments_popup_template(); }
	protected function get_paged_template() { return get_paged_template(); }
	protected function get_index_template() { return get_index_template(); }
}
