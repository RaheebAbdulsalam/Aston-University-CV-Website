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

    <!--The Introduction section-->
    <main>
        <section class="main">
            <div>
                <h2>Getting a great job starts with a great CV</h2><br><br>
                <a href="register.php" class="main-btn">Get Started </a> <br><br>
                <h2 style="color:#be74c5">These are the developers building their CVs on AstonCV</h2><br><br>
                <table>
                    <thead>
                        <tr>
                            <th>Programmer Name</th>
                            <th>Key Programming Languages</th>

                        </tr>
                    </thead>

                    <tbody>

                        <?php    
            require_once ('connectdb.php');  
            $stmt = $db->prepare("SELECT * FROM cvs");
            $stmt->execute();
            $users = $stmt->fetchAll();
            foreach($users as $user) 
         {  
     ?>
                        <tr>
                            <td>
                                <?php echo $user['name']; ?>
                            </td>

                            <td>
                                <?php echo $user['keyprogramming']; ?>
                            </td>

                            <td>
                                <div>
                                    <?php echo "<a href=details.php?id=$user[id]>View CV</a>"; ?>
                                </div>
                            </td>
                        </tr>
                        <?php
     }
     
     ?>
                    </tbody>
                </table>

        </section>
    </main>


    <!--The footer-->
    <?php
include("footer.php");
?>