<?php include_once 'header.php';

/* Post Page */
###########################

$gid = (int)$_GET['post_id'];// Get post id

// Post Query
$getPostData = "SELECT * FROM sitepost WHERE id='$gid'";
$getPostDataQuery = mysql_query($getPostData) or die(mysql_error());
$getPostDatarow = mysql_fetch_array($getPostDataQuery);


// Comments Query
$getCommData = "SELECT * FROM comments WHERE post_id='$gid' AND comm_active=1";
$getCommDataQuery = mysql_query($getCommData) or die(mysql_error());
$getCommNum = mysql_num_rows($getCommDataQuery);

// comm_author comm_email comm_site comm_content  comm_submit
/* Add New Comment Form */
###########################
if($_POST['comm_submit']){
    $comm_author  = strip_tags($_POST['comm_author']);
    $comm_email   = strip_tags($_POST['comm_email']);
    $comm_site    = strip_tags($_POST['comm_site']);
    $comm_content = strip_tags(addslashes($_POST['comm_content']));
    $commError = array();
    
    if(empty($comm_author) || empty($comm_email) || empty($comm_content)){
        $commError[] = "Your Name,Email and Comment content is requierd";
    }elseif(!filter_var($comm_email, FILTER_VALIDATE_EMAIL)){
        $commError[] = "This is not Email";
    }elseif(!empty ($comm_site) && !filter_var($comm_site, FILTER_VALIDATE_URL)){
        $commError[] = "This is not URL";
    }else{
        
        $insertCommData = "INSERT INTO comments (author, comm_email,comm_content,comm_site,post_id, comm_active)
                                          VALUES('$comm_author','$comm_email','$comm_content','$comm_site','$gid',0) ";
        $insertCommDataQuery = mysql_query($insertCommData) or die(mysql_error());
        
    }
}

?>
	<div id="contents">
		<div class="post">
			<div class="date">
				<p>
					<span><?php  echo $getPostDatarow['post_date_d']; ?></span>
					<?php  echo $getPostDatarow['post_date_y']; ?>
				</p>
			</div>
			<h1><?php  echo $getPostDatarow['post_title']; ?><span class="author"><?php  echo $getPostDatarow['post_author']; ?></span></h1>
			<p>
                            <?php  echo $getPostDatarow['post_content']; ?>
                        </p>
			<span><a href="news.php" class="more">Back to News</a></span>
		
	
        
                        <h1>Comments:</h1>
<?php
if($getCommNum > 0 ){// one or more comment
    while ($getCommDatarow = mysql_fetch_array($getCommDataQuery)){
        echo '
            <p class="comm">
                <img src="images/user.png" alt="" />
                <h2 class="username">'.$getCommDatarow['author'].'<h2>
                <span>'.  stripslashes($getCommDatarow['comm_content']).'</span>
            </p>
    ';
    }
}else{// no comment
    echo 'There isn\'t Comment for this post';
}
?>
                        <br /><br /><br />
                     <div id="content">
                         <h1>Add New Comment</h1>
<?php
if($insertCommDataQuery){// check if updateing is done
        echo '<h2 class="success"> Comment was added<br /> But waiting management review </h2>';
        echo '<meta http-equiv="refresh" content="3;url=post.php?post_id='.$gid.'">';
        die();
}
if($commError){
    foreach ($commError as $error){
        echo '<h2 class="error">'.$error.'</h2>';
    }
}
?>
                        <table>
                            <form action="post.php?post_id=<?=$gid; ?> " method="post" >
                                <tr>
                            <td width="150px">Your Name:</td>
                            <td width="150px"><input type="text" name="comm_author" /></td>
                            </tr>
                            <tr>
                            <td width="150px">Your Email:</td>
                            <td width="150px"><input type="text" name="comm_email"  /></td>
                            </tr>
                            <tr>
                            <td width="150px">Your Site:</td>
                            <td width="150px"><input type="text" name="comm_site"  /></td>
                            </tr>
                            <tr>
                            <td width="150px">Content</td>
                            <td width="150px"><textarea name="comm_content"></textarea></td>
                            </tr>
                            <tr>
                                <td width="150px"><input type="submit" name="comm_submit" value="Add Comment" /></td>
                            </tr>
                        </form>
                        </table>        
                     </div>   
               </div>         
        </div>




	<?php include_once 'footer.php';  ?>