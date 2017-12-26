<?php
include 'core.inc.php';
if(loggedin()==false)
{
  echo '<script>alert("Please login first");
    window.location.href = "index.php";</script>';
}
if(($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_POST['submit'])))
{
echo '<script>alert("Please enter query and hit search button");
    window.location.href = "search.php";</script>';
} 
?><html>
<head>
	<title>Infodesk Portal: Search</title>
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
					             <div class="field half">
								<h1 style="font-family:'Questrial',sans-serif;font-weight:100;">Search</h1>
								</div>
								<div class="field third">
								<ul class="actions">
											<li><a href="register.php" class="button special color2">Register</a></li>
											<li><a href="search.php" class="button special color2">New Search</a></li>
									</ul>
							    </div>
								<?php 
									include 'database.inc.php';
									$fn=$ln=$rn=$dcn="empty";
									if ($_SERVER['REQUEST_METHOD'] == 'POST')
									{
										$sefn=$seln=$sern=$sedcn='';
										function test_input($data) {
									$data = trim($data);
									$data = stripslashes($data);
									$data = htmlspecialchars($data);
									return $data;
								}
										if (isset($_POST['firstname'])) { 
											if(empty($_POST['firstname'])) {
												$sefn = 'No search query';
											} else {
												if($_POST['firstname'] == test_input($_POST['firstname'])) {
													$fn ='%'.test_input($_POST['firstname']).'%';
													$sefn='';
												 }
												 else
												 	$sefn='Invalid input';
											}
										}
										if (isset($_POST['lastname'])) {
											if(empty($_POST['lastname'])) {
												$seln = 'No search query';
											} else {
												if($_POST['lastname'] == test_input($_POST['lastname'])) {
													$ln = '%'.test_input($_POST['lastname']).'%';
													$seln='';
												 }
												 else
												 {
												 	$seln='Invalid input';
												 }
											}
										}
										if (isset($_POST['regno'])) {
											if(empty($_POST['regno'])) {
												$sern = 'No search query';
											} else {
												if($_POST['regno'] == test_input($_POST['regno'])) {
													$rn = test_input($_POST['regno']);
													$sern='';
												 }
												 else
												 {
												 	$sern='Invalid input';
												 }
											}
										}
										if (isset($_POST['delegate'])) {
											if(empty($_POST['delegate'])) {
												$sedcn = 'No search query';
											} else {
												if($_POST['delegate'] == test_input($_POST['delegate'])) {
													$dcn = test_input($_POST['delegate']);
													$sedcn='';
												 }
												 else
												 {
												 	$sedcn='Invalid input';
												 }
											}
                                        }
                                      
										if($sefn==''|| $seln=='' || $sern=='' || $sedcn=='')
										{
											$select_statement = $conn -> prepare("SELECT * FROM info WHERE FN LIKE ? OR LN LIKE ? OR REGNO = ? OR DC = ?");
											$select_statement -> bind_param('sssi',$fn,$ln,$rn,$dcn);
											$select_statement -> execute();
											$result = $select_statement -> get_result();
											// echo "<p>$result->num_rows</p>";
										}
										if(($result->num_rows) > 0)
										{
											echo "<p><h3>Search Successful : $result->num_rows results found</h3><br></p>";
											while($row = $result -> fetch_assoc())
											{
												echo "<p>Participant with:<br>";
												foreach ($row as $key => $value) {
													if($key=="DC")
														{$val="delegate card number";}
													if($key=="FN")
														{$val="first name";}
													if($key=="LN")
														{$val="last name";}
													if($key=="EMAIL")
														{$val="Email";}
													if($key=="REGNO")
														{$val="registration number";}
													if($key=="PHNO")
														{$val="phone number";}
													if($key=="CT")
														{$val="card type";}
													echo "$val as $value&nbsp;&nbsp;&nbsp;&nbsp;<br>";
												}
												echo "</p>";
											}
										}
										else
										{
											echo "<p>Search Failed<br></p>";
										}
									$select_statement -> close();
									
								$conn -> close();
							}
								?>
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