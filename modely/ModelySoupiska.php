<?php
class ModelySoupiska{

  //vrati vsechno z tabulky "soupiska"
    public function vratVsechnySoupisky() {
        $sql = "
            SELECT *
            FROM soupiska
        ";
        $soupiska = Db::dotazVsechny($sql);
        return $soupiska;
      }

      /*slouzi k pridani záznamu do databaze, parametr bude pole, vyzadujici:
    id_soup 
    id_akce
    nazev_skupiny
    *vys_s
    
    * - nepovinny atribut
    */
    public function pridejSoupisku($soupiska) {
        $sql = "
            SELECT id_soup
            FROM soupiska
            where id_soup = ?
        ";
        if(Db::dotazJeden($sql,[$soupiska["id_soup"]])){
        return 0;
        }
      Db::vloz("soupiska",$soupiska);
      return 1;
    }//vrati 0 pokud v uz databazi záznam uz je, vrati 1 pokud v databazi "soupiska" jeste neni a prida tam
      
      
    //slouzi k odebrani záznamu z databaze, parametrem bude jen id z databaze(id_soup)
    public function odeberSoupisku($id){
        $sql = "
          DELETE FROM soupiska
          where id_soup = ?
      ";
      if(Db::dotaz($sql,[$id])){
        return 1;
      }
    return 0;
    }//vrati 1 pokud v databazi soupisku odebere, 0 pokud se akce nepodarila


    /*slouzi ke zmene sloupcu v tabulce "soupiska", parametry:
    $hodnoty - pole asociativni pro nazev sloupcu a jeji nove hodnoty ["id_akce"] => 3
                                                                      ["nazev_skupiny"] => "Skupina A"
                                                                      ["vys_s"] => 

    $id - id z databaze(id_soup), čili id konkretni soupisku
    */
    public function zmenSoupisku($hodnoty, $id){
      $sql = "
      where id_soup = ?
      ";
      if(Db::zmen("soupiska",$hodnoty,$sql,[$id])){
        return 1;
      }
      return 0;

      }//vrati 1 pokud v databazi uspesne provedl zmenu, 0 pokud se akce nepodarila



    
}

?>