<?php
session_start();	
        include("header.php");
        ?>

<body>
    <!--The Navigation Bar-->
    <header id="main-header">
        <a class="logo">AstonCV</a>
        <nav class="navigation">
            <div class="dropdown">
                <button class="dropbtn"><?php echo $_SESSION['username'];?>
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <a href="cv.php">Profile <i class='fas fa-user-circle'></i></a>
                    <a href="logout.php">Logout <i class='fas fa-power-off'></i></a>
                </div>
            </div>
        </nav>
    </header>


    <?php
	//Check if the user is not logged in, redirect to start
	if (!isset($_SESSION['username'])){
		header("Location: login.php");
		exit();
	}

    ?>
    <?php

	//Include the connectdb.php to connect to the database 
	require_once ('connectdb.php');  
    try {
        $query = "SELECT * FROM cvs Where name = '".$_SESSION['username']."'";
        //run  the query
        $result = $db->query($query);

        //display the cv information for update	
         ?>
    <section id="form" class="background-img">

        <?php
         while($data = $result->fetch(PDO::FETCH_ASSOC)) {
           ?>

        <form action="update.php" method="post">
            <div class="errorMsg"></div>
            <label>Name: </label>
            <input type="text" name="username" value="<?=$data['name'];?>" class="input-form"><br><br>
            <label>Email Address: </label>
            <input type="email" name="email" value="<?=$data['email'];?>" class="input-form"><br><br>
            <label>Key Programming:</label>
            <input type="text" name="kPrograming" value="<?=$data['keyprogramming'];?>" class="input-form"><br><br>
            <label>Profile:</label>
            <textarea type="text" name="profile" class="input-form"><?php echo $data['profile']; ?></textarea><br><br>
            <label>Education:</label>
            <input type="text" name="education" value="<?=$data['education'];?>" class="input-form"><br>
            <label>URL link:</label>
            <input type="url" name="url" value="<?=$data['URLlinks'];?>" class="input-form"><br>
            <input type="submit" value="Update" name="update" id="submit" /><br>

        </form>
        <?php
          }
          ?>

        </div>
    </section>
    <?php
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }

        if(isset($_POST['update'])){
            $username= strip_tags(trim($_POST['username']));	
            $email= strip_tags(trim($_POST['email']));		
            $keyprogramming= strip_tags(trim($_POST['kPrograming']));
            $profile= strip_tags(trim($_POST['profile']));
            $education= strip_tags(trim($_POST['education']));
            $url= strip_tags(trim($_POST['url']));
            $statment=$db->prepare("UPDATE cvs SET email=?,keyprogramming=?,profile=?,education=?,URLlinks=? WHERE name = '".$_SESSION['username']."'");		//sql insert query					
			$statment->execute([$email,$keyprogramming,$profile,$education,$url]);	
        
            header("Location:cv.php");
            exit();

        }
        ?>
    </main>

    <?php
include("footer.php");
?>