<?php

class ProfilKontroler extends Kontroler {

    public function zpracuj($parametry) {
        $this->pohled = 'profil';

        // Zkontroluj, zda je uživatel přihlášen
        if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
            $this->data['uzivatel'] = null;
            return;
        }

        // Získání emailu přihlášeného uživatele z session
        $emailUzivatele = $_SESSION['email'];

        // Vytvoření instance modelu pro práci s uživateli
        $modelUzivatel = new ModelyUzivatel();

        // Získání informací o přihlášeném uživateli z databáze
        $uzivatelInfo = $modelUzivatel->vratInfoPodleEmailu($emailUzivatele);

        // Kontrola, zda byl uživatel nalezen v databázi
        if ($uzivatelInfo) {
            $this->data['uzivatel'] = $uzivatelInfo;
        } else {
            // Uživatel nenalezen v databázi
            $this->data['uzivatel'] = null;
        }

        // Zpracování formuláře pro úpravu dodatečných údajů
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Zkontroluj, zda byly odeslány údaje z formuláře
            if (isset($_POST['kontaktni_udaje']) && isset($_POST['odkaz_na_web']) && isset($_POST['zdravotni_omezeni']) && isset($_POST['sportovni_aktivity'])) {
                // Získání hodnot z formuláře
                $kontaktniUdaje = $_POST['kontaktni_udaje'];
                $odkazNaWeb = $_POST['odkaz_na_web'];
                $zdravotniOmezeni = $_POST['zdravotni_omezeni'];
                $sportovniAktivity = $_POST['sportovni_aktivity'];

                // Uložení nových údajů do databáze
                $modelUzivatel->upravDodatecneUdaje($emailUzivatele, $kontaktniUdaje, $odkazNaWeb, $zdravotniOmezeni, $sportovniAktivity);

                // Získání aktualizovaných informací o uživateli
                $uzivatelInfo = $modelUzivatel->vratInfoPodleEmailu($emailUzivatele);

                // Aktualizace dat pro zobrazení v pohledu
                $this->data['uzivatel'] = $uzivatelInfo;
            }
        }
    }
}


?>
