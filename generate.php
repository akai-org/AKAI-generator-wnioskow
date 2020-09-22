<?php

echo '<head> <title>AKAI 2020</title>  </head>';

error_reporting(0);

use PhpOffice\PhpWord\Element\Section;
use PhpOffice\PhpWord\Shared\Converter;

include_once 'defines.php';
include_once 'DocumentDirectoryOperator.php';
include_once 'FileSaver.php';

//DELETE OLD FILES
$directoryName = "outputFiles";
$directoryOperator = new DocumentDirectoryOperator($directoryName);
if(!$directoryOperator->directoryExists()) {
    $directoryOperator->createDirectory();
}
$directoryOperator->removeOlderThan($minutes = 60);
//------------------------

$fileSaver = new FileSaver($directoryName);
$fileSaver->acceptData([
    "name" => $_POST["name"],
    "index" => $_POST["indeks"],
    "function" => $_POST["function"],
    "leader" => $_POST["leader"],
    "semesters" => [
        $_POST["firstSemester"],
        $_POST["secondSemester"]
    ],
    "achievements" => [
        $_POST["achivement1"] => [
            "startDate" => $_POST["date11"],
            "endDate" => $_POST["date12"]
        ],
        $_POST["achivement2"] => [
            "startDate" => $_POST["date21"],
            "endDate" => $_POST["date22"]
        ],
        $_POST["achivement3"] => [
            "startDate" => $_POST["date31"],
            "endDate" => $_POST["date32"]
        ]
    ]
]);
$fileSaver->saveFiles();

echo '<a href="' .$fileSaver->getDocxFile() . '" class="btn btn-primary" style="margin: 20px;">Pobierz jako docx</a>';
echo '<a href="index.php" class="btn btn-primary">Powrót</a>';