<?php
    session_start();
    session_unset();
    session_destroy();
    $username = 'Admin';
    $stored_hash = hash('md5', "test123");
    $failure = false;
    if(isset($_POST['uname']) && isset($_POST['pass'])) 
    {
        $check = hash('md5', $_POST['pass']);
        if($_POST['uname'] !== "Admin" || $check != $stored_hash)
        {
            $failure = "*Incorrect Username or Password";
        }
        else
        {
            session_start();
            $_SESSION['username'] = $_POST['uname'];
            $_SESSION['password'] = $_POST['pass'];
            header("Location: Home.php");
            return;
        }
    }
?>
<!DOCTYPE html>    
<html>    
    <head>    
    	<title>Login Form</title>   
    	<meta charset="UTF-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    	<link rel="stylesheet" type="text/css" href="CSS/Login_Style.css">
        <script src="https://kit.fontawesome.com/68b0726c11.js" crossorigin="anonymous"></script>
    </head>
    <body> 
		<h1>PUBLIC LIBARY</h1>
		<div class="login-box">
        	<h2>Login</h2>
        	<form method="post" action="#">
                <p class="failure">
                    <?php
                        if($failure !== false)
                        {
                            echo("$failure");
                        }  
                    ?> 
                </p>
                <i class="fas fa-sign-in-alt"></i><br><br>
				<label><b>Enter Librarian Username</b></label> 
			    <input type="text" name="uname" required> 

			    <label><b>Enter Password</b></label> 
			    <input type="password" name="pass" required> 

				<input type="submit" name="submit" value="Login">
	    	</form> 
		</div>
    </body> 
</html> 
