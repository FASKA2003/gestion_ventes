<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        form
        {
            margin-bottom: 2rem ;
        }
        i
        {
            display: inline-block;
            margin-right: 7px;
        }
    </style>
</head>
<body>
<?php
include('ready_components/navbar.php')
?>

<div class="container py-3 my-3" >
    <h4>Connection</h4>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Login</label>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Login"  name="user-login">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Password</label>
            <input type="password" class="form-control" id="formGroupExampleInput2" placeholder="Password" name="user-password">
        </div>
        <input type="submit" class="btn btn-primary" value="Connection" name="Connection">
    </form>
    <?php
    if(isset($_POST["Connection"]))
    {
          $login = $_POST["user-login"];
          $password = $_POST["user-password"];
          $danger_alert = "<div class='alert alert-danger' role='alert'>Login Or Password is incorrect !</div>";

        if(!empty($login) && !empty($password))
          {
              require_once "ready_components/first_connection.php";
              $sql_state = $pdo->prepare("select * from utilisateurs
                                               where login=? and password=?");
              $sql_state->execute([$login,$password]);
              if($sql_state->rowCount()>0)
              {
                  $_SESSION["utilisateur"] = $sql_state->fetch(PDO::FETCH_ASSOC);
                  header("location: categories_list.php");
              }
              else
              {
                  echo$danger_alert;
              }
          }
          else
          {
                echo$danger_alert;
          }
    }
    ?>
</div>

</body>
</html>