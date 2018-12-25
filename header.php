<?php
include_once 'mangeDesc.php';
?>
<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title><?php  echo $getRow['title']; ?></title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
        <meta name="description" content="<?php  echo $getRow['desc']; ?>">
        <meta name="keywords" content="<?php  echo $getRow['keywords']; ?>">
        <meta name="author" content="<?php  echo $getRow['author']; ?>">
</head>
<body>
	<div id="header">
		<div>
			<div class="logo">
                            <a href="index.php"  <?php echo 'style="background: url(admincp/'.$getLogoRow['img_path'].') no-repeat center top; height: '.$getLogoRow['img_height'].'px; width: '.$getLogoRow['img_width'].'px;"'; ?> >Zero Type</a>
			</div>
			<ul id="navigation">
				<li class="active">
					<a href="index.php">Home</a>
				</li>
				<li>
					<a href="features.php">Features</a>
				</li>
				<li>
					<a href="news.php">News</a>
				</li>
				<li>
					<a href="about.php">About</a>
				</li>
				<li>
					<a href="contact.php">Contact</a>
				</li>
			</ul>
		</div>
	</div>
	