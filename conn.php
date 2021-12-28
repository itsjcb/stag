<?php
try{
    $pdo = new PDO("mysql:host=localhost;dbname=management","root","");
    echo "Successfully connected to the database";
    echo "<br />";
    echo "Jacob Guirou";

}catch(Exception $e){
    die('Error:' . $e->getMessage());

}
$et = $pdo->prepare("SELECT jours.Nom,professeur.idProf,heures.Debut,heures.Fin, groupe.numGroupe, cours.nomCours
        FROM seance,cours,groupe,jours,heures,professeur,personne,horaireseance
        WHERE personne.nom='Niko' and
      personne.idPersonne = professeur.idPersonne and
      seance.idProf=professeur.idProf and
      seance.idGroupe=groupe.idGroupe and
      seance.idCour=cours.idCours and
      horaireseance.idSeance=seance.idSeance and
      horaireseance.IdJour=jours.IdJours and
      horaireseance.IdHeure=heures.IdHeures ");
$et->setFetchMode(PDO::FETCH_ASSOC);
$et->execute();
$tab = $et->fetchAll();

for($i=0;$i<count($tab);$i++){ 
    echo implode(" | ",$tab[$i])."<br />"; 
 } 
echo "<br />";
//echo "<br />";
/*
 for($i=0;$i<count($tab);$i++){ 
    echo $tab[$i]["Nom"]."<br />"; 
    echo $tab[$i]["idProf"]."<br />";
    echo $tab[$i]["Debut"]."<br />"; 
    echo $tab[$i]["Fin"]."<br />"; 
    echo $tab[$i]["numGroupe"]."<br />"; 
    echo $tab[$i]["nomCours"]."<br />";
    echo "<br />";
    echo "<br />";
 }*/ 
?>