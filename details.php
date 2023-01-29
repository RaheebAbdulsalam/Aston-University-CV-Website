<?php
        include("header.php");
        ?>

<body>
    <!--The Navigation Bar-->
    <header id="main-header">
        <a href="index.php" class="logo">AstonCV</a>
        <nav class="navigation">
            <a class="current" href="index.php">Home</a>
            <a href="login.php">Login</a>
            <a href="register.php">Sign Up</a>
            <a href="search.php">Search</a>

        </nav>
    </header>


    <!--Display more details-->
    <main>
        <section class="main">

            <?Php
    $id=$_REQUEST['id'];
if (!isset($id)) {
    die ("Sorry, we can't view this user");
}

require_once ('connectdb.php'); 

try {
    $query = "SELECT * FROM cvs Where id = $id";
    $result = $db->query($query);	
     ?>

            <div style="overflow-x:auto;">

                <?php
             while($data = $result->fetch(PDO::FETCH_ASSOC)) {
                        ?>

                <div id="details">
                    <span class="detail-title">Name: </span> <?php echo $data['name']; ?><br><br>
                    <span class="detail-title">Email Address: </span><?php echo $data['email']; ?><br><br>
                    <span class="detail-title">Key Programming Language: </span><?php echo $data['keyprogramming']; ?>
                    <br><br>
                    <span class="detail-title">Profile: </span><?php echo $data['profile']; ?>
                </div><br>

                <?php
      }
      ?>

                <a href="index.php" class="main-btn">Go back </a>

            </div>
        </section>
        <?php
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
        ?>

        </section>
    </main>


    <?php
include("footer.php");
?>