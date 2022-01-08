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
        try{
            $query = "Select * from Etudiant where username='$username' and password='$password'";
            $e = $this->_db->query($query);
            $result = $e->execute();

        }
        catch(PDOException $e){
            echo $e;

        }
       
    }*/
    #l'emploi du temps grace au nom ou id de l'etudiant
    public function getSchedule($nom)
    {
        //$schList[];
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
        $req->fetch(PDO::FETCH_ASSOC);
        /*while($data=$req->fetch(PDO::FETCH_ASSOC))
        {
            $schList[]=new PersonClass($data);
        }
        return $schList;
        */

    }
    #ses camarades de classe: qui ont le meme idgroupe
    public function StudentList($numGroupe)
    {
        //$stList[];
        $req=$this->_db->query("SELECT Personne.nom, Groupe.numGroupe
        FROM Personne, Etudiant, Groupe, GroupeEtud
        Where personne.role='etudiant' and numGroupe = '".$numGroupe."'  and
            personne.idPersonne = Etudiant.idPersonne and
            groupeEtud.idEtud = Etudiant.idEtudiant and
            groupeEtud.idGroupe = Groupe.idGroupe");
        $req->fetch(PDO::FETCH_ASSOC); 
        /*while($data=$req->fetch(PDO::FETCH_ASSOC))
        {
            $stList[]=new PersonClass($data);
        }
        return $stList;
        */
    }
    #liste des groupes dont il fait partie
    public function GroupList($idEtudiant)
    {
        //$gpList = [];
        $req=$this->_db->query("SELECT Personne.nom, Groupe.numGroupe
        FROM Personne, Etudiant, Groupe, GroupeEtud
        Where personne.role='etudiant' and Etudiant.idEtudiant='".$idEtudiant."' and
            personne.idPersonne = Etudiant.idPersonne and
            groupeEtud.idEtud = Etudiant.idEtudiant and
            groupeEtud.idGroupe = Groupe.idGroupe");
        $req->fetch(PDO::FETCH_ASSOC);   
        /*while($data=$req->fetch(PDO::FETCH_ASSOC))
        {
            $gpList[]=new PersonClass($data);
        }
        return $gpList;
        */
    }
    #les cours qu'il suit par session
    public function CourseList($idEtudiant)
    {   
        //$crList=[];
        $req=$this->_db->query("SELECT Personne.nom, Cours.nomCours, Session.nom
        FROM Personne, Etudiant, Cours, CoursEtudiant, Session
        Where personne.role='etudiant' and Etudiant.idEtudiant ='".$idEtudiant."' and
            Etudiant.idSession = Session.idSession and
            Personne.idPersonne = Etudiant.idPersonne and
            CoursEtudiant.idEtudiant = Etudiant.idEtudiant and
            CoursEtudiant.idCours = Cours.idCours");
        $req->fetch(PDO::FETCH_ASSOC);   
        /*while($data=$req->fetch(PDO::FETCH_ASSOC))
        {
            $crList[]=new PersonClass($data);
        }
        return $crList;
        */

    }

}
?>