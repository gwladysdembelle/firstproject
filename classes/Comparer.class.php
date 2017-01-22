<?php

class Comparer{
    
    // Constantes
    const DBL_RETOURS_FOYERS = 0.56; // Pourcentage
    const ETMO_RETOURS_FOYERS = 0.94; // Pourcentage
    //const ETMO_COUT_UNITAIRE = 0.06320; // Cout unitaire négocié en BAL avant 2014
    //const ETMO_COUT_UNITAIRE = 0.06450; // Cout unitaire négocié depuis 2014
    const ETMO_COUT_UNITAIRE = 0.06580; // Cout unitaire négocié depuis 2015
    const COUT_FABRICATION = 50; // Cout fabrication par defaut
    const COUT_DISTRIBUTION = 45; // Cout distribution par defaut
    
    //DBL = Distribution Boites aux Lettres
    // Nombre de prospectus
    private $dbl_qte_prospectus; 
    // Cout de fabrication : cout du prospectus*nb de prospectus
    private $dbl_cout_fabrication; 
    // Cout de distribution ((nb de prospectus/1000) * coût au mille de la distribution))
    private $dbl_cout_distribution;
    // Cout total de l'opération ($dbl_cout_fabrication + $dbl_cout_distribution)
    private $dbl_cout_total_operation;
    // Foyers touchés : (nb de prospectus distribués X % retour foyer)
    private $dbl_foyers_touches;
    // Coût au contact utile : Distribution seule : coût de la distribution / nombre de foyers touchés
    private $dbl_cout_contact_utile;
    
    //ETMO = Encartage TV Magazine Ouest
    // Nombre de prospectus
    private $etmo_qte_prospectus; 
    // Cout de fabrication : cout du prospectus*nb de prospectus
    private $etmo_cout_fabrication; 
    // Cout de distribution ((nb de prospectus/1000) * coût au mille de la distribution))
    // ou Cout de distribution unitaire (0,03 € le prospectus négocié en BAL) * nb de prospectus
    private $etmo_cout_distribution;
    // Cout total de l'opération ($dbl_cout_fabrication + $dbl_cout_distribution)
    private $etmo_cout_total_operation;
    // Foyers touchés : (nb de prospectus distribués X % retour foyer)
    private $etmo_foyers_touches;
    // Coût au contact utile : Distribution seule : coût de la distribution / nombre de foyers touchés
    // ou Coût total :  coût total/ nombre de foyers touchés 
    private $etmo_cout_contact_utile;
    
    //Economies réalisées (comparaisons entre les donnees etmo et dbl)
    // Nombre de prospectus
    private $compare_qte_prospectus; 
    // Cout de fabrication : cout du prospectus*nb de prospectus
    private $compare_cout_fabrication; 
    // Cout de distribution ((nb de prospectus/1000) * coût au mille de la distribution))
    // ou Cout de distribution unitaire (0,03 € le prospectus négocié en BAL) * nb de prospectus
    private $compare_cout_distribution;
    // Cout total de l'opération ($dbl_cout_fabrication + $dbl_cout_distribution)
    private $compare_cout_total_operation;
    // Foyers touchés : (nb de prospectus distribués X % retour foyer)
    private $compare_foyers_touches;
    // Coût au contact utile : Distribution seule : coût de la distribution / nombre de foyers touchés
    // ou Coût total :  coût total/ nombre de foyers touchés 
    private $compare_cout_contact_utile;
    
    
    function __construct($dbl_qte_prospectus, $cout_fabrication = 50, $cout_distribution = 30, $etmo_qte_prospectus){
        $this->dbl_qte_prospectus = $dbl_qte_prospectus; 
        $this->dbl_cout_fabrication = round(($dbl_qte_prospectus * $cout_fabrication) / 1000, 2);
        $this->dbl_cout_distribution = round(($dbl_qte_prospectus * $cout_distribution) / 1000, 2);
        $this->dbl_cout_total_operation = round($this->dbl_cout_fabrication + $this->dbl_cout_distribution, 2);
        $this->dbl_foyers_touches =  round($dbl_qte_prospectus * self::DBL_RETOURS_FOYERS, 0);
        $this->dbl_cout_contact_utile = round($this->dbl_cout_total_operation / $this->dbl_foyers_touches, 2);
        
        $this->etmo_qte_prospectus = $etmo_qte_prospectus;
        $this->etmo_cout_fabrication = round(($this->etmo_qte_prospectus * $cout_fabrication) / 1000, 2); 
        $this->etmo_cout_distribution = round($this->etmo_qte_prospectus * self::ETMO_COUT_UNITAIRE, 2);
        $this->etmo_cout_total_operation = round($this->etmo_cout_fabrication + $this->etmo_cout_distribution, 2);
        $this->etmo_foyers_touches = round($etmo_qte_prospectus * self::ETMO_RETOURS_FOYERS, 0);
        $this->etmo_cout_contact_utile = round($this->etmo_cout_total_operation / $this->etmo_foyers_touches, 2);
        
        $this->calculeEconomieRealisee();
    }
    
