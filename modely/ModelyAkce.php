<?php
class ModelyAkce{

  //vrati vsechno z tabulky "akce"
    public function vratVsechnyAkce() {
        $sql = "
            SELECT *
            FROM akce
        ";
        $akce = Db::dotazVsechny($sql);
        return $akce;
      }



      /*slouzi k pridani záznamu do databaze, parametr bude pole, vyzadujici:
    id_akce 
    nazev_akce
    datum_zahajeni
    *delka_dni
    misto_kon
    popisek_akce
    
    * - nepovinny atribut
    
    */
    public function pridejAkci($akce) {
        $sql = "
            SELECT id_akce
            FROM akce
            where id_akce = ?
        ";
        if(Db::dotazJeden($sql,[$akce["id_akce"]])){
        return 0;
        }
      Db::vloz("akce",$akce);
      return 1;
    }//vrati 0 pokud v uz databazi záznam uz je, vrati 1 pokud v databazi "akce" jeste neni a prida tam
      
      
    //slouzi k odebrani záznamu z databaze, parametrem bude jen id z databaze(id_akce)
    public function odeberAkci($id){
        $sql = "
          DELETE FROM akce
          where id_akce = ?
      ";
      if(Db::dotaz($sql,[$id])){
        return 1;
      }
    return 0;
    }//vrati 1 pokud v databazi ucastnika odebere, 0 pokud se akce nepodarila


    /*slouzi ke zmene sloupcu v tabulce "ucastnik", parametry:
    $hodnoty - pole asociativni pro nazev sloupcu a jeji nove hodnoty ["id_akce"] => 5
                                                                      ["nazev_akce"] => "Vanocni turnaj"
                                                                      ["datum_zahajeni"] => 2025-12.22
                                                                      ["delka_dni"] => 
                                                                      ["misto_kon"] => "sddgedgfs"
                                                                      ["popisek_akce"] => ""htgdbxrtbgrsgsyrg"
    $id - id z databaze(id_akce), čili id konkretniho ucastnika
    */
    public function zmenAkci($hodnoty, $id){
      $sql = "
      where id_akce = ?
      ";
      if(Db::zmen("akce",$hodnoty,$sql,[$id])){
        return 1;
      }
      return 0;

      }//vrati 1 pokud v databazi uspesne provedl zmenu, 0 pokud se akce nepodarila



    
}

?>