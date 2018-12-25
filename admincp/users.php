<?php

include_once 'includes/header.php';
?>
<ul id="second_navigation">
        <li>
                <a href="users.php?page=change_password">Change Password</a>
        </li>
</ul>
</div>
</div>
<?php
/*get user Data */
$get_user_sql = "SELECT * FROM users";
$get_user_query = mysql_query($get_user_sql) or date(mysql_error());
$get_user_row = mysql_fetch_array($get_user_query);


/* Update user name */
if($_POST['user']){
    $user_name = $_POST['user_name'];
    
    $update_user_sql = "UPDATE users SET user_name='$user_name'";
    $upadte_user_query = mysql_query($update_user_sql) or date(mysql_error());
}

/* Change password */
if($_POST['password']){
    $password = $_POST['old_password'];
    $new_password = md5($_POST['new_password']);
    $r_n_password = md5($_POST['r_new_password']);
    $userErrors = array();
    
    if(empty($password) || empty($new_password) || empty($r_n_password)){
        $userErrors[] = "All Fields are requierd";
    }elseif($password != $get_user_row['password']){
        $userErrors[] = "Wrong Old Password  ";
    }elseif ($r_n_password != $new_password) {
        $userErrors[] = "Retype the same new password";
    }else{
        $update_pass_sql = "UPDATE users SET password='$new_password'";
        $update_pass_query = mysql_query($update_pass_sql) or die(mysql_error());
    }
}
?>
<div id="contents"> 
  
<?php
if($_REQUEST['page'] == 'change_password'){
    echo '<h2>Change PassWord</h2>';
    if($update_pass_query){
    echo '<h2 class="success">UpDate Done Successfully</h2>';
    echo '<meta http-equiv="refresh" content="3;url=users.php">';
    }
    
    if($userErrors){
        foreach ($userErrors as $error){
            echo '<h2 class="error">'.$error.'</h2>';
        }
    }
    echo '
    <table border="0">
      <form action="users.php?page=change_password" method="post" class="message">
            <tr>
                <td width="130px">Old PassWord : </td>
                <td><input type="password" class="inputText" name="old_password" onFocus="this.select();" onMouseOut="javascript:return false;"/> </td>
            </tr>
            <tr>
                <td width="130px">New PassWord : </td>
                <td><input type="password" class="inputText" name="new_password" onFocus="this.select();" onMouseOut="javascript:return false;"/> </td>
            </tr>
            <tr>
                <td width="130px">Replay New PassWord : </td>
                <td><input type="password" class="inputText" name="r_new_password" onFocus="this.select();" onMouseOut="javascript:return false;"/> </td>
            </tr>
            <tr>
                <td width="130px"><input type="submit" name="password" value="UpDate!!" /></td>
                <td></td>
            </tr>


        </form>    
    </table>      
    ';
    
}  else {
if($upadte_user_query){
    echo '<h2 class="success">UpDate Done Successfully</h2>';
    echo '<meta http-equiv="refresh" content="3;url=users.php">';
}
    echo '
    <table border="0">
      <form action="users.php" method="post" class="message">
            <tr>
                <td width="130px">User Name : </td>
                <td><input type="text" class="inputText" name="user_name" value="'.$get_user_row['user_name'].'" onFocus="this.select();" onMouseOut="javascript:return false;"/> </td>
            </tr>
            <tr>
                <td width="130px"><input type="submit" name="user" value="Add!!" /></td>
                <td></td>
            </tr>


        </form>    
    </table>      
    ';
}
?>
    
</div>

<?php
include_once 'includes/footer.php';

?>