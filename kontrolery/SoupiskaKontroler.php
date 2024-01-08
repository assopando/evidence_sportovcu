<?php
class SoupiskaKontroler extends Kontroler {
    public function zpracuj($parametry) {

        $modelDisciplin= new ModelyDisciplina();
        $modelSoupiska= new ModelySoupiska();
        $modelAkce = new ModelyAkce();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pridej'])) {
           
           
            $soupiska = [
                'id_soup' => $_POST['id_soup'],
                'id_akce' => $_POST['id_akce'],
                'nazev_skupiny' => $_POST['nazev_soupisky'],
                'vys_s' => $_POST['vys_s'],
               
            ];

            $pridejSoup= $modelSoupiska->pridejSoupisku($soupiska);

            if ($pridejSoup === 1) {
                // Disciplina  byla úspěšně přidán
                $this->pridejZpravu("Soupiska byla úspěšně přidán.");
                $this->presmeruj("soupiska");
                
                exit;
            } else if ($pridejSoup === 0) {
                // Disciplína již existuje
                $this->pridejZpravu("Soupiska již existuje!");
                $this->presmeruj("soupiska");
                exit;
                
            } else {
                // Nějaká jiná chyba
                // Můžete zde zobrazit chybovou hlášku uživateli
                $this->pridejZpravu("Chyba při přidání soupisky.");
                $this->presmeruj("soupiska");
                exit;
            }
        }
        else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ulozit']))   {
            
            $hodnoty= [
                'id_disc' => $_POST['editovana_disciplina_id'],
                'id_sport' => $_POST['editovany_sport_id'],
                'nazev_disc' => $_POST['novy_nazev_discipliny'],
                
            ];

            $editDisc= $modelDisciplin->zmenDisciplinu($hodnoty, $_POST['editovana_disciplina_id']);

            if ($editDisc === 1) {
                // Sport byl úspěšně editován
                $this->pridejZpravu("Disciplína byla úspěšně editována.");
                $this->presmeruj("disciplina");
                
                exit;
            } 
            else {
                // Nějaká jiná chyba
                // Můžete zde zobrazit chybovou hlášku uživateli
                $this->pridejZpravu("Chyba při editaci disciplíny.");
                
                $this->presmeruj("disciplina");
                exit;   
            } 
            }
            else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['smazat']))   {
            
                
    
                $smazDisc= $modelDisciplin->odeberDisciplinu($_POST['smazana_disciplina_id']);
            
    
                if ($smazDisc === 1) {
                    // Sport byl úspěšně editován
                    $this->pridejZpravu("Disciplína byl úspěšně smazán.");
                    $this->presmeruj("disciplina");
                    
                    exit;
                } 
                else {
                    // Nějaká jiná chyba
                    // Můžete zde zobrazit chybovou hlášku uživateli
                    $this->pridejZpravu("Chyba při smazání disciplíny.");
                    
                    $this->presmeruj("disciplina");
                    exit;   
                } 
                }

        


        $this->pohled = "soupiska";
        $akce=$modelAkce->vratVsechnyAkce();
        $this->data["akce"] = $akce; 
        
        $soupiska=$modelSoupiska->vratVsechnySoupisky();
        $this->data["soupiska"] = $soupiska; 
    }
}