<?php

include "db.php";

// verify form

function sanitize($data)

{

$data = trim($data);

$data = stripslashes($data);

$data = htmlspecialchars($data);

return $data;

}

$error = [];

if (isset($_POST['member_login'])) {

if (empty($_POST['uname'])) {

array_push($error, "***Username is required!");

return;

}

$username = sanitize($_POST['uname']);

if (empty($_POST['psw'])) {

array_push($error, "***Password is required!");

return;

}

$password = sanitize($_POST['psw']);

// fetch data from database and verify them

$sql = "SELECT id, password FROM members";

$res = $conn->query($sql);

if ($res->num_rows > 0) {

$err = 0;

while ($rows = $res->fetch_assoc()) {

$id = $rows['id'];

$psw = password_verify($password, $rows['password']);

if ($username === $id && $psw === TRUE) {

$err = 1;

session_start();

$_SESSION['member_id'] = $username;

$_SESSION['start'] = time();

$_SESSION['expire'] = $_SESSION['start'] + (60 * 60);

header("location: index.php?msg=successfully logged in!");

}

}

if ($err === 0) {

header("location: adminLogin.php");

}

}

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="./css/style.css">

<title>Member Log In page</title>

</head>

<body>

<header>

<?php include "header.php" ?>

</header>

<main>

<section class="sec">

<div class="admin_login">

<h2>Member Log In</h2>

<p>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

<p>

</p>

<p>

<label for="">Username</label><br>

<input type="text" name="uname" id="">

</p>

<p>

<label for="">Password</label><br>

<input type="password" name="psw" id="">

</p>

<p>

<button type="submit" name="member_login">Log In</button>

</p>

</form>

</p>

<hr>

<h3>OR</h3>

<p class="regis_link">

<h4>New Member? <a href="member_registration.php">Register here</a></h4>

</p>

</div>

</section>

</main>

</body>

</html>