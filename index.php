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
    </div>

    <footer style ="margin: auto; background-color: #343A40;display: flex" >
			
				<div class="footerNapis" style ="display: inline-block;  color:#C0F0C0; margin: auto auto auto 20px;">
					 Wykonane przez koło akademickie AKAI 2020 &copy
				</div>
			
				<div class="logos" style="margin-left: auto">
					
					<div class="logoPP" style="display: inline-block; padding: 15px; padding-right: 45px; padding-bottom: 10px; float: right;">
						<figure>
							<a href="https://www.put.poznan.pl/" target="_blank" style="color:#C0F0C0;"><img style="height: 60px;" src="assets/ppLogo.png"></a>
						</figure>

					</div>
					
					<div class="logoGIT" style="display: inline-block; padding: 15px; padding-right: 21px; padding-bottom: 0px; float: right;">
						<figure>
							<a href="https://github.com/akai-org/AKAI-generator-wnioskow" target="_blank" style="color:#C0F0C0;"><img style="width: 60px; height: 60px;" src="assets/githubLogo.png">
							<figcaption style="text-align: center; font-size: 10px; line-height: 100%; margin: 0px; padding-top: 3px; color:#C0F0C0; ">Repozytorium</br>projektu</figcaption></a>
						</figure>
					</div>
					
					<div class="logoAKAI" style="display: inline-block; padding: 15px; padding-right: 21px; padding-bottom: 0px; float: right;">
						<figure>
							<a href="https://akai.org.pl/" target="_blank" style="color:#C0F0C0;"><img style="width: 60px; height: 60px;" src="assets/akaiLogo.png">
							<figcaption style="text-align: center; margin: 0px; ">AKAI</figcaption></a>
						</figure>
					</div>	
				

									
				</div>

		</footer>

    <script src="index.js"></script>
</body>

        
        
                <div style="margin-left: 50px; margin-top: 200px;">
                   
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
                    
                    <input class = "wideField" type = text name = "achievement[0][name]">
                    <input type = date name = "achievement[0][startDate]">
                    - <input type = date name = "achievement[0][endDate]"><br>
                    
                    <input class = "wideField" type = text name = "achievement[1][name]">
                    <input type = date name = "achievement[1][startDate]">
                    - <input type = date name = "achievement[1][endDate]"><br>
                    
                    <input class = "wideField" type = text name = "achievement[2][name]">
                    <input type = date name = "achievement[2][startDate]">
                    - <input type = date name = "achievement[2][endDate]"><br>
                    <hr>                    
                    
                    <input type="submit" value = "Wygeneruj" />
                         </form></div>

		<hr>
		
		
		
    </body>
</html>