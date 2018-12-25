<?php include_once 'header.php';?>
	<div id="contents">
		<div class="main">
			<h1>News</h1>
			<ul class="news">
                            
<?php

 
    
     
 
/* Get Posts one by one */
while ($getPostRow       = mysql_fetch_array($getPostQuery)){
    
    echo '
        <li>
                <div class="date">
                        <p>
                                <span>'.$getPostRow["post_date_d"].'</span>
                                '.$getPostRow["post_date_y"].'
                        </p>
                </div>
                <h2>'.$getPostRow["post_title"].' <span>'.$getPostRow["post_author"].'</span></h2>
                <p>
                    '.substr($getPostRow["post_content"],0,400).'... <span><a href="post.php?post_id='.$getPostRow["id"].'" class="more">Read More</a></span>     
                </p>
        </li>
';
}
?>                            
				
			</ul>
		</div>
		<div class="sidebar">
			<h1>Popular Posts</h1>
			<ul class="posts">
				<li>
					<h4 class="title"><a href="post.php">Making It Work</a></h4>
					<p>
						I'm a paragraph. Click here to add your own text and edit me. I’m a great place for you to tell a story and let your users know a little more about you.
					</p>
				</li>
				<li>
					<h4 class="title"><a href="post.php">Designs and Concepts</a></h4>
					<p>
						I'm a paragraph. Click here to add your own text and edit me. I’m a great place for you to tell a story and let your users know a little more about you.
					</p>
				</li>
				<li>
					<h4 class="title"><a href="post.php">Getting It Done!</a></h4>
					<p>
						I'm a paragraph. Click here to add your own text and edit me. I’m a great place for you to tell a story and let your users know a little more about you.
					</p>
				</li>
			</ul>
		</div>
	</div>
	<?php include_once 'footer.php';  ?>