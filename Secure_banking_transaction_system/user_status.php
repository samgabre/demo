<?php
   $email;
    $qr="select * from user_register where email='$email'";
$qrt1 = $conn->query($qr);
$rw1 = $qrt1->fetch_assoc();

   $sts=$rw1['status'];
if($sts==1)
{
  ?>					
	<script language="javascript">
	alert("Session Closed");
	window.location.href="index.php";
	</script>
	<?php
}
?>

