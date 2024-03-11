<?php
class SoupiskaKontroler extends Kontroler {
    public function zpracuj($parametry) {

        $idTetoSoup=$_GET['is'];

        $modelDisciplin= new ModelyDisciplina();
        $modelSoupiska= new ModelySoupiska();
        $modelAkce = new ModelyAkce();
        $modelUcastnici = new ModelyUcastnik();
        $modelUzivatel = new ModelyUzivatel();
        $modelDisc_ucast = new ModelyDisc_ucast();
        $modelAkce_disc = new ModelyAkce_disc;

        $ucast=$modelUcastnici->vratVsechnyUcastniky();
        $du=$modelDisc_ucast->vratVsechnyDisc_ucast();

        $soup=$modelSoupiska->vratVsechnySoupisky();
        foreach($soup as $s){
            if(!($idTetoSoup == $s["id_soup"])){
                continue;
            }
            $konkretniSoup= [
                                'id_soup' => $s['id_soup'],
                                'id_akce' => $s['id_akce'],
                                'nazev_skupiny' => $s['nazev_skupiny'],
                                'vys_s' => $s['vys_s'],

                            ];
        }


//Edit ---------------------------------------------------------------------------------------------------------------


        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ulozit'])) {
                    
    //pridani ucastníka a následné přiřazení disciplíny ---------------------------------------------------------------


            if (isset($_POST['id_uziv']) && is_array($_POST['id_uziv'])) {
                $ucastnik = $_POST['id_uziv'];

                //zjištění podledního ID v tabulce
                $ucastnikId = $modelUcastnici->vratPosledniId()+1;

                

                $ucastnikove_udaje = [
                    'id_ucast' => $ucastnikId,
                    'id_uziv' => $ucastnik,
                    'id_soup' => $idTetoSoup,
                    // Další potřebné údaje
                ];
                
                //pridani zaznamu do databaze(ucastnik)
                $pridejUcastnik = $modelUcastnici->pridejUcastnika($ucastnikove_udaje);
                
                
                if ($pridejUcastnik == 1) {
                    // Záznam byl úspěšně přidán
                    $this->pridejZpravu("Ucastnik byl úspěšně přidán.");

        //---------------------------- Dělící čara mezi ucastnik a disciplíny ---------------------------------------

                    $disc_ucastId = $modelDisc_ucast->vratPosledniId()+1;

                        $pole_disc = $_POST['disc_k_prirazeni'];
                        foreach($pole_disc as $disc_k_prirazeni){
                            $disc_ucast = [
                                'id_disc_ucast' => $disc_ucastId++,
                                'id_ucast' => $ucastnikove_udaje['id_ucast'],
                                'id_disc' => $disc_k_prirazeni,
                                // Další potřebné údaje
                            ];
                        
                        $pridejDiscucast[] = $modelDisc_ucast->pridejDisc_ucast($disc_ucast);
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
                    

                } else if ($pridejUcastnik == 0) {
                    // Záznam již existuje
                    $this->pridejZpravu("Záznam již existuje!");
                }else {
                    // Nějaká jiná chyba
                    // Můžete zde zobrazit chybovou hlášku uživateli
                    $this->pridejZpravu("Chyba při přidání záznamu.");
                }

        //edit soupisky --------------------------------------------------------------------------------
                
                    $hodnoty= [
                        $_POST['nazev_skupiny'],
                        // Další potřebné údaje
                    ];

                    $editSoupisky= $modelSoupiska->zmenSoupisku($hodnoty, $idTetoSoup);

                    if ($editSoupisky == 1) {
                        // Záznam byl úspěšně editován
                        header("Refresh:0");
                        $this->pridejZpravu("Záznam byla úspěšně editována.");    
                        //header("Refresh:0");                

                    } 
                    else if ($editSoupisky == 2) {
                        // Záznam byl úspěšně editován
                        header("Refresh:0");
                        $this->pridejZpravu("Záznam byl zachován.");    
                        //header("Refresh:0");                

                    } 
                    
                    else {
                        // Nějaká jiná chyba
                        // Můžete zde zobrazit chybovou hlášku uživateli
                        header("Refresh:0");
                        $this->pridejZpravu("Chyba při editaci záznamu."); 
                    } 
                    }

                }

        //Delete Učastníku a jejich discipliny (pres checkboxy)--------------------------------------------------------------------------------------------------

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cb_smazat'])) {

                foreach($_POST['selected_ucast'] as $u){

                    $smazUcastnika = $modelUcastnici->odeberUcastnika($u);

                    if ($smazUcastnika === 1) {
                        // příkaz se provedl
                        $this->pridejZpravu("Záznam byl úspěšně smazán.");
                    } 
                    else {
                        // Nějaká jiná chyba
                        // Můžete zde zobrazit chybovou hlášku uživateli
                        $this->pridejZpravu("Chyba při smazání záznamu.");
                    } 
                }
                header("Refresh:0");  
            }

        //Delete všeho------------------------------------------------------------------------------------------------------------------        
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cele_smazat'])) {
                $smazSoupisku= $modelSoupiska->odeberSoupisku($konkretniSoup['id_soup']);

                if ($smazSoupisku === 1) {
                    //Úspěch
                    $this->pridejZpravu("Záznam byl úspěšně smazán.");
                    //$this->presmeruj("vypisakci");
                    header("Location: akce?ia=".$konkretniSoup['id_akce']);
                    exit;   
                } 
                else {
                    // Nějaká jiná chyba
                    // Můžete zde zobrazit chybovou hlášku uživateli
                    $this->pridejZpravu("Chyba při smazání záznamu."); 
                    header("Refresh:0"); 
                } 
            }






        $this->data["konkretniSoup"] = $konkretniSoup;

        $this->pohled = "soupiska";

        $akce=$modelAkce->vratVsechnyAkce();
        $this->data["akce"] = $akce; 
        
        $soupiska=$modelSoupiska->vratVsechnySoupisky();
        $this->data["soupiska"] = $soupiska; 

        

        $uziv=$modelUzivatel->vratVsechnyUzivatele();
        $this->data["uziv"] = $uziv; 

        $disc=$modelDisciplin->vratVsechnyDiscipliny();
        $this->data["disc"] = $disc; 

        
        $this->data["du"] = $du; 

        $ad=$modelAkce_disc->vratVsechnyAkce_disc();
        $this->data["ad"] = $ad; 

        $this->data["ucast"] = $ucast; 
    }
}