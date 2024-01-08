<?php
class DisciplinaKontroler extends Kontroler {
    public function zpracuj($parametry) {

        $modelDisciplin= new ModelyDisciplina();
        $modelSporty= new ModelySport();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pridej'])) {
           
           
            $discipliny = [
                'id_disc' => $_POST['id_disc'],
                'id_sport' => $_POST['id_sport'],
                'nazev_disc' => $_POST['nazev_disc'],
               
            ];

            $pridejDisc= $modelDisciplin->pridejDisciplinu($discipliny);

            if ($pridejDisc === 1) {
                // Disciplina  byla úspěšně přidán
                $this->pridejZpravu("Disciplína byla úspěšně přidán.");
                $this->presmeruj("disciplina");
                
                exit;
            } else if ($pridejDisc === 0) {
                // Disciplína již existuje
                $this->pridejZpravu("Disciplína již existuje!");
                $this->presmeruj("disciplina");
                exit;
                
            } else {
                // Nějaká jiná chyba
                // Můžete zde zobrazit chybovou hlášku uživateli
                $this->pridejZpravu("Chyba při přidání disciplíny.");
                $this->presmeruj("disciplina");
                exit;
            }
        }
        else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ulozit']))   {
            
            $hodnoty= [
                'id_disc' => $_POST['editovana_disciplina_id'],
                'id_sport' => $_POST['editovany_sport_id'],
                'nazev_disc' => $_POST['novy_nazev_discipliny'],
                
            ];

            $editDisc= $modelDisciplin->zmenDisciplinu($hodnoty, $_POST['editovana_disciplina_id']);

            if ($editDisc === 1) {
                // Sport byl úspěšně editován
                $this->pridejZpravu("Disciplína byla úspěšně editována.");
                $this->presmeruj("disciplina");
                
                exit;
            } 
            else {
                // Nějaká jiná chyba
                // Můžete zde zobrazit chybovou hlášku uživateli
                $this->pridejZpravu("Chyba při editaci disciplíny.");
                
                $this->presmeruj("disciplina");
                exit;   
            } 
            }
            else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['smazat']))   {
            
                
    
                $smazDisc= $modelDisciplin->odeberDisciplinu($_POST['smazana_disciplina_id']);
            
    
                if ($smazDisc === 1) {
                    // Sport byl úspěšně editován
                    $this->pridejZpravu("Disciplína byl úspěšně smazán.");
                    $this->presmeruj("disciplina");
                    
                    exit;
                } 
                else {
                    // Nějaká jiná chyba
                    // Můžete zde zobrazit chybovou hlášku uživateli
                    $this->pridejZpravu("Chyba při smazání disciplíny.");
                    
                    $this->presmeruj("disciplina");
                    exit;   
                } 
                }

        


        $this->pohled = "disciplina";
        $discipliny=$modelDisciplin->vratVsechnyDiscipliny();
        $this->data["discipliny"] = $discipliny; 
        
        $sporty=$modelSporty->vratVsechnySporty();
        $this->data["sporty"] = $sporty; 
    }
}