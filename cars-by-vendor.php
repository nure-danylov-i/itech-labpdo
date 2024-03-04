<?php
require("connect.php");

$vendor = $_REQUEST['vendor'];
$sql = "SELECT Name, Release_date FROM `cars` WHERE FID_Vendors = (SELECT vendors.ID_Vendors from `vendors` WHERE vendors.Name = :vendor);";
//$sql = "SELECT ID_Cars, Name FROM `cars`";
$sth = $dbh->prepare($sql);
$sth->bindValue(':vendor', $vendor);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

if (!empty($result))
{
    echo "<p>Автомобілі виробника <b>$vendor</b>:</p>";
    echo "<table border='1'>";
    echo "<tr><th>Назва автомобіля</th><th>Рік випуску</th></tr>";
    
    foreach ($result as $row)
    {
        echo "<tr><td>{$row['Name']}</td><td>{$row['Release_date']}</td></tr>";
    }
    echo "</table>";
}
else
{
    echo "За заданими параметрами немає результатів";
}

$dbh = null;
