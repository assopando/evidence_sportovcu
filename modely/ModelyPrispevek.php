<?php
class ModelyPrispevek{

  //vrati vsechno z tabulky "prispevek"
    public function vratVsechnyPrispevky() {
        $sql = "
            SELECT *
            FROM prispevek
        ";
        $prispevek = Db::dotazVsechny($sql);
        return $prispevek;
      }


            //vrati posledni id v tabulce
            public function vratPosledniId() {
              return Db::idPoslednihoVlozeneho();
    
        }


      /*slouzi k pridani prispevku na nastenku do databaze, parametr bude pole, vyzadujici:
    id uzivatele (id_uziv)
    nazev_pris
    datum
    text
    */
    public function pridejPrispevek($prispevek) {
        $sql = "
            SELECT nazev_pris
            FROM prispevek
            where nazev_pris = ?
        ";
        if(Db::dotazJeden($sql,[$prispevek["nazev_pris"]])){
        return 0;
        }
      Db::vloz("prispevek",$prispevek);
      return 1;
    }//vrati 0 pokud v databazi prispevek uz je, vrati 1 pokud v databazi jeste neni a prida to tam
      

    //slouzi k odebrani prispevku z databaze, parametrem bude jen id prispevku z databaze(id_pris)
    public function odeberPrispevek($id){
        $sql = "
          DELETE FROM prispevek
          where id_pris = ?
      ";
      if(Db::dotaz($sql,[$id])){
        return 1;
      }
    return 0;
    }//vrati 1 pokud v databazi prispevek odebere, 0 pokud se akce nezdarila


    /*funkce slouzi ke zmene sloupcu v tabulce "prispevek", parametry:
    $hodnoty - pole asociativni pro nazev sloupcu a jeji nove hodnoty ["id_uziv"] => 4
                                                                      ["nazev_pris"] => "Akce na 26.12.2020"
                                                                      ["datum"] => 24.12.2020
                                                                      ["text"] => "fhbdjknsojihufbdjnsjiosjnksjin"
    $id - id z databaze(id_pris), čili id konkretni prispevku
    */
    public function zmenPrispevek($hodnoty, $id){
        $sql = "
        where id_pris = ?
        ";
        if(Db::zmen("prispevek",$hodnoty,$sql,[$id])){
          return 1;
        }
        return 0;

      }//vrati 1 pokud v databazi uspesne provedl zmenu, 0 pokud se akce nepodarila



    
}

?>