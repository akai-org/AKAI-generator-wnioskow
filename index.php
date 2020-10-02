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

            <label class="semesters">Semestry członkostwa: <br />
                <input type="text" name="semester[]" placeholder="np.: zimowy 2019/2020" /><br />
                <input type="text" name="semester[]" /><br /></label>

            <p>Działania w trakcie podanych semestrów: </p>

            <div class="achievement-container">
                <div class="achievement-field">
                    <textarea class="wideField" name="achievement[0][name]" cols="30" rows="5"></textarea>
                    <div class="achievement-field-dates"><input type=date name="achievement[0][startDate]">
                        <span> - </span> <input type=date name="achievement[0][endDate]"></div>
                </div>
            </div>

            <span class="add-achievement-button">Dodaj osiągnięcie</span>

            <input type="submit" value="Wygeneruj" />
        </form>

        <img class="logo" src="/assets/polibuda.jpg" alt="logo politechniki">
    </div>

    <footer class="footer">Created by <a href="https://akai.org.pl" target="blank"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="189.211px" height="211.778px" viewBox="0 0 189.211 211.778" enable-background="new 0 0 189.211 211.778" xml:space="preserve">
                <g>
                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FAA21B" d="M45.2,21.895c24.751,0,44.853,19.896,45.192,44.566H90.4v0.634
		v45.2H45.2h-0.517v-0.006C19.958,112.011,0,91.886,0,67.095C0,42.131,20.237,21.895,45.2,21.895L45.2,21.895z M45.102,40.259
		c-14.447,0-26.159,12.015-26.159,26.835c0,14.718,11.55,26.667,25.86,26.832v0.003h0.299h26.159V67.095v-0.376h-0.005
		C71.06,52.071,59.426,40.259,45.102,40.259z" />
                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#001936" d="M45.2,210.766c24.751,0,44.853-19.896,45.192-44.566H90.4v-0.634
		v-45.2H45.2h-0.517v0.006C19.958,120.65,0,140.775,0,165.566C0,190.528,20.237,210.766,45.2,210.766L45.2,210.766z M45.102,192.401
		c-14.447,0-26.159-12.015-26.159-26.835c0-14.718,11.55-26.667,25.86-26.832v-0.003h0.299h26.159v26.835v0.376h-0.005
		C71.06,180.589,59.426,192.401,45.102,192.401z" />
                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#001936" d="M98.542,0.008c9-0.204,17.93,3.545,19.049,20.216v38.209h28.107
		c19.462-0.382,25.341-20.076,24.511-35.74h18.93c0.93,25.328-7.374,37.651-18.424,44.506c11.051,6.855,19.354,19.178,18.424,44.506
		h-18.93c0.92-17.349-2.17-30.688-23.86-35.727l-28.759,0.162v18.261c-7.856,0.787-10.332,0.971-19.049,9.653V0.008z" />
                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FAA21B" d="M117.863,117.782v-17.263c-9.81,0-17.839,7.62-18.496,17.263
		l-0.044,1.276v17.263c9.81,0,17.839-7.62,18.495-17.263L117.863,117.782z" />
                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#001936" d="M170.043,120.958h18.579l-0.031,36.897
		c-0.656,9.644-8.686,17.263-18.496,17.263v-17.263L170.043,120.958z" />
                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#001936" d="M99.522,142.71c8.802-0.187,15.365-4.473,18.577-9.317
		l-0.031,61.122c-0.656,9.644-8.686,17.263-18.496,17.263v-17.263L99.522,142.71z" />
                </g>
            </svg></a>
    </footer>

    <script src="index.js"></script>
</body>

</html>