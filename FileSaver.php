<?php

require_once 'vendor/tecnickcom/tcpdf/tcpdf.php';

class FileSaver
{
    private $name;
    private $index;
    private $semesters;
    private $achievements;

    private $timezone;
    private $date;
    private $filename;
    private $directoryName;
    private $function;
    private $leader;
    private $semestersPluralSingular;

    public function __construct(String $directory)
    {
        $this->timezone = date_default_timezone_get();
        $this->date = date("d/m/Y", time());
        $this->filename = date('dmYgis', time());
        $this->directoryName = $directory;
    }

    public function acceptData(array $array):void {
        if (isset($array["name"])) $this->name = $array["name"];
        if (isset($array["index"])) $this->index = $array["index"];
        if (isset($array["semesters"])) $this->semesters = $array["semesters"];
        (isset($array["semesters"][0]) && !empty($array["semesters"][0]) &&
            isset($array["semesters"][1]) && !empty($array["semesters"][1]))?
            $this->semestersPluralSingular = "semestrach":
            $this->semestersPluralSingular = "semestrze";
        if (isset($array["achievements"])) $this->achievements = $array["achievements"];
        if (isset($array["function"])) $this->function = $array["function"];
        if (isset($array["leader"])) $this->leader = $array["leader"];
    }

    public function saveFiles(): void {
        $baseName = $this->directoryName . DIRECTORY_SEPARATOR . $this->filename;
        $this->savePdf($baseName);
    }

    private function savePdf(string $baseName)
    {
        $pageOrientation = 'P';
        $measureUnit = "mm";
        $format = "A4";
        $marginY = 7;
        $marginX = 12;
        $isUnicode = true;
        $encoding = 'UTF-8';
        $diskCache = false;
        $creator = "AKAI";
        $author = $this->name;
        $title = "Zaświadczenie";
        $subject = "Zaświadczenie o przynależności do koła naukowego";

        $pdf = new TCPDF($pageOrientation, $measureUnit, $format, $isUnicode, $encoding, $diskCache);
        $pdf->SetCreator($creator);
        $pdf->SetAuthor($author);
        $pdf->SetTitle($title);
        $pdf->SetSubject($subject);
        $pdf->SetFont('dejavusans', '', 14, '', true);


        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->SetMargins($marginX, $marginY, $marginX);
        $pdf->SetAutoPageBreak(TRUE, $marginY);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setFontSubsetting(true);

        $pdf->SetFont('dejavusans', '', 14, '', true);
        $pdf->AddPage();
        $img_file = 'assets/polibuda.jpg';
        $pdf->setAlpha(0.1);
        $pdf->Image($img_file, 15, 80, 180, 180, '', '', '', false, 300, '', false, false, 0);
        $pdf->setAlpha(1);
        $html = $this->composeHtml();
        $pdf->writeHTML($html);



        $pdf->Output($baseName.'.pdf', 'I');
    }

    public function getPdfFile()
    {
        return $this->directoryName . DIRECTORY_SEPARATOR . $this->filename . ".pdf";
    }

    private function composeHtml()
    {
        $html = $this->crerateHeader();
        $html .= $this->createTitle();
        $html .= $this->createContent();
        $html .= $this->createFooter();
        return $html;
    }

    private function crerateHeader()
    {
        $html = '<table>
                     <tr>
                         <td>
                             <img src="assets/polibuda.jpg" width="100" height="100"/>
                         </td>
                         <td colspan="4" style="text-align: center;">
                              <div style="font-size: 24px; font-weight: bold">Politechnika Poznańska</div>
                              <div style="">Wydział Informatyki i Telekomunikacji</div>                         
                         </td>
                         <td></td>
                     </tr>
                 </table>';
        $html .= "<hr>";
        return $html;
    }

    private function createTitle()
    {
        $html = '<table>
                    <tr>
                        <td> </td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-size: 12px;">
                            Poznań, dnia ' . $this->date . '
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">
                            <h6>Zaświadczenie o przynależności do</h6>
                            <span style="font-size: 18px; font-weight: bold;">Akademickiego koła aplikacji internetowych</span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                </table>';
        return $html;
    }

    private function createContent()
    {
        $html = '<table>
                    <tr>
                        <td>
                            Zaświadcza się, że student/ka ' . $this->name . ' (nr albumu: ' . $this->index . ') 
                            był/a członkiem Akademickiego Koła Aplikacji Internetowych w ' . $this->semestersPluralSingular . ': ';
                            foreach ($this->semesters as $key => $semester) {
                                $html .= $semester;
                                if($key != sizeof($this->semesters)-1) {
                                    $html .= ", ";
                                }
                            }
                            $html .= '
                         </td>
                     </tr>';
        
                     $html .= '
                     <tr>
                        <td></td>
                     </tr>
                     <tr>
                        <td>Funkcja: ' . $this->function . '</td>
                     </tr>
                     <tr>
                        <td></td>
                     </tr>
                     <tr>
                        <td>Działania:</td>
                     </tr>';
         foreach($this->achievements as $key => $achievement) {
             $html .= "<tr><td></td></tr>";
             $html .= '<tr><td>' . ($key+1) . '. ' . $achievement['name'] . ' (od: ' . $achievement['startDate'] . ' do ' . $achievement['endDate'] . ') </td></tr>';
         }
         $html .= '</table>';
        return $html;
    }

    private function createFooter()
    {
        $html = '<table><tr><td></td><td></td><td></td></tr>';
        $html .= '<tr><td></td><td></td><td></td></tr>';
        $html .= '<tr style="text-align: center">
                    <td>Przewodniczący</td>
                    <td></td>
                    <td>Opiekun</td>
                  </tr>';
        $html .= '<tr><td></td><td></td><td></td></tr>';
        $html .= '<tr style="text-align: center">
                    <td>' . $this->leader . '</td>
                    <td></td>
                    <td>dr hab. inż. Mikołaj Morzy, prof. PP</td>
                  </tr>';
        $html .= '<tr><td></td><td></td><td></td></tr>';
        $html .= '<tr><td style="text-align: center;">....................................</td><td></td><td style="text-align: center;">....................................</td></tr>';
        $html .= '</table>';
        return $html;
    }
}