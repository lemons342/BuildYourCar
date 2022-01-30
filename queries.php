<?php
    //include("session_handling.php");

//Retrieves logged user ID
function get_userID($id) {
  global $db;

  try {
    $query = "SELECT id FROM Users WHERE username = '" . $id . "'";
    $stmts = $db->query($query);
    foreach ($stmts as $stmt) {
        return  $stmt['id'];
    }
  } catch (PDOException $e) {
    db_disconnect();
    exit("Aborting: There was a database error when retrieving session ID.");
  }
}

//Inserts or modifies build name
function modify_buildName($id, $myname) {
  global $db;
  $query = null;
  try {
    if (get_buildName($id) == null) {   //if not buildName by id...add buildname
        $query = "INSERT INTO buildName(id, name) VALUES (?,?)";
    } else {                            //else, update existing build name
        $query = "UPDATE buildName SET id=(?), name=(?) WHERE id = " . $id . "";
    }
    $stmt = $db->prepare($query);
    $stmt->execute([$id, $myname]);
    return $db->lastInsertId();
  } catch (PDOException $e) {
      db_disconnect();
      exit("Aborting: There was a database error when inserting a new build name. ");
  }
}

//Retrieves build name from server
function get_buildName($id) {
  global $db;

  try {
    $query = "SELECT name FROM buildName WHERE id = " . $id . "";
    $stmts = $db->query($query);
    foreach ($stmts as $stmt) {
        return $stmt['name'];
    }
  } catch (PDOException $e) {
    db_disconnect();
    exit("Aborting: There was a database error when getting build name.");
  }
}

//Adds or changes image to database
function modify_image($id, $fileName) {
  global $db;
  $query = null;
  try {
    if (get_buildName($id) == null) {   //if not buildName by id...add buildname
        $query = "INSERT into images (id, file_name, uploaded_on) VALUES (?,?,?)";
        echo "attempting database insertion";
    } else {                            //else, update existing build name
        $query = "UPDATE images SET id=(?), file_name=(?), uploaded_on=(?) WHERE id = " . $id . "";
    }
    $stmt = $db->prepare($query);
    $stmt->execute([$id, $fileName, NOW()]);
    return $db->lastInsertId();
  } catch (PDOException $e) {
      db_disconnect();
      exit("Aborting: There was a database error when uploading the image. ");
  }
}

//Retrieves image from database
function get_image($id) {
  global $db;

  try {
    $query = "SELECT file_name FROM images WHERE id = " . $id . "";
    $stmts = $db->query($query);
    foreach ($stmts as $stmt) {
        $imageURL = 'images/'.$stmt['file_name'];
    }
    ?>
    <img src="<?php echo $imageURL; ?>" alt="upload" id="upload"/>
    <?php
  } catch (PDOException $e) {
    db_disconnect();
    exit("Aborting: There was a database error when getting image.");
  }
}

//Adds or updates part in database
function update_part($id, $category, $name, $url, $quantity, $price, $importance) {
  global $db;
  
  try {
    if (duplicate_part($url) == null) {   //if not buildName by id...add buildname
        $query = "INSERT INTO parts(id, category, name, url, quantity, price, importance) VALUES (?,?,?,?,?,?,?)";
    } else {                            //else, update existing build name
        $query = "UPDATE parts SET ID=(?),category=(?),name=(?),url=(?),quantity=(?),price=(?),importance=(?) WHERE url ='" . $url . "'";
    }
    $stmt = $db->prepare($query);
    $stmt->execute([$id, $category, $name, $url, $quantity, $price, $importance]);
    return $db->lastInsertId();
  } catch (PDOException $e) {
      db_disconnect();
      exit("Aborting: There was a database error when inserting a new part.");
  }
}

//Checks if part already exists in database using URL value
function duplicate_part($url) {
  global $db;

  try {
    $query = "SELECT url FROM parts WHERE url = '" . $url . "'";
    $stmt = $db->prepare($query);
    $stmt->execute();
    return  $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    db_disconnect();
    exit("Aborting: There was a database error when getting existing parts.");
  }
}

//Retrieves parts from database
function get_parts($category, $id) {
  global $db;

  try {
    $query = "SELECT partID, category, name, url, quantity, price, importance FROM parts WHERE category = '" . $category . "' AND id = '" . $id . "'";
    $stmt = $db->prepare($query);
    $stmt->execute();
    return  $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    db_disconnect();
    exit("Aborting: There was a database error when getting existing parts.");
  }
}

function delete_part($partID) {
  global $db;

  try {
    $query = "DELETE FROM parts WHERE partID = " . $partID . "";
    $stmt = $db->prepare($query);
    $stmt->execute();
    return  $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    db_disconnect();
    exit("Aborting: There was a database error when deleting the part.");
  }
}

//Retrieves total dollar amount for build list from database
function get_total($id) {
  global $db;

  try {
    $query = "SELECT price FROM parts WHERE id = " . $id . "";
    $stmts = $db->query($query);
    $total = 0;
    foreach ($stmts as $stmt) {
        $total += $stmt['price'];
    }
    return number_format($total, 2);
  } catch (PDOException $e) {
    db_disconnect();
    exit("Aborting: There was a database error when getting build name.");
  }
}

//Adds or changes links for links page in database
function modify_links($links) {
  global $db;
  $query = null;
  try {
    if (get_links() == null) {   //if not buildName by id...add buildname
        $query = "INSERT INTO Links(content) VALUES (?)";
    } else {                            //else, update existing build name
        $query = "UPDATE Links SET content=(?)";
    }
    $stmt = $db->prepare($query);
    $stmt->execute([$links]);
    return $db->lastInsertId();
  } catch (PDOException $e) {
      db_disconnect();
      exit("Aborting: There was a database error when updating links. ");
  }
}

//Retrieves links for link page in database
function get_links() {
  global $db;

  try {
    $query = "SELECT content FROM Links";
    $stmts = $db->query($query);
    foreach ($stmts as $stmt) {
        return $stmt['content'];
    }
  } catch (PDOException $e) {
    db_disconnect();
    exit("Aborting: There was a database error when retrieving links.");
  }
}

?>
