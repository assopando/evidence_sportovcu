<?php
class UcastnikKontroler extends Kontroler {
    public function zpracuj($parametry) {

        $modelUcastnik= new ModelyUcastnik;
        $modelUzivatel= new ModelyUzivatel;
        $modelSoupiska= new ModelySoupiska;



        // Zpracování formuláře
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pridej'])) {
            // Zde by mělo dojít k zpracování formuláře
            // a volání metody pridejUcastnika z vaší třídy
            $ucastnik = [
                'id_ucast' => $_POST['id_ucast'],
                'id_uziv' => $_POST['id_uziv'],
                'id_soup' => $_POST['id_soup'],
                'vys_u' => $_POST['vys_u'],
                // Další potřebné údaje
            ];

            $pridejUcastnika= $modelUcastnik->pridejUcastnika($ucastnik);

            echo $pridejUcastnika;

            if ($pridejUcastnika === 1) {
                // Záznam byl úspěšně přidán
                $this->pridejZpravu("Záznam byl úspěšně přidán.");
                $this->presmeruj("ucastnik");
                
                exit;
            } else if ($pridejUcastnika === 0) {
                // Záznam již existuje
                $this->pridejZpravu("Záznam již existuje!");
                $this->presmeruj("ucastnik");
                exit;
                
            } else {
                // Nějaká jiná chyba
                // Můžete zde zobrazit chybovou hlášku uživateli
                $this->pridejZpravu("Chyba při přidání záznamu.");
                $this->presmeruj("ucastnik");
                exit;
            }
        }

        else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ulozit']))   {
            
            $hodnoty= [
                'id_ucast' => $_POST['id_ucast'],
                'id_uziv' => $_POST['id_uziv'],
                'id_soup' => $_POST['id_soup'],
                'vys_u' => $_POST['vys_u'],
                // Další potřebné údaje
                
            ];


            $editUcast= $modelUcastnik->zmenUcastnika($hodnoty, $_POST['id_ucast']);

            if ($editUcast === 1) {
                // Záznam byl úspěšně editován
                $this->pridejZpravu("Záznamu byla úspěšně editována.");
                $this->presmeruj("ucastnik");
                
                exit;
            } 
            else {
                // Nějaká jiná chyba
                // Můžete zde zobrazit chybovou hlášku uživateli
                $this->pridejZpravu("Chyba při editaci záznamu.");
                
                $this->presmeruj("ucastnik");
                exit;   
            } 
            }
            else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['smazat']))   {
            
                
                $smazUcast= $modelUcastnik->odeberUcastnika($_POST['id_ucast']);
            
    
                if ($smazUcast === 1) {
                    // Sport byl úspěšně editován
                    $this->pridejZpravu("Záznamu byl úspěšně smazán.");
                    $this->presmeruj("ucastnik");
                    
                    exit;
                } 
                else {
                    // Nějaká jiná chyba
                    // Můžete zde zobrazit chybovou hlášku uživateli
                    $this->pridejZpravu("Chyba při smazání záznamu.");
                    
                    $this->presmeruj("ucastnik");
                    exit;   
                } 
                }

        


        $this->pohled = "ucastnik";

        $ucastnik=$modelUcastnik->vratVsechnyUcastniky();
        $this->data["ucastnik"] = $ucastnik; 
        
        $uzivatel=$modelUzivatel->vratVsechnyUzivatele();
        $this->data["uzivatel"] = $uzivatel; 

        $soupiska=$modelSoupiska->vratVsechnySoupisky();
        $this->data["soupiska"] = $soupiska; 
    }
}