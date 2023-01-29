<?php

require_once('connectdb.php');
$errorMessage="";
if(isset($_REQUEST['submit'])) 
{

    $username= strip_tags(trim($_POST['username']));	
	$email= strip_tags(trim($_POST['email']));		
	$password= strip_tags(trim($_POST['password']));	
    $keyprogramming= strip_tags(trim($_POST['kPrograming']));
    $profile= strip_tags(trim($_POST['profile']));
    $eduction= strip_tags(trim($_POST['education']));
    $url= strip_tags(trim($_POST['url']));

		
	if(empty($username)){
		$errorMessage="Please enter username";	//check username field not empty 
	}
	else if(empty($email)){
		$errorMessage="Please enter email";	//check email field not empty 
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$errorMessage="Please enter a valid email address";	//check proper email format 
	}
	else if(empty($password)){
		$errorMessage="Please enter password";	//check passowrd field not empty
	}
	else if(strlen($password) < 3){
		$errorMessage = "Password must be atleast 3 characters";	//check passowrd must be 3 characters
	}
	else
	{	
		try
		{	
            $select_stmt=$db->prepare("SELECT * FROM cvs WHERE name=:uname OR email=:email"); //sql select query
			$select_stmt->execute(array(':uname'=>$username, ':email'=>$email));	//execute query with bind parameter
			$row=$select_stmt->fetch(PDO::FETCH_ASSOC);
			
			if($row["name"]==$username){
				$errorMessage="Sorry username already exists";	//check condition username already exists 
			}
			else if($row["email"]==$email){
				$errorMessage="Sorry email already exists";	//check condition email already exists 
			}
			else
			{
				$new_password = password_hash($password, PASSWORD_DEFAULT); //encrypt password using password_hash()
				
				$insert_stmt=$db->prepare("insert into cvs values(default,?,?,?,?,?,?,?)");		//sql insert query					
				
				$insert_stmt->execute(array($username,$email,$new_password, $keyprogramming,$profile,$eduction,$url));
				
                header("Location:login.php");
    exit();
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}
?>

<?php
include("header.php");
?>

<!--The Navigation Bar-->
<header id="main-header">
    <a href="index.php" class="logo">Aston Cvs</a>
    <nav class="navigation">
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
        <a class="current" href="register.php">Sign Up</a>
        <a href="search.php">Search</a>

    </nav>
</header>

<body>
    <section class="background-img" id="register-now">
        <div class="content">
            <div class="card">
                <div class="icon">
                    <i class="fas fa-file"></i>
                </div>
                <div class="info">
                    <h3>Create a free AstonCV account today</h3>
                </div>
            </div>
        </div>
    </section>


    <!--The Registeration form-->
    <section id="form" class="background-img">
        <h2 class="title">Let's grow together</h2>
        <form action="register.php" method="post">
            <div class="errorMsg"><?php echo $errorMessage; ?></div>
            <label>Full Name </label>
            <input type="text" name="username" placeholder="Username" class="input-form"><br><br>
            <label>Email Address </label>
            <input type="email" name="email" placeholder="Email" class="input-form"><br><br>
            <label>Password</label>
            <input type="password" name="password" placeholder="Password" class="input-form"><br><br>
            <label>Repeat Password</label>
            <input type="password" name="passwordRepeat" placeholder="Repeat Password" class="input-form"><br><br>
            <label>Key Programming Languages</label>
            <textarea type="text" name="kPrograming" placeholder="Programming Languages" class="input-form"></textarea><br><br>
            <label>Profile</label>
            <textarea type="text" name="profile" placeholder="Profile" class="input-form"></textarea><br><br>
            <label>Education</label>
            <textarea type="text" name="education" placeholder="Education" class="input-form"></textarea><br>
            <label>URL link</label>
            <input type="url" name="url" placeholder="URL link" class="input-form"><br>
            <input type="submit" value="Submit" name="submit" id="submit" /><br>
            <p class="terms">By using AstonCV, you agree to our Terms of Service</p>
            <p class="terms"> Already a user? <a href="login.php">Log in</a> </p>

        </form>
    </section>


    <?php
include("footer.php");
?>