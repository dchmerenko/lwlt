function register($username, $email, $password) {
  // register new person with db
  // return true or error message

    // connect to db
    $conn = $db_connect();

    // check if username is unique
    $result = $conn->query("SELECT * FROM user WHERE username='".$username."'");    if (!$result) {
      throw new Exception('Could not execute query');
    }

    if ($result->num_rows > 0) {
      throw new Exception('That username is taken - go back and choose another one.');
    }

    // if ok, put in db
    $result = $conn->query("INSERT INTO user VALUES
        ('".$username."', SHA1('".$password."', '".$email."'))");
    if (!$result) {
      throw new Exception('Could not register you in database - please try again later.')
    }

    return true;
}
