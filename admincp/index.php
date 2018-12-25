<?php include_once 'includes/header.php'; 
include_once 'includes/connect.php';//connecting to database
?>

</div></div>
        <div id="contents">
            <div class="slider">
                
            </div>
<?php


/* recent posts  */
###########################
    echo "<div class='post_page_block'>
        <h2>Recent Posts</h2>
        
        ";
$getPost = "SELECT * FROM sitepost ORDER BY id DESC LIMIT 4";
$getPostQuery = mysql_query($getPost);    
while ($getPostRow       = mysql_fetch_array($getPostQuery)){    
   echo '<p><a href="../post.php?post_id='.$getPostRow["id"].'">
    '.substr($getPostRow["post_content"],0,100).'   
</a></p>' ;
    
}
echo '
</div>    
';    
###############################


/* Last comments  */
###########################
    echo '
<div class="post_page_block">
        <h2>Last Comments</h2>
';
    
// Comments Query
$getCommData = "SELECT * FROM comments WHERE comm_active=1 ORDER BY id DESC LIMIT 7";
$getCommDataQuery = mysql_query($getCommData) or die(mysql_error());    

while ($getCommDatarow       = mysql_fetch_array($getCommDataQuery)){    
   echo '<p><span>'.$getCommDatarow["author"].'</span><br /><a href="posts.php?comm_id='.$getCommDatarow["id"].'">
    '.substr($getCommDatarow["comm_content"],0,100).'   
</a></p>' ;
    
}

echo '    
</div>         
';


/* UnActive comments  */
###########################
    echo '
<div class="post_page_block">
        <h2>Un Active Comments</h2>
';

    // UnActive Comments Query
$getCommData = "SELECT * FROM comments WHERE comm_active=0 ORDER BY id DESC LIMIT 7";
$getCommDataQuery = mysql_query($getCommData) or die(mysql_error());    

while ($getCommDatarow       = mysql_fetch_array($getCommDataQuery)){    
   echo '<p><span>'.$getCommDatarow["author"].'</span><br /><a href="posts.php?comm_id='.$getCommDatarow["id"].'">
    '.substr($getCommDatarow["comm_content"],0,100).'   
</a></p>' ;
    
}
    
echo '
</div>    
';    



?>
        </div>
	
	<?php include_once 'includes/footer.php'; ?>