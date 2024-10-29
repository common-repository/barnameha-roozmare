
<?php
	require_once('barnameha-roozmare-function.php');
	global $barnameha_r_table, $wpdb;
	
	
	if($_GET['a']=='show' && $_GET['id']!='' && $_GET['s']!=''){
		if($_GET['s']=='1') $sbarnamehar_show ='0'; else $sbarnamehar_show ='1';
		$barnamehar_id = $_GET['id'];
		$sql = "UPDATE $barnameha_r_table SET barnamehar_show='$sbarnamehar_show' WHERE barnamehar_id='$barnamehar_id'";
		$wpdb->query($sql);
		echo "<div class=updated><p><strong> " . __('Your roozmare display changed.','barnameha-roozmare') . "</strong></p></div> ";
	}elseif($_GET['a']=='del' && $_GET['id']!=''){
		$barnamehar_id = $_GET['id'];
		$sql = "DELETE FROM $barnameha_r_table WHERE barnamehar_id = '$barnamehar_id' LIMIT 1";
		$wpdb->query($sql);
		echo "<div class=updated><p><strong> " . __('Your roozmare deleted.','barnameha-roozmare') . "</strong></p></div> ";
	}
		
	$rate = false;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php echo "\n<script type=\"text/javascript\" src=\"" . get_option('siteurl') ."/wp-content/plugins/barnameha-roozmare/barnameha-r-js.js\"></script>\n"; ?>
</head>
<body>
<form action="" method="post" name="roozmare">
<div class="wrap"><br /><br />
<table class="widefat fixed" cellspacing="0">
 <thead>
  <tr>
   <th id="cb" scope="col" class="manage-column column-cb check-column"></th>
   <th scope="col" class="manage-column column-name" width="100px"><?php _e('Author','barnameha-roozmare') ?></th>
   <th scope="col" class="manage-column column-name"><?php _e('Roozmare','barnameha-roozmare') ?></th>
   <th scope="col" class="manage-column column-name" width="70px"><?php _e('Date','barnameha-roozmare') ?></th>
   <th scope="col" class="manage-column column-name" width="70px"><?php _e('Time','barnameha-roozmare') ?></th>
   <?php if($rate){ ?><th scope="col" class="manage-column column-name" width="50px"><?php _e('Rate','barnameha-roozmare') ?> <?php } ?></th>
   <th scope="col" class="manage-column column-name" width="100px"><?php _e('Edit','barnameha-roozmare') ?></th>
  </tr>
 </thead>
 <tbody>
 	<?php 
		$brpage=$_GET['brpage'];
		br_roozmare($brpage); 
	?>   
  </tbody>
 <tfoot>

  <tr>
   <th id="cb" scope="col" class="manage-column column-cb check-column"></th>
   <th scope="col" class="manage-column column-name" width="200px"><?php _e('Author','barnameha-roozmare') ?></th>
   <th scope="col" class="manage-column column-name"><?php _e('Roozmare','barnameha-roozmare') ?></th>
   <th scope="col" class="manage-column column-name" width="70px"><?php _e('Date','barnameha-roozmare') ?></th>
   <th scope="col" class="manage-column column-name" width="70px"><?php _e('Time','barnameha-roozmare') ?></th>
   <?php if($rate){ ?><th scope="col" class="manage-column column-name" width="50px"><?php _e('Rate','barnameha-roozmare') ?> <?php } ?></th>
   <th scope="col" class="manage-column column-name" width="100px"><?php _e('Edit','barnameha-roozmare') ?></th>
  </tr>
 </tfoot>
 </table><br />
<center>
 <div style="width:400px">
 	<?php 
		$brpage=$_GET['brpage'];
		br_pageadmin($brpage);
	?>
 </div>
 </center>
<br /><br />
</div>
</form>
<hr>
<?php _e('Barnameha Roozmare By: ','barnameha-roozmare'); ?>  <a href="http://www.design.barnameha.ir/" target="_blank"><?php _e('Barnameha','barnameha-roozmare'); ?></a> -  <?php _e('Mohammad Kafi (Parsa)','barnameha-roozmare'); ?> - <a href="http://www.barnameha.ir/support" target="_blank"><?php _e('Support','barnameha-roozmare'); ?></a> - <a href="http://www.barnameha.ir/" target="_blank"><?php _e('Website','barnameha-roozmare'); ?></a> - <a href="http://www.blog.barnameha.ir/" target="_blank"><?php _e('Weblog','barnameha-roozmare'); ?></a><br /><br />
</body>
</html>