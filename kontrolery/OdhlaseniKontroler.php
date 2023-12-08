<?php
class OdhlaseniKontroler extends Kontroler {
	
   public function zpracuj($parametry) {
     $spravceUzivatelu = new SpravceUzivatelu;
     if ($spravceUzivatelu->odhlas())
        $this->pridejZpravu("Odhlášení bylo úspěšné.");
     $this->presmeruj("");
   }

}
?>