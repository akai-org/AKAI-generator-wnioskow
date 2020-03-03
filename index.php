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
                   
                <form action="generate.php" method="post" >
                   Imię i Nazwisko: <br><input type="text" name="name" /><br>
                   Indeks: <br><input type="number" name="indeks" /><br>
                    
                    <br><br>
                    
                    Semestry członkostwa: <br>
                    
                    <input type="text" name="firstSemester" /> (np.: zimowy 2019/2020) <br>
                    <input type="text" name="secondSemester" /><br>
                    
                    <br> Działania w trakcie podanych semestrów: <br>
                    
                    <input class = "wideField" type = text name = "achivement1"> 
                    <input type = date name = "date11">
                    - <input type = date name = "date12"><br>
                    
                    <input class = "wideField" type = text name = "achivement2"> 
                    <input type = date name = "date21">
                    - <input type = date name = "date22"><br>
                    
                    <input class = "wideField" type = text name = "achivement3"> 
                    <input type = date name = "date31">
                    - <input type = date name = "date32"><br>
                    <hr>                    
                    
                    <input type="submit" value = "Wygeneruj" />
                         </form></div>


        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>