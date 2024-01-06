<?php
class UzivatelKontroler extends Kontroler {
    public function zpracuj($parametry) {

        $this->pohled = "uzivatele";

        $modelUzivatel= new ModelyUzivatel;

        $ucitele = $modelUzivatel -> vratInfoVsechUcitelu();

        $this->data["ucitele"] = $ucitele;

    }
}