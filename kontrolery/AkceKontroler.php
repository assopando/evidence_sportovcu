<?php
class AkceKontroler extends Kontroler {
    public function zpracuj($parametry) {

        $idTetoAkce=$_GET['ia'];

        $modelAkce= new ModelyAkce;
        $modelAkcedisc = new ModelyAkce_disc;
        $modelDisciplin = new ModelyDisciplina;
        $modelSoupiska = new ModelySoupiska;

        $akce=$modelAkce->vratVsechnyAkce();
        foreach($akce as $a){
            if($idTetoAkce == $a["id_akce"]){
                $konkretniAkce= [
                    'id_akce' => $a["id_akce"],
                    'nazev_akce' => $a['nazev_akce'],
                    'datum_zahajeni' => $a['datum_zahajeni'],
                    'datum_konce' => $a['datum_konce'],
                    'misto_kon' => $a['misto_kon'],
                    'popisek_akce' => $a['popisek_akce'],
                ];
            }
        }

//Edit ---------------------------------------------------------------------------------------------------------------


        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ulozit'])) {
            
        //pridani akce_disc --------------------------------------------------------------------------------

            if (isset($_POST['pridat_id_disc']) && is_array($_POST['pridat_id_disc'])) { 
                $disc = $_POST['pridat_id_disc'];
                //zjištění podledního ID v tabulce
                $akce_discId = $modelAkcedisc->vratPosledniId()+1;
                //Průchod pole
                foreach ($disc as $selectedDisc) {
                    $akcedisc = [
                        'id_akce_disc' => $akce_discId++,
                        'id_akce' => $idTetoAkce,
                        'id_disc' => $selectedDisc,
                        // Další potřebné údaje
                        ];

                    //pridani zaznamu do databaze(akce_disc), poté následné zajištění nastavení ID
                    $pridejAkcedisc= $modelAkcedisc->pridejAkce_disc($akcedisc);

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

//edit akce --------------------------------------------------------------------------------
                
                $hodnoty= [
                    'nazev_akce' => $_POST['nazev_akce'],
                    'datum_zahajeni' => $_POST['datum_zahajeni'],
                    'datum_konce' => $_POST['datum_konce'],
                    'misto_kon' => $_POST['misto_kon'],
                    'popisek_akce' => $_POST['popisek_akce'],
                    // Další potřebné údaje
                ];
    
                $editAkce= $modelAkce->zmenAkci($hodnoty, $idTetoAkce);
    
                if ($editAkce == 1) {
                    // Záznam byl úspěšně editován
                    $this->pridejZpravu("Záznam byla úspěšně editována.");    
                    //header("Refresh:0");                
                } 
                else {
                    // Nějaká jiná chyba
                    // Můžete zde zobrazit chybovou hlášku uživateli
                    $this->pridejZpravu("Chyba při editaci záznamu."); 
                } 

//edit akce_disc --------------------------------------------------------------------------------
            
                for($i = 0 ;$i<count($_POST['edit_id_ad']);$i++){
                    $hodnoty= [
                                    'id_akce' => $idTetoAkce,
                                    'id_disc' => $_POST['edit_id_disc'][$i],
                                    // Další potřebné údaje
                                    
                                ];

                    $editAkcedisc= $modelAkcedisc->zmenAkce_disc($hodnoty, $_POST['edit_id_ad'][$i]);
                    if ($editAkcedisc === 1) {
                        // Záznam byl úspěšně editován
                        $this->pridejZpravu("Záznamu byla úspěšně editována.");
                    } 
                    else {
                        // Nějaká jiná chyba
                        // Můžete zde zobrazit chybovou hlášku uživateli
                        $this->pridejZpravu("Chyba při editaci záznamu.");   
                    }
                }   
                header("Refresh:0"); 
            }  

//Delete Disciplín (pres checkboxy)--------------------------------------------------------------------------------------------------

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cb_smazat'])) {
            for($i = 0 ;$i<count($_POST['selected_disc']);$i++){

                $smazAkcedisc= $modelAkcedisc->odeberAkce_disc($_POST['selected_disc'][$i]);

                if ($smazAkcedisc === 1) {
                    // Sport byl úspěšně editován
                    $this->pridejZpravu("Záznamu byl úspěšně smazán.");
                } 
                else {
                    // Nějaká jiná chyba
                    // Můžete zde zobrazit chybovou hlášku uživateli
                    $this->pridejZpravu("Chyba při smazání záznamu.");
                    exit;   
                } 
            }
            header("Refresh:0");    
        }

//Delete všeho------------------------------------------------------------------------------------------------------------------        
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cele_smazat'])) {
            foreach ($akcedisc as $ad){
                if ($ad['id_akce'] == $konkretniAkce){

                    $smazAkcedisc= $modelAkcedisc->odeberAkce_disc($ad['id_akce_disc']);

                    if ($smazAkcedisc === 1) {
                        // Sport byl úspěšně editován
                        $this->pridejZpravu("Záznamu byl úspěšně smazán.");
                    } 
                    else {
                        // Nějaká jiná chyba
                        // Můžete zde zobrazit chybovou hlášku uživateli
                        $this->pridejZpravu("Chyba při smazání záznamu.");
                    } 
                }
            }

            $smazAkce= $modelAkce->odeberAkci($idTetoAkce);

            if ($smazAkce === 1) {
                //Úspěch
                $this->pridejZpravu("Záznamu byl úspěšně smazán.");
                $this->presmeruj("vypisakci");
                exit;   
            } 
            else {
                // Nějaká jiná chyba
                // Můžete zde zobrazit chybovou hlášku uživateli
                $this->pridejZpravu("Chyba při smazání záznamu."); 
                header("Refresh:0"); 
            } 
        }
        
        
    

        $this->data["konkretniAkce"] = $konkretniAkce;

        $akcedisc =  $modelAkcedisc->vratVsechnyAkce_disc();
        $this->data["akcedisc"] = $akcedisc;

        $disc=$modelDisciplin->vratVsechnyDiscipliny();
        $this->data["disc"] = $disc;
        
        $soup=$modelSoupiska->vratVsechnySoupisky();
        $this->data["soup"] = $soup; 


        $this->pohled = "akce";
    }
}
