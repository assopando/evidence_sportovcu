<?php
class VytvorSoupiskuKontroler extends Kontroler {
    public function zpracuj($parametry) {

        $idTetoAkce=$_GET['ia'];
        $faze = 0;
        $soupiska=null;


        $modelAkce= new ModelyAkce;
        $modelUzivatel = new ModelyUzivatel;
        $modelSoupiska = new ModelySoupiska;
        $modelUcastnik = new ModelyUcastnik;
        $modelDisciplina = new ModelyDisciplina;
        $modelAkce_disc = new ModelyAkce_disc;

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
                $SoupiskaId = $modelSoupiska->vratPosledniId() +1;

                // Zde by mělo dojít k zpracování formuláře
                // a volání metody pridejUcastnika z vaší třídy
                $soupiska = [
                    'id_soup' => $SoupiskaId,
                    'id_akce' => $konkretniakce["id_akce"],
                    'nazev_skupiny' => $_POST['nazev_soupisky'],
                    // Další potřebné údaje
                ];             

                //pridani zaznamu do databaze(soupiska)
                $pridejSoupisku = $modelSoupiska->pridejSoupisku($soupiska);
                //$pridejSoupisku = 1;              
 

                if ($pridejSoupisku === 1) {
                    // Záznam byl úspěšně přidán
                    $this->pridejZpravu("Soupiska byla úspěšně přidána.");

//------------------ Dělící čara mezi soupiska a ucastnik ---------------------------------------

                    //zjištění podledního ID v tabulce
                    $ucastnik_Id = $modelUcastnik->vratPosledniId()+1;
                    
                    //Průchod pole
                    foreach ($ucastnici as $selectedUziv) {

                        $ucastnik = [
                            'id_ucast' => $ucastnik_Id++,
                            'id_uziv' => $selectedUziv,
                            'id_soup' => $SoupiskaId,
                            // Další potřebné údaje
                        ];
                        
                        //pridani zaznamu do databaze(ucastnik), poté následné zajištění nastavení ID
                        $pridejUcastnik[]= $modelUcastnik->pridejUcastnika($ucastnik);
                        //$pridejUcastnik[] = [1,1];
                    
                    }
                    if (!in_array(0,$pridejUcastnik)) {
                            // Záznam byl úspěšně přidán
                            $this->pridejZpravu("Ucastníci byli úspěšně přidány.");
                            $faze = 1;
                            //header("Refresh:0"); 

                        } else if (in_array(0,$pridejUcastnik)) {
                            // Záznam již existuje
                            $this->pridejZpravu("Některé záznamy již existujou!");
                        }else {
                            // Nějaká jiná chyba
                            // Můžete zde zobrazit chybovou hlášku uživateli
                            $this->pridejZpravu("Chyba při přidání záznamu.");
                        }
                

//------------------ Dělící čara mezi soupiska a ucastnik ---------------------------------------

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

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pridejSoupiskaUcastnik'])) {
            
            foreach ($ucastnici as $uziv) {
                $poleDisc = $_POST[$uziv];
                var_dump($poleDisc);
            
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
