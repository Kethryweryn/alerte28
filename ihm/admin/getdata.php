<?php
require_once('../../dbAccess.php');
$db = new dbAccess();
$rq = "select description from a28_event where id = ".$_GET['id'];
$result = $db->select($rq);

echo $result[0]->description;
