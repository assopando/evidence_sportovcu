<?php
class VypisAkciKontroler extends Kontroler {
    public function zpracuj($parametry) {


            $modelAkce= new ModelyAkce;

    
    
            $this->pohled = "vypisakci";
    
            $akce=$modelAkce->vratVsechnyAkce();
            $this->data["akce"] = $akce; 


    


    }
}