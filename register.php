<?php
include 'core.inc.php';
if(loggedin()==false)
{
  echo '<script>alert("Please login first");
    window.location.href = "index.php";</script>';
}
if (isset($_GET['err'])) {
if ($_GET['err']==1) {
phpAlert($_SESSION['firstname_error'],$_SESSION['lastname_error'],$_SESSION['email_error'],$_SESSION['phnow_error'],$_SESSION['regno_error'],$_SESSION['pref_error']);
  }
}
if(isset($_GET['err']))
{
	if($_GET['err']==2)
	{
		echo '<script>alert("Please submit details for registration.")</script>';
	}
}

function phpAlert($msg,$msg2,$msg3,$msg4,$msg5,$msg6) {
    echo '<script type="text/javascript">alert("' . $msg . $msg2 .$msg3 .$msg4 . $msg5  . $msg6 .'");</script>';
}
if(!isset($_SESSION['firstname']))
{
	$_SESSION['firstname']='';
}
if(!isset($_SESSION['lastname']))
{
	$_SESSION['lastname']='';
}
if(!isset($_SESSION['email']))
{
	$_SESSION['email']='';
}
if(!isset($_SESSION['phnow']))
{
	$_SESSION['phnow']='';
}
if(!isset($_SESSION['regno']))
{
	$_SESSION['regno']='';
}
if(!isset($_SESSION['pref']))
{
	$_SESSION['pref']='-';
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Infodesk Portal: Sys Admin</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>

	<!--<script src="assets/js/jquery.min.js"></script>-->
	<style>
		@import url('https://fonts.googleapis.com/css?family=Questrial');
	</style>
</head>
<body>


	<div id="page-wrapper">


		<div id="wrapper">

			<section class="panel color1-alt">
				<div class="intro color0">
					<h1 class="major" style="font-family:'Questrial',sans-serif;font-weight:100;">Infodesk Portal</h1>
					<h2 class="major" style="font-family:'Questrial',sans-serif;font-weight:100;">Contact</h2>
					<p>For any queries, please contact :-</p>
					<ul>
						<li><b>Samyak  - +91 9969696969</b></li>
						<li><b>Rakshit - +91 9696969691</b></li>
					</ul>
				</div>
				<div class="inner columns divided">
					<div class="span-3-25">
						<form method="post" action="inputr.php" style="font-family:'Questrial',sans-serif;font-weight:100;">
							<div class="field half">
								<h1 style="font-family:'Questrial',sans-serif;font-weight:100;">REGISTRATION</h1>
							</div>
							<div class="field quarter">
							</div>
							<div class="field quarter">
								<!-- ham -->
								<div id="myNav" class="overlay">
								  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
								  <div class="overlay-content">
								    <a href="search.php">Search</a>
								    <a href="logout.php">Logout</a>
								  </div>
								</div>
								<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>

								<script>
								function openNav() {
								    document.getElementById("myNav").style.height = "100%";
								}

								function closeNav() {
								    document.getElementById("myNav").style.height = "0%";
								}
								</script>
					<!-- ham ends-->
							</div>
								<div class="field half">
								<label for="name">First Name</label>
								<input type="text" name="firstname" id="firstname" value="<?php echo($_SESSION['firstname']);?>" required/>
							</div>
							<div class="field half">
								<label for="name">Last Name</label>
								<input type="text" name="lastname" id="lastname" value="<?php echo ($_SESSION['lastname']); ?>" required/>
							</div>
							<div class="field half">
								<label for="email">Email</label>
								<input type="email" name="email" id="email" value="<?php echo ($_SESSION['email']);  ?>" required/>
							</div>
							<div class="field quarter">
								<label for="regno">Reg No.</label>
								<input type="text" name="regno" id="regno" value="<?php echo ($_SESSION['regno']);  ?>" required/>
							</div>
							<div class="field quarter">
								<label for="phnow">Phone No.</label>
								<input type="text" name="phnow" id="phnow" value="<?php echo ($_SESSION['phnow']);  ?>" required/>
							</div>
							<div class="field third">
								<label for="pref">Card Type</label>
								<div class="select-wrapper">
									<select name="pref" id="pref" value="<?php echo ($_SESSION['pref']);  ?>" required>
										<option value="">-</option>
										<option value="1">Normal</option>
										<option value="2">Gaming</option>
									</select>
								</div>
							</div>
							<div class="field">
								<ul class="actions">
									<li><input type="submit" name="submit" value="Register" class="button special" /></li>
									<li><input type="reset" value="Reset" /></li>
								</ul>
							</div>
						</form>
					</div>
					<div class="span-1-25">
						<h2>REMEMBER!</h2>
						<ol>
							<li> Do not press BACKSPACE or BACK.</li>
							<li> If Connection Failure, Report it to System Admin Organizer immediately.</li>
							<li> In case of Wrong Submission, inform it to System Admin Organizer and make sure he notes the Wrong Submission.</li>
				    </div>

				</div>
			</section>

		</div>

	</div>
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/main.js"></script>

</body>

</html>
