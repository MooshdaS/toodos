<?php

include('config.php');

$id=$_GET['id'];
$status=$_GET['status'];

$q = "UPDATE tasks_table SET status=$status WHERE id=$id";

mysqli_query($conn, $q);
header('location:assigned_tasks.php');
?>