<?php
class StudentClass{
    private $_db; 

    public function __construct($db)
    {
       $this->setDb($db);
    }
    public function setDb(PDO $db)
    {
       $this->_db = $db;
    }
    #se connecter
    /*public login($username, $password)
    {   
       //
    }*/
    #l'emploi du temps
    public function getSchedule($nom)
    {
        
        $req=$this->_db->query("SELECT jours.Nom,professeur.idProf,heures.Debut,heures.Fin, groupe.numGroupe, cours.nomCours
        FROM seance,cours,groupe,jours,heures,professeur,personne,horaireseance
        WHERE personne.nom = '".$nom."' and 
        personne.idPersonne = professeur.idPersonne and
        seance.idProf=professeur.idProf and
        seance.idGroupe=groupe.idGroupe and
        seance.idCour=cours.idCours and
        horaireseance.idSeance=seance.idSeance and
        horaireseance.IdJour=jours.IdJours and
        horaireseance.IdHeure=heures.IdHeures ");
        $data= $req->fetch(PDO::FETCH_ASSOC);

    }
    #ses camarades de classe: qui ont le meme idgroupe
    public function StudentList($numGroupe)
    {
        $req=$this->_db->query("SELECT Personne.nom, Groupe.numGroupe
        FROM Personne, Etudiant, Groupe, GroupeEtud
        Where personne.role='etudiant' and numGroupe = '".$numGroupe."'  and
            personne.idPersonne = Etudiant.idPersonne and
            groupeEtud.idEtud = Etudiant.idEtudiant and
            groupeEtud.idGroupe = Groupe.idGroupe");
        $data= $req->fetch(PDO::FETCH_ASSOC); 
    }
    #liste des groupes dont il fait partie
    public function GroupList($numGroupe)
    {
        $req=$this->_db->query("SELECT Personne.nom, Groupe.numGroupe
        FROM Personne, Etudiant, Groupe, GroupeEtud
        Where personne.role='etudiant' and numGroupe = '".$numGroupe."'  and
            personne.idPersonne = Etudiant.idPersonne and
            groupeEtud.idEtud = Etudiant.idEtudiant and
            groupeEtud.idGroupe = Groupe.idGroupe");
        $data= $req->fetch(PDO::FETCH_ASSOC);   

    }
    #les cours qu'il suit
    public function CourseList()
    {

    }

}
?>