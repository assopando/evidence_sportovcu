<?php
class SportyKontroler extends Kontroler {
    public function zpracuj($parametry) {

        $modelSporty= new ModelySport();

        
        


        // Zpracování formuláře
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pridej'])) {
            // Zde by mělo dojít k zpracování formuláře
            // a volání metody pridejSporty z vaší třídy
            $sport = [
                'id_sport' => $_POST['id_sport'],
                'nazev_sportu' => $_POST['nazev_sportu'],
                // Další potřebné údaje sportu
            ];

            $pridejSport= $modelSporty->pridejSporty($sport);

            echo $pridejSport;

            if ($pridejSport === 1) {
                // Sport byl úspěšně přidán
                $this->pridejZpravu("Sport byl úspěšně přidán.");
                $this->presmeruj("sporty");
                
                exit;
            } else if ($pridejSport === 0) {
                // Sport již existuje
                $this->pridejZpravu("Sport již existuje!");
                $this->presmeruj("sporty");
                exit;
                
            } else {
                // Nějaká jiná chyba
                // Můžete zde zobrazit chybovou hlášku uživateli
                $this->pridejZpravu("Chyba při přidání sportu.");
                $this->presmeruj("sporty");
                exit;
            }
        }
        else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ulozit']))   {
            
            $hodnoty= [
                'nazev_sportu' => $_POST['novy_nazev_sportu'],
                
            ];

            $editSport= $modelSporty->zmenSport($hodnoty, $_POST['editovany_sport_id']);

            if ($editSport === 1) {
                // Sport byl úspěšně editován
                $this->pridejZpravu("Sport byl úspěšně editován.");
                $this->presmeruj("sporty");
                
                exit;
            } 
            else {
                // Nějaká jiná chyba
                // Můžete zde zobrazit chybovou hlášku uživateli
                $this->pridejZpravu("Chyba při editaci sportu.");
                
                $this->presmeruj("sporty");
                exit;   
            } 
            }
            else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['smazat']))   {
            
                
    
                $smazSport= $modelSporty->odeberSport($_POST['smazany_sport_id']);
    
                if ($smazSport === 1) {
                    // Sport byl úspěšně editován
                    $this->pridejZpravu("Sport byl úspěšně smazán.");
                    $this->presmeruj("sporty");
                    
                    exit;
                } 
                else {
                    // Nějaká jiná chyba
                    // Můžete zde zobrazit chybovou hlášku uživateli
                    $this->pridejZpravu("Chyba při smazání sportu.");
                    
                    $this->presmeruj("sporty");
                    exit;   
                } 
                }

          $this->pohled = "sporty";

        $sporty=$modelSporty->vratVsechnySporty();
        $this->data["sporty"] = $sporty;  
        }

      
        
    }
