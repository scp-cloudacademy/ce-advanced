<?php

session_start();
echo 'PHP session ID: ';
echo session_id();
echo '<br />';

$count = isset($_SESSION['count']) ? $_SESSION['count'] : 1;
echo 'Count: ';
echo $count;
echo '<br />';
$_SESSION['count'] = ++$count;

?>