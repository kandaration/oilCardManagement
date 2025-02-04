<?php

namespace GestionTransactionBundle\Entity;

/**
 * Terminal
 */
class Terminal
{
    /**
     * @var string
     */
    private $heuretelecollecte;

    /**
     * @var integer
     */
    private $id_terminal;

    /**
     * @var \GestionTransactionBundle\Entity\TPE
     */
    private $tpe;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $transactions;

    /**
     * @var \GestionCarteBundle\Entity\Station
     */
    private $Station;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->transactions = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set heuretelecollecte
     *
     * @param string $heuretelecollecte
     *
     * @return Terminal
     */
    public function setHeuretelecollecte($heuretelecollecte)
    {
        $this->heuretelecollecte = $heuretelecollecte;

        return $this;
    }

    /**
     * Get heuretelecollecte
     *
     * @return string
     */
    public function getHeuretelecollecte()
    {
        return $this->heuretelecollecte;
    }

    /**
     * Set idTerminal
     *
     * @param integer $idTerminal
     *
     * @return Terminal
     */
    public function setIdTerminal($idTerminal)
    {
        $this->id_terminal = $idTerminal;

        return $this;
    }

    /**
     * Get idTerminal
     *
     * @return integer
     */
    public function getIdTerminal()
    {
        return $this->id_terminal;
    }

    /**
     * Set tpe
     *
     * @param \GestionTransactionBundle\Entity\TPE $tpe
     *
     * @return Terminal
     */
    public function setTpe(\GestionTransactionBundle\Entity\TPE $tpe = null)
    {
        $this->tpe = $tpe;

        return $this;
    }

    /**
     * Get tpe
     *
     * @return \GestionTransactionBundle\Entity\TPE
     */
    public function getTpe()
    {
        return $this->tpe;
    }

    /**
     * Add transaction
     *
     * @param \GestionTransactionBundle\Entity\Transaction $transaction
     *
     * @return Terminal
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
     * Set station
     *
     * @param \GestionCarteBundle\Entity\Station $station
     *
     * @return Terminal
     */
    public function setStation(\GestionCarteBundle\Entity\Station $station = null)
    {
        $this->Station = $station;

        return $this;
    }

    /**
     * Get station
     *
     * @return \GestionCarteBundle\Entity\Station
     */
    public function getStation()
    {
        return $this->Station;
    }
}

