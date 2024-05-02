<?php

// J'ai trouv� un pb avec ce compteur : il se remet �  0 apr�s 1000 visites 

/*
* Si le fichier o� l'on stock,
* les donn�es n'existe pas encore
* on le cr�e.
*/
$fichier = '.htcompteur';
if( !file_exists($fichier) ) {
$fp = fopen($fichier, "w");
fwrite($fp, serialize(array()));
fclose($fp);
}

/*
* D�finition de variables
* n�cessaire au compteur :
* - deux termes constants,
* - l'ip du visiteur,
* - la date et l'heure.
*/
$argument_visites = 'visites';
$argument_requ�tes = 'requ�tes';
$ip = $_SERVER['REMOTE_ADDR'];
$time = date('YmdGis');

/*
* R�cup�ration des donn�es du
* compteur pr�c�demment stock�es.
*/
$lignes = file($fichier);
$donnees = unserialize($lignes[0]);

/*
* Pour chaque cl�s du tableau de donn�es
* qui ne soit pas attribu�e aux visite et aux requ�tes
* si la valeur correspond � une date ant�rieur
* au m�me jour, on supprime l'ip du visiteur.
*/
foreach( $donnees as $cle => $valeur )
{
if( substr($valeur, 0, 8) != substr($time, 0, 8) &&
$cle != $argument_visites &&
$cle != $argument_requ�tes ) {
unset($donnees[$cle]);
}
}
/*
* On incr�mente ( ajoute +1 ) la valeur
* du nombre de requ�tes.
* Si l'ip n'est pas encore enregistr�e,
* on incr�mente la valeur du nombre de visites
* et on ajoute l'ip dans le tableau accompagn�
* de la date et de l'heure de l'ex�cution.
*/
$donnees[$argument_requ�tes]++;

/*if( !$donnees[$ip] ) {
$donnees[$argument_visites]++;
$donnees[$ip] = $time;
}*/

/*
* On effectue un petit report de variable
* pour une utilisation ult�rieur plus ais�e.
*/
$nb_visiteurs = $donnees[$argument_visites];
$nb_aujourdhui = count($donnees)-2;
$nb_requ�tes = $donnees[$argument_requ�tes];

/*
* On stock le tableau dans le fichier de donn�es
* en �crasant sa valeur pr�c�dente.
*/
$fp = fopen($fichier,"w");
fwrite($fp, serialize($donnees));
fclose($fp);

/*
* On affiche les r�sultats du compteur.
*/
$nb_visiteurs=$nb_visiteurs+"1000";
echo $nb_visiteurs." visiteurs dont ".$nb_aujourdhui." aujourd'hui.";
?>