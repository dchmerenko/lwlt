<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Site Submission Result</title>
</head>
<body>
  <h1>Site Submission Result</h1>

  <?php
  // Extract from fields
  $url = $_POST['url'];
  $email = $_POST['email'];

  // Check the URL
  $url = parse_url($url);
  $host = $url['host'];

  if (!($ip = gethostbyname($host))) {
    echo 'Host for URL does not have valid IP address.';
    exit;
  }

  echo 'Host ('.$host.') is at IP '.$ip.'<br>';

  // Check the email address
  $email = explode('@', $email);
  $emailhost = $email[1];

  if (!getmxrr($emailhost, $mxhostsarr)) {
    echo 'Email address is not at valid host.';
    exit;
  }

  echo 'Email is delivered via: <br>
  <ul>';
  
  foreach ($mxhostsarr as $mx) {
    echo '<li>'.$mx.'</li>';
  }
  echo '</ul>';

  // if reached here, all is ok
  echo '<p>All submitted details are ok.</p>';
  echo '<p>Thank you for submitting your site.
        It will be visited by one of our staff members soon.</p>';
  ?>

</body>
</html>
