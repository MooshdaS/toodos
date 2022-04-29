<?php
include('config.php');

session_start();

if(isset($_GET['page'])){
    $page = $_GET['page'];
}
else{
    $page = 1;
}

$per_page = 10;
$start = ($page-1)*10;

$select = " SELECT * FROM tasks_table ORDER BY deadline limit $start, $per_page";

$result = mysqli_query($conn, $select);
$index = 0;
$title = "";
$description = "";
$deadline = "";
$assigned = "";
$status = "";


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
        <div class="row">
            <div class="column column-6">
                <h1 class="section_header"><i class="fa fa-list"></i>List of Tasks</h1>
                <form id="approval" method="post">
                    <div class="section_content">
                        <div class="tasks">
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Due Date</th>
                                        <th>Assigned To</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row = mysqli_fetch_array($result)){ 
                                        if($row['status']==1){ ?>
                                            <tr>
                                                <td><?php echo $index= $index + 1; ?></td>
                                                <td><?php echo $title.$row[1]; ?></td>
                                                <td><?php echo $description.$row[2]; ?></td>
                                                <td><?php echo date('F d, Y', strtotime($deadline.$row[3])); ?></td>
                                                <td><?php echo $assigned.$row[4]; ?></td>
                                                <td><?php 
                                                if($row['status']==1){
                                                    echo "pending approval";
                                                    
                                                }
                                                ?> &nbsp;&nbsp;&nbsp;&nbsp; 
                                                <?php 
                                                if($row['status']==1){ 
                                                    echo '<a href="admin_status.php?id='.$row['id'].'&status=2" class="btn btn-success btn-approve">Approve</a>';
                                                ?>
                                                    <!-- <input type="submit" name="approve" value="Approve" class="btn btn-success btn-approve"> -->
                                                <?php } ?></td>                                            
                                            </tr>
                                    <?php }} ?>
                                </tbody>
                            </table>   
                            <?php 
                                $query = "SELECT * FROM tasks_table";
                                $pr_result = mysqli_query($conn, $query);
                                $record = mysqli_num_rows($pr_result);
                                $total_page = ceil($record/$per_page);
                                if($page>1){
                                    echo "<a href='approve_tasks.php?page=".($page-1)."' class='btn btn-danger'>Previous</a>";
                                }

                                for($i=1;$i<$total_page;$i++){
                                    echo "<a href='approve_tasks.php?page=".$i."' class='btn btn-primary'>$i</a>";
                                }
                                if($page>0 && $page<$total_page){
                                    echo "<a href='approve_tasks.php?page=".($page+1)."' class='btn btn-danger'>Next</a>";
                                }

                            ?>            
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div> 
</body>
</html>