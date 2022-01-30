
<?php
    include("session_handling.php");
    ensure_logged_in(); //makes sure user is logged in before using build list


    include('./initialize.php');
    $id = get_userID($_SESSION["name"]);
    $delete = array();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //Inserts or updates parts
        if ($_POST['category'] == null OR $_POST['name'] == null OR $_POST['url'] == null OR $_POST['quantity'] == null OR $_POST['price'] == null) {
            //echo "Please fill every box to add a part to your list.";
        } else {
            update_part($id,$_POST['category'],$_POST['name'],$_POST['url'], $_POST['quantity'], $_POST['price'], $_POST['importance']);
        }

        if(isset($_POST["delete"])) {
            //delete_part($delete);
        }

        //Inserts or updates build name
        if ($_POST['myname'] == null) {
            //echo "Please fill box to add a name to your list.";
        } else {
            modify_buildName($id,$_POST['myname']);
        }

        //Uploading image
        if(isset($_POST["submit"])) {
            echo "attemping image submit--";
            $statusMsg = '';

            // File upload path
            $targetDir = "images/";
            $fileName = basename($_FILES["file"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

            if(!empty($_FILES["file"]["name"])){
                // Allow certain file formats
                $allowTypes = array('jpg','png','jpeg','gif','pdf');
                if(in_array($fileType, $allowTypes)){
                    // Upload file to server
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                        modify_image($id, $fileName);
                    }else{
                        $statusMsg = "Sorry, there was an error uploading your file.";
                    }
                }else{
                    echo $fileType . "--";
                    $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
                }
            }else{
                $statusMsg = 'Please select a file to upload.';
            }

            // Display status message
            echo $statusMsg;
        }
        
    }




    //db_disconnect();
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
        <script src="project.js" defer></script>
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

                <form method="POST" action="build.php" id="add-part" enctype="multipart/form-data">
                <div>
                    <fieldset class="horizontal-controls">
                        <ul>
                            <li>
                                    <label for="myname" id ="left">Build Name:</label>
                                    <input type="text" id="myname" name="myname">
                                    <input type="submit" value="Save">
                                    <h1>
                                     <?php
                                        echo get_buildName($id);//Retrieves build name from database
                                     ?>
                                    </h1>
                                    <b>Total Build Cost: $<?= get_total($id)?></b><span id="price"></span>
                            </li>
                            <li class="upload">
                                
                                    <label for="image" id ="left">Upload Picture:</label>
                                    <input type="file" name="file">
                                    <input type="submit" name="submit" value="Upload">
                                    <?php
                                        get_image($id);//Retrieves image name from database
                                     ?>
                            </li>
                        </ul>
                    </fieldset>

                    <fieldset class="horizontal-controls">
                        <ul>
                            <li>
                                <label for="category">Category</label>
                                <select name="category" size="1">
                                    <option></option>
                                    <option>Engine</option>
                                    <option>Transmission</option>
                                    <option>Suspension</option>
                                    <option>Brakes</option>
                                    <option>Wheels/Tires</option>
                                    <option>Exterior</option>
                                    <option>Interior</option>
                                </select>
                            </li>
                            <li>
                                <label for="name">Part Name</label>
                                <input type="text" id="name" name="name">
                            </li>
                            <li>
                                <label for="url">URL</label>
                                <input type="text" id="url" name="url">
                            </li>
                            <li id="smaller">
                                <label for="quantity">Quantity</label>
                                <input type="number" max="999999" id="quantity" name="quantity">
                            </li>
                            <li id="dollar">$</li>
                            <li id="price">
                                <label for="price">Price</label>
                                <input type="number"  step="any" min="0.00" max="999999.99" id = "partPrice" name="price" oninput="total()" >
                            </li>
                            <li>
                                <label>Importance:</label>
                                <input type="range" name="importance" min="10" max="100" step="15" list="ticks">
                                <!-- tick labels are not supported in Chrome -->
                                <datalist id="ticks">
                                    <option value="10" label="10"></option>
                                    <option value="20"></option>
                                    <option value="30"></option>
                                    <option value="40"></option>
                                    <option value="50" label="50"></option>
                                    <option value="60"></option>
                                    <option value="70"></option>
                                    <option value="80"></option>
                                    <option value="90"></option>
                                    <option value="100" label="100"></option>
                                </datalist>
                            </li>
                            <input type="submit" value="ADD" id="add-btn">
                            <input type="submit" value="UPDATE" id="update-btn">

                        </ul>
                    </fieldset>

                    <fieldset class="horizontal-controls">
                        <legend>Engine</legend>
                        <ul id="parts">
                            <li>
                                <?php
                                    display_parts_table(get_parts('engine',$id));
                                 ?>
                            </li>
                        </ul>
                    </fieldset>

                    <fieldset class="horizontal-controls">
                        <legend>Transmission</legend>
                        <ul id="parts">
                            <li>
                                <?php
                                    display_parts_table(get_parts('transmission',$id));
                                 ?>
                            </li>
                        </ul>
                    </fieldset>

                    <fieldset class="horizontal-controls">
                        <legend>Suspension</legend>
                        <ul id="parts">
                            <li>
                                <?php
                                    display_parts_table(get_parts('suspension',$id));
                                 ?>
                            </li>
                        </ul>
                    </fieldset>

                    <fieldset class="horizontal-controls">
                        <legend>Brakes</legend>
                        <ul id="parts">
                            <li>
                                <?php
                                    display_parts_table(get_parts('brakes',$id));
                                 ?>
                            </li>
                        </ul>
                    </fieldset>

                    <fieldset class="horizontal-controls">
                        <legend>Wheels/Tires</legend>
                        <ul id="parts">
                            <li>
                                <?php
                                    display_parts_table(get_parts('wheels/tires',$id));
                                 ?>
                            </li>
                        </ul>
                    </fieldset>

                    <fieldset class="horizontal-controls">
                        <legend>Exterior</legend>
                        <ul id="parts">
                            <li>
                                <?php
                                    display_parts_table(get_parts('exterior',$id));
                                 ?>
                            </li>
                        </ul>
                    </fieldset>

                    <fieldset class="horizontal-controls">
                        <legend>Interior</legend>
                        </ul>
                        <ul id="parts">
                            <li>
                                <?php
                                    display_parts_table(get_parts('interior',$id));
                                 ?>
                            </li>
                        </ul>
                    </fieldset>
                </form>

            </div>

                    </form>
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

    <?php
        db_disconnect();
    ?>