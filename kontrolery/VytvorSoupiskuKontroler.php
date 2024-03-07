<?php
class VytvorSoupiskuKontroler extends Kontroler {
    public function zpracuj($parametry) {

        $idTetoAkce = $_GET['ia'];
        $faze = 0;
        $soupiska = null;
        $soupiskaId = null;


        $modelAkce= new ModelyAkce;
        $modelUzivatel = new ModelyUzivatel;
        $modelSoupiska = new ModelySoupiska;
        $modelUcastnik = new ModelyUcastnik;
        $modelDisciplina = new ModelyDisciplina;
        $modelAkce_disc = new ModelyAkce_disc;
        $modelDisc_ucast = new ModelyDisc_ucast;

        $akce=$modelAkce->vratVsechnyAkce();
        foreach($akce as $a){
            if($idTetoAkce == $a["id_akce"]){
                $konkretniakce= [
                    'id_akce' => $a["id_akce"],
                    'nazev_akce' => $a['nazev_akce'],
                    'datum_zahajeni' => $a['datum_zahajeni'],
                    'datum_konce' => $a['datum_konce'],
                    'misto_kon' => $a['misto_kon'],
                    'popisek_akce' => $a['popisek_akce'],
                ];
            }
        }


         // Zpracování formuláře
         if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pridejSoupiskaUcastnik'])) {
            // Kontrola jesli to jsou sportovci v poli
            if (isset($_POST['id_uziv']) && is_array($_POST['id_uziv'])) {                   
                $ucastnici = $_POST['id_uziv'];
                $soupiskaId = $modelSoupiska->vratPosledniId() +1;

                // Zde by mělo dojít k zpracování formuláře
                // a volání metody pridejUcastnika z vaší třídy
                $soupiska = [
                    'id_soup' => $soupiskaId,
                    'id_akce' => $konkretniakce["id_akce"],
                    'nazev_skupiny' => $_POST['nazev_soupisky'],
                    // Další potřebné údaje
                ];             

                //pridani zaznamu do databaze(soupiska)
                $pridejSoupisku = $modelSoupiska->pridejSoupisku($soupiska);
                //$pridejSoupisku = 1;                      // vyuzivano behem debugovaní            
 

                if ($pridejSoupisku === 1) {
                    // Záznam byl úspěšně přidán
                    $this->pridejZpravu("Soupiska byla úspěšně přidána.");

//------------------ Dělící čara mezi soupiska a ucastnik ---------------------------------------

                    //zjištění podledního ID v tabulce
                    $ucastnikId = $modelUcastnik->vratPosledniId()+1;
                    
                    //Průchod pole
                    foreach ($ucastnici as $selectedUziv) {

                        $ucastnik = [
                            'id_ucast' => $ucastnikId++,
                            'id_uziv' => $selectedUziv,
                            'id_soup' => $soupiskaId,
                            // Další potřebné údaje
                        ];
                        
                        //pridani zaznamu do databaze(ucastnik)
                        $pridejUcastnik[] = $modelUcastnik->pridejUcastnika($ucastnik);
                    
                    }
                    
                    if (!in_array(0,$pridejUcastnik)) {
                            // Záznam byl úspěšně přidán
                            $this->pridejZpravu("Ucastnik/ci byli úspěšně přidány.");
                            $faze = 1;                          //v vytvorsoupisku.phtml se prepne na "2. fází" - přiřazování disciplín

                        } else if (in_array(0,$pridejUcastnik)) {
                            // Záznam již existuje
                            $this->pridejZpravu("Některé záznamy již existujou!");
                        }else {
                            // Nějaká jiná chyba
                            // Můžete zde zobrazit chybovou hlášku uživateli
                            $this->pridejZpravu("Chyba při přidání záznamu.");
                        }
                        
                        /*
                        if (in_array(0,$pridejUcastnik)) {
                            return;

                        
                        }
                            // Záznam byl úspěšně přidán
                            $this->pridejZpravu("Ucastníci byli úspěšně přidány.");
                            $faze = 1;  
                */

//------------------------------ Dělící čara mezi soupiska a ucastnik -----------------------------------------

                } else if ($pridejSoupisku === 0) {
                    // Záznam již existuje
                    $this->pridejZpravu("Soupiska již existuje!");

                }else {
                    // Nějaká jiná chyba
                    // Můžete zde zobrazit chybovou hlášku uživateli
                    $this->pridejZpravu("Chyba při přidání soupisky.");
                }
            }
        }


//--------------- Dělící čara mezi 1. a 2. fází (soupiska+ucastnik a disc_ucast)------------------



        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['priradDiscipliny'])) {
            $disc_ucastId = $modelDisc_ucast->vratPosledniId()+1;

            $ucastnici = $_POST['id_ucastnika'];

            foreach ($ucastnici as $ucastnik) {
                $poleDisc = $_POST['ucastnici'][$ucastnik];

                foreach($poleDisc as $discKPrirazeni){
                    $discucast = [
                        'id_disc_ucast' => $disc_ucastId++,
                        'id_ucast' => $ucastnik,
                        'id_disc' => $discKPrirazeni,
                        // Další potřebné údaje
                    ];
                
                $pridejDiscucast[] = $modelDisc_ucast->pridejDisc_ucast($discucast);
                }
            }

            if (!in_array(0,$pridejDiscucast)) {
                // Záznam byl úspěšně přidán
                $this->pridejZpravu("Záznam/y byl úspěšně přidán.");
            } else if (!in_array(1,$pridejDiscucast)) {
                // Záznam již existuje
                $this->pridejZpravu("Záznam již existuje!");
                
            } else {
                // Nějaká jiná chyba
                // Můžete zde zobrazit chybovou hlášku uživateli
                $this->pridejZpravu("Chyba při přidání záznamu.");
            }

        }


        $this->data["konkretniakce"] = $konkretniakce;

        $this->data["soupiska"] = $soupiska;

        $this->data["faze"] = $faze;
        
        $uziv=$modelUzivatel->vratVsechnyUzivatele();
        $this->data["uziv"] = $uziv; 

        $ucast=$modelUcastnik->vratVsechnyUcastniky();
        $this->data["ucast"] = $ucast; 

        $disc=$modelDisciplina->vratVsechnyDiscipliny();
        $this->data["disc"] = $disc; 

        $ad=$modelAkce_disc->vratVsechnyAkce_disc();
        $this->data["ad"] = $ad; 

        $this->pohled = "vytvorsoupisku";
    }
}
