<!--<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>Welcome to Finance Portal</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="assests/css/style.css">

</head>
<body>
<div class="signup-form">
    <form action="signupcheck.php" method="post" enctype="multipart/form-data">
		<h2>Register</h2>
		<p class="hint-text">Create your account</p>
        <div class="form-group">
			<div class="row">
				<div class="col"><input type="text" class="form-control" name="first_name" placeholder="First Name" required="required"></div>
				<div class="col"><input type="text" class="form-control" name="last_name" placeholder="Last Name" required="required"></div>
			</div>        	
        </div>
        <div class="form-group">
        	<input type="email" class="form-control" name="email" placeholder="Email" required="required">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="pass" placeholder="Password" required="required">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="cpass" placeholder="Confirm Password" required="required">
        </div>
        <div class="form-group">
            <input type="file" name="file" required>
           
        </div>        
        <div class="form-group">
			<label class="form-check-label"><input type="checkbox" required="required"> I accept the <a href="#">Terms of Use</a> & <a href="#">Privacy Policy</a></label>
		</div>
		<div class="form-group">
            <button type="submit" name="save" class="btn btn-success btn-lg btn-block">Register Now</button>
        </div>
        <div class="text-center">Already have an account? <a href="login.php">Sign in</a></div>
    </form>
	
</div>
</body>
</html>-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="icon" type="image/x-icon" href="/images/ThirdSpaceLogo.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script type = "text/javascript" src="eye.js"></script>
    <link rel="stylesheet" type="text/css" href="signup.css"/>
</head>

<body>
    <?php

    $nameErr = $emailErr =$PasswordErr = $CPErr="";
    $name = $email = $Password = $ConfirmPassword= "";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      if (empty($_POST["email"])) {
        $emailErr = "Enter your Email";
      } 
     else {
        $email = test_input($_POST["email"]);  
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        { 
           $emailErr = "Invalid email format";   
        } 
      }

      if (empty($_POST["Name"])) {
        $nameErr = " Enter your Name ";
      } 
      else 
      {
        $name = test_input($_POST["Name"]);   
          if (!preg_match("/^[a-zA-Z-']*$/",$name)) 
          { 
            $nameErr = "No digits should be there"; 
          }
      }
      
        
      if (empty($_POST["Password"])) {
        $PasswordErr = "Enter the Password";
      } else {
        $Password = test_input($_POST["Password"]);
        $plength=strlen($Password);
        if($plength<8)
        {
            $PasswordErr= "Password should be of atleast 8 characters";
        }
      }
      
    
      if (empty($_POST["ConfirmPassword"])) {
        $CPErr = "Confirm the password";
      } else {
        $ConfirmPassword = test_input($_POST["ConfirmPassword"]);
        
      }
      
      if($_POST["Password"]!=$_POST["ConfirmPassword"])
      {
          $CPErr="Password doesn't match,Re-enter the password";
      }
    
      if($nameErr == "" && $emailErr == "" && $PasswordErr == "" && $CPErr == ""){
    
        $servername = "localhost:3307";
        $username = "root";
        $password = "1234";
        $dbname = "user";
      
        $conn = new mysqli($servername,$username, $password, $dbname);
      
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $name = $_POST['Name'];
        $Pass = $_POST['Password'];
        $email = $_POST['email'];

        $sql=mysqli_query($conn,"SELECT * FROM userinfo where Email='$email'");
        if(mysqli_num_rows($sql)>0)
        {
          echo "<style> 
                color: red;
                font-size:34;
                </style>
                <b>Email Id Already Exists, please go to the login page...</b>"; 
	      exit;
        }
         else if (isset($_POST['Submit']))
         {
          $query = "INSERT INTO userinfo(email,username,password) VALUES('$email','$name','$Pass')";
          $sql=mysqli_query($conn,$query)or die("Could Not Perform the Query");
          header ("Location: firstpage.html?status=success");
       }
    else 
    {
		echo "Error.Please try again";
	}
    $conn->close();
    }
      }
      
    
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
      
    ?> 

<div class="con">
 <div align="left">
    <br>
    <div class="form1">

        <div class="ThirdSpace">
            <p>THIRDSPACE</p><br></div>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

       <input type="text" placeholder="E-Mail Address" name="email" id="Email">
       <span class="error">* <br><?php echo $emailErr;?></span><br>

        <input type="text" placeholder="Name" name="Name" id="Name">
        <span class="error">* <br><?php echo $nameErr;?></span><br>

        <input type="text" placeholder="Enter Password" name="Password" id="Password">
        <i class="fa fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;" onclick="Toggle()"></i>
        <span class="error">*<br> <?php echo $PasswordErr;?></span><br>

        <input type="text" placeholder="Confirm Password" name="ConfirmPassword" id="ConfirmPassword">
        <span class="error">*<br> <?php echo $CPErr;?></span><br>

        <br><input type="Submit" id="Submit" name="Submit" value="Create Account">
        <input type="reset" class="cancel" value="Cancel"><br>

        <p>Already have an account?<a href="login.php">Sign-in</a></p>
    </form>
    </div>
  </div>

  <div class="page"></div>

  <div>
      <h1 class="Welcome">WELCOME TO,</h1>
      <h1 class="Welcome"><span>T</span>HIRD<span>S</span>PACE</h1>
      <p>BORN TO ROCK, FOCUS TO WORK</p>
  </div>
</div>
</body>
</html>