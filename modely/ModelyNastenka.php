<?php
class ModelyDisciplina{

  //funkce vrati vsechno z tabulky "nastenka"
    public function vratVsechnyNastenky() {
        $sql = "
            SELECT *
            FROM nastenka
        ";
        $nastenka = Db::dotazVsechny($sql);
        return $nastenka;
      }



      /*funkce slouzi k pridani prispevku na nastenku do databaze, parametr bude pole, vyzadujici:
    id uzivatele (id_uziv)
    datum
    nazev
    text*/
    public function pridejNastenka($nastenka) {
        $sql = "
            SELECT id_nas
            FROM nastenka
            where id_nas = ?
        ";
        if(Db::dotazJeden($sql,[$nastenka["id_nas"]])){
        return 0;
        }
      Db::vloz("nastenka",$nastenka);
      return 1;
    }//vrati 0 pokud v databazi prispevek na nastenku uz je, vrati 1 pokud v databazi "nastenka" jeste neni a prida to tam
      

    //funkce slouzi k odebrani prispevku na nastenku z databaze, parametrem bude jen id z databaze(id_nas)
    public function odeberNastenku($id){
        $sql = "
          DELETE FROM nastenka
          where id_nas = ?
      ";
      if(Db::dotaz($sql,[$id])){
        return 1;
      }
    return 0;
    }//vrati 1 pokud v databazi prispevek na nastenku odebere, 0 pokud se akce nepodarila


    /*funkce slouzi ke zmene sloupcu v tabulce "nastenka", parametry:
    $hodnoty - pole asociativni pro nazev sloupcu a jeji nove hodnoty ["id_uziv"] => 4
                                                                      ["datum"] => 24.12.2020
                                                                      ["nazev"] => "Akce na 26.12.2020"
                                                                      ["text"] => "fhbdjknsojihufbdjnsjiosjnksjin"
    $id - id z databaze(id_nas), čili id konkretni prispevku (na nastenku)
    */
    public function zmenNastenku($hodnoty, $id){
        $sql = "
        where id_nas = ?
        ";
        if(Db::zmen("nastenka",$hodnoty,$sql,[$id])){
          return 1;
        }
        return 0;

      }//vrati 1 pokud v databazi uspesne provedl zmenu, 0 pokud se akce nepodarila



    
}

?>