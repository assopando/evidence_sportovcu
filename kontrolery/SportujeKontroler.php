<?php
class SportujeKontroler extends Kontroler {
    public function zpracuj($parametry) {

        $modelSportuje= new ModelySportuje;
        $modelDisciplina= new ModelyDisciplina;
        $modelUzivatel= new ModelyUzivatel;
        $modelPozice= new ModelyPozice;
        $modelUroven= new ModelyUroven;



        // Zpracování formuláře
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pridej'])) {
            // Zde by mělo dojít k zpracování formuláře
            // a volání metody pridejSportuje z vaší třídy
            $sportuje = [
                'id_sportuje' => $_POST['id_sportuje'],
                'id_disc' => $_POST['id_disc'],
                'id_stud' => $_POST['id_stud'],
                'id_poz' => $_POST['id_poz'],
                'id_urov' => $_POST['id_urov'],
                'tym' => $_POST['tym'],
                'rekord' => $_POST['rekord'],
                // Další potřebné údaje
            ];

            $pridejSportuje= $modelSportuje->pridejSportuje($sportuje);

            echo $pridejSportuje;

            if ($pridejSportuje === 1) {
                // Záznam byl úspěšně přidán
                $this->pridejZpravu("Záznam byl úspěšně přidán.");
                $this->presmeruj("sportuje");
                
                exit;
            } else if ($pridejSportuje === 0) {
                // Záznam již existuje
                $this->pridejZpravu("Záznam již existuje!");
                $this->presmeruj("sportuje");
                exit;
                
            } else {
                // Nějaká jiná chyba
                // Můžete zde zobrazit chybovou hlášku uživateli
                $this->pridejZpravu("Chyba při přidání záznamu.");
                $this->presmeruj("sportuje");
                exit;
            }
        }
        else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ulozit']))   {
            
            $hodnoty= [
                'id_disc' => $_POST['id_disc'],
                'id_stud' => $_POST['id_stud'],
                'id_poz' => $_POST['id_poz'],
                'id_urov' => $_POST['id_urov'],
                'tym' => $_POST['tym'],
                'rekord' => $_POST['rekord'],
                // Další potřebné údaje
                
            ];


            $editSportuje= $modelSportuje->zmenSportuje($hodnoty, $_POST['id_sportuje']);

            if ($editSportuje === 1) {
                // Záznam byl úspěšně editován
                $this->pridejZpravu("Záznamu byla úspěšně editována.");
                $this->presmeruj("sportuje");
                
                exit;
            } 
            else {
                // Nějaká jiná chyba
                // Můžete zde zobrazit chybovou hlášku uživateli
                $this->pridejZpravu("Chyba při editaci záznamu.");
                
                $this->presmeruj("sportuje");
                exit;   
            } 
            }
            else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['smazat']))   {
            
                
                $smazSportuje= $modelSportuje->odeberSportuje($_POST['id_sportuje']);
            
    
                if ($smazSportuje === 1) {
                    // Sport byl úspěšně editován
                    $this->pridejZpravu("Záznamu byl úspěšně smazán.");
                    $this->presmeruj("sportuje");
                    
                    exit;
                } 
                else {
                    // Nějaká jiná chyba
                    // Můžete zde zobrazit chybovou hlášku uživateli
                    $this->pridejZpravu("Chyba při smazání záznamu.");
                    
                    $this->presmeruj("sportuje");
                    exit;   
                } 
                }


        


        $this->pohled = "sportuje";

        $sportuje=$modelSportuje->vratVsechySportuje();
        $this->data["sportuje"] = $sportuje; 

        $disciplina=$modelDisciplina->vratVsechnyDiscipliny();
        $this->data["disciplina"] = $disciplina;
        
        $uzivatel=$modelUzivatel->vratVsechnyUzivatele();
        $this->data["uzivatel"] = $uzivatel; 

        $pozice=$modelPozice->vratVsechnyPozice();
        $this->data["pozice"] = $pozice;

        $uroven=$modelUroven->vratVsechnyUroven();
        $this->data["uroven"] = $uroven;


    }
}