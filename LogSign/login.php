<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script type = "text/javascript" src="eye.js"></script>
    <title>Login Page</title>

<style>

body{
    font-size: 14px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

}
.page{
    height:50em;
    width:40em;
    background-color:white;
    border-right:1px solid black;
    margin-left:20px;
}

.ThirdSpace{
   margin: 10px;
   font-size: 25px;
   color:#dc143c;
   font-style: bold;
}
.error{
color:red;
}
::placeholder{
   color:#000000;
}

.form1{
   text-align:center;
   
   border-radius:0.5em;
   padding:0.5em;
   /*border:2px solid black;
   width:30.68em;*/
   background-color: #ffffff;
   opacity: 1.0;
   display: inline-block;
   align-content: initial;
}

#Name{
   border-radius: 1em;
   padding:1.03em;
   width:25em;
}

#Password{
   border-radius: 1em;
   padding:1.03em;
   width:25em;
}

#Submit
{ 
   background-color:#000000; 
   width: 12.35em;
   padding: 1.4em; 
   border-radius: 1em;
   cursor: pointer; 
   color:white;
   font-style:bold;
} 

.cancel
{ 
   background-color:white; 
   width: 12.35em;
   border-radius: 1em;
   padding: 1.4em; 
   cursor: pointer; 
   margin: 1em;  
   font-style: bold;
}

img{
   width:0.1em;
   background-color: orange;
}

input[type=text], 
input[type=password] { 
   width: 100%; 
   padding: 1em 5em; 
   margin: 0.08em 0; 
   display: inline-block; 
   border-radius: 1.5em; 
   box-sizing: border-box; 
   resize: vertical;
}

div[align=right]
{
   text-align: center;
   font-size: 32px;
   float:right;
   margin-top:-600px;
   margin-right: 250px;
}
.Welcome span{
   font-weight:bolder;
   color:#dc143c;
}

a{
    color:black;
    margin-left:80px;
}

    </style>
</head>
<body>  

    <?php

    $nameErr =$PasswordErr ="";
    $name = $Password ="";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {


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
    
       if($nameErr == "" && $PasswordErr == "")
       {
          session_start();
          $servername = "localhost:3307";
        $username = "root";
        $password = "1234";
        $dbname = "user";
      
        $conn = new mysqli($servername,$username, $password, $dbname);
      
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        if(isset($_POST['Submit']))
         {
           $name = $_POST['Name'];
           $Pass = $_POST['Password'];
    $sql=mysqli_query($conn,"SELECT * FROM userinfo where username='$name' and password='$Pass'");
        $row  = mysqli_fetch_array($sql);
    if(is_array($row))
    {
      
        $_SESSION["Name"]=$row['username'];
        $_SESSION["Password"]=$row['password']; 
        header("Location: firstpage.php"); 
      
    }
    else
    {
        echo "Invalid Credentials, Please check if you have entered correct details...";
    }
}
       }
       }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
?>

<div align="left">
<div class="page">
    <br>
    <div class="form1">

        <div class="ThirdSpace">
            <h1>THIRDSPACE</h1><br></div>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

        <input type="text" placeholder="Name" name="Name" id="Name">
        <span class="error"> <br><?php echo $nameErr;?></span><br>

        <input type="password" placeholder="Enter Password" name="Password" id="Password">
        <i class="fa fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;" onclick="Toggle()"></i>
        <span class="error"><br> <?php echo $PasswordErr;?></span><br>
    
        <br><input type="Submit" name="Submit" id="Submit" value="Login">
        <input type="reset" class="cancel" value="Cancel"><br>

    </form>
    </div>

   <!-- <br><a href="Forgot.html">Forgot Password?</a>-->
    <p>Don't have an account?<a href="signup.php">Sign up for free</a></p>
    </div>
  </div>

  <div align="right">
      <h1 class="Welcome">WELCOME TO,</h1>
      <h1 class="Welcome"><span>T</span>HIRD<span>S</span>PACE</h1>
      <p>BORN TO ROCK, FOCUS TO WORK</p>
    </div>

</body>
</html>
