<?php
class ModelySport{

    public function vratVsechyBarvy() {
        $sql = "
            SELECT *
            FROM sport
        ";
        $sport = Db::dotazVsechny($sql);
        return $sport;
      }



      /*funkce slouzi k pridani sportu do databaze, parametr bude pole, vyzadujici:
    nazev*/
    public function pridejSporty($sport) {
        $sql = "
            SELECT nazev
            FROM sport
            where nazev = ?
        ";
        if(Db::dotazJeden($sql,[$sport["nazev"]])){
        return 0;
        }
      Db::vloz("sport",$sport);
      return 1;
    }//vrati 0 pokud v uz databazi barva uz je, vrati 1 pokud v databazi Barvy jeste neni a prida tam barvu
      
      
    //funkce slouzi k odebrani sportu z databaze, parametrem bude jen id z databaze(id_sport)
    public function odeberSport($id){
        $sql = "
          DELETE FROM sport
          where nazev = ?
      ";
      if(Db::dotaz($sql,[$id])){
        return 1;
      }
    return 0;
    }//vrati 1 pokud v databazi sport odebere, 0 pokud se akce nepodarila


    /*funkce slouzi ke zmene sloupcu v tabulce "sport", parametry:
    $hodnoty - pole asociativni pro nazev sloupcu a jeji nove hodnoty(["nazev"] => "Atletika"
    $id - id z databaze(id_sport), čili id konkretniho sportu
    */
    public function zmenSport($hodnoty, $id){
        $sql = "
        where nazev = ?
        ";
        if(Db::zmen("sport",$hodnoty,$sql,[$id])){
          return 1;
        }
        return 0;

      }//vrati 1 pokud v databazi uspesne provedl zmenu, 0 pokud se akce nepodarila




    
}

?>