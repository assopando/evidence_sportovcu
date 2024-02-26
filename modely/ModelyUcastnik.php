<?php
class ModelyUcastnik{

  //vrati vsechno z tabulky "ucastnik"
    public function vratVsechnyUcastniky() {
        $sql = "
            SELECT *
            FROM ucastnik
        ";
        $ucastnik = Db::dotazVsechny($sql);
        return $ucastnik;
      }

    //vrati posledni id v tabulce
    public function vratPosledniId() {
      $sql = "SELECT id_ucast
              FROM ucastnik
              ORDER BY id_ucast DESC
              LIMIT 1";
      
      $ucastnik = Db::dotazJeden($sql);
      if ($ucastnik === false) return 1;
      else return $ucastnik['id_ucast'];
    }


      /*slouzi k pridani ucastnika do databaze, parametr bude pole, vyzadujici:
    id_ucast
    id_uziv
    id_soup
    *vys_u
    
    * - nepovinny atribut
    
    */
    public function pridejUcastnika($ucastnik) {
        $sql = "
            SELECT id_ucast
            FROM ucastnik
            where id_ucast = ?
        ";
        if(Db::dotazJeden($sql,[$ucastnik["id_ucast"]])){
        return 0;
        }
      Db::vloz("ucastnik",$ucastnik);
      return 1;
    }//vrati 0 pokud v uz databazi ucastnik uz je, vrati 1 pokud v databazi "ucastnik" jeste neni a prida tam
      
      
    //slouzi k odebrani ucastnika z databaze, parametrem bude jen id z databaze(id_ucast)
    public function odeberUcastnika($id){
        $sql = "
          DELETE FROM ucastnik
          where id_ucast = ?
      ";
      if(Db::dotaz($sql,[$id])){
        return 1;
      }
    return 0;
    }//vrati 1 pokud v databazi ucastnika odebere, 0 pokud se akce nepodarila


    /*slouzi ke zmene sloupcu v tabulce "ucastnik", parametry:
    $hodnoty - pole asociativni pro nazev sloupcu a jeji nove hodnoty ["id_uziv"] => 19
                                                                      ["id_soup"] => 5
                                                                      ["vys_u"] => "Student x skoncil na 2. miste v y turnaji"
    $id - id z databaze(id_ucast), čili id konkretniho ucastnika
    */
    public function zmenUcastnika($hodnoty, $id){
      $sql = "
      where id_ucast = ?
      ";
      if(Db::zmen("ucastnik",$hodnoty,$sql,[$id])){
        return 1;
      }
      return 0;

      }//vrati 1 pokud v databazi uspesne provedl zmenu, 0 pokud se akce nepodarila



    
}

?>