<!-- authorization using this api post https://aadrikainfomedia.com/auth/api/login -->
<?php
session_start();
if (isset($_SESSION['user'])) {
    header('location:mydb.php');
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://aadrikainfomedia.com/auth/api/login');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('email' => $email, 'password' => $password, 'type' => 'mobile')));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response);
    // print_r($result);
    // // stop execution
    // die();


    if ($result->status == 'success') {
        session_start();
        $_SESSION['user'] = $result->data;
        header('location:mydb.php');
    } else {
        header('location:index.php?error=1');
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <h1>Login</h1>
                <form action="" method="post">
                    <div class="form-group
                    <?php
                    if (isset($_GET['error'])) {
                        echo 'has-error';
                    }
                    ?>
                    ">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" required>
                        <?php
                        if (isset($_GET['error'])) {
                        ?>
                            <span class="help-block">Invalid Credentials</span>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="form-group
                    <?php
                    if (isset($_GET['error'])) {
                        echo 'has-error';
                    }
                    ?>
                    ">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group
                    <?php
                    if (isset($_GET['error'])) {
                        echo 'has-error';
                    }
                    ?>
                    ">
                        <button class="btn btn-primary btn-block">Login with PHP Chandan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<!-- // Path: login.php -->


<!-- // Path: home.php -->