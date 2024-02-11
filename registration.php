<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style1.css">
</head>
<body data-new-gr-c-s-check-loaded="14.1154.0" data-gr-ext-installed="">

<header>
    <div class="header" style="height: 80px; background-color: #854b85a1; border-bottom: 1px solid #542d5b;">
    </div>
</header>

<div class="container">
    <div class="register-grid">
        <div style="text-align: -webkit-center; margin: 247px auto; color: azure;">
        <h4 style="width: 154px; text-align: center; font-size: xx-large; font-weight: bolder;">Glad to See You!</h4>
        <p style="color: currentcolor;font-family: monospace;font-size: 15px;"> Welcome to My Personal Website!</p>
    </div>
</div>
<div class="registration-fillup">        
    <div style="text-align: center;">
    <h2>REGISTER HERE</h2>
    </div>
    <?php
        if(isset($_POST["submit"])){
            $LastName = $_POST["LastName"];
            $FirstName = $_POST["FirstName"];
            $email = $_POST["Email"];
            $password = $_POST["password"];
            $RepeatPassword = $_POST["repeat_password"];
            $errors = array();

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            if(empty($LastName) || empty($FirstName) || empty($email) || empty($password) || empty($RepeatPassword)) {
                array_push($errors, "All fields are required");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($errors, "Email is not valid");
            }
            if (strlen($password) < 8){
                array_push($errors, "Password must be at least 8 characters long");
            }
            if ($password != $RepeatPassword){
                array_push($errors, "Passwords do not match");
            }

            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = mysqli_stmt_init($conn);

            if(mysqli_stmt_prepare($stmt, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) > 0){
                    array_push($errors, "Email Already Exist!");
                }
            } else {
                die("Something went wrong");
            }

            if (count($errors) > 0){
                foreach($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                require_once "database.php";
                $sql = "INSERT INTO users (Last_Name, First_Name, email, password) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);

                if(mysqli_stmt_prepare($stmt, $sql)){
                    mysqli_stmt_bind_param($stmt, "ssss", $LastName, $FirstName, $email, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>Registered Successfully!</div>";
                } else {
                    die("Something went wrong");
                }
            }
        }
        ?>
    <form action="registration.php" method="post" style="margin-top: 12px;">
    <div class="last-name">
        <div class="form-group">
            <p>Last Name:</p>
            <input type="text" class="form-control" name="LastName" placeholder="Doe">
        </div>
    </div>
    <div class="first-name">
        <p>First Name:</p>
        <input type="text" class="form-control" name="FirstName" placeholder="John"></div><div class="form-group">
                <p>Email:</p><input type="email" class="form-control" name="Email" placeholder="Email Address">
            </div>
            
            <div class="form-group">
                <p>Input Password:</p><input type="password" class="form-control" name="password" placeholder="*******">
            </div>
            
            <div class="form-group">
                <p>Repeat Password:</p><input type="password" class="form-control" name="repeat_password" placeholder="********">
            </div>
            <div class="form-btn" style="margin: 10px auto;">
            <input type="submit" class="btn btn-primary" name="submit" value="Register" style="
            background: linear-gradient(138deg, #a16e90, #645766);
            border-radius: 20px;">
            </div>
        </form>
        <div style="text-align-last: end;">
        <p>Already registered? <a href="login.php">Login Here</a></p>
    </div>
</div>
</body>
<grammarly-desktop-integration data-grammarly-shadow-root="true">

</grammarly-desktop-integration><div id="smartyContainer" style="position: absolute; top: 0px; right: 0px; line-height: initial; z-index: 2147483647; width: auto; font-size: initial;">
</div>
</html>