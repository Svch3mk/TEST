<?php
error_reporting('E_ALL & ~E_Notice');
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){//check if isset cookie
    die("<h2 style='text-align: center;'>You are already login <br /> >> <a href='logout.php'>Log out</a></h2>");
}else{
    

if($_POST['login']){
    include_once 'includes/connect.php';
    $sql = "SELECT * FROM users";
    $sql_query = mysql_query($sql) or die(mysql_error());
    $sql_row  = mysql_fetch_array($sql_query);
    
    $user = $_POST['user_name'];
    $pass = $_POST['user_pass'];
    $errors = array();
    
    if(empty($user) || empty($pass)){
        $errors[] = "User name and Password are reqiuerd";
    }elseif ($user != $sql_row['user_name'] && $pass != $sql_row['password']) {
        $errors[] = "Invalid user name or password";
    }  else {
        $cookie = setcookie("user",$sql_row['user_name'], time()+3600*24);
        if($cookie){
         
        echo '<meta http-equiv="refresh" content="1;url=index.php">';
        }
        
    }
    
}

?>
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
<?php
if($errors){
        foreach ($errors as $error){
            echo '<h2 class="error">'.$error.'</h2>';
        }
    }
?>
    <table border="0" class="login">
        
    <form action="login.php" method="post" >
        
        <tr>
            <td colspan="2"><h2> Login To Admin Panel </h2></td>
            
        </tr>
        <tr>
            <td width="130px">User Name :</td>
            <td><input type="text" name="user_name" /></td>
        </tr>
        <tr>
            <td width="130px">PassWord :</td>
            <td><input type="text" name="user_pass" /></td>
        </tr>
        <tr>
            <td width="130px"><input type="submit" name="login" value="Login" /></td>
            <td></td>
        </tr>
    
    
    </form>    
</table>
    
</body>
</html>
<?php  } ?>