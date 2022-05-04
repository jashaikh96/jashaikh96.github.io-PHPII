<?php

include "db.php";

// random username generate

$alp_cap = range("A", "Z");

$num = range(0, 9);

$combine = array_merge($alp_cap, $num);

shuffle($combine);

$combine_shufl_str = implode("", $combine);

$user_id = substr($combine_shufl_str, 0, 10);

// verify form

function sanitize($data)

{

$data = trim($data);

$data = stripslashes($data);

$data = htmlspecialchars($data);

return $data;

}

$error = [];

if (isset($_POST['admin_regis'])) {

$userid = sanitize($_POST['uid']);

if (empty($_POST['name'])) {

array_push($error, "***name is required!");

return;

}

$name = sanitize($_POST['name']);

if (empty($_POST['dob'])) {

array_push($error, "***date of birth is required!");

return;

}

$dob = sanitize($_POST['dob']);

if (empty($_POST['gend'])) {

array_push($error, "***please select a gender!");

return;

}

$gender = sanitize($_POST['gend']);

if (empty($_POST['ssn'])) {

array_push($error, "***SSN number is required!");

return;

}

$ssn = sanitize($_POST['ssn']);

if (empty($_POST['address'])) {

array_push($error, "***address is required!");

return;

}

$address = sanitize($_POST['address']);

if (empty($_POST['phone'])) {

array_push($error, "***phone number is required!");

return;

}

$phone = sanitize($_POST['phone']);

if (empty($_POST['email'])) {

array_push($error, "***email ID is required!");

return;

}

$email = sanitize($_POST['email']);

$email = filter_var($email, FILTER_VALIDATE_EMAIL);

if (empty($_POST['psw'])) {

array_push($error, "***password is required!");

return;

}

$password = sanitize($_POST['psw']);

if (empty($_POST['cpsw'])) {

array_push($error, "***please confirm your password!");

return;

}

$confirm_psw = sanitize($_POST['cpsw']);

if ($password === $confirm_psw) {

$password = password_hash(sanitize($_POST['psw']), PASSWORD_DEFAULT);

} else {

array_push($error, "***confirm password must be same as password!");

return;

}

// if everything is ok then save data to database

$sql = "INSERT INTO admins(id, name, dob, gender, SSN, address, phone, email, password) values ('{$userid}', '{$name}', '{$dob}', '{$gender}', '{$ssn}', '{$address}', '{$phone}', '{$email}', '{$password}')";

$res = $conn->query($sql);

if ($res) {

header("location: adminLogin.php?msg=registered successfully!");

} else {

header("location: account_manager.php?msg=unable to register!");

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

<title>Document</title>

</head>

<body>

<header>

<?php include "header.php" ?>

</header>

<main>

<section class="sec">

<div class="admin_login">

<h2>Admin Registration</h2>

<p>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

<p>

<?php

if (count($error) > 0) {

echo "<ul>";

foreach ($error as $err) {

echo "<li>{$err}</li>";

}

echo "</ul>";

}

?>

</p>

<p>

<label for="">Username</label><br>

<input type="text" name="uid" id="" value="<?php echo $user_id; ?>" readonly>

</p>

<p>

<label for="">Name</label><br>

<input type="text" name="name" id="">

</p>

<p>

<label for="">Date of Birth</label><br>

<input type="date" name="dob" id="">

</p>

<p>

<label for="">Gender</label><br>

<input type="radio" name="gend" id="" value="male"> Male

<input type="radio" name="gend" id="" value="female"> Female

<input type="radio" name="gend" id="" value="other"> Other

</p>

<p>

<label for="">SSN No.</label><br>

<input type="text" name="ssn" id="">

</p>

<p>

<label for="">Address</label><br>

<textarea name="address" id="" cols="30" rows="7"></textarea>

</p>

<p>

<label for="">Phone</label><br>

<input type="text" name="phone" id="">

</p>

<p>

<label for="">Email ID</label><br>

<input type="email" name="email" id="">

</p>

<p>

<label for="">Password</label><br>

<input type="password" name="psw" id="">

</p>

<p>

<label for="">Confirm Password</label><br>

<input type="password" name="cpsw" id="">

</p>

<p>

<button type="submit" name="admin_regis">Register</button>

</p>

</form>

</p>

<hr>

<h3>OR</h3>

<p class="regis_link">

<h4>Already registered? <a href="adminLogin.php">Log In here</a></h4>

</p>

</div>

</section>

</main>

</body>

</html>