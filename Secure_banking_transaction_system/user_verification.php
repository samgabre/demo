<?php
 include("email.php");
include("dbconnect.php");
session_start();
extract($_POST);
$nm=$_SESSION['uname'];
$pin1=$_SESSION['pin'];
 $email=$_REQUEST['email'];
 $process=$_REQUEST['process'];
 $amount=$_REQUEST['a'];
 $taccno=$_REQUEST['taccno'];
 $a=$amount;
 $accno=$_REQUEST['accno'];
 $date =date("Y-m-d");
 ////////////////////////// BLOCK
 if(isset($_POST['Submit2']))
{
$pin=$_REQUEST['pin'];
if($pin1==$pin)
{
$qrt1="update user_register set status='1' where accno='$accno'";
	if($conn->query($qrt1) === TRUE)
	  {
	  ?>					
	<script language="javascript">
	alert("Account Blocked");
	window.location.href="index.php";
	</script>
	<?php
		 
	  }
	
	  else
		{
		echo "Error";
		}
}
else
{
?>
<script language="javascript">
alert("Failed..");
window.location.href="user_verification.php";
</script>
<?php
}
}
 ///////////////////////////// END BLOCK
 
////////////////////////////////////////////////// REJECT
if(isset($_POST['Submit']))
{
$pin=$_REQUEST['pin'];
if($pin1==$pin)
{
?>
<script language="javascript">
alert("Rejected..");
window.location.href="index.php";
</script>
<?php
}
else
{
?>
<script language="javascript">
alert("Failed..");
window.location.href="user_verification.php";
</script>
<?php
}
}
 //////////////////////////////////////////////////////////////////// ACCEPT
if(isset($_POST['btn']))
{

 
$pin=$_REQUEST['pin'];
if($pin1==$pin)
{
//////////////////////////////////// DEPOSIT
if($process=="Deposit")
{
$qrys1="select id from  mini ORDER BY id ASC";
$result = $conn->query($qrys1);
$sid=0;
 while($row = $result->fetch_assoc())
 {
 $sid=$row['id'];
 }
$id=$sid+1; 

 $qrd="insert into mini values('$id','$accno','$amount','$date','Deposit','-')";
  if ($conn->query($qrd) === TRUE)
   {
   }
    $qr="select * from user_register where accno='$accno'";
$qrt = $conn->query($qr);
$rw = $qrt->fetch_assoc();

 $amount=$rw['balance'];
 
echo $amount1= $a + $amount;
	
	$qrt1="update user_register set balance='$amount1' where accno='$accno'";
	if($conn->query($qrt1) === TRUE)
	  {
	  ?>					
	<script language="javascript">
	alert("Amount Deposit Successfully");
	window.location.href="user_verification.php";
	</script>
	<?php
		 
	  }
	
	  else
		{
		echo "Error";
		}
}
//////////////////////// END DEPOSIT
//////////////////////// WITHDRAW
if($process=="Withdraw")
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

$qry="select * from user_register where accno='$accno'";
$res1 = $conn->query($qry);
$row1 = $res1->fetch_assoc();

$amount=$row1['balance'];
echo $balance=$amount;
////////////////////////// verify balance
if($balance>=$a)
{


 if($balance>=$a)
{
$amount1=$balance - $a;

$qrt1="update user_register set balance='$amount1' where accno='$accno'";
	if($conn->query($qrt1) === TRUE)
	  {
		$qrd="insert into mini(id,accno,amount,date,process,taccno)values('$id','$accno','$a','$date','Withdraw','-')";
	  	if ($conn->query($qrd) === TRUE)
	   	{
		  ?>					
	<script language="javascript">
	alert("Amount Withdraw Successfully");
	window.location.href="user_verification.php";
	</script>
	<?php
		 
	 
		}
	  }
}
 

}
/////////////////////// end verify balance
else
{
 echo "<script>alert('Your Amount is Low..');</script>";
}
}
////////////////////////END WITHDRAW
//////////////////////// TRANSACTION 
if($process=="transaction")
{
 $qr="select * from user_register where accno='$accno'";
$qrt = $conn->query($qr);
$rw = $qrt->fetch_assoc();

 $balance=$rw['balance'];
if($balance>=$a)
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
$qrd="insert into mini(id,accno,taccno,amount,date,process)values('$id','$accno','$taccno','$a','$date','Debit')";
  if ($conn->query($qrd) === TRUE)
   {
   }
   $id=$id+1;
   $qrd="insert into mini(id,accno,taccno,amount,date,process)values('$id','$taccno','$accno','$a','$date','Credit')";
  if ($conn->query($qrd) === TRUE)
   {
   }
   //////////////////////
   $qr="select * from user_register where accno='$accno'";
$qrt = $conn->query($qr);
$rw = $qrt->fetch_assoc();
$amount=$rw['balance'];
$amt;
$amount1=$amount - $a;
	
	$qrt1="update user_register set balance='$amount1' where accno='$accno'";
	if($conn->query($qrt1) === TRUE)
	  {
		//echo "Update";
	  }
	  else
	  {
		//echo "Error";
	  }
	  $qr="select * from user_register where accno='$taccno'";
$qrt = $conn->query($qr);
$rw = $qrt->fetch_assoc();
$amount2=$rw['balance'];
 $amt;
$amount11= $a + $amount2;
	
	$qrt1="update user_register set balance='$amount11' where accno='$taccno'";
	if($conn->query($qrt1) === TRUE)
	  {
		  ?>					
	<script language="javascript">
	alert("Your Transction is Success");
	window.location.href="user_verification.php";
	</script>
	<?php
		 
	  }
	
	  else
		{
		echo "Error";
		}
}

////////////////////// END CHECK BALANCE
else
{
echo "<script>alert('Your Amount is Low..');</script>";
}
}


//////////////////////// END TRANSACTION
}
else
{
?>
<script language="javascript">
alert("Failed..");
window.location.href="user_verification.php";
</script>
<?php
}
///////////////////////
 

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
				<h2 class="h3-w3l">PIN Verification </h2>
				<form name="form1" method="post" action="">
				  <table width="282" height="167" border="0" align="center">
                    <tr>
                      <td width="95">Email</td>
                      <td width="177"><?php echo $email;?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>Amount</td>
                      <td><?php echo $a;?></td>
                    </tr>
                    <tr>
                      <td>Process</td>
                      <td><?php echo $process; 
		    $count=strlen($taccno);
			if($count>0)
			{
			 echo "-".$taccno;
			}
					  
					 
					  
					  
					  ?></td>
                    </tr>
                    <tr>
                      <td>Pin</td>
                      <td><input name="pin" type="password" id="pin"  required=""></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input name="btn" type="submit" id="btn" value="Accept" />
                      <input type="submit" name="Submit" value="Reject">
                      <input type="submit" name="Submit2" value="Block"></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><label></label></td>
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