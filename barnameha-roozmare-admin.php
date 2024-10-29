<?php
	load_plugin_textdomain('barnameha-csts','wp-content/plugins/barnameha-csts');
	require_once('barnameha-roozmare-function.php');
	
	if(isset($_POST[Submit])){
		update_option("broozmare_showdate", isset($_POST[sdate]) ? '1' : '0' );
		update_option("broozmare_showtime", isset($_POST[stime]) ? '1' : '0' );
		update_option("broozmare_usenewline", isset($_POST[newline]) ? '1' : '0' );
		update_option("broozmare_pages", isset($_POST[pages]) ? 'true' : 'false' );
		update_option("broozmare_theme", $_POST[theme]);
		update_option("broozmare_rcadmin", ($_POST[rcadmin]!='' && is_numeric($_POST[rcadmin]) ? $_POST[rcadmin] : '40' ));
		update_option("broozmare_rcdisplay", ($_POST[rcdisplay]!='' && is_numeric($_POST[rcdisplay]) ? $_POST[rcdisplay] : '20' ));
		echo "<div class=updated><p><strong>" . __('Roozmare Options Updated','barnameha-roozmare') . "</strong></p></div> ";
	}
	
	$broozmare_showdate = get_option('broozmare_showdate');
	$broozmare_showtime = get_option('broozmare_showtime');
	$broozmare_usenewline = get_option('broozmare_usenewline');
	$broozmare_pages = get_option('broozmare_pages');
	$broozmare_rcadmin = get_option('broozmare_rcadmin');
	$broozmare_rcdisplay = get_option('broozmare_rcdisplay');
	$broozmare_theme = get_option('broozmare_theme');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<form action="" method="post">
<div class="wrap">
<br /><br />
<table width="100%" border="0" cellspacing="5" cellpadding="0">
  <tr>
    <td width="250px"><?php _e('Display: ','barnameha-roozmare');?></td>
    <td><label for="sdate"><input name="sdate" type="checkbox" id="sdate" value="" <?php echo $broozmare_showdate=='1' ? "checked='checked'" : '' ?> /> 
    <?php _e('Show Date','barnameha-roozmare') ?></label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><label for="stime"><input name="stime" id="stime" type="checkbox" value="" <?php echo $broozmare_showtime=='1' ? "checked='checked'" : '' ?> /> <?php _e('Show Time','barnameha-roozmare') ?></label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><label for="newline"><input name="newline" id="newline" type="checkbox" value="" <?php echo $broozmare_usenewline=='1' ? "checked='checked'" : '' ?> /> <?php _e('Use New Line','barnameha-roozmare') ?></label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><label for="spages"><input name="pages" id="pages" type="checkbox" value="" <?php echo $broozmare_pages=='true' ? "checked='checked'" : '' ?> /> <?php _e('Pages','barnameha-roozmare') ?></label></td>
  </tr>  
  <tr>
    <td><?php _e('Theme: ','barnameha-roozmare') ?></td>
    <td><select name="theme" style="width:100px">
      		<?php br_themelist($broozmare_theme); ?>
    	</select>
	</td>
  </tr>
  <tr>
    <td><?php _e('Roozmare Count (admin page):','barnameha-roozmare') ?></td>
    <td><input size="3" name="rcadmin" type="text" value="<?php echo $broozmare_rcadmin ?>" />
     </td>
  </tr>
  <tr>
    <td valign="top"><?php _e('Roozmare Count (display page):','barnameha-roozmare') ?></td>
    <td><input size="3" name="rcdisplay" type="text" value="<?php echo $broozmare_rcdisplay ?>" /><br />
	<small><?php _e('Display with [barnameha-roozmare] in post content','barnameha-roozmare') ?></small></td>
  </tr>  
  <tr>
    <td>&nbsp;<p class="submit">
		<input type="submit" name="Submit" value="<?php _e('Save Changes','barnameha-roozmare');?>" />
	</p></td>
    <td></td>
  </tr>
</table>


</div>
</form>
<hr>
<?php _e('Barnameha Roozmare By: ','barnameha-roozmare'); ?>  <a href="http://www.design.barnameha.ir/" target="_blank"><?php _e('Barnameha','barnameha-roozmare'); ?></a> -  <?php _e('Mohammad Kafi (Parsa)','barnameha-roozmare'); ?> - <a href="http://www.barnameha.ir/support" target="_blank"><?php _e('Support','barnameha-roozmare'); ?></a> - <a href="http://www.barnameha.ir/" target="_blank"><?php _e('Website','barnameha-roozmare'); ?></a> - <a href="http://www.blog.barnameha.ir/" target="_blank"><?php _e('Weblog','barnameha-roozmare'); ?></a><br /><br />
</body>
</html>