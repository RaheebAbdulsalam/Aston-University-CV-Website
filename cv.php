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
                           <i class='fas fa-user-circle'></i>
                       </button>
                       <div class="dropdown-content">
                           <a href="update.php">Edit profile <i class='fas fa-user-edit'></i></a>
                           <a href="logout.php">Logout <i class='fas fa-power-off'></i></a>
                       </div>
                   </div>
               </nav>
           </header>


           <?php
	if (!isset($_SESSION['username'])){
		header("Location: login.php");
		exit();
	}

    ?> <section class="background-img">
               <div class="content">
                   <div class="card">
                       <div class="info">

                           <?php
	$username=$_SESSION['username'];
	echo "<h2> Welcome ".$_SESSION['username']."! </h2>";
	?>
                       </div>
                   </div>
               </div>
           </section>
           <?php

	//connectdb.php to connect to the database
	require_once ('connectdb.php');  
    try {
        $query = "SELECT * FROM cvs Where name = '".$_SESSION['username']."'";
        //run  the query
        $result = $db->query($query);

        //display the cv information	
         ?>
           <section class="background-img">
               <div style="overflow-x:auto;">

                   <?php
         while($data = $result->fetch(PDO::FETCH_ASSOC)) {
           ?>
                   <h2 class="title">Your Profile</h2><br><br>
                   <div id="details">
                       <div class="info-section"> <span class="detail-title">ID Number: </span>
                           <?php echo $data['id']; ?> </div> <br><br>
                       <div class="info-section"> <span class="detail-title">Username: </span>
                           <?php echo $data['name']; ?> </div><br><br>
                       <div class="info-section"> <span class="detail-title">Email Address: </span>
                           <?php echo $data['email']; ?> </div><br><br>
                       <div class="info-section"> <span class="detail-title">keyprogramming: </span>
                           <?php echo $data['keyprogramming']; ?></div> <br><br>
                       <div class="info-section"> <span class="detail-title">Profile: </span>
                           <?php echo $data['profile']; ?> </div><br><br>
                       <div class="info-section"> <span class="detail-title">Education: </span>
                           <?php echo $data['education']; ?> </div><br><br>
                       <div class="info-section"><span class="detail-title">URL Links: </span>
                           <?php echo $data['URLlinks']; ?></div> <br><br>
                       <?php
          }
          ?>
                   </div>
           </section>
           <?php
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
        ?>

           </main>


           <?php
include("footer.php");
?>