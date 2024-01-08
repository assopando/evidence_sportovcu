<?php
class DiscucastKontroler extends Kontroler {
    public function zpracuj($parametry) {

        $modelUcastnik= new ModelyUcastnik;
        $modelUzivatel= new ModelyUzivatel;
        $modelDisciplin= new ModelyDisciplina;
        $modelDiscucast= new ModelyDisc_ucast;



        // Zpracování formuláře
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pridej'])) {
            // Zde by mělo dojít k zpracování formuláře
            // a volání metody pridejUcastnika z vaší třídy
            $discucast = [
                'id_disc_ucast' => $_POST['id_disc_ucast'],
                'id_ucast' => $_POST['id_ucast'],
                'id_disc' => $_POST['id_disc'],
                'vys_du' => $_POST['vys_du'],
                // Další potřebné údaje
            ];

            $pridejDiscucast= $modelDiscucast->pridejDisc_ucast($discucast);

            echo $pridejDiscucast;

            if ($pridejDiscucast === 1) {
                // Záznam byl úspěšně přidán
                $this->pridejZpravu("Záznam byl úspěšně přidán.");
                $this->presmeruj("discucast");
                
                exit;
            } else if ($pridejDiscucast === 0) {
                // Záznam již existuje
                $this->pridejZpravu("Záznam již existuje!");
                $this->presmeruj("discucast");
                exit;
                
            } else {
                // Nějaká jiná chyba
                // Můžete zde zobrazit chybovou hlášku uživateli
                $this->pridejZpravu("Chyba při přidání záznamu.");
                $this->presmeruj("discucast");
                exit;
            }
        }

        else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ulozit']))   {
            
            $hodnoty= [
                'id_disc_ucast' => $_POST['id_disc_ucast'],
                'id_ucast' => $_POST['id_ucast'],
                'id_disc' => $_POST['id_disc'],
                'vys_du' => $_POST['vys_du'],
                // Další potřebné údaje
                
            ];


            $editDiscucas= $modelDiscucast->zmenDisc_ucast($hodnoty, $_POST['id_disc_ucast']);

            if ($editDiscucas === 1) {
                // Záznam byl úspěšně editován
                $this->pridejZpravu("Záznamu byla úspěšně editována.");
                $this->presmeruj("discucast");
                
                exit;
            } 
            else {
                // Nějaká jiná chyba
                // Můžete zde zobrazit chybovou hlášku uživateli
                $this->pridejZpravu("Chyba při editaci záznamu.");
                
                $this->presmeruj("discucast");
                exit;   
            } 
            }
            else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['smazat']))   {
            
                
                $smazDiscucast= $modelDiscucast->odeberDisc_ucast($_POST['id_disc_ucast']);
            
    
                if ($smazDiscucast === 1) {
                    // Sport byl úspěšně editován
                    $this->pridejZpravu("Záznamu byl úspěšně smazán.");
                    $this->presmeruj("discucast");
                    
                    exit;
                } 
                else {
                    // Nějaká jiná chyba
                    // Můžete zde zobrazit chybovou hlášku uživateli
                    $this->pridejZpravu("Chyba při smazání záznamu.");
                    
                    $this->presmeruj("discucast");
                    exit;   
                } 
                }

        


        $this->pohled = "discucast";

        $ucastnik=$modelUcastnik->vratVsechnyUcastniky();
        $this->data["ucastnik"] = $ucastnik; 
        
        $uzivatel=$modelUzivatel->vratVsechnyUzivatele();
        $this->data["uzivatel"] = $uzivatel; 

        $disc=$modelDisciplin->vratVsechnyDiscipliny();
        $this->data["disc"] = $disc; 

        $discucast =  $modelDiscucast->vratVsechnyDisc_ucast();
        $this->data["discucast"] = $discucast;
    }
}