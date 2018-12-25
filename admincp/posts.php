<?php
include_once 'includes/header.php';//header page

include_once 'includes/connect.php';//connecting to database
?>
<ul id="second_navigation">
				<li>
					<a href="posts.php?page=add-new">Add New</a>
				</li>
                                <li>
					<a href="posts.php?page=show-all_posts">All Posts</a>
				</li>
                                <li>
					<a href="posts.php?page=show-all_comm">All Comments</a>
				</li>
				
			</ul> 
</div>
</div>
<div id="contents">    
<?php


/* Add New Post */
###############################
if($_POST['new_post']){
    
    $post_title   = $_POST['post_title'];
    $post_author  = $_POST['post_author'];
    $post_content = $_POST['post_content'];
    $post_desc    = $_POST['post_desc'];
    $post_date_d  = date('d');
    $post_date_y  = date('Y');
    $post_errors  = array();
    
    //check all fields
    if(empty($post_title) || empty($post_author) || empty($post_content)){
        $post_errors[] = "Post Tilte,Author and Content is requierd";
    }elseif (empty ($post_title)) {
        $post_errors[] = "Post Title is requierd";
    }elseif (empty ($post_author)) {
        $post_errors[] = "Post Author is requierd";
    }elseif (empty ($post_content)) {
        $post_errors[] = "Post Content is requierd";
    }  else {
        
        $post_sql = "INSERT INTO sitepost (post_title, post_author, post_content, post_desc, post_type, post_date_d, post_date_y) 
                                   VALUES ('$post_title', '$post_author', '$post_content', '$post_desc', 'news', '$post_date_d', '$post_date_y')";
        $post_query = mysql_query($post_sql) or die(mysql_error());
    }
    
}
/* Add New Post */
###############################
if($_REQUEST['page'] == 'add-new' ){
    echo '<h2>Add New Post</h2>';
    
if ($post_query){
    echo '<h2 class="success">Post added Successfully</h2>';
     
     echo '<meta http-equiv="refresh" content="3;url=posts.php">';die();
}
if($post_errors){
    foreach ($post_errors as $error){
        echo '<h2 class="error">'.$error.'</h2>';
       
        
        
    }
}    
echo '
<table border="0">
    <form action="posts.php?page=add-new" method="post" class="message">
        
        <tr>
            <td width="130px">Post Title : </td>
            <td><input type="text" class="inputText" name="post_title"  onFocus="this.select();" onMouseOut="javascript:return false;"/></td>
        </tr>
        <tr>
            <td width="130px">Author : </td>
            <td><input type="text" name="post_author" onFocus="this.select();" onMouseOut="javascript:return false;"/></td>
        </tr>
        <tr>
            <td width="130px">Content : </td>
            <td><textarea name="post_content" onFocus="this.select();" onMouseOut="javascript:return false;"></textarea></td>
        </tr>
        <tr>
            <td width="130px">Description : </td>
            <td><input type="text" class="inputText" name="post_desc"  onFocus="this.select();" onMouseOut="javascript:return false;"/>Optional </td>
        </tr>
        <tr>
            <td width="130px"><input type="submit" name="new_post" value="Add!!" /></td>
            <td></td>
        </tr>
    
    
    </form>    
</table>
';
/* Show All Posts */
###############################
}elseif($_REQUEST['page'] == 'show-all_posts' ){
    echo '<h2>All Posts</h2>';
echo '
<table width="100%" class="post_table">  
    <tr>
        <th width="25px">ID</th>
        <th width="60px">Author</th>
        <th width="60px">Tilt</th>
        <th width="130px">Content</th>
        <th width="60px">Action</th>
    </tr>
'; 
$getPost = "SELECT * FROM sitepost ORDER BY id DESC ";
$getPostQuery = mysql_query($getPost);    
while ($getPostRow       = mysql_fetch_array($getPostQuery)){  
echo '
        
    <tr>
        <td width="25px">'.$getPostRow['id'].'</td>
        <td width="60px">'.$getPostRow['post_author'].'</td>
        <td width="60px">'.$getPostRow['post_title'].'</td>
        <td width="130px">'.substr($getPostRow["post_content"],0,200).'</td>
        <th width="60px"><a href="posts.php?page=delete&post_id='.$getPostRow["id"].'">Delete</a></th>    
    </tr>
    
';    
}

echo '
</table>    
';

    
}elseif($_REQUEST['page'] == 'show-all_comm' ){
    echo '<h2>All Comments</h2>';
// All Comments Query
$getCommData = "SELECT * FROM comments ORDER BY id DESC ";
$getCommDataQuery = mysql_query($getCommData) or die(mysql_error());    
    
echo '
<table width="100%" class="post_table">  
    <tr>
        <th width="25px">ID</td>
        <th width="30px">Author</td>
        <th width="30px">From Email</td>
        <th width="30px">Author Site</td>
        <th width="130px">Content</td>
        <th width="100px">Active / Un Active</td>
        <th width="40px">Delete</td>
    </tr>
'; 

while ($getCommDatarow       = mysql_fetch_array($getCommDataQuery)){
    if($getCommDatarow['comm_active'] == 0){//for un active comments
        echo '
        <tr>
            <td width="25px">'.$getCommDatarow['id'].'</td>
            <td width="30px">'.$getCommDatarow['author'].'</td>
            <td width="30px">'.$getCommDatarow['comm_email'].'</td>
            <td width="30px">'.$getCommDatarow['comm_site'].'</td>
            <td width="130px">'.$getCommDatarow['comm_content'].'</td>
            <td width="100px"><a href="posts.php?page=active&comm_id='.$getCommDatarow["id"].'">Active</a></td>
            <th width="40px"><a href="posts.php?page=delete&comm_id='.$getCommDatarow["id"].'">Delete</a></td>    
        </tr>

    ';    
    }else{//for active comment
        echo '
        <tr>
            <td width="25px">'.$getCommDatarow['id'].'</td>
            <td width="30px">'.$getCommDatarow['author'].'</td>
            <td width="30px">'.$getCommDatarow['comm_email'].'</td>
            <td width="30px">'.$getCommDatarow['comm_site'].'</td>
            <td width="130px">'.$getCommDatarow['comm_content'].'</td>
            <td width="100px"><a href="posts.php?page=un_active&comm_id='.$getCommDatarow["id"].'">Un Active</a></td>
            <th width="40px"><a href="posts.php?page=delete&comm_id='.$getCommDatarow["id"].'">Delete</a></td>    
        </tr>

    ';  
    }
    
}

echo '
</table>    
';
    // delete post and comment
}elseif($_REQUEST['page'] == 'delete' ){
    if($_GET['post_id']){
        $post_id =  $_GET['post_id'];
        
        $delete_post_sql1 = "DELETE FROM sitepost WHERE id='$post_id'";
        $delete_post_query1 = mysql_query($delete_post_sql1) or die(mysql_error());
        
        $delete_post_sql2 = "DELETE FROM comments WHERE post_id='$post_id'";
        $delete_post_query2 = mysql_query($delete_post_sql2) or die(mysql_error());
        
        if($delete_post_query1){
           echo '<h2 class="success">Post Deleted Successfully</h2>';
           echo '<meta http-equiv="refresh" content="3;url=posts.php?page=show-all_posts">'; 
        }
    }
    
    if($_GET['comm_id']){
        $comm_id =  $_GET['comm_id'];
        
        $delete_comm_sql = "DELETE FROM comments WHERE id='$comm_id'";
        $delete_comm_query = mysql_query($delete_comm_sql) or die(mysql_error());
        
        if($delete_comm_query){
           echo '<h2 class="success">Comment Deleted Successfully</h2>';
           echo '<meta http-equiv="refresh" content="3;url=posts.php?page=show-all_comm">'; 
        }
    }
    
}elseif($_REQUEST['page'] == 'active' ){
    
    if($_GET['comm_id']){
        $comm_id =  $_GET['comm_id'];
        
        $unActive_comm_sql = "UPDATE comments SET comm_active='1' WHERE id='$comm_id'";
        $unActive_comm_query = mysql_query($unActive_comm_sql) or die(mysql_error());
        
        if($unActive_comm_query){
           echo '<h2 class="success">Comment is Active</h2>';
           echo '<meta http-equiv="refresh" content="3;url=posts.php?page=show-all_comm">'; 
        } 
    }
}elseif($_REQUEST['page'] == 'un_active' ){
    
    if($_GET['comm_id']){
        $comm_id =  $_GET['comm_id'];
        
        $Active_comm_sql = "UPDATE comments SET comm_active='0' WHERE id='$comm_id'";
        $Active_comm_query = mysql_query($Active_comm_sql) or die(mysql_error());
        
        if($Active_comm_query){
           echo '<h2 class="success">Comment is Un Active</h2>';
           echo '<meta http-equiv="refresh" content="3;url=posts.php?page=show-all_comm">'; 
        } 
    }
}else {
    echo '<h2>Mange Posts Page</h2>';

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
}



include_once 'includes/footer.php';

?>