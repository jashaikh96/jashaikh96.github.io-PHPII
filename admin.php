<?php

session_start();

include "db.php";

// access admin data

$sql = "SELECT * FROM admins";

$res = $conn->query($sql);

// access member data

$sql2 = "SELECT * FROM members ORDER BY name";

$res2 = $conn->query($sql2);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="./css/style.css">

<title>Administrator page</title>

</head>

<body>

<header>

<div class="logo_bar">

<h2>DROID WARS CLUB</h2>

<a href="adminLogout.php">Log Out</a>

</div>

<nav class="menu">

<ul>

<li><a href="index.php" class="active">Home</a></li>

<li><a href="member_registration.php">Join Us</a></li>

<li><a href="#">About Us</a></li>

<li><a href="member_login.php">Members</a></li>

<li><a href="#">News</a></li>

<li><a href="#">Contact</a></li>

</ul>

<span><?php echo "<b>" . date("d/m/Y h:i:sa") . "</b>"; ?><br> Welcome <?php echo $_SESSION['admin_id']; ?></span>

</nav>

</header>

<main>

<section class="section-1">

<div class="add_admin_div">

<h2>List of Administrators</h2>

<a href="account_manager.php">Add New Admin</a>

</div>

<div class="admin-list">

<table cellspacing='0px'>

<tr>

<th>UserID</th>

<th>Name</th>

<th>Date of Birth</th>

<th>Gender</th>

<th>SSN No.</th>

<th>Address</th>

<th>Phone</th>

<th>Email ID</th>

<th></th>

</tr>

<?php

if ($res->num_rows > 0) {

while ($rows = $res->fetch_assoc()) {

?>

<tr>

<td><?php echo $rows['id']; ?></td>

<td><?php echo $rows['name']; ?></td>

<td><?php echo $rows['dob']; ?></td>

<td><?php echo $rows['gender']; ?></td>

<td><?php echo $rows['SSN']; ?></td>

<td><?php echo $rows['address']; ?></td>

<td><?php echo $rows['phone']; ?></td>

<td><?php echo $rows['email']; ?></td>

<td><a href="delete_admin.php?admin_id=<?php echo $rows['id']; ?>" id="delete">Delete</a></td>

</tr>

<?php

}

}

?>

</table>

</div>

</section>

<section class="section-2">

<div class="add_admin_div">

<h2>List of Members</h2>

<a href="member_registration.php">Add New Member</a>

</div>

<div class="admin-list">

<table cellspacing='0px'>

<tr>

<th>Member ID</th>

<th>Name</th>

<th>Date of Birth</th>

<th>Gender</th>

<th>SSN No.</th>

<th>Address</th>

<th>Phone</th>

<th>Email ID</th>

<th></th>

</tr>

<?php

if ($res2->num_rows > 0) {

while ($rows2 = $res2->fetch_assoc()) {

?>

<tr>

<td><?php echo $rows2['id']; ?></td>

<td><?php echo $rows2['name']; ?></td>

<td><?php echo $rows2['dob']; ?></td>

<td><?php echo $rows2['gender']; ?></td>

<td><?php echo $rows2['SSN']; ?></td>

<td><?php echo $rows2['address']; ?></td>

<td><?php echo $rows2['phone']; ?></td>

<td><?php echo $rows2['email']; ?></td>

<td><a href="delete_member.php?member_id=<?php echo $rows2['id']; ?>" id="delete">Delete</a></td>

</tr>

<?php

}

}

?>

</table>

</div>

</section>

</main>

</body>

</html>