<?php
class ModelyUzivatel {

    public function prihlas($prihlasovaciUdaje) {
        
      $sql = "
         SELECT *
         FROM uzivatel
         WHERE email = ?
        ";

      $uzivatel = Db::dotazJeden($sql, 
          [
            $prihlasovaciUdaje["email"],
        //$this->vratHashHesla($prihlasovaciUdaje["heslo"])
          ]  
      );
          
      if ($uzivatel) {
          $_SESSION["uzivatel"] = $uzivatel;
          return 1;
      }
      return 0;    

    }
    
    public function odhlas() {

        if ($this->vratPrihlasenehoUzivatele()) {
          unset($_SESSION["uzivatel"]);
          return 1;
        }
        return 0;

    }
    
    public function vratPrihlasenehoUzivatele() {

        if (isset($_SESSION["uzivatel"]))
          return $_SESSION["uzivatel"];
        else
          return false;    
    }
    
/*
    private function vratHashHesla($heslo) {
    
        return hash("sha256", $heslo);
        //return hash("sha512", $heslo);


    }
*/
    public function vratVsechnyUzivatele() {
      $sql = "
          SELECT *
          FROM uzivatel
      ";
      $uzivatel = Db::dotazVsechny($sql);
      return $uzivatel;
    }

    /*funkce slouzi k pridani studenta do uzivatele, parametr bude pole, vyzadujici:
    id_uziv
    *id_trid
    *isic
    *email
    opravneni
    *jmeno
    *prijmeni
    *dat_nar
    *pohlavi

    * - nepovinny atribut
    */
    public function pridejStudenta($uzivatel) {
      if($uzivatel["opravneni"]==1){
      $sql = "
            SELECT id_uziv
            FROM uzivatel
            where id_uziv = ?
        ";
        if(Db::dotazJeden($sql,[$uzivatel["id_uziv"]])){
        return 0;
        }

      $sql = "
          SELECT isic
          FROM uzivatel
          where isic = ?
      ";
      if(Db::dotazJeden($sql,[$uzivatel["isic"]])){
      return 0;
      }
    Db::vloz("uzivatel",$uzivatel);
    
    return 1;
      }
      else return 2;
    }//vrati 0 pokud v uz databazi uzivatel uz je, vrati 1 pokud v databazi uzivatel jeste neni a prida tam studenta


    /*funkce slouzi k pridani ucitele do uzivatelu, parametr bude pole, vyzadujici:
    id_uziv
    *id_trid - null
    *isic - null
    *email
    opravneni
    *jmeno
    *prijmeni
    *dat_nar
    *pohlavi
    *komentar_uziv
    
    * - nepovinny atribut
    */
    public function pridejUcitele($uzivatel) {
      if($uzivatel["opravneni"]!=1){
      $sql = "
          SELECT id_uziv
          FROM uzivatel
          where id_uziv = ?
      ";
      if(Db::dotazJeden($sql,[$uzivatel["id_uziv"]])){
      return 0;
      }
    Db::vloz("uzivatel",$uzivatel);
    return 1;
      }
      else return 2;
    }//vrati 0 pokud v uz databazi uzivatel uz je, vrati 1 pokud v databazi uzivatel jeste neni a prida tam ucitele

    
    
    //funkce slouzi k odebrani uzivatele z databaze, parametrem bude jen id z databaze(id_uziv)
        public function odeberUzivatele($id){
        $sql = "
          DELETE FROM uzivatel
          where id_uziv = ?
      ";
      if(Db::dotaz($sql,[$id])){
        return 1;
      }
    return 0;
    }//vrati 1 pokud v databazi uzivatel odebere, 0 pokud se akce nepodarila


    /*funkce slouzi ke zmene sloupcu v tabulce "uzivatel", parametry:
    $hodnoty - pole asociativni pro nazev sloupcu a jeji nove hodnoty ["id_trid"] =>
                                                                      ["isic"] => "4df56154sef612564"
                                                                      ["email"] => "s.fabisz.st@spseiostrava.cz"
                                                                      ["opravneni"] => 3
                                                                      ["jmeno"] =>"Sami"
                                                                      ["prijmeni"] =>"Fabi"
                                                                      ["dat_nar"] =>
                                                                      ["pohlavi"] =>"ž"
                                                                      ["komentar_uziv"] =>"Vyborný atlet"
    $id - id z databaze(id_uziv), čili id konkretniho uzivatele
    */
      public function zmenUzivatele($hodnoty){
        $sql = "
        where id_uziv = ?
        ";
        try{
        if(Db::zmen("uzivatel",$hodnoty,$sql,[$hodnoty["id_uziv"]])){
          return 1;
        }
        return 0;
      }catch(PDOException $e){
        var_dump($e->getMessage());
      } 

      }//vrati 1 pokud v databazi uspesne provedl zmenu, 0 pokud se akce nepodarila

//vrati informace vsech ucitelu vsechny ucitele
    public function vratInfoVsechUcitelu(){
      $data = array();
    for ($i = 0; $i < 100; $i++) {
      $sql = "SELECT id_uziv FROM uzivatel WHERE id_uziv = ?";
      $id = Db::dotazJeden($sql, [$i]);
      if($id!=NULL){
      $sql = "SELECT id_uziv, jmeno, prijmeni, email, opravneni FROM uzivatel WHERE id_uziv = ?";
      $data[] = Db::dotazJeden($sql, [$i]);
      }
    }
    return $data;
}
/*
public function vratInfoVsechUcitelu(){
  $data = array(); // Initialize an array to store the data
  for ($i = 0; $i < 100; $i++) {
      $sql = "SELECT id_uziv, jmeno, prijmeni, email, opravneni FROM uzivatel WHERE id_uziv = ?";
      $data[] = Db::dotazJeden($sql, [$i]); // Store each row in the array
  }
  return $data; // Return the array
}
*/

//vrati info o studentovi, vyzaduje isic
    public function vratInfoStudenta($isic){
      $sql = "SELECT jmeno, prijmeni, id_trid, email,  FROM uzivatel WHERE isic = ?";
      $data = Db::dotazJeden($sql, [$isic]);

      return $data;

    }
    
    public function vratInfoPodleEmailu($email) {
      $sql = "SELECT * FROM uzivatel WHERE email = ?";
      return Db::dotazJeden($sql, [$email]);
  }

    // Uložení nových údajů do databáze
    public function upravDodatecneUdaje($email, $kontaktniUdaje, $odkazNaWeb, $zdravotniOmezeni, $sportovniAktivity) {
      $sql = "
          UPDATE uzivatel
          SET kontaktni_udaje = ?, odkaz_na_web = ?, zdravotni_omezeni = ?, sportovni_aktivity = ?
          WHERE email = ?
      ";
      Db::dotaz($sql, [$kontaktniUdaje, $odkazNaWeb, $zdravotniOmezeni, $sportovniAktivity, $email]);
  }


// Funkce slouží k odebrání všech uživatelů s oprávněním = 0
public function vymazStudenty() {
  // Disable foreign key checks
  Db::dotaz("SET foreign_key_checks = 0;");

  $sql = "
      DELETE FROM uzivatel
      WHERE opravneni = 0
  ";
  $result = Db::dotaz($sql);

  // Enable foreign key checks
  Db::dotaz("SET foreign_key_checks = 1;");

  if ($result) {
      return 1;
  }
  return 0;
  // Vrátí 1 pokud v databázi uživatelé s oprávněním = 0 byli odebráni, 0 pokud se akce nepodaří
}



}
?>