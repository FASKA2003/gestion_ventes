<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        form
        {
            margin-bottom: 2rem ;
        }
    </style>
</head>
<body>
<?php
include('navbar_front.php')
?>
<div class="container py-3 my-3" >
    <h4>Add User</h4>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control" id="formGroupExampleInput"   name="user-first-name">
        </div>
        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control" id="formGroupExampleInput"   name="user-last-name">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">E-mail</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" name="user-mail">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Location</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" name="user-location">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Password</label>
            <input type="password" class="form-control" id="formGroupExampleInput2" name="user-pass">
        </div>
        <input type="submit" class="btn btn-secondary" value="Register Now" name="user-click">
    </form>
    <?php
    $validations = 0;

    $danger_alert = "<div class='alert alert-danger' role='alert'>Missing Required Fields !</div>";

    if(isset($_POST["user-click"]))
    {
        $validations++;

        $first_name = $_POST["user-first-name"];
        $last_name = $_POST["user-last-name"];
        $mail = $_POST["user-mail"];
        $location = $_POST["user-location"];
        $password = $_POST["user-pass"];
        $pass  = $_POST["user-pass"];
        $date = date('Y-m-d');

        if(!empty($pass) &&!empty($first_name) && !empty($last_name) && !empty($mail) && !empty($location))
        {
            require_once '../ready_components/first_connection.php';
            $sql_state=$pdo->prepare('insert into clients values(null,?,?,?,?,?,?)');
            $sql_state->execute([$first_name,$last_name,$mail,$location,$password,$date]);
            header("location:clientLogin.php");
        }
        else if(!(!empty($login) && !empty($pass)) && $validations>0)
        {
            echo$danger_alert;
        }
    }
    ?>
</div>

</body>
</html>