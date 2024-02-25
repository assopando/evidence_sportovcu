<?php
class ModelySport_disc{

  //vrati vsechno z tabulky "sport_disc"
    public function vratVsechnySport_disc() {
        $sql = "
            SELECT *
            FROM sport_disc
        ";
        $sport_disc = Db::dotazVsechny($sql);
        return $sport_disc;
      }


            //vrati posledni id v tabulce
            public function vratPosledniId() {
              return Db::idPoslednihoVlozeneho();
    
        }


      /*slouzi k pridani záznamu do databaze, parametr bude pole, vyzadujici:
    id_sport_disc
    id_sport
    id_disc
    
    
    */
    public function pridejSport_disc($sport_disc) {
        $sql = "
            SELECT id_sport_disc
            FROM sport_disc
            where id_sport_disc = ?
        ";
        if(Db::dotazJeden($sql,[$sport_disc["id_sport_disc"]])){
        return 0;
        }
      Db::vloz("sport_disc",$sport_disc);
      return 1;
    }//vrati 0 pokud v uz databazi záznam uz je, vrati 1 pokud v databazi "sport_disc" jeste neni a prida tam
      
      
    //slouzi k odebrani záznamu z databaze, parametrem bude jen id z databaze(id_sport_disc)
    public function odeberSport_disc($id){
        $sql = "
          DELETE FROM sport_disc
          where id_sport_disc = ?
      ";
      if(Db::dotaz($sql,[$id])){
        return 1;
      }
    return 0;
    }//vrati 1 pokud v databazi záznam odebere, 0 pokud se akce nepodarila


    /*slouzi ke zmene sloupcu v tabulce "sport_disc", parametry:
    $hodnoty - pole asociativni pro nazev sloupcu a jeji nove hodnoty ["id_sport"] => 19
                                                                      ["id_disc"] => 5
    $id - id z databaze(id_sport_disc), čili id konkretniho záznamu
    */
    public function zmenSport_disc($hodnoty, $id){

      $sql = "
      where id_sport_disc = ?
      ";
      if(Db::zmen("sport_disc",$hodnoty,$sql,[$id])){
        return 1;
      }
      return 0;

      }//vrati 1 pokud v databazi uspesne provedl zmenu, 0 pokud se akce nepodarila



    
}

?>