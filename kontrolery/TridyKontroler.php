<?php

require 'vendor/autoload.php';    
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class TridyKontroler extends Kontroler {


    public function zpracuj($parametry) {
        $this->pohled = "tridy";

        $modelTridy= new ModelyTrida;



        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_excel_data']))
{

    $fileName = $_FILES['import_file']['name'];                     //do $fileName se uloží celý název souboru
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);            //do $file_ext se uloží přípony názvů souborů

    $allowed_ext = ['xls','csv','xlsx','XLS','CSV','XLSX'];         //do pole jsou jen povolené přípony názvů souborů

    if(in_array($file_ext, $allowed_ext))                           //srovná se jestli jsou přípony názvů souborů z ($file_ext) mezi povolenýma přípony názvů souborů ($allowed_ext)
    {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];    //jako v $fileName se uloží celý název souboru, ale místo názvu se využije dpčasný název(protože to pohynujem)
        /** Načtení $inputFileName na Spreadsheet objekt **/
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        //$i=0;

        //do pole jsou jen id_tridy
        $allowedTridy = ['I1A','I1B','I1C','E1A','E1B','I2A','I2B','I2C','E2A','E2B','I3A','I3B','I3C','E3A','E3B','I4A','I4B','I4C','E4A','E4B'];

        foreach($data as $row)
        {
                
                $id_trid  = $row['0'];
                $tridni_uc = $row['1'];
                $zkratka_uc = $row['2'];

                /**srovná se jestli jsou $id_trid mezi povolenýma id ($allowed_Tridy) **/
                if(in_array($id_trid, $allowedTridy)){
/*
                    echo $i."<br>";
                    echo  $id_trid;
                    echo "<br>";
                    echo $tridni_uc;
                    echo "<br>";
                    echo $zkratka_uc;
                    echo "<br> <br>";
                    $i++;
*/
                /**vložení do pole jednotlivé atributy**/
                $query = [
                    'id_trid' => $id_trid,
                    'tridni_uc' => $tridni_uc,
                    'zkratka_uc' => $zkratka_uc
                ];
                
                //$pridejTrid= $modelTridy->pridejTridu($query);
                /**volání metody na vložení dat z pole do databáze**/
                $modelTridy->pridejTridu($query);


                }

            /*
            if ($pridejTrid === 1) {
                // Třída byl úspěšně přidán
                $this->pridejZpravu("Třída byl úspěšně přidán.");
                $this->presmeruj("tridy");
                
                exit;
            } else if ($pridejTrid === 0) {
                // Třída již existuje
                $this->pridejZpravu("Třída již existuje!");
                $this->presmeruj("tridy");
                exit;
                
            } else {
                // Nějaká jiná chyba
                // Můžete zde zobrazit chybovou hlášku uživateli
                $this->pridejZpravu("Chyba při přidání třídy.");
                $this->presmeruj("tridy");
                exit;
            }
            */
            
        }
    }
}




}
}

?>