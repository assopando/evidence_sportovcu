<?php
class ModelySportuje {

    public function vratVsechySportuje() {
        $sql = "
            SELECT *
            FROM sportuje
        ";
        $sportuje = Db::dotazVsechny($sql);
        return $sportuje;
      }



      /*funkce slouzi k pridani hodnot do databaze, parametr bude pole, vyzadujici:
      id_sportuje
      id_disc (id discipliny)
      id_stud (id_uzivatele)
      *pozice
      *tym
      *uroven

      * - nepovinny atribut
      */
    public function pridejSportuje($sportuje) {
        $sql = "
            SELECT id_sportuje
            FROM sportuje
            where id_sportuje = ?
        ";
        if(Db::dotazJeden($sql,[$sportuje["id_sportuje"]])){
        return 0;
        }
      Db::vloz("sportuje",$sportuje);
      return 1;
    }//vrati 0 pokud v uz databazi hodnoty uz jsou, vrati 1 pokud v databazi "sportuje" jeste neni a prida tam hodnoty
      

    //funkce slouzi k odebrani hodnoty z databaze, parametrem bude jen id z databaze(id_sportuje)
    public function odeberSportuje($id){
        $sql = "
          DELETE FROM sportuje
          where id_sportuje = ?
      ";
      if(Db::dotaz($sql,[$id])){
        return 1;
      }
    return 0;
    }//vrati 1 pokud v databazi hodnoty odebere, 0 pokud se akce nepodarila


    /*funkce slouzi ke zmene sloupcu v tabulce "sportuje", parametry:
    $hodnoty - pole asociativni pro nazev sloupcu a jeji nove hodnoty(["id_disc"] => 3
                                                                      ["id_stud"] => 2
                                                                      ["pozice"] => "leve kridlo"
                                                                      ["tym"] => "Baník"
                                                                      ["uroven"] => "Celostátní liga U19"
    $id - id z databaze(id_sportuje), čili id konkretniho řádku
    */
    public function zmenSportuje($hodnoty, $id){
        $sql = "
        where id_sportuje = ?
        ";
        if(Db::zmen("sportuje",$hodnoty,$sql,[$id])){
          return 1;
        }
        return 0;

      }//vrati 1 pokud v databazi uspesne provedl zmenu, 0 pokud se akce nepodarila




    
}

?>