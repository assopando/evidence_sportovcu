<?php
class PridelenidisciplinKontroler extends Kontroler  {

    public function zpracuj($parametry){

        $modelyUzivatelu= new ModelyUzivatel;
        $modelyDisciplin= new ModelyDisciplina;
        $modelySportuje = new ModelySportuje;
        $modelyPozice= new ModelyPozice;
        $modelyUroven= new ModelyUroven;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pridej'])) {
            // Zpracujte data z formuláře
           // $id_sportuje = $_POST['id_sportuje'];
            $id_disc = $_POST['id_disc'];
            $id_stud = $_POST['id_uziv'];
            $pozice = isset($_POST['id_poz']) ? $_POST['id_poz'] : null;
            $tym = isset($_POST['tym']) ? $_POST['tym'] : null;
            $uroven = isset($_POST['id_urov']) ? $_POST['id_urov'] : null;
            
             

            // Validace a další zpracování dat, pokud je to potřeba

            // Volání metody pro přidání hodnot do databáze
             // Upravte název modelu podle vaší implementace
            $result = $modelySportuje->pridejSportuje([
               // 'id_sportuje' => $id_sportuje,
                'id_disc' => $id_disc,
                'id_stud' => $id_stud,
                'id_poz' => $pozice,
                'tym' => $tym,
                'id_urov' => $uroven,
                'rekord' => $_POST['rekord'],
            ]);

            // Zpracování výsledku a přesměrování nebo zobrazení odpovědi uživateli
            if ($result === 1) {
                // Přidání úspěšné
                $this->pridejZpravu("Sportovec byl úspěšně přidán.");
                $this->presmeruj("pridelenidisciplin");
                
                exit;
            } else {
                // Chyba při přidávání
                $this->pridejZpravu("Sportovec nebyl úspěšně přidán.");
                $this->presmeruj("pridelenidisciplin");
            }
        } else {
            // Formulář nebyl odeslán, můžete provést další akce, pokud jsou potřeba
           /* $this->pridejZpravu("Formulář nebyl odeslán");
                $this->presmeruj("pridelenidisciplin");*/
        }
        
       
       
    
      
        $this->pohled="pridelenidisciplin";
        $this->data["studenti"]= $modelyUzivatelu->vratVsechnyUzivatele();
        $this->data["disc"]= $modelyDisciplin->vratVsechnyDiscipliny();
        $this->data["pozice"] = $modelyPozice->vratVsechnyPozice();
        $this->data["uroven"] = $modelyUroven->vratVsechnyUroven();

    }

        
        
    }
