<?php
class VytvorAkceKontroler extends Kontroler {
    public function zpracuj($parametry) {


            $modelAkce= new ModelyAkce;
            $modelAkcedisc = new ModelyAkce_disc;
            $modelDisciplin = new ModelyDisciplina;
    
            // Zpracování formuláře
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pridej'])) {
                // Kontrola jesli to jsou discipliny v poli
                if (isset($_POST['id_disc']) && is_array($_POST['id_disc'])) {                   
                    $disc = $_POST['id_disc'];
                    $akceId = $modelAkce->vratPosledniId() + 1;

                    // Zde by mělo dojít k zpracování formuláře
                    // a volání metody pridejUcastnika z vaší třídy
                    $akce = [
                        'id_akce' => $akceId,
                        'nazev_akce' => $_POST['nazev_akce'],
                        'datum_zahajeni' => $_POST['datum_zahajeni'],
                        'datum_konce' => $_POST['datum_konce'],
                        'misto_kon' => $_POST['misto_kon'],
                        'popisek_akce' => $_POST['popisek_akce'],
                        // Další potřebné údaje
                    ];             

                    //pridani zaznamu do databaze(akce)
                    $pridejAkce= $modelAkce->pridejAkci($akce);


                    if ($pridejAkce === 1) {
                        // Záznam byl úspěšně přidán
                        $this->pridejZpravu("Záznam byl úspěšně přidán.");
                    } else if ($pridejAkce === 0) {
                        // Záznam již existuje
                        $this->pridejZpravu("Záznam již existuje!");
                    }else {
                        // Nějaká jiná chyba
                        // Můžete zde zobrazit chybovou hlášku uživateli
                        $this->pridejZpravu("Chyba při přidání záznamu.");
                    }

//------------------ Dělící čara mezi akce a akce_disc ---------------------------------------

                    //zjištění podledního ID v tabulce
                    $akce_discId = $modelAkcedisc->vratPosledniId()+1;

                    //Průchod pole
                    foreach ($disc as $selectedDisc) {

                        $akcedisc = [
                            'id_akce_disc' => $akce_discId,
                            'id_akce' => $akceId,
                            'id_disc' => $selectedDisc,
                            // Další potřebné údaje
                        ];

                        //
                        
                        //pridani zaznamu do databaze(akce_disc), poté následné zajištění nastavení ID
                        $pridejAkcedisc= $modelAkcedisc->pridejAkce_disc($akcedisc);
                        $akce_discId+=1;

                        if ($pridejAkcedisc === 1) {
                            // Záznam byl úspěšně přidán
                            $this->pridejZpravu("Záznam byl úspěšně přidán.");
                        } else if ($pridejAkcedisc === 0) {
                            // Záznam již existuje
                            $this->pridejZpravu("Záznam již existuje!");
                        }else {
                            // Nějaká jiná chyba
                            // Můžete zde zobrazit chybovou hlášku uživateli
                            $this->pridejZpravu("Chyba při přidání záznamu.");
                        }
                    }
                }
                $this->presmeruj("vytorakce");
            }


                
    
            else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ulozit']))   {
                
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
                    $this->presmeruj("vytorakce");
                    
                    exit;
                } 
                else {
                    // Nějaká jiná chyba
                    // Můžete zde zobrazit chybovou hlášku uživateli
                    $this->pridejZpravu("Chyba při editaci záznamu.");
                    
                    $this->presmeruj("vytorakce");
                    exit;   
                } 
                }
                else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['smazat']))   {
                    
                    $smazAkce= $modelAkce->odeberAkci($_POST['id_akce']);
                
        
                    if ($smazAkce === 1) {
                        // Sport byl úspěšně editován
                        $this->pridejZpravu("Záznamu byl úspěšně smazán.");
                        $this->presmeruj("vytorakce");
                        
                        exit;
                    } 
                    else {
                        // Nějaká jiná chyba
                        // Můžete zde zobrazit chybovou hlášku uživateli
                        $this->pridejZpravu("Chyba při smazání záznamu.");
                        
                        $this->presmeruj("vytorakce");
                        exit;   
                    } 
                    }
    
            $this->pohled = "vytvorakce";
    
            $akce=$modelAkce->vratVsechnyAkce();
            $this->data["akce"] = $akce; 

            $akcedisc =  $modelAkcedisc->vratVsechnyAkce_disc();
            $this->data["akcedisc"] = $akcedisc; 

            $disc=$modelDisciplin->vratVsechnyDiscipliny();
            $this->data["disc"] = $disc; 
    


    }
}