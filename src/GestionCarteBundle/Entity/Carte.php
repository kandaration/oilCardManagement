<?php

namespace GestionCarteBundle\Entity;

/**
 * Carte
 */
class Carte
{
    /**
     * @var string
     */
    public $nom_porteur;

    /**
     * @var string
     */
    public $prenom_porteur;

    /**
     * @var string
     */
    public $cin;

    /**
     * @var float
     */
    public $solde;

    /**
     * @var string
     */
    private $num_supcarte;

    /**
     * @var string
     */
    private $etat;

    /**
     * @var string
     */
    public $num_carte;

    /**
     * @var \GestionAccesBundle\Entity\Utilisateur
     */
    private $usercarte;

    public function jsonSerialize() {
        return (object) get_object_vars($this);
    }

    /**
     * Set nomPorteur
     *
     * @param string $nomPorteur
     *
     * @return Carte
     */
    public function setNomPorteur($nomPorteur)
    {
        $this->nom_porteur = $nomPorteur;

        return $this;
    }

    /**
     * Get nomPorteur
     *
     * @return string
     */
    public function getNomPorteur()
    {
        return $this->nom_porteur;
    }

    /**
     * Set prenomPorteur
     *
     * @param string $prenomPorteur
     *
     * @return Carte
     */
    public function setPrenomPorteur($prenomPorteur)
    {
        $this->prenom_porteur = $prenomPorteur;

        return $this;
    }

    /**
     * Get prenomPorteur
     *
     * @return string
     */
    public function getPrenomPorteur()
    {
        return $this->prenom_porteur;
    }

    /**
     * Set cin
     *
     * @param string $cin
     *
     * @return Carte
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return string
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Set solde
     *
     * @param float $solde
     *
     * @return Carte
     */
    public function setSolde($solde)
    {
        $this->solde = $solde;

        return $this;
    }

    /**
     * Get solde
     *
     * @return float
     */
    public function getSolde()
    {
        return $this->solde;
    }

    /**
     * Set numSupcarte
     *
     * @param string $numSupcarte
     *
     * @return Carte
     */
    public function setNumSupcarte($numSupcarte)
    {
        $this->num_supcarte = $numSupcarte;

        return $this;
    }

    /**
     * Get numSupcarte
     *
     * @return string
     */
    public function getNumSupcarte()
    {
        return $this->num_supcarte;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Carte
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set numCarte
     *
     * @param string $numCarte
     *
     * @return Carte
     */
    public function setNumCarte($numCarte)
    {
        $this->num_carte = $numCarte;

        return $this;
    }

    /**
     * Get numCarte
     *
     * @return string
     */
    public function getNumCarte()
    {
        return $this->num_carte;
    }

    /**
     * Set usercarte
     *
     * @param \GestionAccesBundle\Entity\Utilisateur $usercarte
     *
     * @return Carte
     */
    public function setUsercarte(\GestionAccesBundle\Entity\Utilisateur $usercarte = null)
    {
        $this->usercarte = $usercarte;

        return $this;
    }

    /**
     * Get usercarte
     *
     * @return \GestionAccesBundle\Entity\Utilisateur
     */
    public function getUsercarte()
    {
        return $this->usercarte;
    }
    /**
     * @var integer
     */
    public $plafond;


    /**
     * Set plafond
     *
     * @param integer $plafond
     *
     * @return Carte
     */
    public function setPlafond($plafond)
    {
        $this->plafond = $plafond;

        return $this;
    }

    /**
     * Get plafond
     *
     * @return integer
     */
    public function getPlafond()
    {
        return $this->plafond;
    }
    /**
     * @var \GestionCarteBundle\Entity\Carte
     */
    private $client;


    /**
     * Set client
     *
     * @param \GestionCarteBundle\Entity\Carte $client
     *
     * @return Carte
     */
    public function setClient(\GestionCarteBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \GestionCarteBundle\Entity\Carte
     */
    public function getClient()
    {
        return $this->client;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $transactions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->transactions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add transaction
     *
     * @param \GestionTransactionBundle\Entity\transaction $transaction
     *
     * @return Carte
     */
    public function addTransaction(\GestionTransactionBundle\Entity\transaction $transaction)
    {
        $this->transactions[] = $transaction;

        return $this;
    }

    /**
     * Remove transaction
     *
     * @param \GestionTransactionBundle\Entity\transaction $transaction
     */
    public function removeTransaction(\GestionTransactionBundle\Entity\transaction $transaction)
    {
        $this->transactions->removeElement($transaction);
    }

    /**
     * Get transactions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTransactions()
    {
        return $this->transactions;
    }
    /**
     * @var string
     */
    private $Code;


    /**
     * Set code
     *
     * @param string $code
     *
     * @return Carte
     */
    public function setCode($code)
    {
        $this->Code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->Code;
    }
}
