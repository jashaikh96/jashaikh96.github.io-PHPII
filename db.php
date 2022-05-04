<?php

$host = "localhost";

$user = "root";

$password = "";

$database = "droid_wars_club_db";

$conn = new Mysqli($host, $user, $password, $database);

if (!$conn) {

die("connection failed! " . $conn->connect_error);

}