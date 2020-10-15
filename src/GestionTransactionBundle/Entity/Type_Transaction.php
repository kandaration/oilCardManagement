<?php

namespace GestionTransactionBundle\Entity;

/**
 * Type_Transaction
 */
class Type_Transaction implements \JsonSerializable
{
    /**
     * @var string
     */
    private $designiation;

    /**
     * @var string
     */
    private $abreviation;

    /**
     * @var integer
     */
    private $id_Type_Transaction;

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
     * Set designiation
     *
     * @param string $designiation
     *
     * @return Type_Transaction
     */
    public function setDesigniation($designiation)
    {
        $this->designiation = $designiation;

        return $this;
    }

    /**
     * Get designiation
     *
     * @return string
     */
    public function getDesigniation()
    {
        return $this->designiation;
    }

    /**
     * Set abreviation
     *
     * @param string $abreviation
     *
     * @return Type_Transaction
     */
    public function setAbreviation($abreviation)
    {
        $this->abreviation = $abreviation;

        return $this;
    }

    /**
     * Get abreviation
     *
     * @return string
     */
    public function getAbreviation()
    {
        return $this->abreviation;
    }

    /**
     * Set idTypeTransaction
     *
     * @param integer $idTypeTransaction
     *
     * @return Type_Transaction
     */
    public function setIdTypeTransaction($idTypeTransaction)
    {
        $this->id_Type_Transaction = $idTypeTransaction;

        return $this;
    }

    /**
     * Get idTypeTransaction
     *
     * @return integer
     */
    public function getIdTypeTransaction()
    {
        return $this->id_Type_Transaction;
    }

    /**
     * Add transaction
     *
     * @param \GestionTransactionBundle\Entity\Transaction $transaction
     *
     * @return Type_Transaction
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
}

