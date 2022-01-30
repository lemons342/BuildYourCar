<?php
include("session_handling.php");
include("db.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    
  $name = $_POST["name"];
  $password = $_POST["password"];
  
  if (register($name, $password)) {
    redirect("login.php", "Registration successful. You may now log in.");
  } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="noindex, nofollow" >
    <title>BuildYourCar</title>

    <link rel="stylesheet" href="project.css">
    <link rel="icon" href="icon.png">
</head>
<body>
    <div id="wrapper">
        <header>
            <a href="home.html">BUILD YOUR CAR</a>
        </header>

        <nav>
            <ul>
                <li>
                    <a href="build.php">Build</a>
                    <ul class="sub-links">
                    </ul>
                </li>
                <li>
                    <a href="community.html">Community</a>
                    <ul class="sub-links">
                    </ul>
                </li>
                <li>
                    <a href="links.php">Useful Links</a>
                    <ul class="sub-links">
                    </ul>
                </li>
                <li id="profileicon" class="login-link">
                    <a href="profile.php"><img src="profile.png" alt="profile"></a>
                        
                    <ul class="sub-links">
                    </ul>
                </li>
            </ul>
        </nav>

            <main>
                <div>
                    <page>
                        <fieldset class="horizontal-controls">
                            <legend>Register</legend>
                            <ul>
                                <li>
                                    <form id="register" action="register.php" method="post">
                                        <label for="name" id="register">Username:</label>
                                        <input type="text" id="name" name="name">
                                        <label for="password" id="register">Password:</label>
                                        <input type="password" id="password" name="password"> <!--add second password comfirmation later?-->
                                        <input type="submit" value="Register" id="register-btn">
                                    </form>
                                </li>
                            </ul>
                        </fieldset>
                    </page>

                </div>
            </main>

            <footer>
                This site is under development by UW-Oshkosh students as a prototype for
                personal use. Nothing on the site should be construed in any way as being ocially
                connected with or representative of personal use.
                <p>
                    <a href="http://validator.w3.org/check/referer"
                       referrerpolicy="unsafe-url">
                        Validate Me
                    </a>
                </p>
            </footer>
        </div>
    </body>
    </html>
