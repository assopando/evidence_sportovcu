<?php
class PridelenidisciplinKontroler extends Kontroler  {

    public function zpracuj($parametry){

          $modelyUzivatelu= new ModelyUzivatel;
        $modelyDisciplin= new ModelyDisciplina;
        $modelySportuje = new ModelySportuje;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pridej'])) {
            // Zpracujte data z formuláře
           // $id_sportuje = $_POST['id_sportuje'];
            $id_disc = $_POST['id_disc'];
            $id_stud = $_POST['id_uziv'];
            $pozice = isset($_POST['pozice']) ? $_POST['pozice'] : null;
            $tym = isset($_POST['tym']) ? $_POST['tym'] : null;
            $uroven = isset($_POST['uroven']) ? $_POST['uroven'] : null;

            // Validace a další zpracování dat, pokud je to potřeba

            // Volání metody pro přidání hodnot do databáze
             // Upravte název modelu podle vaší implementace
            $result = $modelySportuje->pridejSportuje([
               // 'id_sportuje' => $id_sportuje,
                'id_disc' => $id_disc,
                'id_stud' => $id_stud,
                'pozice' => $pozice,
                'tym' => $tym,
                'uroven' => $uroven,
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

    }

        
        
    }