    public static function recupereEtmoQteProspectus($array_editions){
        // Recherche de l'info parmis des valeurs fixes : xml ou base de données ?
        // Retourne la somme des qtantités par editions selectionnées
        
        return null;
    }
    
    function calculeEconomieRealisee(){
        $this->compare_qte_prospectus = $this->etmo_qte_prospectus - $this->dbl_qte_prospectus;
        $this->compare_cout_fabrication = round($this->etmo_cout_fabrication - $this->dbl_cout_fabrication, 2);
        $this->compare_cout_distribution = round($this->etmo_cout_distribution - $this->dbl_cout_distribution, 2);
        $this->compare_cout_total_operation = round($this->etmo_cout_total_operation - $this->dbl_cout_total_operation, 2);
        $this->compare_foyers_touches = round($this->etmo_foyers_touches - $this->dbl_foyers_touches, 0);
        $this->compare_cout_contact_utile = round($this->etmo_cout_contact_utile - $this->dbl_cout_contact_utile, 2);        
    }
    
    function getDblQtePprospectus(){
        return $this->dbl_qte_prospectus;
    }
    function getDblCoutFabrication(){
        return $this->dbl_cout_fabrication;
    }
    function getDblCoutDistribution(){
        return $this->dbl_cout_distribution;
    }
    function getDblCoutTotalOperation(){
        return $this->dbl_cout_total_operation;
    }
    function getDblFoyersTouches(){
        return $this->dbl_foyers_touches;
    }
    function getDblCoutContactUtile(){
        return $this->dbl_cout_contact_utile;
    }
    function getEtmoQteProspectus(){
        return $this->etmo_qte_prospectus;
    }
    function getEtmoCoutFabrication(){
        return $this->etmo_cout_fabrication;        
    }
    function getEtmoCoutDistribution(){
        return $this->etmo_cout_distribution;        
    }
    function getEtmoCoutTotalOperation(){
        return $this->etmo_cout_total_operation;        
    }
    function getEtmoFoyersTouches(){
        return $this->etmo_foyers_touches;       
    }
    function getEtmoCoutContactUtile(){
        return $this->etmo_cout_contact_utile;        
    }
    function getCompareQteProspectus(){
        return $this->compare_qte_prospectus;
    }
    function getCompareCoutFabrication(){
        return $this->compare_cout_fabrication;        
    }
    function getCompareCoutDistribution(){
        return $this->compare_cout_distribution;        
    }
    function getCompareCoutTotalOperation(){
        return $this->compare_cout_total_operation;        
    }
    function getCompareFoyersTouches(){
        return $this->compare_foyers_touches;       
    }
    function getCompareCoutContactUtile(){
        return $this->compare_cout_contact_utile;        
    }
    
}
