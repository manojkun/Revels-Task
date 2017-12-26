<?php
include 'core.inc.php';
if(loggedin()==false)
{
  echo '<script>alert("Please login first");
    window.location.href = "index.php";</script>';
}
if (isset($_SESSION['gen'])) {
    if ($_SESSION['gen'] != '1') {
      echo '<script>alert("Please Enter details and hit register button");
        window.location.href = "register.php";</script>';
    }
  }
  else {
    echo '<script>alert("Please Enter details and hit register button");
      window.location.href = "register.php";</script>';
  }
$_SESSION['gen'] = '';
function phpAlert($qwer) {
    echo '<script type="text/javascript">alert("' . $qwer . '");</script>';
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
					<div class="span-2-25">
							<div class="field half">
								<h2 style="font-family:'Questrial',sans-serif;font-weight:100;">Result</h2>
							</div>
							<br>
							<br>
							<br>
								<div class="field">
									<h2 style="font-family:'Questrial',sans-serif;font-weight:100;"><?php
$link = mysqli_connect("localhost", "root", "", "tut17");


if (mysqli_connect_errno()) {
    printf("Connection failed: %s\n", mysqli_connect_error());
    exit();
}
$exist= $_SESSION['exist_error'];
$reg = $_SESSION['regno'];
$first = $_SESSION['firstname'];
$last = $_SESSION['lastname'];
if ($exist!=''){
phpAlert($exist);
}
if ($stmt = mysqli_prepare($link, "SELECT DC,FN,LN,REGNO FROM info WHERE REGNO=?")) {

    mysqli_stmt_bind_param($stmt, "s",$reg);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $res,$res1,$res2,$res3);
    mysqli_stmt_fetch($stmt);
    printf("Delegate card no. : %s \n", $res);
    printf("Registration no. : %s \n", $res3);
    printf("Name : %s %s \n", $res1,$res2);
    mysqli_stmt_close($stmt);

}
mysqli_close($link);
$_SESSION['firstname'] = $_SESSION['lastname']= $_SESSION['email']= $_SESSION['phnow']= $_SESSION['regno']= $_SESSION['pref'] ='';

?></h2>
								</div>
             <br>
						 <br>
						 <br>
							<div class="field">
								<ul class="actions">
											<li><a href="register.php" class="button special color2">Register</a></li>
											<li><a href="logout.php" class="button">Logout</a></li>
									</ul>
							</div>
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
