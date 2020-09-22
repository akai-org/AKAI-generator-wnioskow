<?php

include_once 'defines.php';

class FileSaver
{
    private $name;
    private $index;
    private $semesters;
    private $achievements;

    private $template;
    private $timezone;
    private $date;
    private $filename;
    private $directoryName;
    private $function;
    private $leader;

    public function __construct(String $directory)
    {
        $this->template = new \PhpOffice\PhpWord\TemplateProcessor('sample.docx');
        $this->timezone = date_default_timezone_get();
        $this->date = date("d/m/Y", time());
        $this->filename = date('dmYgis', time());
        $this->directoryName = $directory;
    }

    public function acceptData(array $array):void {
        if (isset($array["name"])) $this->name = $array["name"];
        if (isset($array["index"])) $this->index = $array["index"];
        if (isset($array["semesters"])) $this->semesters = $array["semesters"];
        if (isset($array["achievements"])) $this->achievements = $array["achievements"];
        if (isset($array["function"])) $this->function = $array["function"];
        if (isset($array["leader"])) $this->leader = $array["leader"];
        $this->fillTemplate();
    }

    public function saveFiles(): void {
        $baseName = $this->directoryName . DIRECTORY_SEPARATOR . $this->filename;
        $this->saveDocx($baseName);

        $this->savePdf($baseName);
    }

    private function saveDocx(String $name)
    {
        $this->template->saveAs($name . ".docx");
    }

    private function savePdf(String $name)
    {
        \PhpOffice\PhpWord\Settings::setPdfRendererPath('vendor/tecnickcom/tcpdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererName('TCPDF');

        $file = \PhpOffice\PhpWord\IOFactory::load($name.".docx");
        $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($file, 'PDF');
        $xmlWriter->save($name . ".pdf");
    }

    public function getDocxFile()
    {
        return $this->directoryName . DIRECTORY_SEPARATOR . $this->filename . ".docx";
    }

    public function getPdfFile()
    {
        return $this->directoryName . DIRECTORY_SEPARATOR . $this->filename . ".pdf";
    }

    private function fillTemplate()
    {
        $this->fillBasicData();
        $this->fillSemesters();
        $this->fillAchievements();
    }

    private function fillBasicData()
    {
        $this->template->setValue('date', $this->date);
        $this->template->setValue('name', $this->name);
        $this->template->setValue('indexNumber', $this->index);
        $this->template->setValue('function', $this->function);
        $this->template->setValue('leader', $this->leader);
    }

    private function fillSemesters()
    {
        $this->template->setValue('firstSemester', $this->semesters[0]);
        $this->template->setValue('secondSemester', $this->semesters[1]);

        if(isset($this->semesters[0]) && isset($this->semesters[1])) {
            $this->template->setValue('semestrze', "semestrach");
        }
        else $this->template->setValue('semestrze', "semestrze");
    }

    private function fillAchievements()
    {
        $achievementNames = array_keys($this->achievements);
        $this->template->setValue('achivement1', $achievementNames[0]);
        $this->template->setValue('achivement2', $achievementNames[1]);
        $this->template->setValue('achivement3', $achievementNames[2]);

        if($this->achievements[$achievementNames[0]]["startDate"]!="")
        {
            $this->template->setValue('date11', date('d/m/Y', strtotime($this->achievements[$achievementNames[0]]["startDate"])));
        }
        else $this->template->setValue('date11', "");
        if($this->achievements[$achievementNames[0]]["endDate"]!="")
        {
            $this->template->setValue('date12', date('d/m/Y', strtotime($this->achievements[$achievementNames[0]]["endDate"])));
        }
        else $this->template->setValue('date12', "");
        if($this->achievements[$achievementNames[1]]["startDate"]!="")
        {
            $this->template->setValue('date21', date('d/m/Y', strtotime($this->achievements[$achievementNames[1]]["startDate"])));
        }
        else $this->template->setValue('date21', "");
        if($this->achievements[$achievementNames[1]]["endDate"]!="")
        {
            $this->template->setValue('date22', date('d/m/Y', strtotime($this->achievements[$achievementNames[1]]["endDate"])));
        }
        else $this->template->setValue('date22', "");
        if($this->achievements[$achievementNames[2]]["startDate"]!="")
        {
            $this->template->setValue('date31', date('d/m/Y', strtotime($this->achievements[$achievementNames[2]]["startDate"])));
        }
        else $this->template->setValue('date31', "");
        if($this->achievements[$achievementNames[2]]["endDate"]!="")
        {
            $this->template->setValue('date32', date('d/m/Y', strtotime($this->achievements[$achievementNames[2]]["endDate"])));
        }
        else $this->template->setValue('date32', "");
    }
}