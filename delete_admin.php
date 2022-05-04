<?php

include "db.php";

$admin_id = $_GET['admin_id'];

$sql = "DELETE FROM admins WHERE id='{$admin_id}'";

$res = $conn->query($sql);

if ($res) {

header("location: admin.php?msg=data successfully deleted!");

} else {

header("location: admin.php?msg=unable to delete data!");

}