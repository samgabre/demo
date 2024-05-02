<?php
extract($_POST);
session_start(); 
include("dbconnect.php");
 
if(isset($_POST['btn'])) 
{ 
$name=$_REQUEST['name'];
$accno=$_REQUEST['accno'];
$gender=$_REQUEST['gender'];
$pnumber=$_REQUEST['pnumber'];
$email=$_REQUEST['email'];
$address=$_REQUEST['address'];
$username=$_REQUEST['uname'];
$password=$_REQUEST['password'];
$pin=$_REQUEST['pin'];
 

 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$qrys1="select id from  user_register ORDER BY id ASC";
$result = $conn->query($qrys1);
$sid=0;
 while($row = $result->fetch_assoc())
 {
 $sid=$row['id'];
 }
$id=$sid+1; 

$uk=$name.$id;
$sk=md5($uk);
$key1=substr($sk,0,8);


$accno="100".$id;

$wrt=$id.$accno.$name.$gender.$address.$email.$pnumber;
$r=md5($wrt);
$myfile = fopen("encrypt/user_".$id."$name.txt", "w") or die("Unable to open file!");

 
fwrite($myfile,$r);
fclose($myfile);

$rdate=date("d-m-y");
  
 $qrys1="insert into user_register values('$id','$accno','$name','$gender','$address','$email','$pnumber','$uname','$password','$key1','0','0','$pin','0')";
  if ($conn->query($qrys1) === TRUE)
   {
  header("location:user.php?kk=".$txt);
$_SESSION['nm']=$id;
 }
 else
{
    
 ?>					
<script language="javascript">
alert("Registration Failed");
</script>
<?php
}
$conn->close();
}
$message=$txt;

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
<script language="javascript">
            function user_register()
            {
              // alert("");
               
				if (document.form1.name.value == "")
                {
				
                    alert("Enter the Name");
                    document.form1.name.focus();
                    return false;
                }
				 if (!/^[a-zA-Z]*$/g.test(document.form1.name.value)) {
					alert("Invalid characters. Enter  Name..");
					document.form1.name.focus();
					return false;
				}
				 if (document.form1.address.value == "")
                {
                    alert("Enter the  Address");
                    document.form1.address.focus();
                    return false;
                }
				
				if (document.form1.email.value == "")
                {
                    alert("Enter the email");
                    document.form1.email.focus();
                    return false;
                }
                if (document.form1.email.value != "")
                {
                    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
if(document.form1.email.value.match(mailformat))  
{  
}  
else  
{  
alert("You have entered an invalid email address!");  
document.form1.email.focus();  
return false;  
}  
                }
				
				if (document.form1.pnumber.value == "")
                {
                    alert("Enter the Contact");
                    document.form1.pnumber.focus();
                    return false;
                } 
                if (document.form1.pnumber.value != "")
                {
                  var z = document.form1.pnumber.value;
             if(!/^[0-9]+$/.test(z)){
   
        alert("enter 0-9")
       document.form1.pnumber.focus();
        return false;
        }   
                }
                  
                      
               if (document.form1.pnumber.value != "")
                {
                   var a=document.form1.pnumber.value;
                   if(!(a.length ==10)) //i got a problem with this one i think
  {
  alert("Enter  10 character Maximum length");
    document.form1.pnumber.focus();

  return false;
  }
  
 
                }
				 
						
				
				
				 if (document.form1.uname.value == "")
                {
                    alert("Enter the Username");
                    document.form1.uname.focus();
                    return false;
                } 
               
               
                if (document.form1.password.value == "")
                {
                    alert("Enter the Password");
                    document.form1.password.focus();
                    return false;
                }
                //finishMD();
                return true;
            }
        </script>

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
				<h2 class="h3-w3l">User  registration </h2>
				<form name="form1" method="post" action="">
				  <table width="372" height="104" border="0" align="center">
				    <tr>
                      <td><span class="style4">Name</span></td>
				      <td><input name="name" type="text" id="name" required="" /></td>
			        </tr>
				    <tr>
                      <td><span class="style4">Gender</span></td>
				      <td><strong>
                        <input name="gender" type="radio" value="Male" required/>
				        Male
				        <input name="gender" type="radio" value="Female" required/>
				        Female</strong></td>
			        </tr>
				    <tr>
                      <td><span class="style4">Address</span></td>
				      <td><textarea name="address" id="address" required="" ></textarea></td>
			        </tr>
				    <tr>
                      <td><span class="style4">Email-Id</span></td>
				      <td><input name="email" type="email" id="email" required="" /></td>
			        </tr>
				    <tr>
                      <td><span class="style4">Phone Number </span></td>
				      <td><input name="pnumber" type="number" id="pnumber" required=""  /></td>
			        </tr>
				    <tr>
                      <td><span class="style4">User Name </span></td>
				      <td><input name="uname" type="text" id="uname"  required="" /></td>
			        </tr>
				    <tr>
				      <td>Pin no </td>
				      <td>
				        <input name="pin" type="number" id="pin"  required="">
				       </td>
			        </tr>
				    <tr>
                      <td><span class="style4">Password</span></td>
				      <td><input name="password" type="password" id="password" required="" /></td>
			        </tr>
				    <tr>
                      <td>&nbsp;</td>
				      <td>&nbsp;</td>
			        </tr>
				    <tr>
                      <td>&nbsp;</td>
				      <td><input name="btn" type="submit" id="btn" value="Register" onClick="return user_register()" />
                        <a href="userlog.php"></a></td>
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