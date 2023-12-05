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
        <h4>Add User</h4>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Login</label>
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Login"  name="user-login">
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Password</label>
                <input type="password" class="form-control" id="formGroupExampleInput2" placeholder="Password" name="user-password">
            </div>
            <input type="submit" class="btn btn-secondary" value="Ajouter Utiliasteur" name="user-click">
        </form>
        <?php
        $validations = 0;

        $danger_alert = "<div class='alert alert-danger' role='alert'>All The Fields Are Required !</div>";

        if(isset($_POST["user-click"]))
        {
            $validations++;

            $login = $_POST["user-login"];
            $pass  = $_POST["user-password"];
            $date = date('Y-m-d');

            if(!empty($login) && !empty($pass))
            {
                require_once 'ready_components/first_connection.php';
                $sql_state=$pdo->prepare('insert into utilisateurs values(null,?,?,?)');
                $sql_state->execute([$login,$pass,$date]);
                header("location:connection.php");
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