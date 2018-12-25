<?php

include_once 'includes/header.php';
include_once '../mangeDesc.php';
?>
                        <ul id="second_navigation">
				<li>
					<a href="pages.php?page=features">Features</a>
				</li>
                                <li>
					<a href="pages.php?page=about">About</a>
				</li>
                                <li>
					<a href="pages.php?page=contact">Contact</a>
				</li>
				
			</ul> 
</div>
</div>
<div id="contents">    
    
<?php

/*  Features Page */
#######################

/* Get Page Description */
$g_f_desc_sql = "SELECT post_content FROM sitepost WHERE post_type='f_desc'";
$g_f_desc_query = mysql_query($g_f_desc_sql) or die(mysql_error());
$g_f_desc_row = mysql_fetch_array($g_f_desc_query);

/* Update Page Description */
if($_POST['f_desc_submit']){
    $f_desc = strip_tags(addslashes($_POST['f_desc']));
    $f_desc_sql = "UPDATE sitepost SET post_content='$f_desc' WHERE post_type='f_desc'";
    $f_desc_query = mysql_query($f_desc_sql) or die(mysql_error());
}

/* Add new post */
if($_POST['f_n_submit']){
    $f_file_name =  $_FILES['f_file']['name'];
    $f_title = $_POST['f_title'];
    $f_content =  $_POST['f_content'];
    $fPostError = array();
    $photo = array('image/png','image/jpg','image/pjpeg','image/jpeg');//ext photo
    if(empty($f_title) || empty($f_content)){
        $fPostError[] = "Post Title and Content are requird";
    }elseif (!empty ($f_file_name) && !in_array($_FILES['f_file']['type'], $photo) ) {
        $fPostError[] = "this is not image";
        
    }else{
        $f_upload = move_uploaded_file($_FILES['f_file']['tmp_name'],"images/".$_FILES['f_file']['name']);
        $f_sql = "INSERT INTO sitepost (post_title,post_content,post_photo,post_type)
                                        VALUES('$f_title','$f_content','$f_file_name','features')";
        $f_query = mysql_query($f_sql) or die(mysql_error());
    }
}

/*  Contact Page */
#######################

/* Answer To message */
if($_POST['send_asnwer']){
    $from = $_POST['from'];
    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];
    $answerErrors = array();
    
    if (empty($from) || empty($to) || empty($content) || empty($subject) ){
        $answerErrors[] = "All Fields are requierd";
    }  else {
        
        $answer_sql = "INSERT INTO contact (name,email,subject,content,type) 
                                     VALUES('Admin@zerotype By : $from','$to','$subject','$content','send')";
        $answer_query = mysql_query($answer_sql) or die(mysql_error());
        
        $headers = 'From: '.$from. "\r\n" .
    'Reply-To: ' .$to;

$mail = mail($to, $subject, $content, $headers);
    }
}
/* contact page desc */
if($_POST['contact_desc']){
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $contactDescErrors = array();
    
    if(empty($phone) || empty($email) || empty($address)){
        $contactDescErrors[] = "All fields are requierd";
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $contactDescErrors[] = "This is not Email";
    }else{
        $contact_dec_sql = "UPDATE sitedesc SET phone='$phone',
                                                email='$email',
                                                address='$address'";
        $contact_desc_query = mysql_query($contact_dec_sql) or die(mysql_error());
    }
}

