<?php
session_start();
require 'classes/Comparer.class.php';
require 'classes/LectureXml.class.php';

// Formulaire prérempli
if (isset($_POST['formnonvide']) && $_POST['formnonvide'] == '1') {
    $email = $_SESSION['email'];
    $dbl_qte_prospectus = $_SESSION['quantiteprospectus'];
    $cout_fabrication = $_SESSION['coutfabrication'];
    $cout_distribution = $_SESSION['coutdistribution'];
    $etmo_qte_prospectus = $_SESSION['quantite'];
    $nom = $_SESSION['nom'];
    $interlocuteur = $_SESSION['interlocuteur'];
    $adresse = $_SESSION['adresse'];
    $ville = $_SESSION['ville'];
    $telephone = $_SESSION['telephone'];
    if(isset($_SESSION['listeeditions'])){
        $listeeditions = $_SESSION['listeeditions'];
    }
} else {
    $email = '';
    $dbl_qte_prospectus = '';
    $cout_fabrication = '';
    $cout_distribution = '';
    $etmo_qte_prospectus = '';
    $nom = '';
    $interlocuteur = '';
    $adresse = '';
    $ville = '';
    $telephone = '';
    $listeeditions = array();
}

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
        <link rel="apple-touch-icon" href="images/touch-icon-ipad.png" />

        <!--[if lt IE 9]>
            <script src="js/jquery-1.10.2.min.js"></script>
        <![endif]-->
        <!--[if gte IE 9]><!-->
        <script src="js/jquery-2.0.3.min.js"></script>
        <!--<![endif]-->

        <title>TV Mag – Comparer </title>
    </head>
    <body>
        <div class="row-fluid">
            <div class="span10 offset1" id="contenu">
                <div class="row-fluid" id="titre">
                    <div class="span9 offset3">
                        <div class="span12" id="titretexte">
                            <h3>Simulation d'une distribution de prospectus pour le client</h3>
                            <h5>Comparaison entre la distribution Boîtes aux Lettres et l'hébergement dans TV Magazine Ouest</h5>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span11 offset1">
                        <h4>Données du commercial</h4>
                    </div>
                </div>
                <form action="main.php" method="post" id="contactHappy">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <div class="span3 offset1">
                                    <label class="pull-right" for="email">Email du commercial</label>
                                </div>		    
                                <div class="span6 offset1">
                                    <input type="email" placeholder="Email du commercial" id="email" name="email" class="span12" value="<?php echo $email; ?>">
                                </div>
                            </div>
                            <div class="row-fluid separateur"></div>
                        </div>
                    </div>

                    <div class="row-fluid">
                        <div class="span11 offset1">
                            <h4>Données de base du client</h4>
                        </div>
                    </div>

                    <div class="row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <div class="span3 offset1">
                                    <label class="pull-right" for="nom">Nom du client</label>
                                </div>		    
                                <div class="span6 offset1">
                                    <input type="text" placeholder="Nom du client" id="nom" name="nom" class="span12" value="<?php echo $nom; ?>">
                                </div>
                            </div>
                            <div class="row-fluid separateur"></div>
                        </div>
                    </div>

                    <div class="row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <div class="span3 offset1">
                                    <label class="pull-right" for="interlocuteur">Interlocuteur</label>
                                </div>		    
                                <div class="span6 offset1">
                                    <input type="text" placeholder="Interlocuteur" id="interlocuteur" name="interlocuteur" class="span12" value="<?php echo $interlocuteur; ?>">
                                </div>
                            </div>
                            <div class="row-fluid separateur"></div>
                        </div>
                    </div>

                    <div class="row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <div class="span3 offset1">
                                    <label class="pull-right" for="email">Adresse</label>
                                </div>		    
                                <div class="span6 offset1">
                                    <input type="text" placeholder="Adresse" id="adresse" name="adresse" class="span12" value="<?php echo $adresse; ?>">
                                </div>
                            </div>
                            <div class="row-fluid separateur"></div>
                        </div>
                    </div>

                    <div class="row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <div class="span3 offset1">
                                    <label class="pull-right" for="telephone">Téléphone</label>
                                </div>		    
                                <div class="span6 offset1">
                                    <input type="tel" placeholder="Téléphone" id="portable" name="telephone" class="span12" pattern="^0[1-68]([-. ]?[0-9]{2}){4}$" value="<?php echo $telephone; ?>">
                                </div>
                            </div>
                            <div class="row-fluid separateur"></div>
                        </div>
                    </div>

                    <div class="row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <div class="span3 offset1">
                                    <label class="pull-right" for="ville">Ville</label>
                                </div>		    
                                <div class="span6 offset1">
                                    <input type="text" placeholder="Ville" id="ville" name="ville" class="span12" value="<?php echo $ville; ?>">
                                </div>
                            </div>
                            <div class="row-fluid separateur"></div>
                        </div>
                    </div> 

                    <div class="row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <div class="span3 offset1">
                                    <label class="pull-right" for="quantiteprospectus">Quantité de prospectus *</label>
                                </div>		    
                                <div class="span6 offset1">
                                    <input type="number" placeholder="Quantité de prospectus" id="quantiteprospectus" name="quantiteprospectus" class="span12" value="<?php echo $dbl_qte_prospectus; ?>" required>
                                </div>
                            </div>
                            <div class="row-fluid separateur"></div>
                        </div>
                    </div>      

                    <div class="row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <div class="span3 offset1">
                                    <label class="pull-right" for="coutfabrication">Coût de fabrication le mille (par défaut <?php echo Comparer::COUT_FABRICATION ?>€)</label>
                                </div>		    
                                <div class="span6 offset1">
                                    <input type="text" placeholder="<?php echo Comparer::COUT_FABRICATION ?>" id="coutfabrication" name="coutfabrication" class="span12" value="<?php echo $cout_fabrication; ?>">
                                </div>
                            </div>
                            <div class="row-fluid separateur"></div>
                        </div>
                    </div>      

                    <div class="row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <div class="span3 offset1">
                                    <label class="pull-right" for="coutdistribution">Coût de distribution le mille (par défaut <?php echo Comparer::COUT_DISTRIBUTION ?>€)</label>
                                </div>		    
                                <div class="span6 offset1">
                                    <input type="text" placeholder="<?php echo Comparer::COUT_DISTRIBUTION ?>" id="coutdistribution" name="coutdistribution" class="span12" value="<?php echo $cout_distribution; ?>">
                                </div>
                            </div>
                            <div class="row-fluid separateur"></div>
                        </div>
                    </div>                     

                    <div class="row-fluid">
                        <div class="span11 offset1">
                            <h4>Données TV Magazine Ouest</h4>
                        </div>
                    </div>

                    <div class="span3 offset1">
                        <input type="radio" name="show" id="showEditions"> Sélectionner une édition<br/>
                        <input type="radio" name="show" id="showQuantite"> Saisir une quantité d'exemplaires
                    </div>

                    <div class="row-fluid" id="editions" style="display: none;">
                        <div class="span12">
                            <div class="row-fluid">
                                <div class="span6 offset5 showOption">
                                    <select multiple size="10" id="listeeditions" class="span12" name="listeeditions[]">
                                        <?php
                                        $object_editions = new LectureXml("donnees/liste_qte_editions.xml");
                                        $array_editions = $object_editions->recupereListeEditions();
                                        foreach ($array_editions as $edition) {
                                            ?>
                                            <option value="<?php echo $edition[0]; ?>" <?php if (in_array($edition[0], $listeeditions)) { ?>selected="selected"<?php } ?>><?php echo $edition[0]; ?> - <?php echo $edition[1]; ?> ex.</option>';
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row-fluid separateur"></div>
                        </div>
                    </div>

                    <div class="row-fluid" id="quantity" style="display: none;">
                        <div class="span12">
                            <div class="row-fluid">
                                <div class="span6 offset5 showOption">
                                    <input type="number" placeholder="Quantité" id="quantite" name="quantite" value="<?php echo $etmo_qte_prospectus; ?>" class="span12" required>
                                </div>
                            </div>
                            <div class="row-fluid separateur"></div>
                        </div>
                    </div>         

                    <div class="row-fluid">
                        <div class="span6 offset5">
                            <button type="submit" class="btn envoyer span12">Envoyer</button>
                        </div>
                    </div>    
                    <div class="row-fluid">
                        <div class="span6 offset5">
                            <button type="reset" id="resetform" name="resetform" class="btn envoyer span12">Vider le formulaire</button>
                        </div>
                    </div>         
                </form> 
                <div class="row-fluid">
                    <div class="span12" id="texteinfo">
                        <p>Ce document est une simulation tarifaire établie à partir de données déclaratives. 
                            Elle ne peut être assimilée à un document contractuel.</p>
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
            <script src="js/script-tvmag.js"></script>
        </footer>
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-44612899-1', 'precom.fr');
            ga('send', 'pageview');
        </script>
    </body>
</html>