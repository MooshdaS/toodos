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
$per_page2 = 3;
$start2 = ($page-1)*3;

$select = " SELECT * FROM tasks_table ORDER BY deadline limit $start,$per_page";
$select2 = " SELECT * FROM tasks_table ORDER BY deadline limit $start2,$per_page2";

$result = mysqli_query($conn, $select);
$result2 = mysqli_query($conn, $select2);

$index = 0;
$title = "";
$description = "";
$deadline = "";
$assigned = "";

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
        <div class="row">
            <div class="column column-5">
                <h1 class="section_header">List of Tasks</h1>
                <form id="approval" method="post">
                    <div class="section_content">
                        <div class="tasks">
                            <table>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Due Date</th>
                                    <th>Assigned To</th>
                                    <th>Status</th>
                                </tr>
                                <?php while($row = mysqli_fetch_array($result)){ 
                                    if($row['assigned_user']==$_SESSION['user_name'] && $row['status']==0){ ?>
                                        <tr>
                                            <td><?php echo $index= $index + 1; ?></td>
                                            <td><?php echo $title.$row[1]; ?></td>
                                            <td><?php echo $description.$row[2]; ?></td>
                                            <td><?php echo date('F d, Y', strtotime($deadline.$row[3])); ?></td>
                                            <td><?php echo $assigned.$row[4]; ?></td>
                                            <td><?php 
                                            if($row['status']==0){
                                                echo "incomplete";
                                                
                                            }
                                            ?> &nbsp;&nbsp;&nbsp;&nbsp; 
                                            <?php 
                                            if($row['status']==0){ 
                                                echo '<a href="user_status.php?id='.$row['id'].'&status=1" name="" class="btn btn-success btn-approve">Complete</a>';
                                            ?>

                                            <?php } ?></td>                                            
                                        </tr>
                                <?php }} ?>
                            </table>   
                            <?php 
                                $query = "SELECT * FROM tasks_table";
                                $pr_result = mysqli_query($conn, $query);
                                $record = mysqli_num_rows($pr_result);
                                $total_page = ceil($record/$per_page);
                                if($page>1){
                                    echo "<a href='assigned_tasks.php?page=".($page-1)."' class='btn btn-danger'>Previous</a>";
                                }

                                for($i=1;$i<=$total_page;$i++){
                                    echo "<a href='assigned_tasks.php?page=".$i."' class='btn btn-primary'>$i</a>";
                                }
                                if($page>0 && $page<$total_page){
                                    echo "<a href='assigned_tasks.php?page=".($page+1)."' class='btn btn-danger'>Next</a>";
                                }

                            ?>         
                        </div>
                    </div>
                </form>
            </div>
            <div class="column column-7">
                <div class="section-data">
                    <div class="section-head">
                            <h2>Pending Approval</h2>
                    </div>
                    <form id="complete" method="post">
                        <div class="tasks">
                            <table>
                                <tr>
                                    <th>Title</th>
                                    <th>Status</th>
                                </tr>
                                <?php
                                $select2 = " SELECT * FROM tasks_table ORDER BY deadline ";

                                $result2 = mysqli_query($conn, $select2);
                                while($row = mysqli_fetch_array($result2)){ 
                                    if($row['assigned_user']==$_SESSION['user_name'] && $row['status']==1){ ?>
                                        <tr>
                                            <td><?php echo $title.$row[1]; ?></td>
                                            <td><?php 
                                            if($row['status']==1){
                                                echo "pending approval";                                    
                                            }
                                            ?></td>                                            
                                        </tr>
                                <?php }} ?>
                            </table>     
                            <?php 
                                $query = "SELECT status FROM tasks_table where status='1'";
                                $pr_result = mysqli_query($conn, $query);
                                $record = mysqli_num_rows($pr_result);
                                $total_page2 = ceil($record/$per_page2);
                                if($page>1){
                                    echo "<a href='assigned_user.php?page=".($page-1)."' class='btn btn-danger'>Previous</a>";
                                }

                                for($i=1;$i<=$total_page2;$i++){
                                    echo "<a href='#?page=".$i."' class='btn btn-primary'>$i</a>";
                                }
                                if($page>0 && $page<$total_page2){
                                    echo "<a href='#?page=".($page+1)."' class='btn btn-danger'>Next</a>";
                                }

                            ?> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
</body>
</html>