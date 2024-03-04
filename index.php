<html lang="uk-UA">
    <head>
	<title>Лабораторна з PDO</title>
    </head>
    <body>
<p>
<form action="income-by-date.php" method="get">
    <label for="date">Отриманий дохід з прокату станом на обрану дату:</label>
    <br>
    <input type="date" name="date" id="date" value="2014-09-01">
    <input type="time" name="time" id="time" value="11:00">
    <button type="submit">Отримати</button>
</form>
</p>

<p>
<form action="cars-by-vendor.php" method="get">
    <label for="vendor">Автомобілі за назвою виробника:</label>
    <br>
<select name="vendor" id="vendor">
<?php
require("connect.php");
$sql = "SELECT Name FROM `vendors`";
foreach ($dbh->query($sql) as $vendor)
{
    echo "<option value='{$vendor['Name']}'>{$vendor['Name']}</option>";
}
$dbh = null;
?>
</select>
    <button type="submit">Отримати</button>
</form>
</p>

<p>
<form action="cars-by-date-free.php" method="get">
    <label for="date">Вільні автомобілі на обрану дату:</label>
    <br>
    <input type="date" name="date" id="date" value="2014-08-12">
    <input type="time" name="time" id="time" value="08:59">
    <button type="submit">Отримати</button>
</form>
</p>
</body>

