<?php
class Titulaire
{
    private string $_nom;
    private string $_prenom;
    private string $_dateNaissance;
    private string $_ville;
    private array $_comptesEnsemble;
    public function __construct(string $nom, string $prenom, string $dateNaissance, string $ville)
    {
        $this->_nom = $nom;
        $this->_prenom = $prenom;
        $this->_dateNaissance = $dateNaissance;
        $this->_ville = $ville;
        $this->_comptesEnsemble = [];
    }
    /*-------setters------------*/
    public function setNom(string $nom)
    {
        $this->_nom = $nom;
    }
    public function setPrenom(string $prenom)
    {
        $this->_prenom = $prenom;
    }
    public function setDateNaissance(string $dateNaissance)
    {
        $this->_dateNaissance = $dateNaissance;
    }
    public function setVille(string $ville)
    {
        $this->_ville = $ville;
    }
    public function setComptesEnsemble(array $comptesEnsemble)
    {
        $this->_comptesEnsemble = $comptesEnsemble;
    }
/*****------------GETTERS----------------- */
    public function getNom() : string
    {
        return $this->_nom;
    }
    public function getPreom() : string
    {
        return $this->_prenom;
    }
    public function getDateNaissance() : string
    {
        return $this->_dateNaissance;
    }
    public function getVille() : string
    {
        return $this->_ville;
    }
    public function getComptesEnsemble() : array
    {
        return $this->_comptesEnsemble;
    }
    /*-----------METHODES-----------------*/
    public function ajouterCompteBancaire(Compte $compte)
    {
        array_push($this->_comptesEnsemble, $compte);
    }
    public function infosTitulaire() : string
    {
        $age = date_diff(date_create($this->_dateNaissance), date_create('today'))->y;
        $result = "Nom : " . $this->_nom . "<br>";
        $result .= "Prénom : " . $this->_prenom . "<br>";
        $result .= "Date de naissance : " . $this->_dateNaissance . "<br>";
        $result .= "Ville : " . $this->_ville . "<br>";
        $result .= "Age : " . $age . " ans <br>";
        $result .= "Comptes bancaires : <br>";
        foreach ($this->_comptesEnsemble as $compte)
        {
            $result .=  $compte."<br>";
        }
        $result .= "<br>";
        return $result;
    }
    /*-------------Pas de __toString() : uncaught error en boucle parce qu'on tente de convertir une chaine de char------------*/
    public function __toString()
    {
        return $this->_nom . ' ' . $this->_prenom;
    }
}
