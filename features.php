<?php 
include_once 'header.php';
include_once 'mangeDesc.php';
?>
	<div id="contents">
		<div class="features">
			<h1>Features</h1>
			<p>
				<?php echo $g_f_desc_row['post_content'];//Features Desc  ?>
			</p>
                        <?php 
                        while ($g_f_post_row = mysql_fetch_array($g_f_post_query)){
                            echo '
                             <div class="f_post">
				<img class="f_post" src="admincp/images/'.$g_f_post_row['post_photo'].'" alt="Img">
				<h2 class="f_post">'.$g_f_post_row['post_title'].'</h2>
				<p class="f_post">
				'.$g_f_post_row['post_content'].'	
				</p>
				
			     </div>   
                            ';
                        }
                        ?>
			
			
		</div>
	</div>
	<?php include_once 'footer.php';  ?>