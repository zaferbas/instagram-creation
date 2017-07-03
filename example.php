<?php

require 'src/Create.class.php';

$app = new InstagramWebCreate();
# ->create(username, email, password, name) - set null to random :)
$app->shuffle()->create(null, null, 'contohcustomhehe123', null, function($error, $data) {
  if($error) echo $data; # $data contains error code
  else {
    # $data contains : username, email, password, name
    echo "Successfully created a account, username:password = " . $data['username'] . ":" . $data['password'];
  }
});
