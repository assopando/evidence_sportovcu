<?php
class SportovciKontroler extends Kontroler {
    public function zpracuj($parametry) {

        $modelySportuje = new ModelySportuje();
        $modelyUzivatel = new ModelyUzivatel();
        $modelyDisciplin = new ModelyDisciplina();
        $modelyPozice = new ModelyPozice();
        $modelyUroven = new ModelyUroven();


    //Delete záznamu------------------------------------------------------------------------------------------------------------------        
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['smazat'])) {
            $radek = $_POST['radek'];
            var_dump($radek);
            $smazSportuje= $modelySportuje->odeberSportuje($radek);

            if ($smazSportuje === 1) {
                //Úspěch
                $this->pridejZpravu("Záznam byl úspěšně smazán.");
                header("Refresh:0"); 
                   
            } 
            else {
                // Nějaká jiná chyba
                // Můžete zde zobrazit chybovou hlášku uživateli
                $this->pridejZpravu("Chyba při smazání záznamu."); 
            } 
        }



        
        $this->data["sportovci"]=$modelySportuje->vratVsechySportuje();
        $this->data["sportuje"]=$modelyUzivatel->vratVsechnyUzivatele();
        $this->data["disc"]=$modelyDisciplin->vratVsechnyDiscipliny();
        $this->data["poz"]=$modelyPozice->vratVsechnyPozice();
        $this->data["urov"]=$modelyUroven->vratVsechnyUroven();
        $this->pohled = "sportovci";
    }
}