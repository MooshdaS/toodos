<?php 
include('config.php');

session_start();

if(!isset($_SESSION['user_name'])){
    header('location:index.php');
 }

if(isset($_POST['submit'])){

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $deadline = mysqli_real_escape_string($conn, $_POST['deadline']);
    $user = mysqli_real_escape_string($conn, $_SESSION['user_name']);

    $select = " SELECT * FROM tasks_table ";

    $result = mysqli_query($conn, $select);

    $insert = "INSERT INTO tasks_table(title, description, deadline, assigned_user) VALUES('$title','$description','$deadline','$user')";
    mysqli_query($conn, $insert);
    header('location:user_page.php');
    echo "Task Added Successfully.";

    $_SESSION['tasks'] = $select;

};
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
            <div class="navbar">
                <img src="logo.png" class="logo">
                <ul>
                    <li><h3><?php echo $_SESSION['user_name'] ?></h3></li>
                    <li><a href="user_page.php">Home</a></li>
                    <li><a href="tasks_user.php">All Tasks</a></li>
                    <li><a href="assigned_tasks.php">Assigned Tasks</a></li>
                    <li><a href="user_completed.php">Completed Tasks</a></li>
                    <li><a href="logout.php" class="btn">Logout</a></li>
                </ul>

            </div>
        <div class="content">
            <div class="form-data">
                <form id="task" method="post">
                    <div class="form-head">
                            <h2>Add A Task</h2>
                    </div>
                    <div class="form-body">
                        <div class="row form-row">
                            <input type="text" name="title" placeholder="Add A Title" class="form-control" required>
                        </div>
                        <div class="row form-row">
                            <input type="text" name="description" placeholder="Add Task Description" class="form-control" required>
                        </div>
                        <div class="row form-row">
                            <input id="dat" type="date" name="deadline" placeholder="Deadline" class="form-control" required>
                        </div>
                        <div class="row form-row">
                            <input type="submit" name="submit" value="Add Task" class="btn btn-success btn-appointment">
                        </div>
                    </div>
                </form>
            </div>
        </div> 
    </div>
</body>
</html>