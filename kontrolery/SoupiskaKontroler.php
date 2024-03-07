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



        $this->data["konkretniSoup"] = $konkretniSoup;

        $this->pohled = "soupiska";

        $akce=$modelAkce->vratVsechnyAkce();
        $this->data["akce"] = $akce; 
        
        $soupiska=$modelSoupiska->vratVsechnySoupisky();
        $this->data["soupiska"] = $soupiska; 

        $ucast=$modelUcastnici->vratVsechnyUcastniky();
        $this->data["ucast"] = $ucast; 

        $uziv=$modelUzivatel->vratVsechnyUzivatele();
        $this->data["uziv"] = $uziv; 

        $disc=$modelDisciplin->vratVsechnyDiscipliny();
        $this->data["disc"] = $disc; 

        $du=$modelDisc_ucast->vratVsechnyDisc_ucast();
        $this->data["du"] = $du; 


    }
}