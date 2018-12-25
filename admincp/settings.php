<?php
include_once 'includes/header.php';//header page

include_once 'includes/connect.php';//connecting to database
?>
<ul id="second_navigation">
				<li>
					<a href="settings.php?page=desc">Description</a>
				</li>
                                <li>
					<a href="settings.php?page=links">Links</a>
				</li>
				<li>
					<a href="settings.php?page=images">Images</a>
				</li>
                                
				
				
                                
			</ul>                        
		</div>
	</div>
        <div id="contents">
<?php
/* get the site description data*/
$getData = "SELECT * FROM siteDesc ORDER BY id";
$getDescQuery = mysql_query($getData)  or die(mysql_error());
$getRow       = mysql_fetch_array($getDescQuery);


/* update the site description data*/
if($_POST['descSubmit']){
    
    $status    = $_POST['status'];
    $author    = strip_tags(mysql_real_escape_string($_POST['author']));
    $title     = strip_tags(mysql_real_escape_string($_POST['title']));
    $desc     = strip_tags(mysql_real_escape_string(addslashes($_POST['desc'])));
    $keywords  = strip_tags(mysql_real_escape_string($_POST['keywords']));
    $copyright = strip_tags(mysql_real_escape_string($_POST['copyright']));
    
    $sql = "UPDATE `siteDesc` SET  `status`='$status' ,
                                  `title`='$title',
                                  `author`='$author',
                                  `desc`='$desc ',
                                  `keywords`='$keywords',
                                  `copyright`='$copyright'
                                      ";
    
    $descQuery = mysql_query($sql)  or die(mysql_error());
    
}
/* get the urls data*/
$getUrl = "SELECT * FROM siteurl ORDER BY id";
$getUrlData = mysql_query($getUrl) or die(mysql_error());
$rowUrl = mysql_fetch_array($getUrlData);

/* update the  urls data*/
if($_POST['urlSubmit']){
   $site_url = $_POST['site_url'];
   $facebook = $_POST['facebook'];
   $twitter  = $_POST['twitter'];
   $google   = $_POST['google'];
   $youtube  = $_POST['youtube'];
   $urlError    = array();
   
   if(!empty($site_url) && !filter_var($site_url, FILTER_VALIDATE_URL)){
       $urlError[] = "Site url isn't correct !";
   }elseif(!filter_var($facebook, FILTER_VALIDATE_URL)){
       $urlError[] = "Facebook url isn't correct !";
   }elseif(!filter_var($twitter, FILTER_VALIDATE_URL)){
       $urlError[] = "Twitter url isn't correct !";
   }elseif(!filter_var($google, FILTER_VALIDATE_URL)){
       $urlError[] = "Google+ url isn't correct !";
   }elseif(!filter_var($youtube, FILTER_VALIDATE_URL)){
       $urlError[] = "Youtube url isn't correct !";
   }else{
     $sql = "UPDATE siteurl SET site_url='$site_url',
                                facebook='$facebook',
                                twitter='$twitter',
                                google='$google',
                                youtube='$youtube' 
                                "; 
     $urlQuery = mysql_query($sql) or die(mysql_error());
   }
   
}

/* Update Logo image by direct url */
if($_POST['url_submit']){
    $img_name = $_POST['img_name'];
    $img_path = $_POST['img_url'];
    $img_width = $_POST['img_width'];
    $img_height = $_POST['img_height'];
    $urlError = array();
    
    if(!filter_var($img_path, FILTER_VALIDATE_URL)){
       $urlError[] = "The url isn't correct !";
    }else{
    
        $sqlUrl = "UPDATE siteimage SET img_name='$img_name',
                                     img_type='logo',
                                     img_path='$img_path',
                                     img_width='$img_width',
                                     img_height='$img_height' ";
        $uploadquery = mysql_query($sqlUrl) or die(mysql_error());
    }
}

