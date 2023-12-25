<?php
class BodyKontroler extends Kontroler {
    public function zpracuj($parametry) {
        $this->pohled = "body";

        $spravceBodu = new SpravceBodu;

        if (!empty($parametry[0])) { // známe ID bodu
            $idBodu = $parametry[0];

            switch ($parametry[1]) {
                case "delete":
                    if ($this->prihlasenyUzivatel) {

                        $spravceBodu->odstranBod($idBodu);
                        $this->pridejZpravu("Bod s ID $idBodu byl úspěšně odstraněn.");
                        $this->presmeruj("body");
                    }
                    else {
                        $this->pridejZpravu("Pro odstranění bodu je nutné být přihlášen.");
                        $this->presmeruj("login");
                    }
                    
                break;

                case "edit":

                break;
                
                default:

                break;
            }
        }

        if (isset($_POST["x"])) {
            $spravceBodu->vlozBod($_POST);
            $this->presmeruj("body");
        }

        $bodyDB = $spravceBodu->vratVsechnyBody();
        // var_dump($bodyDB);

        $body = $spravceBodu->prevedDbZaznamyNaObjekty($bodyDB);
                
        // v pohledu využít foreach
        $this->data["body"] = $body;
        
    }
}