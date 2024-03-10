<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body data-new-gr-c-s-check-loaded="14.1154.0" data-gr-ext-installed="">
<header>
    <div class="header" style="height: 80px;color: #53325ebf;padding-top: 38px;padding-right: 30px;text-align: end;"><h4 style="font-family: sans-serif;font-weight: 900;"> GOLDY | 2024 </h4>
    </div>
</header>
<div style="text-align-last: center;margin-top: 10px;margin-bottom: -9px;">
  <h1 style="color: #ffffff6e;margin-bottom: 0;font-weight: bold;font-size: 40px;font-family: inherit;"> LOGIN FORM </h1>  
</div>
    <div class="container" style="position: relative; margin-top:0;">
    <div class="register-grid" style="display: flex;justify-content: space-around;height: 52px;">
        <div style="text-align: -webkit-center;/* margin: 247px auto; */color: azure;">
        <a class="register " href="registration.php">Register</a>
        </div>
    <div>
    <a class="register active" style="text-align: -webkit-center;/* margin: 247px auto;" href="login.php">Login</a>
</div>
</div>
<div class="registration-fillup">        
    <div style="text-align: center;">
    <h2>LOGIN HERE</h2>
    </div>
    <?php
            if (isset($_POST["login"])) {
                $email = $_POST["email"];
                $password = $_POST["password"];
                
                require_once "database.php";
                
                $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                $users = $result->fetch_assoc();

                if ($users) {
                    if (password_verify($password, $users["password"])) {
                        $_SESSION["users"] = true;
                        header("Location: index.php");
                        exit(); // Ensure the script stops execution after redirect
                    } else {
                        echo "<div class='alert alert-danger'>Invalid email or password</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Invalid email or password</div>";
                }
            }
        ?>
        <form action="login.php" method="post" style="padding-top: 36px;">
            <div style="display: grid;margin-bottom: 41px;">
    
<div class="form-group" style="justify-self:center">
                <label for="email">Email:</label>
                
            </div>
            <div style="justify-self:center; width: 50%;"><input type="email" name="email" class="form-control" required="" style="
    height: 40px;"></div>
</div>
            <div style="display: grid;margin-bottom: 15px;">
            <div class="form-group" style="justify-self:center;">
                <label for="password">Password:</label>
                
            </div>
            <div style="justify-self:center; width: 50%;">
            <input type="password" name="password" class="form-control" required="" style="height: 40px;">
        </div>
        </div>
    <div class="form-btn" style="
    text-align: center;
">
                <input type="submit" value="Login" name="login" class="btn btn-primary" style="
    margin-top: 15px;
    margin-left: 10px;
    background: linear-gradient(138deg, #a16e90, #645766);
">
            </div>
        </form>
        </div>

<grammarly-desktop-integration data-grammarly-shadow-root="true">

</grammarly-desktop-integration>
</div>


</body><grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration><div id="smartyContainer" style="position: absolute; top: 0px; right: 0px; line-height: initial; z-index: 2147483647; width: auto; font-size: initial;"></div></html>