/* Upload Logo image */
if($_POST['uploadsubmit']){
    $img_name = $_FILES["file"]["name"];
    $img_path = "images/".$_FILES['file']['name'];
    $img_width = $_POST['img_width'];
    $img_height = $_POST['img_height'];
    
    if(($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/png")){
        $upload = move_uploaded_file($_FILES['file']['tmp_name'],"images/".$_FILES['file']['name']);
        $sql = "UPDATE siteimage SET img_name='$img_name',
                                     img_type='logo',
                                     img_path='$img_path',
                                     img_width='$img_width',
                                     img_height='$img_height' ";
        $uploadquery = mysql_query($sql) or die(mysql_error());
    }else{
        $error[] = 'This is not image';
    }
}



/* Site's Description */
if($_REQUEST['page'] == 'desc'){
echo "<h1>The Site's Description</h1>";


if($descQuery){// check if updateing is done
        echo '<h2 class="success"> UPDateing is done successfully</h2>';
        echo '<meta http-equiv="refresh" content="3;url=settings.php?page=desc">';
}

echo '
<table border="0">
    <form action="settings.php?page=desc" method="post" class="message">
        <tr>
            <td width="130px">Status : </td>
            <td></td>
        </tr>
        <tr>
            <td width="130px">Title : </td>
            <td><input type="text" class="inputText" name="title" value="'.$getRow['title'].'" onFocus="this.select();" onMouseOut="javascript:return false;"/></td>
        </tr>
        <tr>
            <td width="130px">Author : </td>
            <td><input type="text" name="author" value="'.$getRow['author'].'" onFocus="this.select();" onMouseOut="javascript:return false;"/></td>
        </tr>
        <tr>
            <td width="130px">Description : </td>
            <td><textarea name="desc" onFocus="this.select();" onMouseOut="javascript:return false;">'.stripcslashes($getRow['desc']).'</textarea></td>
        </tr>
        <tr>
            <td width="130px">KeyWords : </td>
            <td><input type="text" class="inputText" name="keywords" value="'.$getRow['keywords'].'" onFocus="this.select();" onMouseOut="javascript:return false;"/></td>
        </tr>
        <tr>
            <td width="130px">Copyright : </td>
            <td><input type="text" class="inputText" name="copyright" value="'.$getRow['copyright'].'" onFocus="this.select();" onMouseOut="javascript:return false;"/></td>
        </tr>
        <tr>
            <td width="130px"><input type="submit" name="descSubmit" value="UpDate" /></td>
            <td></td>
        </tr>
    
    
    </form>    
</table>
';  
}

#// Site's URL ///#
elseif($_REQUEST['page'] == 'links'){
    echo "<h2>The Site's URL</h2>";

if($urlQuery){// check if updateing is done
        echo '<h2 class="success"> UPDateing is done successfully</h2>';
        die();
        echo '<meta http-equiv="refresh" content="3;url=settings.php?page=links">';
}
if($urlError){
    foreach ($urlError as $error){
        echo '<h2 class="error">'.$error.'</h2>';
    }
}

echo '
<table border="0">
    <form action="settings.php?page=links" method="post" class="message">
        
        <tr>
            <td width="130px">Site URL : </td>
            <td><input type="text" class="inputText" name="site_url" value="'.$rowUrl['site_url'].'" onFocus="this.select();" onMouseOut="javascript:return false;"/></td>
        </tr>
        <tr>
            <td width="130px">FaceBook URL : </td>
            <td><input type="text" class="inputText" name="facebook" value="'.$rowUrl['facebook'].'" onFocus="this.select();" onMouseOut="javascript:return false;"/></td>
        </tr>
        <tr>
            <td width="130px">Google+ URL : </td>
            <td><input type="text" class="inputText" name="google" value="'.$rowUrl['google'].'" onFocus="this.select();" onMouseOut="javascript:return false;"/></td>
        </tr>
        <tr>
            <td width="130px">Twitter URL : </td>
            <td><input type="text" class="inputText" name="twitter" value="'.$rowUrl['twitter'].'" onFocus="this.select();" onMouseOut="javascript:return false;"/></td>
        </tr>
        <tr>
            <td width="130px">Yuotube URL : </td>
            <td><input type="text" class="inputText" name="youtube" value="'.$rowUrl['youtube'].'" onFocus="this.select();" onMouseOut="javascript:return false;"/></td>
        </tr>
        
        <tr>
            <td width="130px"><input type="submit" name="urlSubmit" value="UpDate" /></td>
            <td></td>
        </tr>
    
    
    </form>    
</table>
';
    
    
}
#// Site's Images ///#

elseif($_REQUEST['page'] == 'images'){
    echo "<h2>The Site's Images</h2>";

echo '
<table>
<tr>
    <td width="150px">Site Logo</td>
    <td width="150px"><img src="'.$getLogoRow['img_path'].'" class="urlImage"/></td>
    <td width="150px"><a href="settings.php?page=change-image-by-upload">Upload</a> - 
                      <a href="settings.php?page=change-image-by-url">Direct URL</a></td>
</tr>
</table>    
';
    
}

elseif($_REQUEST['page'] == 'change-image-by-url' ){
    echo '<h2>Upload Images</h2>';
if($urlError){
    foreach ($urlError as $errors){
        echo '<h2 class="error">'.$errors.'</h2>';
    }
}
if($uploadquery){
    echo '<h2 class="success">Image  Saved Successfully</h2>';
    echo '<meta http-equiv="refresh" content="3;url=settings.php?page=images">';
}    
    echo '
<table>
    <form action="settings.php?page=change-image-by-url" method="post" >
        <tr>
    <td width="150px">Type URL</td>
    <td width="150px"><input type="text" name="img_url" value="'.$getLogoRow['img_path'].'"/></td>
    </tr>
    <tr>
    <td width="150px">Type Image Name</td>
    <td width="150px"><input type="text" name="img_name"  value="'.$getLogoRow['img_name'].'"/></td>
    </tr>
    <tr>
    <td width="150px">Width</td>
    <td width="150px"><input type="text" name="img_width" class="width" value="'.$getLogoRow['img_width'].'" /></td>
    </tr>
    <tr>
    <td width="150px">Height</td>
    <td width="150px"><input type="text" name="img_height" class="width" value="'.$getLogoRow['img_height'].'"/></td>
    </tr>
    <tr>
        <td width="150px"><input type="submit" name="url_submit" value="Update" /></td>
    </tr>
</form>
</table>        
';    
}

elseif($_REQUEST['page'] == 'change-image-by-upload' ){
    echo '<h2>Upload Images</h2>';
if($error){
    foreach ($error as $errors){
        echo '<h2 class="error">'.$errors.'</h2>';
    }
}
if($upload && $uploadquery){
    echo '<h2 class="success">Image Upload and Save Successfully</h2>';
    echo '<meta http-equiv="refresh" content="3;url=settings.php?page=images">';
}    
    echo '
<table>
    <form action="settings.php?page=change-image-by-upload" method="post" enctype="multipart/form-data">
        <tr>
    <td width="150px">Select Image</td>
    <td width="150px"><input type="file" name="file" /></td>
    </tr>
    <tr>
    <td width="150px">Width</td>
    <td width="150px"><input type="text" name="img_width" class="width" value="'.$getLogoRow['img_width'].'" /></td>
    </tr>
    <tr>
    <td width="150px">Height</td>
    <td width="150px"><input type="text" name="img_height" class="width" value="'.$getLogoRow['img_height'].'"/></td>
    </tr>
    <tr>
        <td width="150px"><input type="submit" name="uploadsubmit" value="UpLoad" /></td>
    </tr>
</form>
</table>        
';    
}

#// Site's Home Settings ///#
else{
    echo "<h2>The Site's Home Settings</h2>";
    

    
}

include_once 'includes/footer.php';
?>
