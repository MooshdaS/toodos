<?php 
include('config.php');
session_start();

$select = " SELECT * FROM user_table ";

$result = mysqli_query($conn, $select);
$options = "";

while($row = mysqli_fetch_array($result)){
    if($row['user_type'] == 'user'){
        $options = $options."<option>$row[1]</option>";
    }
}

if(isset($_POST['submit'])){

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $deadline = mysqli_real_escape_string($conn, $_POST['deadline']);
    $user = mysqli_real_escape_string($conn, $_POST['format']);
    $status = "incomplete";
    
    $select = " SELECT * FROM tasks_table ";
    
    $result = mysqli_query($conn, $select);
    
    
    $insert = "INSERT INTO tasks_table(title, description, deadline, assigned_user, status) VALUES('$title','$description','$deadline', '$user', '$status')";
    mysqli_query($conn, $insert);
    header('location:admin_page.php');
    echo "Task Added Successfully.";

    
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
            <div class="navbar">
                <img src="logo.png" class="logo">
                <ul>
                    <li><h3>Admin Panel</h3></li>
                    <li><a href="admin_page.php">Home</a></li>
                    <li><a href="tasks.php">All Tasks</a></li>
                    <li><a href="approve_tasks.php">Approve Tasks</a></li>
                    <li><a href="admin_completed.php">Completed Tasks</a></li>
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
                            <div class="select">
                                <select name="format" id="format">
                                    <option selected disabled>Assign Task To A User</option>
                                    <option required> <?php echo $options; ?> </option>
                                </select>
                            </div>
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