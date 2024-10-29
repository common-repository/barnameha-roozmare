<?php
 /* 
  Plugin Name: Barnameha Roozmare
  Plugin URI: http://www.design.barnameha.ir/
  Description: Post Per Day. <a href="http://www.barnameha.ir/support" target="_blank">Support</a> | <a href="http://www.barnameha.ir/" target="_blank">Website</a> | <a href="http://www.blog.barnameha.ir/" target="_blank">Weblog</a>
  Author: Mohammad Kafi | Parsa
  Version: 1.0.1
  Author URI: http://www.blog.barnameha.ir/
*/  
	require_once('barnameha-roozmare-function.php');
	load_plugin_textdomain('barnameha-roozmare','wp-content/plugins/barnameha-roozmare/languages');
	
	function b_roozmare_start($text){
		$text = str_replace('[barnameha-roozmare]',get_br_content(get_option('broozmare_rcdisplay')),$text);
		return $text;
	}
	add_filter('the_content','b_roozmare_start');
	
	function get_br_content($num,$page=true){
		$bctheme = get_option('broozmare_theme');
		$f = fopen(get_option('home') . "/wp-content/plugins/barnameha-roozmare/theme/" . $bctheme . ".html", "r");
		$fp = fopen(get_option('home') . "/wp-content/plugins/barnameha-roozmare/theme/" . $bctheme . "_p.html", "r");
		if($f==false || $fp==false){
			die(__('Error in open theme file.','barnameha-roozmare'));  
		}else{
			$post= br_post(stream_get_contents($fp),$num);
			$out = stream_get_contents($f);
			$out = str_replace('{br_post}',$post,$out);
			if($page)
				$out = str_replace('{br_page}',br_roozmarepage($num),$out);
			else
				$out = str_replace('{br_page}','',$out);
		}
		return $out ;
	}
	
	add_action('wp_print_styles', 'b_roozmare_stylesheets');
	function b_roozmare_stylesheets() {
		$bctheme = get_option('broozmare_theme');
		if(@file_exists(TEMPLATEPATH.'/theme/' . $bctheme . '_css.css')) {
			wp_enqueue_style('broozmare-page', get_stylesheet_directory_uri().'/theme/' . $bctheme . '_css.css', false, '2.50', 'all');
		} else {
			wp_enqueue_style('broozmare-page', plugins_url('barnameha-roozmare/theme/' . $bctheme . '_css.css'), false, '2.50', 'all');
		}	
	}
	
	function barnameha_roozmare($num=5,$page=true) {
		echo get_br_content($num,$page);
	}
	
	add_action( 'activate_barnameha-roozmare/barnameha-roozmare.php', 'b_roozmare_install' );
	function b_roozmare_install() {
		global $wpdb, $wp_version;
		global $barnameha_r_table;
		$barnameha_r_table = $wpdb->prefix . 'barnameha_roozmare';
		
		if ( empty($wp_version) || version_compare($wp_version, '2.5', '<') )  // if WP 2.1 or less
		exit('<div class="error"><p>This plugin requires WordPress version 2.5 or newer. Please remove it.</p></div></body></html>');
		
		// create or update the Post table
	
		if ( ($wpdb->get_var("show tables like '$barnameha_r_table'") != $barnameha_r_table) || (get_option('barnamehar_db_version') != '1.0') ) { 
	
			if ( version_compare(mysql_get_server_info(), '4.1.0', '>=') ) { // from WP
			   if ( ! empty($wpdb->charset) )
				  $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
			   if ( ! empty($wpdb->collate) )
				  $charset_collate .= " COLLATE $wpdb->collate";
			}
	
			$sql =  "CREATE TABLE " . $barnameha_r_table . " (".
					"barnamehar_id int(10) NOT NULL auto_increment,".
					"barnamehar_author varchar(50) NOT NULL default '',".
					"barnamehar_content varchar(500) NOT NULL default '',".
					"barnamehar_date varchar(20) NOT NULL default '0000/00/00',".
					"barnamehar_time VARCHAR(20) NOT NULL default '00:00:00',".
					"barnamehar_rate varchar(20) NOT NULL default '0',".
					"barnamehar_show varchar(10) NOT NULL default '1',".
					"PRIMARY KEY (barnamehar_id)) $charset_collate;";
	
			if ( version_compare($wp_version, '2.3', '<') ) require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
			else require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			maybe_create_table($barnameha_r_table, $sql);
		   
			$role = get_role('administrator');
			if(!$role->has_cap('manage_roozmare')) {
				$role->add_cap('manage_roozmare');
			}
			
			add_option("broozmare_showdate", "1");
			add_option("broozmare_showtime", "1");
			add_option("broozmare_usenewline", "0");
			add_option("broozmare_pages", "true");
			add_option("broozmare_theme", "simple");
			add_option("broozmare_rcadmin", "40");
			add_option("broozmare_rcdisplay", "20");
			add_option("barnameha_r_db_version", "1.0");
		}
	}
	
	### Function: Roozmare Administration Menu
	add_action('admin_menu', 'b_roozmare_menu');
	function b_roozmare_menu() {
		if (function_exists('add_menu_page')) {
			add_menu_page(__('Roozmare', 'barnameha-roozmare'), __('Roozmare', 'barnameha-roozmare'), 'manage_roozmare', 'barnameha-roozmare/barnameha-roozmare-add.php', '', plugins_url('barnameha-roozmare/images/br_admin_icon.png'));
		}
		
		
		if (function_exists('add_submenu_page')) {
			if($_GET['a']=='edit' || $_POST['action']=='edit'){
			add_submenu_page('barnameha-roozmare/barnameha-roozmare-add.php', __('Edit Roozmare', 'barnameha-roozmare'), __('Edit Roozmare', 'barnameha-roozmare'), 'manage_roozmare', 'barnameha-roozmare/barnameha-roozmare-add.php');
			}else{
			add_submenu_page('barnameha-roozmare/barnameha-roozmare-add.php', __('Add Roozmare', 'barnameha-roozmare'), __('Add Roozmare', 'barnameha-roozmare'), 'manage_roozmare', 'barnameha-roozmare/barnameha-roozmare-add.php');			
			}
			add_submenu_page('barnameha-roozmare/barnameha-roozmare-add.php', __('Manage Roozmare', 'barnameha-roozmare'), __('Manage Roozmare', 'barnameha-roozmare'), 'manage_roozmare', 'barnameha-roozmare/barnameha-roozmare-manage.php');		
			add_submenu_page('barnameha-roozmare/barnameha-roozmare-add.php', __('Roozmare Settings', 'barnameha-roozmare'), __('Roozmare Settings', 'barnameha-roozmare'), 'manage_roozmare', 'barnameha-roozmare/barnameha-roozmare-admin.php');
	
		}
	}
?>
