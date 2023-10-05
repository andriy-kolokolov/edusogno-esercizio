<?php

use Util\DbUtil;

require_once 'autoload.php'; // automate use of 'require' where needed
require_once 'session.php'; // init session

DbUtil::runMigrations(); // running if tables don't exist