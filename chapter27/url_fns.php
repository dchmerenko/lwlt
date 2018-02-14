function add_bm($new_url) {
  // Add new bookmark to the database

  echo "Attempting to add ".htmlspecialchars($new_url)."<br>";
  $valid_user = $_SESSION['valid_user'];

  $conn = db_connect();

  // check not a repeat bookmark
  $result = $conn->query("SELECT * FROM bookmark
                          WHERE username='".$valid_user."'
                          AND bm_URL='".$new_url."'
                         ");
  if ($result && ($result->num_rows > 0)) {
    throw new Exception('Bookmark already exists.');
  }

  // insert the new bookmark
  if (!$conn->query("INSERT INTO bookmark
                     VALUES ('".$valid_user."', '".$new_url."')
                    ")) {
    throw new Exception('Bookmark could not be inserted.');                   
  }

  return true;
}

function get_user_urls($username) {
  // extract from the database all the URLs this user has stored

  $conn = db_connect();
  $result = $conn->query("SELECT bm_URL
                          FROM bookmark
                          WHERE username='".$username."'
                         ");
  if (!$result) {
    return false;
  }

  // create an  array of the URLs
  $url_array = array();
  for ($count = 1; $row = $result->fetch_row(); ++$count) {
    $url_array[$count] = $row[0];
  }
  return $url_array;
}
