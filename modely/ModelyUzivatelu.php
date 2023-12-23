<?php
class ModelyUzivatelu {

    public function prihlas($prihlasovaciUdaje) {
        
      $sql = "
         SELECT *
         FROM uzivatel
         WHERE email = ?
          AND heslo = ?
        ";

      $uzivatel = Db::dotazJeden($sql, 
          [
            $prihlasovaciUdaje["email"],
        $this->vratHashHesla($prihlasovaciUdaje["heslo"])
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
    
    private function vratHashHesla($heslo) {
    
        return hash("sha256", $heslo);
        //return hash("sha512", $heslo);


    }

    public function vratVsechnyUzivatele() {
      $sql = "
          SELECT *
          FROM uzivatel
      ";
      $uzivatel = Db::dotazVsechny($sql);
      return $uzivatel;
    }

    /*funkce slouzi k pridani studenta do uzivatele, parametr bude pole, vyzadujici:
    *id_trid
    student (true)
    *isic
    *email
    heslo
    opravneni
    *jmeno
    *prijmeni

    * - nepovinny atribut
    */
    public function pridejStudenta($uzivatel) {
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
    }//vrati 0 pokud v uz databazi uzivatel uz je, vrati 1 pokud v databazi uzivatel jeste neni a prida tam studenta


    /*funkce slouzi k pridani ucitele do uzivatelu, parametr bude pole, vyzadujici:
    *id_trid - null
    student (false)
    *isic - null
    *email
    heslo
    opravneni
    *jmeno
    *prijmeni
    
    * - nepovinny atribut
    */
    public function pridejUcitele($uzivatel) {
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
                                                                      ["student"] => true
                                                                      ["isic"] => "4df56154sef612564"
                                                                      ["email"] => "s.fabisz.st@spseiostrava.cz"
                                                                      ["heslo"] => "fotbal123"
                                                                      ["opravneni"] => 3
                                                                      ["jmeno"] =>"Sami"
                                                                      ["prijmeni"] =>"Fabi"
    $id - id z databaze(id_user), čili id konkretniho uzivatele
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

    public function vratInfoUzivatele($id){
  // Získání instance připojení k databázi
  $sql = "SELECT id_osob_udaj, email FROM uzivatel WHERE id_uziv = ?";
  $data = Db::dotazJeden($sql, [$id]);

  return $data;

}
        

}
?>