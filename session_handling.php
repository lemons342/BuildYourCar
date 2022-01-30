<?php
session_start();

# Redirects current page to login.php if user is not logged in.
function ensure_logged_in() {
  if (!isset($_SESSION["name"])) {
    redirect("login.php", "You must log in before you can view that page.");
  }
}

# Redirects to home.php if user is not an admin.
function ensure_admin($id) {
    echo "checking admin";
  if (($id != 0)) {
    echo "running admin check";
    redirect("home.html", "You must be an admin to view that page.");
  }
}

# Redirects current page to the given URL and optionally sets flash message.
function redirect($url, $flash_message = NULL) {
  if ($flash_message) {
    $_SESSION["flash"] = $flash_message;
  }
  
  header("Location: $url");
  die;
}

?>