if($_REQUEST['page'] == 'features'){// if page = Features
    echo '<h1> Welcome To Features Page Setting</h1>';

echo '
    <h2> Features Description</h2>
    <span><a href="pages.php?page=update_f_desc">Update Features Description</a></span>
';

echo '
    <h2> Features Posts</h2>
    <span><a href="pages.php?page=show_f_posts">Show All</a> - <a href="pages.php?page=add_f_post">Add New</a></span>
';
    
}elseif($_REQUEST['page'] == 'update_f_desc'){//update Features page description
   if($f_desc_query){
    echo "<h2 class='success'>Update Done Successfully<h2>";
    echo '<meta http-equiv="refresh" content="3;url=pages.php?page=update_f_desc">';
   }
echo '
    <h1>Update Features Description</h1>
    <table border="0">
    <form action="pages.php?page=update_f_desc" method="post" class="message">
        
        <tr>
            <td width="130px">Page Description</td>
            <td><textarea name="f_desc">'.$g_f_desc_row['post_content'].'</textarea></td>
        </tr>
        
        <tr>
            <td width="130px"><input type="submit" name="f_desc_submit" value="UpDate" /></td>
            <td></td>
        </tr>
    
    
    </form>    
</table>

';
    
}elseif($_REQUEST['page'] == 'add_f_post'){// Add new post
if($f_query && $f_upload){
    echo "<h2 class='success'>Post Added Successfully<h2>";
    echo '<meta http-equiv="refresh" content="3;url=pages.php?page=add_f_post">';
   }
if($fPostError){
    foreach ($fPostError as $error){
        echo '<h2 class="error">'.$error.'</h2>';
    }
}
echo '
<table>
    <form action="pages.php?page=add_f_post" method="post" enctype="multipart/form-data">
        <tr>
    <td width="150px">Title</td>
    <td width="150px"><input type="text" name="f_title" /></td>
    </tr>
    <tr>
    <td width="150px">Photo</td>
    <td width="150px"><input type="file" name="f_file" /></td>
    </tr>
    <tr>
    <td width="150px">content</td>
    <td width="150px"><textarea name="f_content" ></textarea></td>
    </tr>
    <tr>
        <td width="150px"><input type="submit" name="f_n_submit" value="ADD" /></td>
    </tr>
</form>
</table>        
';    
    
    
    
}elseif($_REQUEST['page'] == 'show_f_posts'){// Show All Posts
echo '<h2>All Posts</h2>';
echo '
<table width="100%" class="post_table">  
    <tr>
        <th width="25px">ID</td>
        <th width="60px">Title</td>
        <th width="60px">Content</td>
        <th width="130px"Photo</td>
        <th width="60px">Action</td>
    </tr>
'; 
$getPost = "SELECT * FROM sitepost WHERE post_type='features' ORDER BY id DESC ";
$getPostQuery = mysql_query($getPost);    
while ($getPostRow       = mysql_fetch_array($getPostQuery)){  
echo '
        
    <tr>
        <td width="25px">'.$getPostRow['id'].'</td>
        <td width="60px">'.$getPostRow['post_title'].'</td>
        <td width="60px">'.substr($getPostRow["post_content"],0,200).'</td>
        <td width="60px"><img src="images/'.$getPostRow['post_photo'].'" /></td>
        <th width="60px"><a href="pages.php?page=f_delete&f_post_id='.$getPostRow["id"].'">Delete</a></td>
    </tr>
    
';  }  
echo '</table>';
    
}elseif($_REQUEST['page'] == 'f_delete'){
    if($_GET['f_post_id']){
        $f_post_id =  $_GET['f_post_id'];
        
        $f_post_sql = "DELETE FROM sitepost WHERE post_type='features' AND id='$f_post_id'";
        $f_post_query = mysql_query($f_post_sql) or die(mysql_error());
        if($f_post_query){
            echo '<h2 class="success">The Post has been Deleted successfully</h2>';
            echo '<meta http-equiv="refresh" content="3;url=pages.php?page=show_f_posts">';
        }
    }
    
    
    
    
}elseif($_REQUEST['page'] == 'contact'){// contact page
    echo '<h1> Welcome To Contact Page Setting</h1>';
    echo '
        <ul id="second_navigation">
                <li>
                        <a href="pages.php?page=contact&box=inbox">Inbox</a>
                </li>
                <li>
                        <a href="pages.php?page=contact&box=send">Send</a>
                </li>
                <li>
                        <a href="pages.php?page=contact&box=desc">Desc</a>
                </li>
        </ul><br />  <br /><br />
    ';
    
    
    if($_GET['box'] == 'inbox'){
        $inbox_sql = "SELECT * FROM contact WHERE type='user' ORDER BY id ";
        $inbox_query = mysql_query($inbox_sql) or die(mysql_error());
        
        echo '
        <table width="100%" class="post_table">  
            <tr>
                <th width="15px">ID</th>
                <th width="40px">From</th>
                <th width="50px">Email</th>
                <th width="60px">Subject</th>
                <th width="150px">Content</th>
                <th width="50px">Date</td>
                <th width="150px"></td>
            </tr>    
        ';
        while ($inbox_row = mysql_fetch_array($inbox_query)){
            echo '
                <tr>
                    <td>'.$inbox_row['id'].'</td>
                    <td>'.$inbox_row['name'].'</td>
                    <td>'.$inbox_row['email'].'</td>
                    <td>'.$inbox_row['subject'].'</td>
                    <td>'.$inbox_row['content'].'</td>
                    <td>'.$inbox_row['date'].'</td>
                    <td><span>
                            <a href="pages.php?page=contact&asnwer_email='.$inbox_row['email'].'">Answer</a> - 
                        <a href="pages.php?page=contact&delete_email='.$inbox_row['email'].'&type=user">Delete</a>
                        </span></td>
                </tr>
            ';
        }
        echo '</table>';
    }
    if($_GET['asnwer_email']){
        $email = $_GET['asnwer_email'];
        if($mail && $answer_query){
            echo "<h2 class='success'>Message has been send<h2>";
            echo '<meta http-equiv="refresh" content="3;url=pages.php?page=contact">';
        }
        if($answerErrors){
            foreach ($answerErrors as $error){
                echo '<h2 class="error">'.$error.'</h2>';
            }
        }
        echo'
            <table>
                <form action="pages.php?page=contact&asnwer_email='.$email.'" method="post" >
                <tr>
                <td width="150px">From</td>
                <td width="150px"><input type="text" name="from" value="Admin@zerotype.com"/></td>
                </tr>
                <tr>
                <td width="150px">TO</td>
                <td width="150px"><input type="text" name="to" value="'.$email.'"/></td>
                </tr>
                <td width="150px">Subject</td>
                <td width="150px"><input type="text" name="subject"/></td>
                </tr>
                <tr>
                <td width="150px">content</td>
                <td width="150px"><textarea name="content" ></textarea></td>
                </tr>
                <tr>
                    <td width="150px"><input type="submit" name="send_asnwer" value="Send" /></td>
                </tr>
                </form>
            </table>  
        ';
    }
    if($_GET['delete_email']){
        $eamil =  $_GET['delete_email'];
        $type= $_GET['type'];
        $delete_sql = "DELETE FROM contact WHERE email='$eamil'  AND type='$type'";
        $delete_query = mysql_query($delete_sql) or die(mysql_error());
        
        if($delete_query){
             echo "<h2 class='success'>Message has been deleted<h2>";
            echo '<meta http-equiv="refresh" content="3;url=pages.php?page=contact">';
        }
    }
    if($_GET['box'] == 'send'){
        $send_sql = "SELECT * FROM contact WHERE type='send'";
        $send_query = mysql_query($send_sql) or die(mysql_error());
        
        echo '
        <table width="100%" class="post_table">  
            <tr>
                <th width="15px">ID</th>
                <th width="40px">From</th>
                <th width="50px">Email</th>
                <th width="60px">Subject</th>
                <th width="100px">Content</th>
                <th width="50px">Date</td>
                <th width="100px"></td>
            </tr>    
        ';
        while ($send_row = mysql_fetch_array($send_query)){
            echo '
                <tr>
                    <td>'.$send_row['id'].'</td>
                    <td>'.$inbox_row['name'].'</td>
                    <td>'.$send_row['email'].'</td>
                    <td>'.$send_row['subject'].'</td>
                    <td>'.$send_row['content'].'</td>
                    <td>'.$send_row['date'].'</td>
                    <td><span>
                             
                        <a href="pages.php?page=contact&delete_email='.$send_row['email'].'&type=send">Delete</a>
                        </span></td>
                </tr>
            ';
        }
        echo '</table>';
    }
   if($_GET['box'] == 'desc'){
       if($contact_desc_query){
          echo "<h2 class='success'>Save Done Successfully<h2>";
            echo '<meta http-equiv="refresh" content="3;url=pages.php?page=contact&box=desc">';
       }
       if($contactDescErrors){
            foreach ($contactDescErrors as $error){
                echo '<h2 class="error">'.$error.'</h2>';
            }  
       }
        echo'
            <table>
                <form action="pages.php?page=contact&box=desc" method="post" >
                <tr>
                <td width="150px">Phone</td>
                <td width="150px"><input type="text" name="phone" value="'.$getRow['phone'].'"/></td>
                </tr>
                <tr>
                <td width="150px">Email</td>
                <td width="150px"><input type="text" name="email" value="'.$getRow['email'].'"/></td>
                </tr>
                <td width="150px">Address</td>
                <td width="150px"><input type="text" name="address" value="'.$getRow['address'].'"/></td>
                </tr>
                <tr>
                    <td width="150px"><input type="submit" name="contact_desc" value="Save" /></td>
                </tr>
                </form>
            </table>  
        ';
    }
}elseif($_REQUEST['page'] == 'inbox'){//all messages in inbox
    
}else{
     echo '<h1> Welcome To Pages Setting</h1>';
    
    
    
    
}


?>
<?php
include_once 'includes/footer.php';

?>