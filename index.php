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

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <pre class="navbar-brand">AKAI 2020 - wniosek o stypendium</pre>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    </nav>

    <div>

        <form action="index.php" method="post">
            Imię i Nazwisko: <br><input type="text" name="name" /><br>
            Indeks: <br><input type="number" name="index" /><br>
            Funkcja: <br><input type="text" name="function" /><br>
            Przewodniczący: <br><input type="text" name="leader" /><br>
            <br><br>

            Semestry członkostwa: <br>

            <input type="text" name="semester[]" /> (np.: zimowy 2019/2020) <br>
            <input type="text" name="semester[]" /><br>

            <br> Działania w trakcie podanych semestrów: <br>

            <textarea class="wideField" name="achievement[0][name]" cols="30" rows="5"></textarea><br />
            <input type=date name="achievement[0][startDate]">
            - <input type=date name="achievement[0][endDate]"><br>

            <textarea class="wideField" name="achievement[1][name]" cols="30" rows="5"></textarea><br />
            <input type=date name="achievement[1][startDate]">
            - <input type=date name="achievement[1][endDate]"><br>

            <textarea class="wideField" name="achievement[2][name]" cols="30" rows="5"></textarea><br />
            <input type=date name="achievement[2][startDate]">
            - <input type=date name="achievement[2][endDate]"><br>

            <hr>

            <input type="submit" value="Wygeneruj" />
        </form>
    </div>

    <hr>
</body>

</html>