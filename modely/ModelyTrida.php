<?php
class ModelyDisciplina{

  //funkce vrati vsechno z tabulky "trida"
    public function vratVsechnyTridy() {
        $sql = "
            SELECT *
            FROM trida
        ";
        $trida = Db::dotazVsechny($sql);
        return $trida;
      }



      /*funkce slouzi k pridani tridy do databaze, parametr bude pole, vyzadujici:
    nazev_trid
    tridni ucitel*/
    public function pridejTridu($trida) {
        $sql = "
            SELECT nazev_trid
            FROM trida
            where nazev_trid = ?
        ";
        if(Db::dotazJeden($sql,[$trida["nazev_trid"]])){
        return 0;
        }
      Db::vloz("trida",$trida);
      return 1;
    }//vrati 0 pokud v databazi trida uz je, vrati 1 pokud v databazi "trida" jeste neni a prida tam tridu
      

    //funkce slouzi k odebrani tridy z databaze, parametrem bude jen id z databaze(id_trid)
    public function odeberTridu($id){
        $sql = "
          DELETE FROM trida
          where id_trid = ?
      ";
      if(Db::dotaz($sql,[$id])){
        return 1;
      }
    return 0;
    }//vrati 1 pokud v databazi tridu odebere, 0 pokud se akce nepodarila


    /*funkce slouzi ke zmene sloupcu v tabulce "trida", parametry:
    $hodnoty - pole asociativni pro nazev sloupcu a jeji nove hodnoty ["nazev_trid"] => I4B
                                                                      ["tridni_uc"] => "Antonín Kačerovský"
    $id - id z databaze(id_trid), čili id konkretni tridy
    */
    public function zmenTridu($hodnoty, $id){
        $sql = "
        where id_trid = ?
        ";
        if(Db::zmen("trida",$hodnoty,$sql,[$id])){
          return 1;
        }
        return 0;

      }//vrati 1 pokud v databazi uspesne provedl zmenu, 0 pokud se akce nepodarila



    
}

?>