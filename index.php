<?php

session_start();

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

<?php

include "header.php";

?>

</header>

<main>

<section class="sec1">

<span class="register">

<h2>Become a Member</h2>

<p>Why join Us? You will be able to take on a Star Wars adventure with others in our great community. Find out the news before anyone or get together with our other members for any exicting projects! </p>

<?php

if (isset($_SESSION['member_id'])) {

$curtime = time();

if ($curtime > $_SESSION['expire']) {

session_destroy();

echo "<p>Session expired! please log in <a href='member_login.php'>here</a></p>";

}

} else {

echo '<p><a href="account_manager.php">Join Us</a></p>';

}

?>

</span>

<img src="./images/members.jpg" alt="members' images">

</section>

</main>

</body>

</html>