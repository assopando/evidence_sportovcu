<?php
class UzivateleKontroler extends Kontroler {
    public function zpracuj($parametry) {

        $this->pohled = "uzivatele";

        $modelUzivatelu= new ModelyUzivatelu;

        $ucitele = $modelUzivatelu -> vratInfoVsechUcitelu();

        $this->data["ucitele"] = $ucitele;

    }
}