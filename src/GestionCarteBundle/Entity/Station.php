<?php

namespace GestionCarteBundle\Entity;

/**
 * Station
 */
class Station implements \JsonSerializable
{
    /**
     * @var string
     */
    public $fax;

    /**
     * @var string
     */
    public $adress;

    /**
     * @var string
     */
    private $longitude;

    /**
     * @var string
     */
    private $latitude;

    /**
     * @var integer
     */
    private $id_station;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $terminals;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $transactions;

    /**
     * @var \GestionCarteBundle\Entity\Gerant
     */
    private $gerant;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->terminals = new \Doctrine\Common\Collections\ArrayCollection();
        $this->transactions = new \Doctrine\Common\Collections\ArrayCollection();
    }
    public function jsonSerialize() {
        return (object) get_object_vars($this);
    }
    /**
     * Set fax
     *
     * @param string $fax
     *
     * @return Station
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set adress
     *
     * @param string $adress
     *
     * @return Station
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
     * Set longitude
     *
     * @param string $longitude
     *
     * @return Station
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return Station
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set idStation
     *
     * @param integer $idStation
     *
     * @return Station
     */
    public function setIdStation($idStation)
    {
        $this->id_station = $idStation;

        return $this;
    }

    /**
     * Get idStation
     *
     * @return integer
     */
    public function getIdStation()
    {
        return $this->id_station;
    }

    /**
     * Add terminal
     *
     * @param \GestionTransactionBundle\Entity\Terminal $terminal
     *
     * @return Station
     */
    public function addTerminal(\GestionTransactionBundle\Entity\Terminal $terminal)
    {
        $this->terminals[] = $terminal;

        return $this;
    }

    /**
     * Remove terminal
     *
     * @param \GestionTransactionBundle\Entity\Terminal $terminal
     */
    public function removeTerminal(\GestionTransactionBundle\Entity\Terminal $terminal)
    {
        $this->terminals->removeElement($terminal);
    }

    /**
     * Get terminals
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTerminals()
    {
        return $this->terminals;
    }

    /**
     * Add transaction
     *
     * @param \GestionTransactionBundle\Entity\Transaction $transaction
     *
     * @return Station
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
     * Set gerant
     *
     * @param \GestionCarteBundle\Entity\Gerant $gerant
     *
     * @return Station
     */
    public function setGerant(\GestionCarteBundle\Entity\Gerant $gerant = null)
    {
        $this->gerant = $gerant;

        return $this;
    }

    /**
     * Get gerant
     *
     * @return \GestionCarteBundle\Entity\Gerant
     */
    public function getGerant()
    {
        return $this->gerant;
    }
}

