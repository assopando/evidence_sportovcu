<?php
class ModelyOsobniUdaje{

  //funkce vrati vsechno z tabulky "osobni_udaje"
    public function vratVsechyOsobniUdaje() {
        $sql = "
            SELECT *
            FROM osobni_udaje
        ";
        $osobniUdaje = Db::dotazVsechny($sql);
        return $osobniUdaje;
      }



      /*funkce slouzi k pridani osobnich udaju do databaze, parametr bude pole, vyzadujici:
    jmeno
    prijmeni*/
    public function pridejOsobniUdaje($osobniUdaje) {
        $sql = "
            SELECT jmeno, prijmeni
            FROM osobni_udaje
            where jmeno = ?
            and prijmeni = ? 
        ";
        if(Db::dotazJeden($sql,[$osobniUdaje["nazev"]])){
        return 0;
        }
      Db::vloz("osobni_udaje",$osobniUdaje);
      return 1;
    }//vrati 0 pokud v uz databazi osobni udaje jsou, vrati 1 pokud v databazi "osobni_udaje" jeste nejsou a prida tam
      
      
    //funkce slouzi k odebrani osobni udaje z databaze, parametrem bude jen id z databaze(id_osob_udaj)
    public function odeberOsobniUdaje($id){
        $sql = "
          DELETE FROM osobni_udaje
          where id_osob_udaj = ?
      ";
      if(Db::dotaz($sql,[$id])){
        return 1;
      }
    return 0;
    }//vrati 1 pokud v databazi osobni udaj odebere, 0 pokud se akce nepodarila


    /*funkce slouzi ke zmene sloupcu v tabulce "osobni_udaje", parametry:
    $hodnoty - pole asociativni pro nazev sloupcu a jeji nove hodnoty ["jmeno"] => "Samuel"
                                                                      ["prijmeni"] => "Fabiž"
                                                                    
    $id - id z databaze(id_osob_udaj), čili id konkretniho osobniho udaje
    */
    public function zmenOsobniUdaje($hodnoty, $id){
        $sql = "
        where id_osob_udaj = ?
        ";
        if(Db::zmen("osobni_udaje",$hodnoty,$sql,[$id])){
          return 1;
        }
        return 0;

      }//vrati 1 pokud v databazi uspesne provedl zmenu, 0 pokud se akce nepodarila




    
}

?>