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

if (isset($_POST['admin_login'])) {

if (empty($_POST['uid'])) {

array_push($error, "***User ID is required!");

return;

}

$userID = sanitize($_POST['uid']);

if (empty($_POST['psw'])) {

array_push($error, "***Password is required!");

return;

}

$password = sanitize($_POST['psw']);

// fetch data from database and verify them

$sql = "SELECT id, password FROM admins";

$res = $conn->query($sql);

if ($res->num_rows > 0) {

$err = 0;

while ($rows = $res->fetch_assoc()) {

$id = $rows['id'];

$psw = password_verify($password, $rows['password']);

if ($userID === $id && $psw === TRUE) {

$err = 1;

session_start();

$_SESSION['admin_id'] = $userID;

header("location: admin.php?msg=successfully logged in!");

}

}

if ($err === 0) {

header("location: member_login.php");

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

<title>Admin Log In page</title>

</head>

<body>

<header>

<?php include "header.php" ?>

</header>

<main>

<section class="sec">

<div class="admin_login">

<h2>Admin Log In</h2>

<p>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

<p>

</p>

<p>

<label for="">User ID</label><br>

<input type="text" name="uid" id="">

</p>

<p>

<label for="">Password</label><br>

<input type="password" name="psw" id="">

</p>

<p>

<button type="submit" name="admin_login">Log In</button>

</p>

</form>

</p>

<hr>

<h3>OR</h3>

<p class="regis_link">

<h4>New Admin? <a href="account_manager.php">Register here</a></h4>

</p>

</div>

</section>

</main>

</body>

</html>