<?php

use LdapRecord\Models\ActiveDirectory\User;
use LdapRecord\Container;
use LdapRecord\Connection;


    $connection = new Connection([
        'hosts' => ['192.168.1.31'],
        'username' => 's.fabisz.st@testovaci.local',
        'password' => '11082004Sf',
        'base_dn' => 'dc=testovaci,dc=local',
        'port' => 389,
    ]);

  /*  $connection = new Connection([
        'hosts' => ['msad19.spseiostrava.cz'],
        'username' => 's.fabisz.st@spseiostrava.cz',
        'password' => '11082004Sf',
        'base_dn' => 'dc=msad19,dc=spseiostrava,dc=cz',
        'port' => 389,
    ]);*/
    
    $connection->connect();
    Container::addConnection($connection, 'ldap'); // Přidejte připojení do kontejneru s názvem 'ldap'

    try {
        $connection->connect();
    
       // echo "Successfully connected!";
       // echo "<br>";
        
    } catch (\LdapRecord\Auth\BindException $e) {
        $error = $e->getDetailedError();
    
        echo $error->getErrorCode();
        echo $error->getErrorMessage();
        echo $error->getDiagnosticMessage();
    }


    

class ImportcsvKontroler extends Kontroler {
    public function zpracuj($parametry) {

        // Zde můžete přidat kód pro zpracování formuláře pro nahrání CSV souboru (HTML, formulář, atd.)
        
        if (isset($_POST['import'])) {
            try {
                // Získání cesty k nahranému CSV souboru
                $csvFilePath = $_FILES['csv_file']['tmp_name'];

                // Volání metody pro import osobních údajů
                $this->importujOsobniUdaje($csvFilePath);

                echo "Data byla úspěšně importována do databáze.<br>";
                $modelyUzivatelu = new ModelyUzivatel;

        // Sestavte dotaz pro získání jmen a příjmení všech uživatelů v organizační jednotce SpseiUsers
        $users = User::on('ldap')->select('givenName', 'sn','mail')->in('OU=SpseiUsers,dc=testovaci,dc=local')->get();
   
        $uspesneAktualizovaneEmaily = 0;
        $neuspesneAktualizovaneEmaily = 0;
        $nenalezenyUzivatel=0;

foreach ($users as $user) {
    $ldapEmail = $user->mail[0];

    $existingUser = Db::dotazJeden("SELECT * FROM uzivatel WHERE jmeno = ? AND prijmeni = ?", [$user->givenName[0], $user->sn[0]]);

    if ($existingUser) {
        $hodnoty = [
            "id_uziv" => $existingUser["id_uziv"],
            "email" => $ldapEmail,
        ];

        $zmenaVDb = $modelyUzivatelu->zmenUzivatele($hodnoty);

        if ($zmenaVDb === 1) {
            $uspesneAktualizovaneEmaily++;
           // echo "E-mail uživatele " . $user->givenName[0] . " úspěšně aktualizován na $ldapEmail.<br>";
        } else {
            $neuspesneAktualizovaneEmaily++;
            echo "Chyba při aktualizaci e-mailu uživatele " . $user->givenName[0] ." ". $user->sn[0] . ".<br>";
        }
    } else {
        $nenalezenyUzivatel++;
        echo "Uživatel " . $user->givenName[0] ." ". $user->sn[0] . " nenalezen v databázi.<br>";
    }
}

echo "Počet úspěšně aktualizovaných e-mailů: $uspesneAktualizovaneEmaily<br>";
//echo "Počet neúspěšně aktualizovaných e-mailů: $neuspesneAktualizovaneEmaily<br>";
echo "Počet nenalezených uživatelů :  $nenalezenyUzivatel<br>";
                
            } catch (Exception $e) {
                echo "Chyba: " . $e->getMessage();
            }
        }
        $modelyUzivatelu = new ModelyUzivatel;
        // Zde můžete přidat kód pro zobrazení stránky s formulářem pro import CSV souboru
        $this->pohled = "importcsv";  // Nastavte název pohledu dle vaší aplikace
      //  $this->data["uzivatele"]=$modelyUzivatelu->vratVsechnyUzivatele();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vyprazdnit'])) {
            $vyprazdneni = $modelyUzivatelu->vymazUzivatele();
            if ($vyprazdneni === 1) {
                //Úspěch
                $this->presmeruj("importcsv");
                $this->pridejZpravu("Vyprázdnění studentů bylo úspěšné.");
                exit;   
            } 
            else {
                // Nějaká jiná chyba
                // Můžete zde zobrazit chybovou hlášku uživateli
                header("Refresh:0"); 
                $this->pridejZpravu("Chyba při smazání záznamu."); 
                
            } 
        }



    }

    private function importujOsobniUdaje($csvFilePath) {
        // Otevření souboru pomocí SPLFileObject
        $file = new SplFileObject($csvFilePath, 'r');
    
        $modelyUzivatelu = new ModelyUzivatel;
    
        // Přečtení prvního řádku (hlavičky)
        $header = $file->fgetcsv(';');
    
        // Kontrola, zda hlavička obsahuje očekávané klíče
        if (!isset($header[0], $header[1], $header[2], $header[3])) {
            echo "Chyba: Hlavička souboru neobsahuje očekávané klíče.";
            return;
        }
        $i=100;
        // Iterace přes zbývající řádky souboru
        while (!$file->eof()) {
            // Přečtení řádku
            $data = $file->fgetcsv(';');
    
            // Přidání kontroly existence očekávaných klíčů v poli $data
            if (isset($data[0], $data[1], $data[2], $data[3])) {
                // Příprava dat pro vložení do databáze a převedení na UTF-8MB4
                $datum = explode('.', str_replace(' ', '', $data[4]));
                $novyFormat = $datum[2] . '-' . $datum[1] . '-' . $datum[0];
                $uzivatel = [
                    'id_uziv' => $i,
                    'jmeno' => iconv('Windows-1250', 'UTF-8', $data[0]),
                    'prijmeni' => iconv('Windows-1250', 'UTF-8', $data[1]),
                    'id_trid' => iconv('Windows-1250', 'UTF-8', $data[2]),
                    'isic' => iconv('Windows-1250', 'UTF-8', $data[3]),
                    'opravneni' => 0,
                    'dat_nar' => iconv('Windows-1250', 'UTF-8', $novyFormat),
                    'pohlavi' => iconv('Windows-1250', 'UTF-8', $data[5]),
                ];
                $i++;
                

              
                

                
    
                // Volání metody pro přidání osobních údajů do databáze
                $modelyUzivatelu->pridejStudenta($uzivatel);
            } else {
               
            }
        }
    
        // Zavření souboru
        $file = null;
    }

}
?>

