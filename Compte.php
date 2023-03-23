<?php
class Compte
{
    private string $_nomCompte;
    private float $_solde = 0; //Pour être sûr d'intialiser un solde nul
    private string $_devise;
    private Titulaire $_titulaire;
    private float $_argent;
    public function __construct(string $nomCompte,float $solde,string $devise,Titulaire $titulaire)
    {
        $this->_nomCompte = $nomCompte;
        $this->_solde = $solde;
        $this->_devise = $devise;
        $this->_titulaire = $titulaire;
        $this->_titulaire->ajouterCompteBancaire($this);
    }
    /*---------------------------SETTERS-----------------------*/
    public function setNomCompte(string $nomCompte)
    {
        $this->_nomCompte = $nomCompte;
    }
    public function setSolde(int $solde)
    {
        $this->_solde = $solde;
    }
    public function setDevise(string $devise)
    {
        $this->_devise = $devise;
    }
    public function setTitulaire(Titulaire $titulaire)
    {
        $this->_titulaire = $titulaire;
    }
    /*-------------------GETTERS--------------------------*/
    public function getNomCompte() : string
    {
        return $this->_nomCompte;
    }
    public function getSolde() : int
    {
        return $this->_solde;
    }
    public function getDevise() : string
    {
        return $this->_devise;
    }
    public function getTitulaire() : Titulaire
    {
        return $this->_titulaire;
    }
    /*------------------METHODES--------------------*/
    /*Note : testez toutes les possibilités absurdes */
    public function créditer(float $argent) : string
    {
        if ($argent < 0)
        {
            $result = "Vous ne pouvez pas créditer une somme négative.<br>";
            return $result;
        }
        else
        {
        $this->_solde += $argent;
        $result = "Votre compte a été crédité de $argent ".$this->_devise."<br> ";
        $result.= "Nouveau solde : ".$this->_solde."".$this->_devise." <br>";
        return $result;
        }

    }
    public function débiter (float $argent) : string
    {
        if ($argent < 0)
        {
            $result = "Vous ne pouvez pas débiter une somme négative.<br>";
            return $result;
        }
        
        else if (($this->_solde - $argent) < 0)
        {
            $result = "L'opération n'est pas autorisée. Vous demandez le débit de $argent ".$this->_devise. " . Vous disposez de $this";    
            return $result;       
        }
        else
        {
            $this->_solde = $this->_solde-$argent;
            $result = "Votre compte ".$this->_nomCompte." a été débité de ".abs($argent)." ".$this->_devise.".<br> ";
            $result .="Nouveau solde $this.<br>";
            return $result;
        }
    }
    public function virement (float $argent, object $compte) : string
    {   
        if ($argent < 0)
        {
            $result = "Virer un montant négatif n'est pas possible.<br>";
            return $result;
        }
        else if ($this->_solde - $argent <0)
        {
            $result = "L'opération n'est pas autorisée. Vous demandez le débit de $argent".$this->_devise. " . Vous disposez de $this";    
            return $result;       
        }
        else
        {
            $this->_solde =-$argent;
            $compte->créditer($argent);
            $result = " Virement : <strong> Votre compte $this->_nomCompte a été débité de $argent ".$this->_devise. ". 
            Votre compte $compte a été crédité de ".$argent." ".$this->_devise .".</strong><br>";
            return $result;
        }    
    }
    public function infosCompte() : string
    {
        $result = "Nom du compte : ".$this->_nomCompte."<br>";
        $result .="Solde ".$this->_solde." ".$this->_devise." <br>";
        $result .="Titulaire du compte : ".$this->_titulaire."<br><br>";
        return $result;
    }
    public function __toString() : string
    {
        return $this->_nomCompte." ".$this->_solde." ".$this->_devise;   
    }
}