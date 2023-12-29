<?php

class ImportcsvKontroler extends Kontroler {
   
    public function zpracuj($parametry) {
        // Zde můžete přidat kód pro zpracování formuláře pro nahrání CSV souboru (HTML, formulář, atd.)
        
        if (isset($_POST['import'])) {
            try {
                // Získání cesty k nahranému CSV souboru
                $csvFilePath = $_FILES['csv_file']['tmp_name'];

                // Volání metody pro import osobních údajů
                $this->importujOsobniUdaje($csvFilePath);

                echo "Data byla úspěšně importována do databáze.";
            } catch (Exception $e) {
                echo "Chyba: " . $e->getMessage();
            }
        }
        $modelyUzivatelu = new ModelyUzivatelu;
        // Zde můžete přidat kód pro zobrazení stránky s formulářem pro import CSV souboru
        $this->pohled = "importcsv";  // Nastavte název pohledu dle vaší aplikace
      //  $this->data["uzivatele"]=$modelyUzivatelu->vratVsechnyUzivatele();
    }

    private function importujOsobniUdaje($csvFilePath) {
        // Otevření souboru pomocí SPLFileObject
        $file = new SplFileObject($csvFilePath, 'r');
    
        $modelyUzivatelu = new ModelyUzivatelu;
    
        // Přečtení prvního řádku (hlavičky)
        $header = $file->fgetcsv(';');
    
        // Kontrola, zda hlavička obsahuje očekávané klíče
        if (!isset($header[0], $header[1], $header[2], $header[3])) {
            echo "Chyba: Hlavička souboru neobsahuje očekávané klíče.";
            return;
        }
        $i=100;
        // Iterace přes zbývající řádky souboru
        while (!$file->eof()) {
            // Přečtení řádku
            $data = $file->fgetcsv(';');
    
            // Přidání kontroly existence očekávaných klíčů v poli $data
            if (isset($data[0], $data[1], $data[2], $data[3])) {
                // Příprava dat pro vložení do databáze a převedení na UTF-8MB4
                $datum = explode('.', str_replace(' ', '', $data[4]));
                $novyFormat = $datum[2] . '-' . $datum[1] . '-' . $datum[0];
                $uzivatel = [
                    'id_uziv' => $i,
                    'jmeno' => iconv('Windows-1250', 'UTF-8', $data[0]),
                    'prijmeni' => iconv('Windows-1250', 'UTF-8', $data[1]),
                    'id_trid' => iconv('Windows-1250', 'UTF-8', $data[2]),
                    'isic' => iconv('Windows-1250', 'UTF-8', $data[3]),

                    'dat_nar' => iconv('Windows-1250', 'UTF-8', $novyFormat),
                    'pohlavi' => iconv('Windows-1250', 'UTF-8', $data[5]),
                ];
                $i++;
                

                // Převod na formát "yyyy:mm:dd"
              /*  var_dump($data[4]);
                echo ("\n--------------------------------");
                $k=date("Y-m-d", strtotime(str_replace(".", "-", $data[4])));
                var_dump($k);
               /* echo ("\n--------------------------------");
                $a=DateTime::createFromFormat('j. n.Y', $data[4]);
                $a->format('yyyy-mm-dd');
                var_dump($a);*/
               /* echo ("\n--------------------------------");
                $source = $data[4];
                $date = new DateTime($source);
                echo $date->format('d.m.Y'); // 31.07.2012
                echo $date->format('d-m-Y'); // 31-07-2012
                echo ("\n--------------------------------");*/

                

                
    
                // Volání metody pro přidání osobních údajů do databáze
                $modelyUzivatelu->pridejStudenta($uzivatel);
            } else {
                // Pokud chybí očekávané klíče, vypište, která data chybí, a také konkrétní řádek CSV souboru
             /*   $chybejiciData = array_diff(['jmeno', 'prijmeni', 'id_trid', 'isic'], array_keys($data));
    
                echo "Chyba: Chybějící data - " . implode(', ', $chybejiciData) . ".";
                echo " Konkrétní řádek CSV: " . implode('; ', $data);*/
            }
        }
    
        // Zavření souboru
        $file = null;
    }
}
?>