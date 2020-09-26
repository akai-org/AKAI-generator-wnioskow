<?php
error_reporting(0);

require_once 'FileSaver.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST)) {
    $fileSaver = new FileSaver();
    $fileSaver->acceptData([
        "name" => $_POST["name"],
        "index" => $_POST["index"],
        "function" => $_POST["function"],
        "leader" => $_POST["leader"],
        "semesters" => $_POST["semester"],
        "achievements" => $_POST["achievement"]
    ]);
    $fileSaver->saveFiles();
    header($fileSaver->getPdfFile());
    die();
}
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <title>AKAI 2020</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="style/style.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar">
        <header class="navbar-brand">AKAI 2020 - wniosek o stypendium</header>
    </nav>

    <div class="form-container">

        <form class="form" action="index.php" method="post">
            <label>Imię i Nazwisko: <br /><input type="text" name="name" /></label>
            <label>Indeks: <br /><input type="number" name="index" /></label>
            <label>Funkcja: <br /><input type="text" name="function" /></label>
            <label>Przewodniczący: <br /><input type="text" name="leader" /></label>

            <label>Semestry członkostwa: <br />
                <input type="text" name="semester[]" /> (np.: zimowy 2019/2020) <br />
                <input type="text" name="semester[]" /><br /></label>

            <p>Działania w trakcie podanych semestrów: </p>

            <div class="achievement-field">
                <textarea class="wideField" name="achievement[0][name]" cols="30" rows="5"></textarea>
                <div class="achievement-field-dates"><input type=date name="achievement[0][startDate]">
                    <span> - </span> <input type=date name="achievement[0][endDate]"></div>
            </div>

            <input type="submit" value="Wygeneruj" />
        </form>
    </div>

    <hr>
</body>

</html>