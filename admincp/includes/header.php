<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    

error_reporting('E_ALL & ~E_Notice');


?>
<?php include_once '../mangeDesc.php'; ?>
<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Zerotype Website Template</title>
	<link rel="stylesheet" href="../css/style.css" type="text/css">
        <link rel="stylesheet" href="css/adminStyle.css" type="text/css">
</head>
<body>
	<div id="header">
		<div>
			<div class="logo">
                            <a href="index.php"  <?php echo 'style="background: url('.$getLogoRow['img_path'].') no-repeat center top; height: '.$getLogoRow['img_height'].'px; width: '.$getLogoRow['img_width'].'px;"'; ?> >Zero Type</a>
			</div>
			<ul id="admin_navigation">
				<li>
					<a href="index.php">Dashboard</a>
				</li>
                                <li class="active">
					<a href="settings.php">Site Settings</a>
				</li>
				<li>
					<a href="pages.php">Pages</a>
				</li>
				<li>
					<a href="users.php">Users</a>
				</li>
				<li>
					<a href="posts.php">Posts</a>
				</li>
				
                                <li>
                                    <a href="../index.php" target="_blank">Review </a>
				</li>
                                <li>
                                    <a href="logout.php" target="_blank">Log out </a>
				</li>
			</ul>
                    
                        
            <?php
            }  else {
    header("Location: login.php");//if there is no cookie
}
            ?>
            
