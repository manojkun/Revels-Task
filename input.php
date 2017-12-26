<?php
include 'database.inc.php';
include 'core.inc.php';
if(loggedin()==false && $_SERVER['REQUEST_METHOD'] != 'POST')
{	
	echo '<script>alert("Please login first");
    window.location.href = "index.php";</script>';
}
if(loggedin()==true)
{
	if(($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_POST['submit'])))
{
	echo '<script>alert("Please fill registration form");
    window.location.href = "register.php";</script>';
} 
}
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$username = $password = $username_error = $password_error = '';
		$islogged = 1;
		$user = $pass = $user_error = $pass_error = $login_error = '';
		$_SESSION['u_error']=$_SESSION['u2_error']=$_SESSION['p_error']=$_SESSION['p2_error']=$_SESSION['login_error']=	'';

		if (isset($_POST['username'])) {
			if(empty($_POST['username'])) {
				$username_error = 'Username is required';
				$_SESSION['u_error'] = $username_error;
			} else {
				if($_POST['username'] == test_input($_POST['username'])) {
					$username = test_input($_POST['username']);
				} else {
					$username_error = 'Use a different username';
					$_SESSION['u_error'] = $username_error;
				}
			}
		}
		if (isset($_POST['password'])) {
			if(empty($_POST['password'])) {
				$password_error = 'Password is required';
				$_SESSION['p_error'] = $password_error;
			} else {
				$password = test_input($_POST['password']);
			}
		}
		if (isset($_POST['user'])) {
			if(empty($_POST['user'])) {
				$user_error = 'Username is required';
				$_SESSION['u2_error'] = $user_error;
			} else {
				if($_POST['user'] == test_input($_POST['user'])) {
					$user = test_input($_POST['user']);
				} else {
					$user_error = 'Use a different username';
					$_SESSION['u2_error'] = $user_error;
				}
			}
		}
		if (isset($_POST['pass'])) {
			if(empty($_POST['pass'])) {
				$pass_error = 'Password is required';
				$_SESSION['p2_error'] = $pass_error;
			} else {
				$pass = test_input($_POST['pass']);
			}
		}

		if($username_error == '' && $password_error == '' && $user_error == '' && $pass_error == '') {
			$select_statement = $conn -> prepare('SELECT * FROM login WHERE UID = ?');
			$select_statement -> bind_param('s', $username);
			$select_statement -> execute();
			$result = $select_statement -> get_result();
			$row = $result -> fetch_assoc();

			$select_statement_desk = $conn -> prepare('SELECT * FROM loginDesk WHERE UID = ?');
			$select_statement_desk -> bind_param('s', $user);
			$select_statement_desk -> execute();
			$result_desk = $select_statement_desk -> get_result();
			$row_desk = $result_desk -> fetch_assoc();


			$query = $conn -> prepare('SELECT * FROM time where UID = ? AND logged = ?');
			$query -> bind_param('ss', $user, $islogged);
			$query -> execute();
			$result = $query -> get_result();
			$row_log = $result -> fetch_assoc();


		}

			if($row == NULL && $row_desk == NULL) {
				$mssg = 'Users not found';
				$_SESSION['u_error'] = $mssg;
				$username = '';
				$password = '';
				$user = '';
				$pass = '';
				header('Location: loginform.php?erro=1');
			} else if($row == NULL) {
				$mssg = 'invalid username';
				$_SESSION['u2_error'] = $mssg;
				$username = '';
				$password = '';
				$user = $_SESSION['user'];
				header('Location: loginform.php?erro=1');
			} else if($row_desk == NULL) {
				$mssg = 'invalid username';
				$_SESSION['u_error'] = $mssg;
				$user = '';
				$pass = '';
				$username = $_SESSION['username'];
				header('Location: loginform.php?erro=1');
			}
				else if($row_log['logged'] == 1) {
				$login_error = "User already logged in.";
				$_SESSION['login_error'] = $login_error;
				header('Location: loginform.php?erro=1');
			}
				else if(($password) == $row['PASS'] && ($pass) == $row_desk['PASS']) {
				$_SESSION['user'] = $row['UID'];
				$sql = "INSERT INTO time(UID,logged,sysin) VALUES ('$user','1',now());";
				mysqli_query($conn,$sql);
				$_SESSION['UID'] = $user;
               	header("Location: register.php");
			} else {
				$mssg = 'Incorrect Password';
				if(($password) != $row['PASS'])
					$password = '';
				if(($pass) != $row_desk['PASS'])
					$pass = '';
			    $_SESSION['p_error'] = $mssg;
				header('Location: loginform.php?erro=1');
			}
			$select_statement -> close();
			$select_statement_desk -> close();
		}


	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$conn -> close();
?>
