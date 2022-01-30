<?php
include("session_handling.php");
include("db.php");
ensure_logged_in();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                            <legend>Profile</legend>
                            <h1>Welcome <?= $_SESSION["name"] ?>!</h1>
                            <p>
                              You can now create/edit your build list!
                            </p>
                            <ul>
                                <li>
                                    <form id="logout" action="logout.php" method="POST">
                                      <input type="submit" value="Log out" >
                                      <input type="hidden" name="logout" value="true" >
                                    </form>
                                </li>
                            </ul>
                        </fieldset>
                    </page>

                </div>
            </main>

            <footer>
                buildyourcar.com
            </footer>
        </div>
    </body>
    </html>
