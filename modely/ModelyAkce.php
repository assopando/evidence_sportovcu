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


      //vrati posledni id v tabulce
      public function vratPosledniId() {
        return Db::idPoslednihoVlozeneho();

  }


      /*slouzi k pridani záznamu do databaze, parametr bude pole, vyzadujici:
    id_akce 
    nazev_akce
    datum_zahajeni
    *datum_konce
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
    }//vrati 1 pokud v databazi akce odebere, 0 pokud se akce nepodarila


    /*slouzi ke zmene sloupcu v tabulce "akce", parametry:
    $hodnoty - pole asociativni pro nazev sloupcu a jeji nove hodnoty ["nazev_akce"] => "Vanocni turnaj"
                                                                      ["datum_zahajeni"] => 2025-12.22
                                                                      ["datum_konce"] => 
                                                                      ["misto_kon"] => "sddgedgfs"
                                                                      ["popisek_akce"] => ""htgdbxrtbgrsgsyrg"
    $id - id z databaze(id_akce), čili id konkretni akci
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