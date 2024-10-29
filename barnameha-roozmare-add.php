
<?php
	
	require_once('barnameha-roozmare-function.php');
	global $barnameha_r_table;
	
	if($_GET['a']=='edit' || $_POST['action']=='edit'){
		$action='edit';
		if($_GET['id']!='')
			$id=$_GET['id'];
		elseif($_POST['id']!='')
			$id=$_POST['id'];
		
	}else{
		$action='add';
	}
	
	if(isset($_POST[Submit])){
		$author = $_POST['author'];
		$content = trim($_POST['content']);
		$date = $_POST['date'];
		$time = $_POST['time'];	
		
		if($action=='add'){
			if($content!=''){
				$sql = "INSERT INTO $barnameha_r_table (barnamehar_author,barnamehar_content,barnamehar_date,barnamehar_time,barnamehar_rate,barnamehar_show) VALUES ('$author','$content','$date','$time','0','1')";
				if ( version_compare($wp_version, '2.3', '<') ) require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
				else require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				$r=$wpdb->query($sql);
				echo "<div class=updated><p><strong> " . __('Your roozmare has been sent','barnameha-roozmare') . "</strong></p></div> ";
				$content = '';
			}else{
				echo '<div class="error"><p>' . __('Please enter post content','barnameha-roozmare') . '</p></div>';
			}
			
		}elseif($action=='edit'){
			if($content!=''){
				$sql = "UPDATE $barnameha_r_table SET barnamehar_author='$author', barnamehar_content='$content' WHERE barnamehar_id='$id'";
				$wpdb->query($sql);
				ob_start();
				echo "<div class=updated><p><strong> " . __('Your roozmare save Changed','barnameha-roozmare') . "</strong></p></div> ";
			}else{
				echo '<div class="error"><p>' . __('Please enter post content','barnameha-roozmare') . '</p></div>';
			}
		}
	}
	
	if($action=='edit' && $id!=''){
		$sql = "SELECT * FROM $barnameha_r_table WHERE barnamehar_id='$id'";
		$br_rlist = $wpdb->get_results($sql);
		$author = $br_rlist[0]->barnamehar_author; 
		$content = $br_rlist[0]->barnamehar_content; 
		$date = $br_rlist[0]->barnamehar_date; 
		$time = $br_rlist[0]->barnamehar_time; 
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php echo "\n<script type=\"text/javascript\" src=\"" . get_option('siteurl') ."/wp-content/plugins/barnameha-roozmare/barnameha-r-js.js\"></script>\n"; ?>
</head>
<body>
<form action="" method="post" name="roozmare">
<div class="wrap">
<table width="100%" border="0" cellspacing="5" cellpadding="5">
  <tr>
    <td width="200px"><?php _e('Author: ','barnameha-roozmare'); ?></td>
    <td>
	<?php 
	 //if($action=='edit')
	 	br_userlist($author);
	 //else 
	 	//br_userlist('');
	 ?></td>
  </tr>
  <tr>
    <td valign="top"><?php _e('Roozmare: ','barnameha-roozmare'); ?><br /><br /><?php _e('Characters Left: ','barnameha-roozmare'); ?><input readonly type="text" name="remLen1" size="3" maxlength="3" value="140"></td>
    <td><textarea cols="60" rows="7" name="content" onKeyDown="textCounter(document.roozmare.content,document.roozmare.remLen1,140)"
onKeyUp="textCounter(document.roozmare.content,document.roozmare.remLen1,140)"><?php echo $content; ?></textarea>
<?php if($action=='edit'): ?>
	<script>
		textCounter(document.roozmare.content,document.roozmare.remLen1,140);
	</script>	
<?php endif; ?>
</td>
  </tr>
  <tr>
    <td><?php _e('Date & Time: ','barnameha-roozmare'); ?></td>
    <td><?php
		//date_default_timezone_set('Asia/Tehran');
		if($action=='edit'){
			$bdate = $date;
			$btime = $time;
		}else{
			date_default_timezone_set(get_option('timezone_string'));
			if (function_exists('jdate')) {
				$bdate = jdate("Y/m/d", time()) ;
				$btime = jdate("H:i a", time());
			}else{
				$bdate = date("Y/m/d", time());
				$btime = date("H:i a", time());
			} 
			
		}
		
			echo "$bdate - $btime";
		
	     ?>
	  <input type="hidden" name="date" value="<?php echo $bdate; ?>" />
	  <input type="hidden" name="time" value="<?php echo $btime; ?>" />
	  <input type="hidden" name="action" value="<?php echo $action; ?>" />
	  <input type="hidden" name="id" value="<?php echo $id; ?>" />
	  </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p class="submit">
		<input type="submit" name="Submit" value="<?php if($action=='add'){ _e('Add Roozmare','barnameha-roozmare'); }else{ _e('Roozmare Save Changed','barnameha-roozmare'); }?>" />
	</p></td>
  </tr>
  <tr>
  	<td height="300px"></td>
	 <td>&nbsp;</td>
  </tr>
</table>

</div>
</form>
<hr>
<?php _e('Barnameha Roozmare By: ','barnameha-roozmare'); ?>  <a href="http://www.design.barnameha.ir/" target="_blank"><?php _e('Barnameha','barnameha-roozmare'); ?></a> -  <?php _e('Mohammad Kafi (Parsa)','barnameha-roozmare'); ?> - <a href="http://www.barnameha.ir/support" target="_blank"><?php _e('Support','barnameha-roozmare'); ?></a> - <a href="http://www.barnameha.ir/" target="_blank"><?php _e('Website','barnameha-roozmare'); ?></a> - <a href="http://www.blog.barnameha.ir/" target="_blank"><?php _e('Weblog','barnameha-roozmare'); ?></a><br /><br />
</body>
</html>