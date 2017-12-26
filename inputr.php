<?php
include 'core.inc.php';
if(loggedin()==false)
{
  echo '<script>alert("Please login first");
    window.location.href = "index.php";</script>';
}
if(($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_POST['submit'])))
{
echo '<script>alert("Enter details and Press register button");
    window.location.href = "register.php";</script>';
}
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


        $firstname = $lastname = $firstname_error = $lastname_error = $pref = '';
        $email = $regno = $phnow = $email_error= $regno_error = $phnow_error = $pref_error = $exist_error = '';

        if (isset($_POST['firstname'])) {
          $_SESSION['firstname']='';
            if(empty($_POST['firstname'])) {

                $firstname_error = 'Firstname is required';
                $_SESSION['firstname_error'] = $firstname_error;
            } else {
                if($_POST['firstname'] == test_input($_POST['firstname'])) {
                     if (!preg_match("/^[a-zA-Z ]*$/",$_POST['firstname'])){
                    $firstname_error = 'Only letters and whitespaces allowed in Firstname .';
                    $_SESSION['firstname_error'] = $firstname_error;
                  }
                    else {
                    $firstname = test_input($_POST['firstname']);
                    $_SESSION['firstname']=$firstname;
                  $_SESSION['firstname_error'] = $firstname_error;
                }
            }
            else {
              $firstname_error = 'Enter valid first name .';
              $_SESSION['firstname_error'] = $firstname_error;
            }

        }
    }
       if (isset($_POST['lastname'])) {
         $_SESSION['lastname']='';
            if(empty($_POST['lastname'])) {
                $lastname_error = 'Lastname is required';
                $_SESSION['lastname_error'] = $lastname_error;
            } else {
                if($_POST['lastname'] == test_input($_POST['lastname'])) {
                     if (!preg_match("/^[a-zA-Z ]*$/",$_POST['lastname'])){
                        $lastname_error = 'Only letters and whitespaces allowed in lastname .';
                        $_SESSION['lastname_error'] = $lastname_error;
                      }
                    else {
                    $lastname = test_input($_POST['lastname']);
                    $_SESSION['lastname']=$lastname;
                      $_SESSION['lastname_error'] = $lastname_error;
                  }
            }
            else {
              $lastname_error = 'Enter valid lastname .';
              $_SESSION['lastname_error'] = $lastname_error;
            }
        }
    }
       if (isset($_POST['email'])) {
         $_SESSION['email']='';
            if(empty($_POST['email'])) {
                $email_error = 'Email is required';
                $_SESSION['email_error'] = $email_error;
            } else {
                 if($_POST['email'] == test_input($_POST['email'])) {
                    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                    $email_error = 'Enter a valid email address .';
                    $_SESSION['email_error'] = $email_error;
                  }
                    else {
                    $email = test_input($_POST['email']);
                    $_SESSION['email']=$email;
                    $_SESSION['email_error'] = $email_error;
                  }
            }
            else {
              $email_error = 'Enter valid email ID .';
              $_SESSION['email_error'] = $email_error;
            }
        }
    }
        if (isset($_POST['phnow'])) {
            $_SESSION['phnow']='';
            if(empty($_POST['phnow'])) {
                $phnow_error = 'Phone no. is required';
                $_SESSION['phnow_error'] = $phnow_error;
            } else {
                 if($_POST['phnow'] == test_input($_POST['phnow'])) {
                    if (!preg_match("/^[7-9]{1}[0-9]{9}$/",$_POST['phnow']))
                    { $phnow_error = 'Enter valid phone no .';
                      $_SESSION['phnow_error'] = $phnow_error;
                } else {
                   $phnow = test_input($_POST['phnow']);
                   $_SESSION['phnow']=$phnow;
                   $_SESSION['phnow_error'] = $phnow_error;

                }
            }
            else {
              $phnow_error = 'Enter valid Phone no .';
              $_SESSION['phnow_error'] = $phnow_error;
            }
        }
    }
        if (isset($_POST['regno'])) {
          $_SESSION['regno']='';
            if(empty($_POST['regno'])) {

                $regno_error = 'Enter registration no.';
                $_SESSION['regno_error'] = $regno_error;
            } else {
                 if($_POST['regno'] == test_input($_POST['regno'])) {
                    if (!preg_match("/^[1]{1}[3-7]{1}[0-9]{7}$/",$_POST['regno']))
                    {
                      $regno_error = 'Enter valid registration no .';
                      $_SESSION['regno_error'] = $regno_error;
                } else {
                    $regno = test_input($_POST['regno']);
                    $_SESSION['regno']=$regno;

                      $_SESSION['regno_error'] = $regno_error;
                }
              }
                else {
                  $regno_error = 'Enter valid reg no .';
                  $_SESSION['regno_error'] = $regno_error;
                }

        }
    }
      if (isset($_POST['pref'])) {
          $_SESSION['pref']='';
            if(empty($_POST['pref'])) {

                $pref_error = 'Enter a preference';
                $_SESSION['pref']=$pref;
            } else {
                 if($_POST['pref'] == test_input($_POST['pref'])) {
                    if ($_POST['pref'] == 1 || $_POST['pref'] == 2)
                    {$pref = test_input($_POST['pref']);
                    $_SESSION['pref']=$pref;
                    $_SESSION['pref_error'] = $pref_error;
                } else {
                    $pref_error = 'Choose a valid preference .';
                    $_SESSION['pref_error'] = $pref_error;
                }
            }
        }
    }

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tut17";

$conn = new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}
else if($firstname_error == '' && $lastname_error == '' && $email_error == '' && $regno_error == '' && $phnow_error == '' && $pref_error == '' && $exist_error == '') {
  $select_statement = $conn -> prepare('SELECT * FROM info WHERE REGNO = ?');
  $select_statement -> bind_param('s', $regno);
  $select_statement -> execute();
  $result = $select_statement -> get_result();
  $row = $result -> fetch_assoc();
  if($row['REGNO']== $regno)
  {
    $exist_error = 'User already exists';
    $_SESSION['exist_error'] = $exist_error;
    $_SESSION['gen'] = '1';
    header('Location: gen.php');
  }
  else {
    $stmt = $conn->prepare("INSERT INTO info (FN, LN, EMAIL, REGNO, PHNO, CT) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $firstname, $lastname, $email, $regno, $phnow, $pref);
    $stmt->execute();
    $stmt -> close();
    $conn -> close();
    $_SESSION['exist_error'] = '';
    $_SESSION['gen'] = '1';
    header("Location: gen.php");
    }
}
else {
$conn -> close();
header("Location: register.php?err=1");
}
}
?>
