<?php
require("connect.php");

$date = $_REQUEST['date'];
$time = $_REQUEST['time'];
$sql = <<<END
SELECT SUM(Cost) FROM `rent` WHERE :date >= Date_start 
	AND (IF (Date_start = :date, :time >= Time_start, 1));
END;

$sth = $dbh->prepare($sql);
$sth->bindValue(':date', $date);
$sth->bindValue(':time', $time);
$sth->execute();
$result = $sth->fetchAll();

echo "Отриманий дохід станом на <b>$date, $time</b> становить <b>{$result[0][0]}</b>";

$dbh = null;
