<?php
include("header.php");
?>

<!--The Navigation Bar-->
<header id="main-header">
    <a href="index.php" class="logo">AstonCV</a>
    <nav class="navigation">
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
        <a href="register.php">Sign Up</a>
        <a class="current" href="search.php">Search</a>
    </nav>
</header>

<body>
    <main>
        <section class="main">
            <section id="form" class="background-img">
                    <div class="content">
            <div class="card">
            <div class="info">
                    <h3>Search AstonCV Database for the most cost-effective way to find the best programmer
                    for your jobs.</h3>
                </div>
                </div>


                <table width="599" border="1">
                    <tr>
                        <th>
                            <div>
                                <form action="search.php" method="post">
                                    <input type="text" placeholder="Name/Key programming language" name="key" class="input-form"><br>
                                    <button type="submit" value="submit" name="submit" id="submit"><i class="fa fa-search"></i></button>


                                </form>
                            </div>

                            <div>
                                <?php 
                                require_once ("connectdb.php");
                                $key= strip_tags(trim($_POST['key']?? ""));	
                                if(ISSET($_POST['submit'])){
                                    if(empty($key)){						
                                       echo "please enter a search key"; 
                                      }else{
                                    $query=$db->prepare('SELECT * FROM cvs WHERE name LIKE :keyword OR keyprogramming LIKE :keyword ORDER BY name');
                                    $query->bindValue(':keyword','%'.$key.'%', PDO::PARAM_STR);
                                    $query->execute();
                                    $results=$query->fetchAll();
                                    $rows=$query->rowCount();
                                    ?>
                                <span id="serach-result">You have currently searched for
                                    '<?php echo $key; ?>'</span><br><br><?php
        if($rows != 0){
            foreach($results as $r){
                echo '<h4>'.$r['name'].'('.$r['keyprogramming'].' programmer) '.'</h4>';
                echo "<a href=details.php?id=$r[id]>View CV</a>";
            }
        }
        else{
            echo 'Sorry there is nothing to show!';
        }
        
    }
}
    ?>
                            </div>
                        </th>
                    </tr>
                </table>

                </form>
            </section>
        </section>

    </main>

    <?php
include("footer.php");
?>