<?php
class ModelyUcastnik{



/*
!!! Work in progress !!!
*/






  //vrati vsechno z tabulky "ucastnik"
    public function vratVsechnySporty() {
        $sql = "
            SELECT *
            FROM ucastnik
        ";
        $ucastnik = Db::dotazVsechny($sql);
        return $ucastnik;
      }



      /*slouzi k pridani ucastnika do databaze, parametr bude pole, vyzadujici:
    id_ucastnik
    id_uziv
    id_soup*/
    public function pridejUcastnika($ucastnik) {
      
        $sql = "
            SELECT id_ucast
            FROM ucastnik
            where id_ucast = ?
        ";
        if(Db::dotazJeden($sql,[$ucastnik["id_ucast"]])){
        return 0;
        }
        $sql = "
            SELECT nazev_sportu
            FROM ucastnik
            where nazev_sportu = ?
        ";
        if(Db::dotazJeden($sql,[$ucastnik["nazev_sportu"]])){
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
    $hodnoty - pole asociativni pro nazev sloupcu a jeji nove hodnoty ["id_ucastnik"] => "5"
                                                                      ["id_uziv"] => "19"
                                                                      ["id_soup"] => "5"
    $id - id z databaze(id_ucast), čili id konkretniho ucastnika
    */
    public function zmenUcastnika($hodnoty, $id){

      $sql = "
      SELECT nazev_sportu
      FROM ucastnik
      where nazev_sportu = ?
      ";
      if(Db::dotazJeden($sql,[$hodnoty["nazev_sportu"]])){
        return 0;
      }


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