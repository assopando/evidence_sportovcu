<?php
class AkcediscKontroler extends Kontroler {
    public function zpracuj($parametry) {
/*


        $modelAkcedisc = new ModelyAkce_disc;
        $modelAkce = new ModelyAkce;
        $modelDisciplin = new ModelyDisciplina;


        // Zpracování formuláře
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pridej'])) {
            // Zde by mělo dojít k zpracování formuláře
            // a volání metody pridejUcastnika z vaší třídy
            $akcedisc = [
                'id_akce_disc' => $_POST['id_akce_disc'],
                'id_akce' => $_POST['id_akce'],
                'id_disc' => $_POST['id_disc'],
                // Další potřebné údaje
            ];

            $pridejAkcedisc= $modelAkcedisc->pridejAkce_disc($akcedisc);

            echo $pridejAkcedisc;

            if ($pridejAkcedisc === 1) {
                // Záznam byl úspěšně přidán
                $this->pridejZpravu("Záznam byl úspěšně přidán.");
                $this->presmeruj("akcedisc");
                
                exit;
            } else if ($pridejAkcedisc === 0) {
                // Záznam již existuje
                $this->pridejZpravu("Záznam již existuje!");
                $this->presmeruj("akcedisc");
                exit;
                
            } else {
                // Nějaká jiná chyba
                // Můžete zde zobrazit chybovou hlášku uživateli
                $this->pridejZpravu("Chyba při přidání záznamu.");
                $this->presmeruj("akcedisc");
                exit;
            }
        }

        else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ulozit']))   {
            
            $hodnoty= [
                'id_akce' => $_POST['id_akce'],
                'id_disc' => $_POST['id_disc'],
                // Další potřebné údaje
                
            ];


            $editAkcedisc= $modelAkcedisc->zmenAkce_disc($hodnoty, $_POST['id_akce_disc']);

            if ($editAkcedisc === 1) {
                // Záznam byl úspěšně editován
                $this->pridejZpravu("Záznamu byla úspěšně editována.");
                $this->presmeruj("akcedisc");
                
                exit;
            } 
            else {
                // Nějaká jiná chyba
                // Můžete zde zobrazit chybovou hlášku uživateli
                $this->pridejZpravu("Chyba při editaci záznamu.");
                
                $this->presmeruj("akcedisc");
                exit;   
            } 
            }
            else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['smazat']))   {
            
                
                $smazAkcedisc= $modelAkcedisc->odeberAkce_disc($_POST['id_akce_disc']);
            
    
                if ($smazAkcedisc === 1) {
                    // Sport byl úspěšně editován
                    $this->pridejZpravu("Záznamu byl úspěšně smazán.");
                    $this->presmeruj("akcedisc");
                    
                    exit;
                } 
                else {
                    // Nějaká jiná chyba
                    // Můžete zde zobrazit chybovou hlášku uživateli
                    $this->pridejZpravu("Chyba při smazání záznamu.");
                    
                    $this->presmeruj("akcedisc");
                    exit;   
                } 
                }

        


        $this->pohled = "akcedisc";
        
        $akcedisc =  $modelAkcedisc->vratVsechnyAkce_disc();
        $this->data["akcedisc"] = $akcedisc;

        $akce=$modelAkce->vratVsechnyAkce();
        $this->data["akce"] = $akce; 

        $disc=$modelDisciplin->vratVsechnyDiscipliny();
        $this->data["disc"] = $disc; 


*/



$modelAkcedisc = new ModelyAkce_disc;
$modelAkce = new ModelyAkce;
$modelDisciplin = new ModelyDisciplina;


// Zpracování formuláře
/*
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pridej'])) {
    // Zde by mělo dojít k zpracování formuláře
    // a volání metody pridejUcastnika z vaší třídy
    $akcedisc = [
        'id_akce' => $_POST['id_akce'],
        'id_disc' => $_POST['id_disc'],
        // Další potřebné údaje
    ];

    $pridejAkcedisc= $modelAkcedisc->pridejAkce_disc($akcedisc);

    echo $pridejAkcedisc;

    if ($pridejAkcedisc === 1) {
        // Záznam byl úspěšně přidán
        $this->pridejZpravu("Záznam byl úspěšně přidán.");
        $this->presmeruj("akcedisc");
        
        exit;
    } else if ($pridejAkcedisc === 0) {
        // Záznam již existuje
        $this->pridejZpravu("Záznam již existuje!");
        $this->presmeruj("akcedisc");
        exit;
        
    } else {
        // Nějaká jiná chyba
        // Můžete zde zobrazit chybovou hlášku uživateli
        $this->pridejZpravu("Chyba při přidání záznamu.");
        $this->presmeruj("akcedisc");
        exit;
    }
}


else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ulozit']))   {
    
    $hodnoty= [
        'id_akce' => $_POST['id_akce'],
        'id_disc' => $_POST['id_disc'],
        // Další potřebné údaje
        
    ];


    $editAkcedisc= $modelAkcedisc->zmenAkce_disc($hodnoty, $_POST['id_akce_disc']);

    if ($editAkcedisc === 1) {
        // Záznam byl úspěšně editován
        $this->pridejZpravu("Záznamu byla úspěšně editována.");
        $this->presmeruj("akcedisc");
        
        exit;
    } 
    else {
        // Nějaká jiná chyba
        // Můžete zde zobrazit chybovou hlášku uživateli
        $this->pridejZpravu("Chyba při editaci záznamu.");
        
        $this->presmeruj("akcedisc");
        exit;   
    } 
    }
    else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['smazat']))   {
    
        
        $smazAkcedisc= $modelAkcedisc->odeberAkce_disc($_POST['id_akce_disc']);
    

        if ($smazAkcedisc === 1) {
            // Sport byl úspěšně editován
            $this->pridejZpravu("Záznamu byl úspěšně smazán.");
            $this->presmeruj("akcedisc");
            
            exit;
        } 
        else {
            // Nějaká jiná chyba
            // Můžete zde zobrazit chybovou hlášku uživateli
            $this->pridejZpravu("Chyba při smazání záznamu.");
            
            $this->presmeruj("akcedisc");
            exit;   
        } 
        }




$this->pohled = "akce";

$akcedisc =  $modelAkcedisc->vratVsechnyAkce_disc();
$this->data["akcedisc"] = $akcedisc;

$akce=$modelAkce->vratVsechnyAkce();
$this->data["akce"] = $akce; 

$disc=$modelDisciplin->vratVsechnyDiscipliny();
$this->data["disc"] = $disc; 




*/
    }
}