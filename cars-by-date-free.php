<?php
require("connect.php");

$date = $_REQUEST['date'];
$time = $_REQUEST['time'];
$sql = <<<END
SELECT Name, Release_date, Race FROM `cars` WHERE ID_Cars NOT IN (
    SELECT FID_Car FROM `rent` WHERE 
    :date >= Date_start # Дата більше або дорівнює даті початку
    AND (IF (Date_start = :date, :time >= Time_start, 1)) # Якщо дата початку співпадає, час початку має бути більше
    AND (:date <= Date_end) # Дата менше або дорівнює даті кінця
    AND (IF (Date_end = :date, :time < Time_end, 1)) # Якщо дата кінця співпадає, час кінця має бути меншее
);
END;
$sth = $dbh->prepare($sql);
$sth->bindValue(':date', $date);
$sth->bindValue(':time', $time);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

if (!empty($result))
{
    echo "<p>Вільні автомобілі станом на <b>$date, $time</b>:</p>";
    echo "<table border='1'>";
    echo "<tr><th>Назва автомобіля</th><th>Рік випуску</th><th>Пробіг</th></tr>";
    
    foreach ($result as $row)
    {
        echo "<tr><td>{$row['Name']}</td><td>{$row['Release_date']}</td><td>{$row['Race']}</td></tr>";
    }
    echo "</table>";
}
else
{
    echo "За заданими параметрами немає результатів";
}

$dbh = null;
