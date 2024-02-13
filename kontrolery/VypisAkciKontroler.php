<?php
class VypisAkciKontroler extends Kontroler {
    public function zpracuj($parametry) {


            $modelAkce= new ModelyAkce;
            $modelAkcedisc = new ModelyAkce_disc;
            $modelDisciplin = new ModelyDisciplina;
    

            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ulozit']))   {
                
                $hodnoty= [
                    'id_akce' => $_POST['id_akce'],
                    'nazev_akce' => $_POST['nazev_akce'],
                    'datum_zahajeni' => $_POST['datum_zahajeni'],
                    'datum_konce' => $_POST['datum_konce'],
                    'misto_kon' => $_POST['misto_kon'],
                    'popisek_akce' => $_POST['popisek_akce'],
                    // Další potřebné údaje
                    
                ];
    
                $editAkce= $modelAkce->zmenAkci($hodnoty, $_POST['id_akce']);
    
                if ($editAkce === 1) {
                    // Záznam byl úspěšně editován
                    $this->pridejZpravu("Záznamu byla úspěšně editována.");
                    $this->presmeruj("akce");
                    
                    exit;
                } 
                else {
                    // Nějaká jiná chyba
                    // Můžete zde zobrazit chybovou hlášku uživateli
                    $this->pridejZpravu("Chyba při editaci záznamu.");
                    
                    $this->presmeruj("akce");
                    exit;   
                } 
                }
                else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['smazat']))   {
                    
                    $smazAkce= $modelAkce->odeberAkci($_POST['id_akce']);
                
        
                    if ($smazAkce === 1) {
                        // Sport byl úspěšně editován
                        $this->pridejZpravu("Záznamu byl úspěšně smazán.");
                        $this->presmeruj("akce");
                        
                        exit;
                    } 
                    else {
                        // Nějaká jiná chyba
                        // Můžete zde zobrazit chybovou hlášku uživateli
                        $this->pridejZpravu("Chyba při smazání záznamu.");
                        
                        $this->presmeruj("akce");
                        exit;   
                    } 
                    }
    
            $this->pohled = "vypisakci";
    
            $akce=$modelAkce->vratVsechnyAkce();
            $this->data["akce"] = $akce; 

            $akcedisc =  $modelAkcedisc->vratVsechnyAkce_disc();
            $this->data["akcedisc"] = $akcedisc; 

            $disc=$modelDisciplin->vratVsechnyDiscipliny();
            $this->data["disc"] = $disc; 
    


    }
}