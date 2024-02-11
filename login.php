<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style1.css">
</head>
<body data-new-gr-c-s-check-loaded="14.1154.0" data-gr-ext-installed=""><header>
    <div class="header" style="height: 80px; background-color: #854b85a1; border-bottom: 1px solid #542d5b;">
    </div>
</header>
    
    <div class="container" style="
    position: relative;
">
    
<div class="registration-fillup">        
    <div style="text-align: center;">
    <h2>LOGIN</h2>
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
        <form action="login.php" method="post" style="
    padding-top: 36px;
    width: 407px;
">
            <div style="
    display: grid;
    margin-bottom: 41px;
">
    
<div class="form-group" style="
">
                <label for="email">Email:</label>
                
            </div>
            <input type="email" name="email" class="form-control" required=""></div>
            <div style="display: grid;margin-bottom: 15px;"><div class="form-group">
                <label for="password">Password:</label>
                
            </div>
            <input type="password" name="password" class="form-control" required=""></div>
    <div class="form-btn" style="
    text-align: center;
">
                <input type="submit" value="Login" name="login" class="btn btn-primary" style="
    margin-top: 15px;
    margin-left: 10px;
">
            </div>
        </form>
        <div style="
    margin-top: 114px;
">
            <p>Not Registered yet? <a href="registration.php">Register Here</a></p>
        </div>
</div><div class="register-grid">
        <div style="text-align: -webkit-center; margin: 247px auto; color: azure;">
        <h4 style="width: 154px; text-align: center; font-size: xx-large; font-weight: bolder;">Glad to See You!</h4>
        <p style="color: currentcolor;font-family: monospace;font-size: 15px;"> Welcome to My Personal Website!</p>
    </div>
</div>

<grammarly-desktop-integration data-grammarly-shadow-root="true">

</grammarly-desktop-integration>
</div>


</body><grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration><div id="smartyContainer" style="position: absolute; top: 0px; right: 0px; line-height: initial; z-index: 2147483647; width: auto; font-size: initial;"></div></html>