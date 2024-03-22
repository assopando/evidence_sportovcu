<?php
class StatistikyKontroler extends Kontroler {
    public function zpracuj($parametry) {




        $modelAkce= new ModelyAkce;
        $modelAkcedisc = new ModelyAkce_disc;
        $modelDisciplin = new ModelyDisciplina;
        $modelSoupiska  = new ModelySoupiska;
        $modelUcastnici = new ModelyUcastnik();
        $modelUzivatele = new ModelyUzivatel();
        $modelTrid= new ModelyTrida;

        $trida = $modelTrid->vratVsechnyTridy();
        $this->data["tridy"] = $trida;

        $akce=$modelAkce->vratVsechnyAkce();
        $this->data["akce"]=$akce;

        $akcedisc =  $modelAkcedisc->vratVsechnyAkce_disc();
        $this->data["akcedisc"] = $akcedisc;

        $disc=$modelDisciplin->vratVsechnyDiscipliny();
        $this->data["disc"] = $disc; 

        $soup=$modelSoupiska->vratVsechnySoupisky();
        $this->data["soup"] = $soup;

        $ucast = $modelUcastnici->vratVsechnyUcastniky();
        $this->data["ucast"] = $ucast;

        $uziv = $modelUzivatele->vratVsechnyUzivatele();
        $this->data["uzivatele"] = $uziv;


        $modelDiscUcast = new ModelyDisc_ucast();
        $discucast = $modelDiscUcast->vratVsechnyDisc_ucast();
        $this->data["du"] = $discucast;

        $modelOpak = new ModelyOpakovanost();
        $opak = $modelOpak->vratVsechnyOpak();
        $this->data["opak"] = $opak;

        $modelKolo = new ModelyKolo();
        $kolo = $modelKolo->vratVsechnyKolo();
        $this->data["kolo"] = $kolo;

        
        

        $this->pohled = "statistiky";
    }
}