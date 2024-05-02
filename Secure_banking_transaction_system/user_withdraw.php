<?php
 include("email.php");
include("dbconnect.php");
session_start();
extract($_POST);
$nm=$_SESSION['uname'];
 
$pin1=$_SESSION['pin'];
  $email=$_SESSION['email'];
$date =date("Y-m-d");
//////////////////////////////
include("user_status.php");
/////////////////////////////
$qr="select * from user_register where uname='$nm'";
$res = $conn->query($qr);
$r = $res->fetch_assoc();
$name=$r['name'];
$id=$r['id'];
$accno=$r['accno'];
$balance=$r['balance'];

if(isset($_POST['btn']))
{
$wrt=$id.$accno.$name.$amt.$date;
$r=md5($wrt);
$myfile = fopen("encrypt/withdraw".$nm.".txt", "w") or die("Unable to open file!");

fwrite($myfile,$r);
fwrite($myfile,$wrt);
fclose($myfile);
$amt=$_REQUEST['amt'];
$pin=$_REQUEST['pin'];
///////////////////// CHECK PIN
if($pin1==$pin)	
{
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$qrys1="select id from  mini ORDER BY id ASC";
$result = $conn->query($qrys1);
$sid=0;
 while($row = $result->fetch_assoc())
 {
 $sid=$row['id'];
 }
$id=$sid+1; 

if($balance>=$amt)
{

$qry="select * from user_register where accno='$accno'";
$res1 = $conn->query($qry);
$row1 = $res1->fetch_assoc();
$amount=$row1['balance'];
 
$amount1=$amount - $amt;

$qrt1="update user_register set balance='$amount1' where accno='$accno'";
	if($conn->query($qrt1) === TRUE)
	  {
		$qrd="insert into mini(id,accno,amount,date,process,taccno)values('$id','$accno','$amt','$date','Withdraw','-')";
	  	if ($conn->query($qrd) === TRUE)
	   	{
		echo "<script>alert('Amount Withdraw Successfull');</script>";
		}
	  }
	   

}
else
{
 echo "<script>alert('Your Amount is Low..');</script>";
}
}
///////////////////// END CHECK PIN
else
{
$objEmail	=	new CI_Email();
$objEmail->from("serverkey2018@gmail.com", "Pin Not Matched");
$objEmail->to($email);
$objEmail->subject("Pin Not Matched");
$objEmail->message("http://localhost/Secure_banking_transaction_system/user_verification.php?email=".$email."&process=Withdraw&a=".$amt."&accno=".$accno);
if ($objEmail->send())
{
echo "<script>alert('Pin Not Matched');</script>";
}
else
{
//echo "n";
}
}

	

 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>E-Banking a Banking Category Bootstrap Bootstrap Responsive website Template | Gallery :: w3layouts</title>
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
						 <li><a href="user_home.php" class="scroll">Home</a></li>
						<li><a href="user_deposit.php" class="scroll">Deposit</a></li>    
						<li><a href="user_withdraw.php" class="active">Withdraw</a></li>    
						<li><a href="user_transaction.php" class="scroll">Transction</a></li>    
						<li><a href="index.php" class="scroll">Logout</a></li>    
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
				<h2 class="h3-w3l">Withdraw </h2>
				<form name="form1" method="post" action="">
				  <table width="237" height="69" border="0" align="center">
                    <tr>
                      <td><span class="style4">Amount</span></td>
                      <td><input name="amt" type="text" id="amt" required="" /></td>
                    </tr>
                    <tr>
                      <td>Pin</td>
                      <td><input name="pin" type="number" id="pin"  required=""></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input name="btn" type="submit" id="btn" value="Withdraw" /></td>
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