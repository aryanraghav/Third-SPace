<!--<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Third Space</title>
    <link rel="stylesheet" href="firstpage.css">
    
</head>
<body>
    <header>
        <img class="header" src="logo-orange.png" alt="logo">
    <nav>
        <label class="logo">Third Space</label>
        <ul>
            <li><a class="active" href="">About</a></li>
            <li><a href="login.php">Log In</a></li>
            <li><a href="signup.php">Sign Up</a></li>
        </ul>
        </nav>
</header>
</body>
</html>-->

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Welcome to Finance Portal</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="assests/css/style.css">

</head>
<body>
<div class="signup-form">
    <form action="firstpage.php" method="post" enctype="multipart/form-data">
		<h2>Welcome</h2>
        <br>

            <?php
				session_start();
				$servername = "localhost:3307";
        $username = "root";
        $password = "1234";
        $dbname = "user";
      
        $conn = new mysqli($servername,$username, $password, $dbname);
      
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
                $name=$_SESSION["Name"];
				$sql=mysqli_query($conn,"SELECT * FROM userinfo where username='$name' ");
				$row  = mysqli_fetch_array($sql);
            ?>
            
		<p><br><b>Welcome </b><?php echo $_SESSION["Name"] ?></p>
        <div>Want to Leave the Page? <br><a href="logout.php">Logout</a></div>
    </form>
	
</div>
</body>
</html>