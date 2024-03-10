<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link href="intlTelInput.css" rel="stylesheet">
</head>
<body data-new-gr-c-s-check-loaded="14.1154.0" data-gr-ext-installed="">

<header>
    <div class="header" style="height: 80px;color: #53325ebf;padding-top: 38px;padding-right: 30px;text-align: end;"><h4 style="font-family: sans-serif;font-weight: 900;"> GOLDY | 2024 </h4>
    </div>
</header>
<div style="text-align-last: center;margin-top: 10px;margin-bottom: -9px;">
  <h1 style="color: #ffffff6e;margin-bottom: 0;font-weight: bold;font-size: 40px;font-family: inherit;"> REGISTRATION FORM </h1>  
</div>
<div style="margin-top:0;"class="container">
<div class="register-grid" style="display: flex;justify-content: space-around;height: 52px;">
        <div style="text-align: -webkit-center;/* margin: 247px auto; */color: azure;">
        <a class="register active" href="registration.php">Register</a>
        </div>
    <div>
    <a class="register" style="text-align: -webkit-center;/* margin: 247px auto;" href="login.php">Login</a>
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
            $Country = $_POST["country"];
            $Province = $_POST["province"];
            $City = $_POST["city"];
            $Barangay = $_POST["barangay"];
            $Contact_No = $_POST["phone"];
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
                $sql = "INSERT INTO users (Last_Name, First_Name, email, password, country, province, city, barangay, contact_no) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);

                if(mysqli_stmt_prepare($stmt, $sql)){
                    mysqli_stmt_bind_param($stmt, "sssssssss", $LastName, $FirstName, $email, $passwordHash, $Country, $Province, $City, $Barangay, $Contact_No);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>Registered Successfully!</div>";
                } else {
                    die("Something went wrong");
                }
            }
        }
        ?>
    <form action="registration.php" method="post" style="position: relative;margin-top: 12px;">
    <div class="last-name">
        <div class="form-group"style="width: 45%;">
            <p>Last Name:</p>
            <input type="text" class="form-control" name="LastName" placeholder="Doe">
        </div>
        <div class="form-group" style="width: 45%;">
        <p>First Name:</p>
        <input type="text" class="form-control" name="FirstName" placeholder="John"></div>
    </div>
    <div class="form-group">
                <p>Email:</p><input type="email" class="form-control" name="Email" placeholder="Email Address">
            </div>
            
    <div style="display: flex;justify-content: space-between;">
        <div class="form-group" style="width: 50%;">
                <p>Input Password:</p><input type="password" class="form-control" name="password" placeholder="*******" aria-autocomplete="list">
            </div>
    <div class="form-group" style="width: 45%; ">
                <p>Repeat Password:</p><input type="password" class="form-control" name="repeat_password" placeholder="********">
            </div></div>
            
            <!--provice and city-->
            <div class="form-group">
            <label>Country</label>
            <select id="countries" name="country" class="form-control"  required>
            </select>
        </div> <!-- form-group end.// -->
        <div class="form-row">
            <div class="col form-group">
                <label>Province</label>
                <select id="provinces" name="province" class="form-control" required>
                    <option value="" disabled selected>Select Province</option>
                </select>
            </div> <!-- form-group end.// -->
            <div class="col form-group">
                <label>City/Municipality</label>
                <select id="cities" name="city" class="form-control" required>
                    <option value="" disabled selected>Select City/Municipality</option>
                </select>
            </div> <!-- form-group end.// -->
            <div class="col form-group">
                <label>Barangay</label>
                <select id="barangay" name="barangay" class="form-control" required>
                    <option value="" disabled selected>Select Barangay</option>
                </select>
            </div> <!-- form-group end.// -->
        </div>

        <div class="form-group">
        <label>Phone Number:</label> <br>
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required maxlength="20"    style="margin-top: 10px;">
        </div>
        <div class="form-btn" style="text-align:end; margin: 10px auto;">
            <input type="submit" class="btn btn-primary" name="submit" value="Register" style="
            background: linear-gradient(138deg, #a16e90, #645766);
            border-radius: 20px;">
            </div>
        
        </div> <!-- form-group// -->
            
        </form>
        
</div>
<script src="intlTelInput.js"></script>
        <script src="country.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="province_barangay_city.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var input = document.querySelector("#phone");
                var iti = window.intlTelInput(input, {
                    utilsScript: "utils.js",
                    separateDialCode: true,        
                });
 
                // Event listener for handling changes in the input
                input.addEventListener("change", function() {
                    // Check if the input value already contains the dial code
                    if (!input.value.startsWith('+')) {
                        var selectedCountryData = iti.getSelectedCountryData();
                        var countryCode = selectedCountryData.dialCode;
 
                        // Remove leading zeros
                        input.value = input.value.replace(/^0+/, '');
 
                        // Add the dial code only if it's not already present
                        input.value = '+' + countryCode + input.value;
                    }
                });
            });
        </script>
</body>
<grammarly-desktop-integration data-grammarly-shadow-root="true">

</grammarly-desktop-integration><div id="smartyContainer" style="position: absolute; top: 0px; right: 0px; line-height: initial; z-index: 2147483647; width: auto; font-size: initial;">
</div>
</html>