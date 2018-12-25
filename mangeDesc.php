<?php
error_reporting('E_ALL & ~E_Notice');
include_once 'admincp/includes/connect.php';

/* site description*/
##########################
$getData = "SELECT * FROM siteDesc ORDER BY id";
$getDataQuery = mysql_query($getData);
$getRow       = mysql_fetch_array($getDataQuery);

/* site url*/
###########################
/*facebook*/
$facebookUrl = "SELECT facebook FROM siteurl ORDER BY id";
$facebookData = mysql_query($facebookUrl) or die(mysql_error());
$facebook = mysql_fetch_array($facebookData);

/*twitter*/
$twitterUrl = "SELECT twitter FROM siteurl ORDER BY id";
$twitterData = mysql_query($twitterUrl) or die(mysql_error());
$twitter = mysql_fetch_array($twitterData);

/*google*/
$googleUrl = "SELECT google FROM siteurl ORDER BY id";
$googleData = mysql_query($googleUrl) or die(mysql_error());
$google = mysql_fetch_array($googleData);

/*youtube*/
$youtubeUrl = "SELECT youtube FROM siteurl ORDER BY id";
$youtubeData = mysql_query($youtubeUrl) or die(mysql_error());
$youtube = mysql_fetch_array($youtubeData);


/* site images */
###########################

$getLogo = "SELECT * FROM siteimage WHERE img_type='logo'";
$getLogoQuery = mysql_query($getLogo);
$getLogoRow       = mysql_fetch_array($getLogoQuery);


/* News page -> new post */
###########################
$getPost = "SELECT * FROM sitepost WHERE post_type='news' ORDER BY id DESC";
$getPostQuery = mysql_query($getPost);


######################
##### Pages Setting ##
######################

/*  Features Page */
#######################
/* Get Page Description */
$g_f_desc_sql = "SELECT post_content FROM sitepost WHERE post_type='f_desc'";
$g_f_desc_query = mysql_query($g_f_desc_sql) or die(mysql_error());
$g_f_desc_row = mysql_fetch_array($g_f_desc_query);

/* Get Posts*/
$g_f_post_sql = "SELECT * FROM sitepost WHERE post_type='features' ORDER BY id DESC";
$g_f_post_query = mysql_query($g_f_post_sql) or die(mysql_error());

