<?php
class VypisAkciKontroler extends Kontroler {
    public function zpracuj($parametry) {
            session_start();

            $modelAkce= new ModelyAkce;

    
    
            $this->pohled = "vypisakci";
    
            $akce=$modelAkce->vratVsechnyAkce();
            $this->data["akce"] = $akce; 


            
            $this->data["serazeniUcast"] = ModelyUzivatel::serazeniNaAkciPodleUcasti($_SESSION ['email']);
            $this->data["serazeniZajem"] = ModelyUzivatel::serazeniNaAkciPodleZajmu($_SESSION ['email']);
            
            

    


    }
}