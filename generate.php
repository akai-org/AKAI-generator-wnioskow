<?php

echo '<head> <title>AKAI 2020</title>  </head>';

error_reporting(0);

use PhpOffice\PhpWord\Element\Section;
use PhpOffice\PhpWord\Shared\Converter;

include_once 'defines.php';

//DELETE OLD FILES
$folderName = "outputFiles";
if (file_exists($folderName)) 
{
    foreach (new DirectoryIterator($folderName) as $fileInfo) 
    {
        if ($fileInfo->isDot()) 
        {
            continue;
        }
        if ($fileInfo->isFile() && time() - $fileInfo->getCTime() >= 1*60*60/*godziny * minuty * sekundy*/) //usuwa pliki starsze niż godzina
        {
            unlink($fileInfo->getRealPath());
        }
    }
}
//------------------------





$template = new \PhpOffice\PhpWord\TemplateProcessor('sample.docx');

$name = $_POST["name"];
$indeks = $_POST["indeks"];
$firstSemester = $_POST["firstSemester"];
$secondSemester = $_POST["secondSemester"];

$ach1 = $_POST["achivement1"];
$date11 = strtotime($_POST["date11"]);
$date12 = strtotime($_POST["date12"]);
$ach2 = $_POST["achivement2"];
$date21 = strtotime($_POST["date21"]);
$date22 = strtotime($_POST["date22"]);
$ach3 = $_POST["achivement3"];
$date31 = strtotime($_POST["date31"]);
$date32 = strtotime($_POST["date32"]);

$timezone = date_default_timezone_get();

$date = date('d/m/Y', time());

$template->setValue('date', $date);
$template->setValue('name', $name);
$template->setValue('indexNumber', $indeks);

$template->setValue('firstSemester', $firstSemester);
$template->setValue('secondSemester', $secondSemester);

if($secondSemester != "")
{
    $template->setValue('semestrze', "semestrach");
}
else $template->setValue('semestrze', "semestrze");
$template->setValue('achivement1', $ach1);
$template->setValue('achivement2', $ach2);
$template->setValue('achivement3', $ach3);

if($date11!="")
{
    $template->setValue('date11', date('d/m/Y',$date11));
}
else $template->setValue('date11', "");
if($date12!="")
{
    $template->setValue('date12', date('d/m/Y',$date12));
}
else $template->setValue('date12', "");
if($date21!="")
{
    $template->setValue('date21', date('d/m/Y',$date21));
}
else $template->setValue('date21', "");
if($date22!="")
{
    $template->setValue('date22', date('d/m/Y',$date22));
}
else $template->setValue('date22', "");
if($date31!="")
{
    $template->setValue('date31', date('d/m/Y',$date31));
}
else $template->setValue('date31', "");
if($date32!="")
{
    $template->setValue('date32', date('d/m/Y',$date32));
}
else $template->setValue('date32', "");

$newFilename = date('dmYgis', time());
$template->saveAs("outputFiles/".$newFilename.".docx"); 

echo '<a href="outputFiles/'.$newFilename.'.docx" class="btn btn-primary" style="margin: 20px;">Pobierz jako docx</a>';
echo '<a href="index.php" class="btn btn-primary">Powrót</a>';