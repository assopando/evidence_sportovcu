<?php
class LoginKontroler extends Kontroler {
  
   public function zpracuj($parametry) {
     $modelyUzivatelu = new ModelyUzivatel;
     
     if (!empty($_POST)) {
        if ($modelyUzivatelu->prihlas($_POST)) {
            $this->pridejZpravu("Přihlášení bylo úspěšné.");
            $this->presmeruj("");
        }
        else
          $this->pridejZpravu("Přihlášení nebylo úspěšné.");
          
     }
     
     $this->pohled = "login";
   }

}
?>