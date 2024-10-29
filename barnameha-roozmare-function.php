<?php
	global $barnameha_r_table;
	global $wpdb;
	$barnameha_r_table = $wpdb->prefix . 'barnameha_roozmare';
	$limit = 20;
	
	function br_userlist($u){
		global $wpdb;
		$sql = "SELECT * FROM $wpdb->users";
		$br_ulist = $wpdb->get_results($sql);
		
		echo '<select name="author" name="select">';
		foreach($br_ulist as $user){
			$display_name=$user->display_name;
			if($u==$display_name)
				echo "<option value='$display_name' selected='selected'>" . $display_name . "</option>";
			else
				echo "<option value='$display_name'>" . $display_name . "</option>";
		}
		echo '</select>';
	}
	
	function br_roozmare($page=1){
		global $wpdb,$barnameha_r_table,$limit;
		$limit = get_option('broozmare_rcadmin');
		$broozmare_usenewline = get_option('broozmare_usenewline');
		
		$page=$page=='' ? 0 : $page-1;
		$p=$page*$limit;
		$sql = "SELECT * FROM $barnameha_r_table ORDER BY barnamehar_id DESC LIMIT $p, $limit";
		$br_rlist = $wpdb->get_results($sql);
		
		while(count($br_rlist)==0 && $page!=0){
			$page--;
			$p=$page*$limit;
			$sql = "SELECT * FROM $barnameha_r_table ORDER BY barnamehar_id DESC LIMIT $p, $limit";
			$br_rlist = $wpdb->get_results($sql);
		}
	?>
		
		 <?php foreach($br_rlist as $roozmare){ ?>
	   <tr class="alternate" valign="middle" id="link-2">
	
		  <th class="check-column" scope="row">
		 
		</th>
		<td class="column-name">
		 <strong>
		  <?php echo $roozmare->barnamehar_author; ?>
		 </strong>
		</td>
		<td class="column-name">
			<?php 
				$content = $roozmare->barnamehar_content ;
				if($broozmare_usenewline) $content = str_replace("\n","<br />",$content);
				echo $content;
			?>   
		</td>
		<td class="column-name">
		 <?php echo $roozmare->barnamehar_date ; ?>
		</td>
		<td class="column-name">
		  <?php echo $roozmare->barnamehar_time ; ?>
		</td>
		<?php if($rate){ ?><td align="center" class="column-name"><?php echo $roozmare->barnamehar_rate ; ?></td><?php } ?>
			<td align="center" class="column-name">
			
			<a href="?page=barnameha-roozmare/barnameha-roozmare-manage.php&a=show&id=<?php $barnamehar_show=$roozmare->barnamehar_show;  echo $roozmare->barnamehar_id . "&s=" . $barnamehar_show . ($_GET['brpage']!="" ? "&brpage=" . $_GET['brpage'] : ""); ?>"><img alt="<?php _e('Change Display','barnameha-roozmare') ?>" title="<?php _e('Change Display','barnameha-roozmare') ?>" src="../wp-content/plugins/barnameha-roozmare/images/<?php if($barnamehar_show=='1') echo 'eye.png'; elseif($barnamehar_show=='0') echo 'eye-ds.png';?>" alt="" width="16" height="16" /></a>
			
			<a href="?page=barnameha-roozmare/barnameha-roozmare-add.php&a=edit&id=<?php echo $roozmare->barnamehar_id; ?>"><img alt="<?php _e('Edit Roozmare','barnameha-roozmare') ?>" title="<?php _e('Edit Roozmare','barnameha-roozmare') ?>" src="../wp-content/plugins/barnameha-roozmare/images/pencil.png" alt="" width="16" height="16" /></a>
			
			<a href="#" onclick="javascript:roozmare_go('?page=barnameha-roozmare/barnameha-roozmare-manage.php&a=del&id=<?php  echo $roozmare->barnamehar_id . ($_GET['brpage']!="" ? "&brpage=" . $_GET['brpage'] : ""); ?>','<?php _e('Do You want delete this roozmare?','barnameha-roozmare') ?>');"><img alt="<?php _e('Delete Roozmare','barnameha-roozmare') ?>" title="<?php _e('Delete Roozmare','barnameha-roozmare') ?>" src="../wp-content/plugins/barnameha-roozmare/images/delete.png" alt="" width="16" height="16" /></a>
			   </td>
	   </tr>
	   <?php } ?>
	
	<?php
	}
	
	function br_pageadmin($page=1){
		global $wpdb,$barnameha_r_table,$limit;
		$limit = get_option('broozmare_rcadmin');
		$page=$page=='' ? 0 : $page-1; 
		$p=$page*$limit;
		
		$sql = "SELECT * FROM $barnameha_r_table";
		$br = $wpdb->get_results($sql);
		
		$sql = "SELECT * FROM $barnameha_r_table ORDER BY barnamehar_id DESC LIMIT $p, $limit";
		$br_rlist = $wpdb->get_results($sql);
		
		while(count($br_rlist)==0 && $page!=0){
			$page--;
			$p=$page*$limit;
			$sql = "SELECT * FROM $barnameha_r_table ORDER BY barnamehar_id DESC LIMIT $p, $limit";
			$br_rlist = $wpdb->get_results($sql);
		}
		
		$co = count($br);
		$page++;
		$ps=1;
		if($co>0) echo '| ';
		for($j=0;$j<=$co-1;$j+=$limit){
			if($page!=$ps){
				echo '<a href="?page=barnameha-roozmare/barnameha-roozmare-manage.php&brpage=' . $ps . '">' . $ps . '</a> | ';
			}else{
				echo  $ps . ' | ';
			}
			$ps++;
		}
	}
	
	function br_roozmarepage($num){
		global $wpdb,$barnameha_r_table,$limit;
		$limit = $num; //get_option('broozmare_rcdisplay');
		$home = get_permalink();
		$page=$_GET['brpage'];
		$page=$page=='' ? 0 : $page-1; 
		$p=$page*$limit;
		
		$sql = "SELECT * FROM $barnameha_r_table WHERE barnamehar_show='1'";
		$br = $wpdb->get_results($sql);
		
		$sql = "SELECT * FROM $barnameha_r_table WHERE barnamehar_show='1' ORDER BY barnamehar_id DESC LIMIT $p, $limit";
		$br_rlist = $wpdb->get_results($sql);
		
		while(count($br_rlist)==0 && $page!=0){
			$page--;
			$p=$page*$limit;
			$sql = "SELECT * FROM $barnameha_r_table WHERE barnamehar_show='1' ORDER BY barnamehar_id DESC LIMIT $p, $limit";
			$br_rlist = $wpdb->get_results($sql);
		}
		
		$co = count($br);
		$page++;
		$ps=1;
		$out='';
		if($co>$limit) {
			$out='<div ID="broozmare-page">';
			//if($co>0) $out .= '| ';
			for($j=0;$j<=$co-1;$j+=$limit){
				if($page!=$ps){
					if(strstr($home,'?')){
						if($ps!=1)
							$out .= '<a href="' . $home . '&brpage=' . $ps . '" class="page" >' . $ps . '</a> ';
						else
							$out .= '<a href="' . $home . '" class="page" >' . $ps . '</a> ';
					}else{
						if($ps!=1)
							$out .= '<a href="' . $home . '?brpage=' . $ps . '" class="page" >' . $ps . '</a> ';
						else
							$out .= '<a href="' . $home . '" class="page" >' . $ps . '</a> ';
					}
					
				}else{
					$out .= '<span class="current">' . $ps . '</span> ';
				}
				$ps++;
			}
			
			$out .='</div>';
		}
		
		
		
		return $out;
	}
	
	function br_post($text,$num){
		global $wpdb,$barnameha_r_table,$limit;
		$broozmare_usenewline = get_option('broozmare_usenewline');
		$limit = $num; //get_option('broozmare_rcdisplay');
		$page=$_GET['brpage'];
		$page=$page=='' ? 0 : $page-1;
		$p=$page*$limit;
		$sql = "SELECT * FROM $barnameha_r_table WHERE barnamehar_show='1' ORDER BY barnamehar_id DESC LIMIT $p, $limit";
		$br_rlist = $wpdb->get_results($sql);
		
		while(count($br_rlist)==0 && $page!=0){
			$page--;
			$p=$page*$limit;
			$sql = "SELECT * FROM $barnameha_r_table WHERE barnamehar_show='1' ORDER BY barnamehar_id DESC LIMIT $p, $limit";
			$br_rlist = $wpdb->get_results($sql);
		}
				
		foreach($br_rlist as $roozmare){
			$out .= $text;
			$content = $roozmare->barnamehar_content ;
			if($broozmare_usenewline) $content = str_replace("\n","<br />",$content);
			$out = str_replace('{br_content}',$content,$out);
			$out = str_replace('{br_author}',$roozmare->barnamehar_author,$out);
			if(get_option('broozmare_showdate')) 
				$out = str_replace('{br_date}',$roozmare->barnamehar_date,$out);
			else
				$out = str_replace('{br_date}','',$out);
			
			if(get_option('broozmare_showdate') || get_option('broozmare_showtime')) 
				$out = str_replace('{br_separate}',' , ',$out);
				
			if(get_option('broozmare_showtime'))
				$out = str_replace('{br_time}',$roozmare->barnamehar_time,$out);
			else
				$out = str_replace('{br_time}','',$out);
		}
		
		return $out;
	}
	
	//File List (File List in theme dir)
	function br_filearray($path, $filter, $strreplace = '', $exclude = ".|..", $recursive = false) {
        $path = rtrim($path, "/") . "/";
        $folder_handle = opendir($path);
        $exclude_array = explode("|", $exclude);
        $result = array();
        while(false !== ($filename = readdir($folder_handle))) {
            if(!in_array(strtolower($filename), $exclude_array)) {
                if(is_dir($path . $filename . "/")) {
                    if($recursive) $result[] = br_filearray($path, $exclude, true);
                } else { 
					$b=true;
					for($i=0;$i<count($filter);$i++)
						if(strstr(strtolower($filename),$filter[$i]))
							$b=false;
					if($b)
						$result[] = str_replace($strreplace,'',$filename);
                }
            }
        }
		
        return $result;
	}
	
	function br_themelist($ct=''){
		$brtheme = array();
		$filter = array();
		$filter[] = '_img'; $filter[] = '.gif'; $filter[] = '.jpg'; $filter[] = '.jpeg'; $filter[] = '.png';
		$filter[] = '.js'; $filter[] = '.css'; $filter[] = '_p'; $filter[] = '.psd';
		$brtheme = br_filearray('../wp-content/plugins/barnameha-roozmare/theme',$filter,'.html');
		$out = '';
		
		for($i=0;$i<count($brtheme);$i++){
			$out .= "<option value='$brtheme[$i]' " . ($ct==$brtheme[$i] ? "selected='selected'" : "" ). ">$brtheme[$i]</option>\n";
		}
		echo $out;
		//return $out;
	}
	
	 function br_localel() {
		$locale='';
		
		// WPLANG is defined in wp-config.
		if (defined('WPLANG'))
			$locale = WPLANG;
			
		if($locale=='fa_IR')
			$locale = 'fa_IR';
		else
			$locale = 'en_US';
		
		return $locale;
	}
?>