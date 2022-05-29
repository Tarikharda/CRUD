<?php
Session_start();
Session_destroy();
header("Location:user.php");