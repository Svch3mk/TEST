<?php 
include_once 'header.php';

if($_POST['send']){
    $name = strip_tags($_POST['name']);
    $email = strip_tags($_POST['email']);
    $subject = strip_tags($_POST['subject']);
    $content = strip_tags(addslashes($_POST['content']));
    $contactErrors = array();
    
    if(empty($name) || empty($email) || empty($subject) || empty($content)){
       $contactErrors[] = "All Fields Are Requierd"; 
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $contactErrors[] = "This is not Email";
    }  else {
        $contact_sql = "INSERT INTO contact (name,email,subject,content,type) 
                                     VALUES ('$name','$email','$subject','$content','user')";
        $contact_query = mysql_query($contact_sql) or die(mysql_error());
        
    }
    
    
}
?>
	<div id="contents">
		<div class="section">
			<h1>Contact</h1>
			<p>
				You can replace all this text with your own text. Want an easier solution for a Free Website? Head straight to Wix and immediately start customizing your website! Wix is an online website builder with a simple drag & drop interface, meaning you do the work online and instantly publish to the web. All Wix templates are fully customizable and free to use. Just pick one you like, click Edit, and enter the online editor.
			</p>
                        <?php
                        if($contact_query){
                            echo '<h2 class="success">Message send  successfully<h2>';
                            echo '<meta http-equiv="refresh" content="3;url=contact.php">';     
                        }
                        if($contactErrors){
                            foreach ($contactErrors as $error){
                                echo '<h2 class="error">'.$error.'</h2>';
                            }
                        }
                        
                        ?>
			<form action="contact.php" method="post" class="message">
				<input type="text" value="Name" name="name" onFocus="this.select();" onMouseOut="javascript:return false;"/>
				<input type="text" value="Email" name="email" onFocus="this.select();" onMouseOut="javascript:return false;"/>
				<input type="text" value="Subject" name="subject" onFocus="this.select();" onMouseOut="javascript:return false;"/>
				<textarea name="content"></textarea>
				<input type="submit" value="Send" name="send"/>
			</form>
		</div>
		<div class="section contact">
			<p>
				For Inquiries Please Call: <span><?=$getRow['phone'];  ?></span>
			</p>
			<p>
                            Or you can visit us at: <span>ZeroType<h3><?=$getRow['email'];  ?></h3 <br /> <?=$getRow['address'];  ?></span>
			</p>
		</div>
	</div>
	<?php include_once 'footer.php';  ?>