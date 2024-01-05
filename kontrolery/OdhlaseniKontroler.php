<?php
class OdhlaseniKontroler extends Kontroler {
	
   public function zpracuj($parametry) {
     $spravceUzivatelu = new ModelyUzivatel;
     if ($spravceUzivatelu->odhlas())
        $this->pridejZpravu("Odhlášení bylo úspěšné.");
     $this->presmeruj("");
   }

}
?>