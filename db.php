<?php

require_once('db_credentials.php');
include('queries.php');

function db_connect() {
  try {
    $dbh = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_SERVER,
				   DB_USER,
				   DB_PWD,
				   array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  } catch (PDOException $e) {
    echo "This application exited with failure " .
		 "because there was an error when trying to " .
		 "connect to its database.";
    exit();
  }
  return $dbh;
}

function db_disconnect() {
  global $db;
  $db = null;
}

$db = db_connect();


# Returns TRUE if given user and password are created in database.
# (If username doesn't already exist and password is valid)
function register($name, $password) {
  global $db;
  $registered = FALSE;
  try {
    $sql = "INSERT INTO Users(username, password) VALUES (?, ?)";
    $statement = $db->prepare($sql);
    $params = [ $name, crypt($password) ];
    $statement->execute($params);
    $registered = TRUE;
  } catch (PDOException $e) {
    echo "ERROR";
    var_dump($e);
  }
  return $registered;
}

# Returns TRUE if given password is correct password for this user name.
function is_password_correct($name, $password) {
  global $db;
  $password_correct = FALSE;
  
  $sql = "SELECT password FROM Users WHERE username = ?";
  $statement = $db->prepare($sql);
  $statement->execute([$name]);
  
  if ($statement) {
    foreach ($statement as $row) {
      $correct_password = $row["password"];
      $password_correct = $correct_password === crypt($password, $correct_password);
      //echo $password, " ", $correct_password, " === ", crypt($password, $correct_password), " "; //debugging
    }
  }
  return $password_correct;
}
?>
