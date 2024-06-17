<?php

use Core\Authenticator;

$auth = new Authenticator;

$auth->logout();

redirect($_POST['old_uri']);
