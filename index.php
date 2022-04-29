<?php 
@include 'config.php';

session_start();

if(isset($_POST['rsubmit'])){

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];
 
    $select = " SELECT * FROM user_table WHERE email = '$email' && password = '$pass' ";
 
    $result = mysqli_query($conn, $select);
 
    if(mysqli_num_rows($result) > 0){
 
       $error[] = 'user already exist!';
 
    }else{
 
       if($pass != $cpass){
          $error[] = 'password not matched!';
       }else{
          $insert = "INSERT INTO user_table(username, email, password, user_type) VALUES('$username','$email','$pass','$user_type')";
          mysqli_query($conn, $insert);
          header('location:index.php');
          echo "Account Created Successfully.";
       }
    }
 
 };

 if(isset($_POST['lsubmit'])){

    $name = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $user_type = $_POST['user_type'];

    $select = " SELECT * FROM user_table WHERE email = '$email' && password = '$pass' ";
 
    $result = mysqli_query($conn, $select);
 
    if(mysqli_num_rows($result) > 0){
 
       $row = mysqli_fetch_array($result);
 
       if($row['user_type'] == 'admin'){
 
          $_SESSION['admin_name'] = $row['username'];
          header('location:admin_page.php');
 
       }elseif($row['user_type'] == 'user'){
 
          $_SESSION['user_name'] = $row['username'];
          header('location:user_page.php');
 
       }
      
    }else{
       $error[] = 'incorrect email or password!';
    }
 
 };


?>

<!DOCTYPE html>
    <head>
        <title>Schedule Maker</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
            <div class="navbar">
                <img src="logo.png" class="logo">
                <ul>
                    <li><button class="loginbtn" onclick="document.getElementById('login-form').style.display='block'" style="width:auto;">Login</button></li>
                </ul>
            </div>
            <div class="content">
                <div class="left-col">
                    <h1> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; SET<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YOUR<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SCHEDULE</h1>
                </div>
                <div id="login-form" class="login-page">
                    <div class="form-box">
                        <div class="button-box">
                            <div id="btn"></div>
                            <button type="button" onclick="login()" class="toggle-btn">Log In</button>
                            <button type="button" onclick="register()" class="toggle-btn">Register</button>
                        </div>
                        <form id="login" class="input-group-login" method="post">
                            <?php
                            if(isset($error)){
                                foreach($error as $error){
                                    echo '<span class="error-msg">'.$error.'</span>';
                                };
                            };
                            ?>
                            <input type="text" name="username" class="input-field" placeholder="username" required>
                            <input type="text" name="email" class="input-field" placeholder="email" required>
                            <input type="password" name="password" class="input-field" placeholder="password" required>
                            <button type="submit" name="lsubmit" class="lsubmit-btn">Login</button>
                        </form>
                        <form id="register" class="input-group-register" method="post">
                            <?php
                            if(isset($error)){
                                foreach($error as $error){
                                    echo '<span class="error-msg">'.$error.'</span>';
                                };
                            };
                            ?>
                            <input type="text" name="username" class="input-field" placeholder="Userame" required>
                            <input type="email" name="email" class="input-field" placeholder="Email" required>
                            <input type="password" name="password" class="input-field" placeholder="Enter Password" required>
                            <input type="password" name="cpassword" class="input-field" placeholder="Confirm Password" required>
                            <select name="user_type" class="option-btn">
                                <option value="user">user</option>
                                <option value="admin">admin</option>
                            </select>
                            <button type="submit" name="rsubmit" class="rsubmit-btn">Register</button>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                var x=document.getElementById("login");
                var y=document.getElementById("register");
                var z=document.getElementById("btn");
                function register()
                {
                    x.style.left='-400px';
                    y.style.left='50px';
                    z.style.left='110px';
                }
                function login()
                {
                    x.style.left='50px';
                    y.style.left='450px';
                    z.style.left='0px';
                }
            </script>
            <script>
                var modal = document.getElementById("login-form");
                window.onclick = function(event)
                {
                    if (event.target == modal)
                    {
                        modal.style.display = "none";
                    }
                }
            </script>
        </div>

    </body>
</html>