<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// include page header HTML for ezxample
//include_once "layout_head.php";
 
echo "<div class='col-sm-6 col-md-4 col-md-offset-4'>";
 
   $action=isset($_GET['action']) ? $_GET['action'] : ""; //***************************************
 
// tell the user he is not yet logged in
if($action =='not_yet_logged_in'){
    echo "<div class='alert alert-danger margin-top-40' role='alert'>Please login.</div>";
}
 
// tell the user to login
else if($action=='please_login'){
    echo "<div class='alert alert-info'>
        <strong>Please login to access that page.</strong>
    </div>";
}
 
// tell the user email is verified
else if($action=='username_verified'){
    echo "<div class='alert alert-success'>
        <strong>Your User Name address have been validated.</strong>
    </div>";
}
 
// tell the user if access denied
if($access_denied){
    echo "<div class='alert alert-danger margin-top-40' role='alert'>
        Access Denied.<br /><br />
        Your username or password maybe incorrect
    </div>";
}

 
    // actual HTML login form
    echo "<div class='account-wall'>";
        echo "<div id='my-tab-content' class='tab-content'>";
            echo "<div class='tab-pane active' id='login'>";
                
                                //echo "<img class='profile-img' src='images/login-icon.png'>"; //this is something to come back to!!!! Micht look cool for sprint 3!
            
                echo "<form class='form-signin' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>";
                    echo "<input type='text' name='username' class='form-control' placeholder='User Name' required autofocus />";
                    echo "<input type='password' name='password' class='form-control' placeholder='Password' required />";
                    echo "<input type='submit' class='btn btn-lg btn-primary btn-block' value='Log In' />";
                echo "</form>";
            echo "</div>";
        echo "</div>";
    echo "</div>";
 
echo "</div>";
 
// footer HTML and JavaScript codes for example:
//include_once "layout_foot.php";
