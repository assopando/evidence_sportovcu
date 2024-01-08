<?php
class UzivatelKontroler extends Kontroler {
    public function zpracuj($parametry) {

        $this->pohled = "uzivatel";

        $modelUzivatel= new ModelyUzivatel;

        $ucitele = $modelUzivatel -> vratInfoVsechUcitelu();

        $this->data["ucitele"] = $ucitele;

    }
}