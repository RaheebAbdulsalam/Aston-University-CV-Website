<?php

require_once ("connectdb.php");

session_start();

$errorMessage="";
if(isset($_SESSION["username"]))	//check condition user login,if not direct back to index.php page
{
	header("location: cv.php");
}

if(isset($_REQUEST['submit']))	//button name is "btn_login"  
{       
	$username=strip_tags(trim($_POST["username"]));			
	$password=strip_tags(trim($_POST["password"]));			
	if(empty($username)){						
		$errorMessage="please enter username or email";	//check "username/email" is not empty 
	}
	
	else if(empty($password)){
		$errorMessage="please enter password";	//check "passowrd" is not empty 
	}
	else
	{
		try
		{
			$select_stmt=$db->prepare("SELECT * FROM cvs WHERE name=:uname OR password=:pass"); //sql select query
			$select_stmt->execute(array(':uname'=>$username, ':pass'=>$password));	//execute query with bind parameter
			$row=$select_stmt->fetch(PDO::FETCH_ASSOC);
			
			if($select_stmt->rowCount() > 0)	//check condition database record greater zero 
			{
				if($username==$row["name"]) //check condition user taypable "username"match from database "username " 
				{
					if(password_verify($password, $row["password"])) //check condition user taypable "password" are match from database "password" using password_verify() 
					{
                        $_SESSION["username"]=$_POST['username'];
                        header("refresh:1; cv.php");	
                        exit();
					}
					else
					{
						$errorMessage="wrong password";
					}
				}
				else
				{
					$errorMessage="wrong username or email";
				}
			}
			else
			{
				$errorMessage="wrong username or email";
			}
		}
		catch(PDOException $e)
		{
			$e->getMessage();
		}		
	}
}
?>

<?php
include("header.php");
?>

<!--The Navigation Bar-->
<header id="main-header">
    <a href="index.php" class="logo">AstonCV</a>
    <nav class="navigation">
        <a href="index.php">Home</a>
        <a class="current" href="login.php">Login</a>
        <a href="register.php">Sign Up</a>
        <a href="search.php">Search</a>
    </nav>
</header>

<body>
    <!-- a Login form that allows the user to enter his username and password for login.-->
    <section id="form" class="background-img">
        <h2 class="title">Log in to your AstonCV account</h2>
        <form action="login.php" method="post">

            <div class="errorMsg"><?php echo $errorMessage; ?></div>

            <label>Username</label>
            <input type="text" name="username" class="input-form" />

            <label>Password</label>
            <input type="password" name="password" class="input-form" /><br>

            <input type="submit" value="Login" id="submit" name="submit" />

            <p class="terms">By using AstonCV, you agree to our Terms of Service</p>
            <p class="terms"> Not registered yet? <a href="register.php">Register</a></p>

        </form>
    </section>


    <?php
include("footer.php");
?>