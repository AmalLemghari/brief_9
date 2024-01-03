<?php
require_once('database.php');

class ProjectModel{
    private $idpro;
    private $nompro;
    private $descpro;
    private $conn;
    
    public function __construct() {
       
        $this->conn = Database::getDb()->getConn();

    }


    public function getIdpro(){
        return $this->idpro;
    }

    public function setIdpro($idpro){
        $this->idpro = $idpro;

    }
    public function getNompro(){
        return $this->nompro;
    }

    public function setNompro($nompro){
        $this->nompro = $nompro;
    }
    public function getDescpro(){
        return $this->descpro;
    }

    public function setDescpro($descpro){
        $this->descpro = $descpro;
    }

    public function displayProject($iduser)
    {
        $sql = "SELECT * FROM projet where iduser = :idu";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idu', $iduser);
        $stmt->execute();
        $projectsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $projects = [];
        foreach ($projectsData as $projectData) {
            $project = new ProjectModel();
            // $user = new UserModel();
            $project->setIdpro($projectData['idpro']);
            $project->setNompro($projectData['nompro']);
            $project->setDescpro($projectData['descpro']);
            // $user->setnom($projectData['nom']);
            $projects[] = $project;
        }

        return $projects;
    }

    public function addProject($iduser)
    {
        $sql = "INSERT INTO projet (nompro, descpro,iduser) VALUES (:nom_pro, :descrp_pro, :idu)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nom_pro', $this->nompro);
        $stmt->bindParam(':descrp_pro', $this->descpro);
        $stmt->bindParam(':idu', $iduser);
        return $stmt->execute();
    }


    public function editProject($idpro)
    {
        $sql = "UPDATE projet SET nompro = :nompro, descpro = :descpro WHERE idpro = :idpro";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idpro', $idpro);
        $stmt->bindParam(':nompro', $this->nompro);
        $stmt->bindParam(':descpro', $this->descpro);
        return $stmt->execute();
    }

    public function deleteProject($idpro)
    {
        $sql = "DELETE FROM projet WHERE idpro = :idpro";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idpro', $idpro);
        return $stmt->execute();
    }
    
    public function ProjectFinished($iduser)
    {
        $sql = "SELECT count(idpro) FROM projet WHERE iduser = :iduser";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':iduser', $iduser);
        if ($stmt->execute()) {
            return $stmt->fetchColumn();
        } else {
            return false;
        }
    }


}