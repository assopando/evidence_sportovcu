<?php
class SportovciKontroler extends Kontroler {
    public function zpracuj($parametry) {


        $modelySportuje = new ModelySportuje();
        $modelyUzivatel = new ModelyUzivatel();
        $modelyDisciplin = new ModelyDisciplina();
        $modelyPozice = new ModelyPozice();
        $modelyUroven = new ModelyUroven();
        $this->data["sportovci"]=$modelySportuje->vratVsechySportuje();
        $this->data["sportuje"]=$modelyUzivatel->vratVsechnyUzivatele();
        $this->data["disc"]=$modelyDisciplin->vratVsechnyDiscipliny();
        $this->data["poz"]=$modelyPozice->vratVsechnyPozice();
        $this->data["urov"]=$modelyUroven->vratVsechnyUroven();
        $this->pohled = "sportovci";
    }
}