<?php

class LectureXml{
    
    private $xml_editions_qte; 
    
    function __construct($fichier){
        $this->xml_editions_qte = simplexml_load_file($fichier);
    }
    
    function recupereQteParEditions($array_edition){
        $quantite_totale = 0;
        foreach($this->xml_editions_qte as $ligne){
            if(in_array($ligne->edition, $array_edition)){
             $quantite_totale += $ligne->quantite;
            }
        }
        return $quantite_totale;
    }
    
    function recupereListeEditions(){
        $array_liste_editions = array();
        foreach($this->xml_editions_qte as $ligne){
            $array_liste_editions[] = array($ligne->edition, $ligne->quantite);
        }
        
        return $array_liste_editions;
    }
    
    function getArrayEditionsQte(){
        return $this->xml_editions_qte;
    }
    
    function supprimerEdition(){
        
    }
    
    function ajouterEdition(){
        
    }
    function modifierEdition(){
        
    }
}
