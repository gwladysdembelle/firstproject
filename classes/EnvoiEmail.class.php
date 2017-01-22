<?php
session_start();
class EnvoiEmail{
    function __construct($image=null){
        /*************** Envoi du mail ************/
        $conf = parse_ini_file('../config.ini', true);
        // To
        $to = $_SESSION['email'];
        // Subject
        $subject = 'Comparer TV Mag - '.$_SESSION['nom'].' - Simulation d\'une distribution de prospectus';
        // clé aléatoire de limite
        $boundary = md5(uniqid(microtime(), TRUE));
        // Headers
        $headers = 'From: Comparer TV Mag <noreply@precom.fr>'."\r\n";
        $headers .= 'Mime-Version: 1.0'."\r\n";
        $headers .= 'Content-Type: multipart/mixed;boundary='.$boundary."\r\n";
        $headers .= "\r\n";
        // Message
        $msg = 'Texte affiché par des clients mail ne supportant pas le type MIME.'."\r\n\r\n";
        // Message HTML
        $msg .= '--'.$boundary."\r\n";
        $msg .= 'Content-type: text/html; charset=utf-8'."\r\n\r\n";
        $msg .= '
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <title>Comparer TV Mag - Simulation d\'une distribution de prospectus pour le client</title>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <meta content="width=device-width">
            <style type="text/css">
                /* Fonts and Content */
                body, td { font-family: "Helvetica Neue", Arial, Helvetica, Geneva, sans-serif; font-size:14px; color: #555555; }
                body { background-color: #FFFFFF; margin: 0; padding: 0; -webkit-text-size-adjust:none; -ms-text-size-adjust:none; }
                h2{ padding-top:12px; /* ne fonctionnera pas sous Outlook 2007+ */color:#5B4E4E; font-size:22px; }
                        @media only screen and (max-width: 480px) { 

                                table[class=w275], td[class=w275], img[class=w275] { width:135px !important; }
                                table[class=w30], td[class=w30], img[class=w30] { width:10px !important; }  
                                table[class=w60], td[class=w60], img[class=w60] { width:20px !important; }  
                                table[class=w580], td[class=w580], img[class=w580] { width:280px !important; }
                                table[class=w640], td[class=w640], img[class=w640] { width:300px !important; }
                                table[class=w1], td[class=w1], img[class=w1] { background-color: #d7d6d6; !important; }

                                table[class=h70], td[class=h70], img[class=h70] { height:70px !important; }  
                                img{ height:auto;}
                                 /*illisible, on passe donc sur 3 lignes */
                                table[class=w180], td[class=w180], img[class=w180] { 
                                        width:280px !important; 
                                        display:block;
                                }    
                                td[class=w20]{ display:none; }    
                        } 
            </style>
        </head>
        <body style="margin:0px; padding:0px; -webkit-text-size-adjust:none; color: #555555;">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:rgb(42, 55, 78)" >
                <tbody>
                    <tr>
                        <td align="center" bgcolor="#FFFFFF">
                            <table  cellpadding="0" cellspacing="0" border="0">
                                <tbody>                            
                                    <tr>
                                        <td class="w640"  width="640" height="10"></td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="w640"  width="640" height="20">
                                            <span style="color:#ffffff; font-size:12px;">&nbsp;</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w640"  width="640" height="10"></td>
                                    </tr>
                                    <tr>
                                        <td  class="w640"  width="640" height="1" bgcolor="#d7d6d6"></td>
                                    </tr>
                                    <!-- entete -->
                                    <tr class="pagetoplogo">
                                        <td class="w640"  width="640">
                                            <table  class="w640"  width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#EDEDED">
                                                <tbody>
                                                    <tr>
                                                        <td class="w1"  width="1" bgcolor="#d7d6d6"> </td>
                                                        <td class="w1"  width="1" bgcolor="#EDEDED"> </td>
                                                        <td class="w30"  width="30"> </td>
                                                        <td  class="w580"  width="580" valign="middle" align="left">
                                                            <div class="pagetoplogo-content">
                                                                <table cellpadding="0" cellspacing="0" border="0">
																	<tr>
																		<td align="center" height="20">
																			<span style="color:#ffffff; font-size:12px;">&nbsp;</span>
																		</td>
																		<td align="center" height="20">
																			<span style="color:#ffffff; font-size:12px;">&nbsp;</span>
																		</td>
																		<td align="center" height="20">
																			<span style="color:#ffffff; font-size:12px;">&nbsp;</span>
																		</td>
																	</tr>
                                                                    <tr>
                                                                        <td>
                                                                           <img src="http://comparer-tvmag.precom.fr/images/logo_TV_MAG_OUEST_petit.jpg" alt="logo">
                                                                        </td>
																		<td align="center" class="w30" width="30">
																			<span style="color:#ffffff; font-size:12px;">&nbsp;</span>
																		</td>
                                                                        <td>
                                                                           <h2>Simulation d\'une distribution de prospectus</h2>
                                                                        </td>
                                                                    </tr>
																	<tr>
																		<td align="center" height="20">
																			<span style="color:#ffffff; font-size:12px;">&nbsp;</span>
																		</td>
																		<td align="center" height="20">
																			<span style="color:#ffffff; font-size:12px;">&nbsp;</span>
																		</td>
																		<td align="center" height="20">
																			<span style="color:#ffffff; font-size:12px;">&nbsp;</span>
																		</td>
																	</tr>
                                                                </table>
                                                            </div>
                                                        </td> 
                                                        <td class="w30"  width="30"> </td>
                                                        <td class="w1"  width="1" bgcolor="#d7d6d6"> </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <!-- separateur horizontal -->
                                    <tr>
                                        <td  class="w640"  width="640" height="1" bgcolor="#d7d6d6"></td>
                                    </tr>
                                     <!-- contenu -->
                                    <tr class="content">
                                        <td class="w640" class="w640"  width="640" bgcolor="#ffffff">
                                            <table class="w640"  width="640" cellpadding="0" cellspacing="0" border="0">
                                                <tbody>
                                                    <tr>
                                                        <td class="w1"  width="1" bgcolor="#d7d6d6"> </td>
                                                        <td  class="w30"  width="30"></td>
                                                        <td  class="w580"  width="578">
                                                            <!-- une zone de contenu -->
                                                            <table class="w580"  width="580" cellpadding="0" cellspacing="0" border="0">
                                                                <tbody>                                                            
                                                                    <tr>
                                                                        <td class="w580"  width="580">
                                                                            <h2 style="color:#5B4E4E; font-size:22px; padding-top:12px;">
                                                                            &nbsp;
                                                                            </h2>
                                                                            <div align="left" class="article-content">
                                                                                Feuille de comparaison pour le client '.$_SESSION['nom'].'<br/><br/>
                                                                                Interlocuteur : '.$_SESSION['interlocuteur'].'<br/>
                                                                                Adresse : '.$_SESSION['adresse'].'<br/>
                                                                                Ville : '.$_SESSION['ville'].'<br/>
                                                                                Tel : '.$_SESSION['telephone'].'<br/>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <!-- fin zone -->                                                   
                                                        </td>
                                                        <td class="w30" class="w30"  width="30"></td>
                                                        <td class="w1"  width="1" bgcolor="#d7d6d6"> </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <!-- pied de page -->
                                    <tr class="pagebottom">
                                        <td class="w640"  width="640">
                                            <table class="w640"  width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#FFFFFF">
                                                <tbody>
                                                    <tr>
                                                        <td class="w1"  width="1" bgcolor="#d7d6d6"> </td>
                                                        <td colspan="3" height="10"></td>
                                                        <td class="w1"  width="1" bgcolor="#d7d6d6"> </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="w1"  width="1" bgcolor="#d7d6d6"> </td>
                                                        <td class="w30"  width="30"></td>
                                                        <td class="w580"  width="580" valign="top">
                                                            <p align="right" class="pagebottom-content-left">
                                                            &nbsp;
                                                            </p>
                                                        </td>
                                                        <td class="w30"  width="30"></td>
                                                        <td class="w1"  width="1" bgcolor="#d7d6d6"> </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="w1"  width="1" bgcolor="#d7d6d6"> </td>
                                                        <td colspan="3" height="10"></td>
                                                        <td class="w1"  width="1" bgcolor="#d7d6d6"> </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <!-- separateur horizontal -->
                                    <tr>
                                        <td  class="w640"  width="640" height="1" bgcolor="#d7d6d6"></td>
                                    </tr>
                                    <!-- pied de page -->
                                    <tr class="pagebottom">
                                        <td class="w640"  width="640">
                                            <table class="w640"  width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#FAFAFA">
                                                <tbody>
                                                    <tr>
                                                        <td class="w1"  width="1" bgcolor="#d7d6d6"> </td>
                                                        <td colspan="3" height="2"></td>
                                                        <td class="w1"  width="1" bgcolor="#d7d6d6"> </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="w1"  width="1" bgcolor="#d7d6d6"> </td>
                                                        <td class="w30"  width="30"></td>
                                                        <td class="w580"  width="580" valign="top">
                                                            <p align="right" class="pagebottom-content-left">
                                                            &nbsp;
                                                            </p>
                                                        </td>
                                                        <td class="w30"  width="30"></td>
                                                        <td class="w1"  width="1" bgcolor="#d7d6d6"> </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="w1"  width="1" bgcolor="#d7d6d6"> </td>
                                                        <td colspan="3" height="2"></td>
                                                        <td class="w1"  width="1" bgcolor="#d7d6d6"> </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <!-- separateur horizontal -->
                                    <tr>
                                        <td  class="w640"  width="640" height="1" bgcolor="#d7d6d6"></td>
                                    </tr>
                                    <tr>
                                        <td class="w640"  width="640" height="60"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </body>
        </html>'."\r\n";
        
        // Pièce jointe 1
        if($image){
            $file_name = $image;
            if (file_exists($file_name))
            {
                    $file_type = filetype($file_name);
                    $file_size = filesize($file_name);

                    $handle = fopen($file_name, 'r') or die('File '.$file_name.'can t be open');
                    $content = fread($handle, $file_size);
                    $content = chunk_split(base64_encode($content));
                    $f = fclose($handle);

                    $msg .= '--'.$boundary."\r\n";
                    $msg .= 'Content-type:'.$file_type.';name='.$file_name."\r\n";
                    $msg .= 'Content-transfer-encoding:base64'."\r\n\r\n";
                    $msg .= $content."\r\n";
            }
        }
        // Fin
        $msg .= '--'.$boundary."\r\n";

        // Function mail()
        $success = mail($to, $subject, $msg, $headers);
        $_SESSION['email_success'] = $success;
        // On redirige
        //header("location:".$conf['ENV']['url']."index.php"); 
    }
}
?>
