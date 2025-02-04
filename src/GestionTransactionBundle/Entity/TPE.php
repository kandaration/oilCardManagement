<?php

namespace GestionTransactionBundle\Entity;

/**
 * TPE
 */
class TPE  implements \JsonSerializable
{
    /**
     * @var string
     */
    private $num_serie;

    /**
     * @var \DateTime
     */
    private $date_accisition;

    /**
     * @var boolean
     */
    private $actif;

    /**
     * @var integer
     */
    private $id_TPE;

    /**
     * @var \GestionTransactionBundle\Entity\Terminal
     */
    private $terminal;

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



    public function jsonSerialize() {
        return (object) get_object_vars($this);
    }

    /**
     * Set numSerie
     *
     * @param string $numSerie
     *
     * @return TPE
     */
    public function setNumSerie($numSerie)
    {
        $this->num_serie = $numSerie;

        return $this;
    }

    /**
     * Get numSerie
     *
     * @return string
     */
    public function getNumSerie()
    {
        return $this->num_serie;
    }

    /**
     * Set dateAccisition
     *
     * @param \DateTime $dateAccisition
     *
     * @return TPE
     */
    public function setDateAccisition($dateAccisition)
    {
        $this->date_accisition = $dateAccisition;

        return $this;
    }

    /**
     * Get dateAccisition
     *
     * @return \DateTime
     */
    public function getDateAccisition()
    {
        return $this->date_accisition;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     *
     * @return TPE
     */
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get actif
     *
     * @return boolean
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * Set idTPE
     *
     * @param integer $idTPE
     *
     * @return TPE
     */
    public function setIdTPE($idTPE)
    {
        $this->id_TPE = $idTPE;

        return $this;
    }

    /**
     * Get idTPE
     *
     * @return integer
     */
    public function getIdTPE()
    {
        return $this->id_TPE;
    }

    /**
     * Set terminal
     *
     * @param \GestionTransactionBundle\Entity\Terminal $terminal
     *
     * @return TPE
     */
    public function setTerminal(\GestionTransactionBundle\Entity\Terminal $terminal = null)
    {
        $this->terminal = $terminal;

        return $this;
    }

    /**
     * Get terminal
     *
     * @return \GestionTransactionBundle\Entity\Terminal
     */
    public function getTerminal()
    {
        return $this->terminal;
    }

    /**
     * Add transaction
     *
     * @param \GestionTransactionBundle\Entity\Transaction $transaction
     *
     * @return TPE
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
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */

}

