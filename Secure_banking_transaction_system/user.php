<?php
include("dbconnect.php");
session_start();
extract($_POST);
$date =date("Y-m-d");
date_default_timezone_set("Asia/Calcutta");
$time=date('g:i a');

if(isset($_POST['btn'])) 
{
	$uname=$_REQUEST['uname'];
	$password=$_REQUEST['password'];

	if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
	} 
	else
	{
	 $qry="select * from user_register where uname='$uname' and  password='$password' and status='0'";
	$result = mysqli_query($conn, $qry);
	 if (mysqli_num_rows($result)) 
	{
	while($row = $result->fetch_assoc())
		 {
		echo  $email=$row['email'];
		  $accno=$row['accno'];
		  $pin=$row['pin'];
		  $_SESSION['email']=$email;
		  $_SESSION['accno']=$accno;
		  $_SESSION['pin']=$pin;
		  
		   
		}
	 /////////   
	 

	
	/*if ($result1->num_rows > 0) 
	{
		while($row = $result1->fetch_assoc())
		 {
		   
		}
	}*/
	
$qrt1="update user_register set date='$date' where uname='$uname'";
$qrt1;
if($conn->query($qrt1) === TRUE)
{
$qrt11="update user_register set time='$time' where uname='$uname'";
if($conn->query($qrt11) === TRUE)
{
	
	$_SESSION['uname']=$uname;    

    
	?>					
	<script language="javascript">
	alert("login Success");
	window.location.href="user_home.php";
	</script>
	<?php
}
}
	}  
	else
	{
 
	?>					
	<script language="javascript">
	alert("Failed");
	</script>
	<?php

	}
  
}
 
$conn->close();
 }

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<title>Secure Banking Transaction System With Data Encryption</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="E-Banking Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
<link href="css/style.css" type="text/css" rel="stylesheet" media="all">
<link href="css/font-awesome.css" rel="stylesheet">   <!-- font-awesome icons -->
<link rel="stylesheet" href="css/lightbox.css">
<!-- //Custom Theme files -->  
<!-- js --> 
	<script src="js/jquery-2.2.3.min.js"></script>
<!-- web-fonts -->
<link href="//fonts.googleapis.com/css?family=Secular+One" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<!-- //web-fonts --> 

</head>
<body> 
	<!-- header -->
	<div class="headerw3-agile"> 
		<div class="header-w3mdl"><!-- header-two --> 
			<div class="container"> 
				<div class="agileits-logo navbar-left">
					<h1><a href="#">Secure Banking Transcation System</a></h1> 
				</div> 
				<div class="agileits-hdright nav navbar-nav">
					<div class="header-w3top"><!-- header-top --> 
						<ul class="w3l-nav-top">
							
						</ul>
						<div class="clearfix"> </div> 	 
					</div>
					<div class="agile_social_banner">
						<ul class="agileits_social_list">
							
						</ul>
					</div>  

				</div>
				<div class="clearfix"> </div> 
			</div>	
		</div>	
	</div>	
	<!-- //header -->  
	<!-- banner -->
	<div class="banner inner-banner">
		<div class="header-nav"><!-- header-three --> 	
			<nav class="navbar navbar-default">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						Menu 
					</button> 
				</div>
				<!-- top-nav -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						 <li><a href="index.php" class="scroll">Home</a></li>
						<li><a href="user.php" class="active">User</a></li>    
						<li><a href="admin.php" class="scroll">Admin</a></li>    
					</ul>  
					<div class="clearfix"> </div>	
				</div>
			</nav>    
		</div>
	</div>	
	<!-- banner -->
	<!-- gallery -->
	<div class="w3ls-section gallery">
		<div class="container">   
			<div class="w3ls-title">
				<h2 class="h3-w3l">User  Login </h2>
				<form name="form1" method="post" action="">
				  <table width="372" height="104" border="0" align="center">
                    <tr>
                      <td><span class="style2">User Name </span></td>
                      <td><input name="uname" type="text" id="uname" /></td>
                    </tr>
                    <tr>
                      <td><span class="style2">Password</span></td>
                      <td><input name="password" type="password" id="password" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input name="btn" type="submit" id="btn" value="Login" />
  &nbsp;&nbsp; <a href="user_register.php">Register</a></td>
                    </tr>
                  </table>
              </form>
				<p class="h3-w3l">&nbsp;</p>
			</div> 
			<div class="gallery-grids-top">
				<div class="gallery-grids agileits-w3layouts">
				  <div class="clearfix"> </div>	
					<script src="js/lightbox-plus-jquery.min.js"></script>	
			  </div> 
			</div> 
		</div>
	</div>
	<!-- //gallery -->     

<!--footer-->
<div class="w3_agile-copyright text-center">
		<p>© <?php echo date('Y');?> Secure-Banking. All rights reserved | Design by <a href="#">Admin</a></p>
	</div>
<!--//footer-->	
<!-- modal-subscribe-->  
	<div class="modal bnr-modal fade" id="myModal1" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<img src="images/logo.png" alt="logo"/>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
				</div> 
				<div class="modal-body modal-spa">
					<p>E-Banking's email newsletter provides subscribers with helpful articles on important issues in the banking industry, as well as news about events and more! To sign up for the newsletter, fill the below form.</p>
					<form class=" wthree-subsribe" action="#" method="post"> 
						<input type="text" name="name" placeholder="Your Name" required="">
						<input type="email" name="email" placeholder="your Email" required="">
						<input type="submit" value="SignUp"> 
						<div class="clearfix"></div>
					</form>
				</div> 
			</div>
		</div>
	</div>
	<!-- //modal-subscribe-->  
	<script src="js/SmoothScroll.min.js"></script>
	<!-- smooth-scrolling-of-move-up -->
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			/*
			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
			};
			*/
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
	<!-- //smooth-scrolling-of-move-up -->  	
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.js"></script>

</body>
</html>