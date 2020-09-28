<?php
error_reporting(0);

require_once 'FileSaver.php';

if($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST)) {
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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <meta charset="utf-8">

        <title>AKAI 2020</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <style>
        .wideField
            {
                width: 400px;
            }
        </style>
    </head>
    <body>
        
         <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <pre class="navbar-brand">AKAI 2020 - wniosek o stypendium</pre>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

    </nav>
        
        
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
		
		<footer style ="margin-left: auto; margin-right: auto; background-color: #343A40; " >
			
				<div class="footerNapis" style ="display: inline-block;  color:#A0F0A0; padding-top: 20px; padding-bottom: 20px; padding-left:30px;">
				 Wykonane przez koło akademickie AKAI 2020 &copy
				</div>
				
				
				<div class="logo" style="display: inline-block; padding: 15px; padding-right: 45px; padding-bottom: 0px; float: right;">
					
					<figure>
						<a href="https://www.put.poznan.pl/" target="_blank" style="color:#90E090;"><img style="width: 60px; height: 60px;" src="assets/ppLogo.png">
						<figcaption style="text-align: center; font-size: 10px; line-height: 100%; margin: 0px; padding-top: 3px; color:#90E090; ">Politechnika</br> Poznańska</figcaption></a>
					</figure>
					
				</div>
				
				<div class="logo" style="display: inline-block; padding: 15px; padding-right: 25px; padding-bottom: 0px; float: right;">
					<figure>
						<a href="https://akai.org.pl/" target="_blank" style="color:#90E090;"><img style="width: 60px; height: 60px;" src="assets/akaiLogo.png">
						<figcaption style="text-align: center; margin: 0px; ">AKAI</figcaption></a>
					</figure>
				</div>		
				
				<div class="bottomFooter" style ="margin-left: auto; margin-right: auto; height: 50px; background-color: #343A50; ">
					<div class="bottomFooterText" style =" color:#90E090; opacity: 90%; font-size: 13px; padding-top: 5px; padding-bottom: 20px; padding-left:50px;">
					Link do repozytorium projektu: <a href="https://github.com/akai-org/AKAI-generator-wnioskow?fbclid=IwAR2Df0qBYjp_-UCWiyoccz9WT28D5rhQnDXo9Xk8Kknvh0wapOvADCpoTgA" target="_blank" style =" color:#90E090;">tutaj</a>
				
					</div>
				</div>
			

		<footer>
    </body>
</html>