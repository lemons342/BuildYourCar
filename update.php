<?php
    include("session_handling.php");


    include('./initialize.php');
    $id = get_userID($_SESSION["name"]);
    ensure_admin($id); //user must be an ADMIN to view this page!

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_POST['links'] == null) {
            //echo "Please fill every box to add a part to your list.";
        } else {
            modify_links($_POST['links']);
        }
        header('Location: links.php');
        exit;
    }
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
                            <legend>Sales</legend>
                            <div>
                                <form action="update.php" method="POST">
                                <textarea rows="15" cols="74" id="links" name="links"><?php echo get_links(); ?></textarea>
                                <input type="submit" value="Save">
                                </form>
                            </div>
                        </fieldset>
                        <fieldset class="horizontal-controls">
                            <legend>Forums</legend>
                            <div>
                                <a href="https://forums.nasioc.com/forums/index.php?">Subaru - nasioc.com</a>
                            </div>
                            <div>
                                <a href="https://honda-tech.com/forums/">Honda - honda-tech.com</a>
                            </div>
                            <div>
                                <a href="https://forums.nicoclub.com/">Nissan - nicoclub.com</a>
                            </div>
                            <div>
                                <a href="https://www.toyotaownersclub.com/forums/">Toyota - toyotaownersclub.com</a>
                            </div>
                            <div>
                                <a href="https://chevroletforum.com/forum/">Chevy - chevroletforum.com</a>
                            </div>
                            <div>
                                <a href="https://www.fordforum.com/forum/">Form - fordforum.com</a>
                            </div>
                            <div>
                                <a href="https://dodgeforum.com/forum/dodge-charger-74/">Dodge - dodgeforum.com</a>
                            </div>
                            <div>
                                <a href="https://volkswagenforum.com/forum/">Volkswagen - volkswagenforum.com</a>
                            </div>
                            <div>
                                <a href="https://www.bimmerpost.com/">BMW - bimmerpost.com</a>
                            </div>
                            <div>
                                <a href="https://volvoforums.com/forum/">Volvo - volvoforums.com</a>
                            </div>
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
