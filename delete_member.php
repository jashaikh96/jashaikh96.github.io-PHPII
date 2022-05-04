<?php

include "db.php";

$member_id = $_GET['member_id'];

$sql = "DELETE FROM members WHERE id='{$member_id}'";

$res = $conn->query($sql);

if ($res) {

header("location: admin.php?msg=data successfully deleted!");

} else {

header("location: admin.php?msg=unable to delete data!");

}