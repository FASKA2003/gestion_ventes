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
    <h4>Connection</h4>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Email"  name="user-email">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Password</label>
            <input type="password" placeholder="Password" class="form-control" id="formGroupExampleInput2" name="user-password">
        </div>
        <input type="submit" class="btn btn-primary" value="Connection" name="connection">
    </form>
    <?php
    if(isset($_POST["connection"]))
    {
        $email = $_POST["user-email"];
        $password = $_POST["user-password"];
        $danger_alert = "<div class='alert alert-danger' role='alert'>Login Or Password is incorrect !</div>";
        $missing_alert = "<div class='alert alert-danger' role='alert'>Missing Required Fields !</div>";

        if(!empty($email) && !empty($password))
        {
            require_once "../ready_components/first_connection.php";
            $sql_state = $pdo->prepare("select * from clients
                                               where E_mail=? and Mot_De_Passe=?");
            $sql_state->execute([$email,$password]);
            if($sql_state->rowCount()>0)
            {
                $_SESSION["client"] = $sql_state->fetch(PDO::FETCH_ASSOC);
                header("location: index.php");
            }
            else
            {
                echo$danger_alert;
            }
        }
        else
        {
            echo$missing_alert;
        }
    }
    ?>
</div>

</body>
</html>