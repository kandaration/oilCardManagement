<?php

namespace GestionCarteBundle\Entity;

/**
 * Client
 */
class Client implements \JsonSerializable
{
    /**
     * @var string
     */
    private $designation;

    /**
     * @var string
     */
    private $adress;

    /**
     * @var integer
     */
    private $plafondcredit;

    /**
     * @var integer
     */
    private $id_client;

    /**
     * @var \GestionAccesBundle\Entity\Utilisateur
     */
    private $compte_carte_clt;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $transactions;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $cartes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->transactions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cartes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function jsonSerialize() {
        return (object) get_object_vars($this);
    }

    /**
     * Set designation
     *
     * @param string $designation
     *
     * @return Client
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set adress
     *
     * @param string $adress
     *
     * @return Client
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress
     *
     * @return string
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set plafondcredit
     *
     * @param integer $plafondcredit
     *
     * @return Client
     */
    public function setPlafondcredit($plafondcredit)
    {
        $this->plafondcredit = $plafondcredit;

        return $this;
    }

    /**
     * Get plafondcredit
     *
     * @return integer
     */
    public function getPlafondcredit()
    {
        return $this->plafondcredit;
    }

    /**
     * Set idClient
     *
     * @param integer $idClient
     *
     * @return Client
     */
    public function setIdClient($idClient)
    {
        $this->id_client = $idClient;

        return $this;
    }

    /**
     * Get idClient
     *
     * @return integer
     */
    public function getIdClient()
    {
        return $this->id_client;
    }

    /**
     * Set compteCarteClt
     *
     * @param \GestionAccesBundle\Entity\Utilisateur $compteCarteClt
     *
     * @return Client
     */
    public function setCompteCarteClt(\GestionAccesBundle\Entity\Utilisateur $compteCarteClt = null)
    {
        $this->compte_carte_clt = $compteCarteClt;

        return $this;
    }

    /**
     * Get compteCarteClt
     *
     * @return \GestionAccesBundle\Entity\Utilisateur
     */
    public function getCompteCarteClt()
    {
        return $this->compte_carte_clt;
    }

    /**
     * Add transaction
     *
     * @param \GestionTransactionBundle\Entity\Transaction $transaction
     *
     * @return Client
     */
    public function addTransaction(\GestionTransactionBundle\Entity\Transaction $transaction)
    {
        $this->transactions[] = $transaction;

        return $this;
    }

    /**
     * Remove transaction
     *
     * @param \GestionTransactionBundle\Entity\Transaction $transaction
     */
    public function removeTransaction(\GestionTransactionBundle\Entity\Transaction $transaction)
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
     * Add carte
     *
     * @param \GestionCarteBundle\Entity\Carte $carte
     *
     * @return Client
     */
    public function addCarte(\GestionCarteBundle\Entity\Carte $carte)
    {
        $this->cartes[] = $carte;

        return $this;
    }

    /**
     * Remove carte
     *
     * @param \GestionCarteBundle\Entity\Carte $carte
     */
    public function removeCarte(\GestionCarteBundle\Entity\Carte $carte)
    {
        $this->cartes->removeElement($carte);
    }

    /**
     * Get cartes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCartes()
    {
        return $this->cartes;
    }
}
