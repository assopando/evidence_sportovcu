<?php
class OdhlaseniKontroler extends Kontroler {
	
   public function zpracuj($parametry) {
     $modelyUzivatelu = new ModelyUzivatel;
     if ($modelyUzivatelu->odhlas())
        $this->pridejZpravu("Odhlášení bylo úspěšné.");
     $this->presmeruj("");
   }

}
?>