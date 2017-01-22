<?php
session_start();
require 'classes/LectureXml.class.php';

// Pour l'export en pdf
$_SESSION['email'] = $email;
$_SESSION['quantiteprospectus'] = $dbl_qte_prospectus;
$_SESSION['coutfabrication'] = $cout_fabrication;
$_SESSION['coutdistribution'] = $cout_distribution;
$_SESSION['quantite'] = $etmo_qte_prospectus;
$_SESSION['nom'] = $nom;
$_SESSION['adresse'] = $adresse;
$_SESSION['ville'] = $ville;
$_SESSION['telephone'] = $telephone;


// On récupère tous les résultats en fonction de ce qui a été rentré dans le formulaire
$results = new Comparer($dbl_qte_prospectus, $cout_fabrication, $cout_distribution, $etmo_qte_prospectus);

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- meta -->
        <meta charset="utf-8" />
        <meta name="keywords" content="mots-clés" />
        <meta name="description" content="description" />
        <meta name="author" content="auteur">
        <meta name="viewport" content="initial-scale=1.0" />
        <meta name="apple-mobile-web-app-capable" content="yes" /><!-- Fullscreen Ipad -->
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" /><!-- Barre du haut translucide -->

        <!-- include -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css" />
        <link rel="stylesheet" href="css/stylesheet.css" type="text/css" />
        <link rel="alternate" title="Flux de votre site" href="rss.php" type="application/rss+xml" />
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        
        <!--[if lt IE 9]>
            <script src="js/jquery-1.10.2.min.js"></script>
        <![endif]-->
        <!--[if gte IE 9]><!-->
            <script src="js/jquery-2.0.3.min.js"></script>
        <!--<![endif]-->

        <title>TV Magazine Ouest - Comparer</title>
    </head>
    <body>
        <div class="row-fluid">
            <div class="span10 offset1" id="contenu">
                <div class="row-fluid" id="titre">
                    <div class="span9 offset3">
                        <div class="span12" id="titretexte">
                            <h3>Simulation d'une distribution de prospectus pour le client <?php echo $nom; ?> </h3>
                            <h5>Liste des éditions</h5>
                        </div>
                    </div>
                </div>
                
                <div class="row-fluid">
                    <div class="span12">
                        <div class="row-fluid">
                            <div class="span5">
                                
                            </div>
                            <div class="span5">
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    $object_editions = new LectureXml("donnees/liste_qte_editions.xml");
                    $array_editions = $object_editions->recupereListeEditions();
                    foreach($array_editions as $edition){
                        echo '<option value="'.$edition.'">'.$edition.'</option>';
                    }
                ?>
                <div class="row-fluid">
                    <div class="span12">
                        <a href="index.php" class="btn btn-default span12" id="btnretour">Retour au formulaire</a>
                    </div>
                </div>
                <div class="row-fluid bordurebas client">
                    <div class="span3 offset1"> 
                        <span class="gras">Données client</span>
                    </div>
                    <div class="span6">
                        <div class="row-fluid">
                            <div class="span3">
                                Nom :
                            </div>
                            <div class="span9" id="nomClient">
                                <?php echo $nom; ?>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span3">
                                Adresse :
                            </div>
                            <div class="span9">
                                <?php echo $adresse; ?>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span3">
                                Ville :
                            </div>
                            <div class="span9">
                                <?php echo $ville; ?>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span3">
                                Tél :
                            </div>
                            <div class="span9">
                                <?php echo $telephone; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-fluid bordurebas">
                    <div class="span6 titre"> 
                    </div>
                    <div class="span2 titre">
                        Distribution Boîtes aux Lettres
                    </div>
                    <div class="span2 titre">
                        Encartage TV Magazine Ouest
                    </div>
                    <div class="span2 titre">
                        Ecart constaté
                    </div>
                </div>
                
                <div class="row-fluid bordurebas">
                    <div class="span6"> 
                        <span class="gras">Quantité</span><br />(nombre de prospectus)
                    </div>
                    <div class="span2 bleu">
                        <?php echo number_format($results->getDblQtePprospectus(), 0, ',', ' '); ?>
                    </div>
                    <div class="span2 orange">
                        <?php echo number_format($results->getEtmoQteProspectus(), 0, ',', ' '); ?>
                    </div>
                    <?php 
                        if($results->getCompareQteProspectus() < 0){
                            echo '<div class="span2 rouge">'.number_format($results->getCompareQteProspectus(), 0, ',', ' ').'</div>';
                        }else{
                            echo '<div class="span2 vert">'.number_format($results->getCompareQteProspectus(), 0, ',', ' ').'</div>';
                        }
                    ?>
                </div>
                
                <div class="row-fluid bordurebas">
                    <div class="span6"> 
                        <span class="gras">1 - Fabrication</span><br />(estimée à 0,05 euros l'unité, soir 50 € le mille par défaut)
                        (Coût de fabrication : coût du prospectus * nb de prospectus)
                    </div>
                    <div class="span2 bleu">
                        <?php echo number_format($results->getDblCoutFabrication(), 0, ',', ' '); ?> €
                    </div>
                    <div class="span2 orange">
                        <?php echo number_format($results->getEtmoCoutFabrication(), 0, ',', ' '); ?> €
                    </div>
                    <?php 
                        if($results->getCompareCoutFabrication() < 0){
                            echo '<div class="span2 rouge">'.number_format($results->getCompareCoutFabrication(), 0, ',', ' ').' €</div>';
                        }else{
                            echo '<div class="span2 vert">'.number_format($results->getCompareCoutFabrication(), 0, ',', ' ').' €</div>';
                        }
                    ?>
                </div>
                
                <div class="row-fluid">
                    <div class="span6"> 
                        <span class="gras">2 - Distribution <sup>*</sup></span>
                        <br />((nb de prospectus/1000) * coût au mille de la distribution))
                        ou coût de distribution unitaire (0,03 € le prospectus négocié en BAL) * nb de prospectus
                    </div>
                    <div class="span2 bleu">
                        <?php echo number_format($results->getDblCoutDistribution(), 0, ',', ' '); ?> €
                    </div>
                    <div class="span2 orange">
                        <?php echo number_format($results->getEtmoCoutDistribution(), 0, ',', ' '); ?> €
                    </div>
                    <?php 
                        if($results->getCompareCoutDistribution() < 0){
                            echo '<div class="span2 rouge">'.number_format($results->getCompareCoutDistribution(), 0, ',', ' ').' €</div>';
                        }else{
                            echo '<div class="span2 vert">'.number_format($results->getCompareCoutDistribution(), 0, ',', ' ').' €</div>';
                        }
                    ?>
                </div>
                <div class="row-fluid bordurebas">
                    <div class="span12 texteinfo">
                        <sup>*</sup> Base encart glissé dans TV Magazine: 58 € le mille<br/>
                        <sup>*</sup> Prix moyen retenu en distribution Boîtes aux lettres : 30 € le mille.
                    </div>
                </div>
                
                <div class="row-fluid bordurebas">
                    <div class="span6"> 
                        <span class="gras">Coût total de l'opération</span> (1+2)
                    </div>
                    <div class="span2 bleu">
                        <?php echo number_format($results->getDblCoutTotalOperation(), 0, ',', ' '); ?> €
                    </div>
                    <div class="span2 orange">
                        <?php echo number_format($results->getEtmoCoutTotalOperation(), 0, ',', ' '); ?> €
                    </div>
                    <?php 
                        if($results->getCompareCoutTotalOperation() < 0){
                            echo '<div class="span2 rouge">'.number_format($results->getCompareCoutTotalOperation(), 0, ',', ' ').' €</div>';
                        }else{
                            echo '<div class="span2 vert">'.number_format($results->getCompareCoutTotalOperation(), 0, ',', ' ').' €</div>';
                        }
                    ?>
                </div>
                
                <div class="row-fluid">
                    <div class="span6"> 
                        <span class="gras">Retours foyers</span>
                    </div>
                    <div class="span2 noir gras">
                        <?php echo Comparer::DBL_RETOURS_FOYERS*100; ?> %<sup>1</sup>
                    </div>
                    <div class="span2 noir gras">
                        <?php echo Comparer::ETMO_RETOURS_FOYERS*100; ?> %<sup>2</sup>
                    </div>
                </div>
                
                <div class="row-fluid bordurebas">
                    <div class="span12 texteinfo">
                        <sup>1</sup> 56 % Estimation du % de prospectus effectivement remontés dans les foyers (Source Précom). 
                        Base 40 Kgs de prospectus par an et par foyer (zone urbaine)<br />
                        <sup>2</sup> Chaque TV Magazine Ouest est vendu avec le journal. 
                        Le prospectus hebergé dans le magazine remonte avec dans le foyer.
                        En moyenne, 94 % des prospectus confiés sont distribués avec TV Magazine Ouest.
                    </div>
                </div>
                
                <div class="row-fluid bordurebas">
                    <div class="span6"> 
                        <span class="gras">Foyers touchés</span><br />(nb de prospectus distribués X % retour foyer)
                    </div>
                    <div class="span2 bleu">
                        <?php echo number_format($results->getDblFoyersTouches(), 0, ',', ' '); ?>
                    </div>
                    <div class="span2 orange">
                        <?php echo number_format($results->getEtmoFoyersTouches(), 0, ',', ' '); ?>
                    </div>
                    <?php 
                        if($results->getCompareFoyersTouches() < 0){
                            echo '<div class="span2 rouge">'.number_format($results->getCompareFoyersTouches(), 0, ',', ' ').'</div>';
                        }else{
                            echo '<div class="span2 vert">'.number_format($results->getCompareFoyersTouches(), 0, ',', ' ').'</div>';
                        }
                    ?>
                </div>
                
                <div class="row-fluid bordurebas">
                    <div class="span6"> 
                        <span class="gras">Coût au contact utile</span>
                        <br />Distribution seule : coût de la distribution / nombre de foyers touchés
                        <br />ou Coût total :  coût total/ nombre de foyers touchés 
                    </div>
                    <div class="span2 bleu">
                        <?php echo number_format($results->getDblCoutContactUtile(), 2, ',', ' '); ?> €
                    </div>
                    <div class="span2 orange">
                        <?php echo number_format($results->getEtmoCoutContactUtile(), 2, ',', ' '); ?> €
                    </div>
                    <?php 
                        if($results->getCompareCoutContactUtile() < 0){
                            echo '<div class="span2 rouge">'.number_format($results->getCompareCoutContactUtile(), 2, ',', ' ').' €</div>';
                        }else{
                            echo '<div class="span2 vert">'.number_format($results->getCompareCoutContactUtile(), 2, ',', ' ').' €</div>';
                        }
                    ?>
                </div>
                
                <div class="row-fluid conclusion">
                   <div class="span12">
                        <div class="row-fluid">
                            <div class="span12"> 
                                En conclusion, en distribuant avec  TV Magazine Ouest, vous touchez
                                <span class="fontvert"><?php echo number_format($results->getCompareFoyersTouches(), 0, ',', ' '); ?></span> foyers 
                                de différence.
                            </div>
                        </div>

                        <div class="row-fluid">
                            <div class="span12"> 
                                Le delta financier sur votre opération est de 
                                <span class="fontvert"><?php echo number_format($results->getCompareCoutTotalOperation(), 0, ',', ' '); ?> €</span>,
                                soit 
                                <span class="fontvert"><?php echo number_format($results->getCompareCoutContactUtile(), 2, ',', ' '); ?></span>
                                centimes par prospectus utile.
                            </div>
                        </div>
                   </div>
                </div>
            </div>
        </div>
        <footer>
            <script src="bootstrap/js/bootstrap.min.js"></script>
            <script src="bootstrap/js/bootstrap-button.js"></script>
            <script src="js/jquery.mask.min.js"></script>
            <script src="js/js-webshim/minified/extras/modernizr-custom.js"></script>
            <script src="js/js-webshim/minified/polyfiller.js"></script>
            <script src="js/html2canvas/html2canvas.js"></script>
            <script src="js/html2canvas/base64.js"></script>
            <script src="js/script-tvmag.js"></script>
        </footer>
    </body>
</html>