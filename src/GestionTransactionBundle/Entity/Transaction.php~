<?php


namespace GestionTransactionBundle\Entity;

/**
 * Transaction
 */
class Transaction
{
    /**
     * @var string
     */
    public $num_ticket;

    /**
     * @var \DateTime
     */
    public $date;

    /**
     * @var \DateTime
     */
    public $heure;

    /**
     * @var float
     */
    public $montant;

    /**
     * @var float
     */
    public $solde;

    /**
     * @var integer
     */
    private $id_transaction;

    /**
     * @var \GestionCarteBundle\Entity\Carte
     */
    public $carte;

    /**
     * @var \GestionTransactionBundle\Entity\TPE
     */
    public $tpe;

    /**
     * @var \GestionTransactionBundle\Entity\Terminal
     */
    private $terminal;

    /**
     * @var \GestionCarteBundle\Entity\Station
     */
    public $station;

    /**
     * @var \GestionCarteBundle\Entity\Client
     */
    public $client;

    /**
     * @var \GestionTransactionBundle\Entity\Type_Transaction
     */
    public $type;

    public function jsonSerialize() {
        return (object) get_object_vars($this);
    }

    /**
     * Set numTicket
     *
     * @param string $numTicket
     *
     * @return Transaction
     */
    public function setNumTicket($numTicket)
    {
        $this->num_ticket = $numTicket;

        return $this;
    }



    /**
     * Get numTicket
     *
     * @return string
     */
    public function getNumTicket()
    {
        return $this->num_ticket;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Transaction
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set heure
     *
     * @param \DateTime $heure
     *
     * @return Transaction
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;

        return $this;
    }

    /**
     * Get heure
     *
     * @return \DateTime
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * Set montant
     *
     * @param float $montant
     *
     * @return Transaction
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return float
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set solde
     *
     * @param float $solde
     *
     * @return Transaction
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
     * Set idTransaction
     *
     * @param integer $idTransaction
     *
     * @return Transaction
     */
    public function setIdTransaction($idTransaction)
    {
        $this->id_transaction = $idTransaction;

        return $this;
    }

    /**
     * Get idTransaction
     *
     * @return integer
     */
    public function getIdTransaction()
    {
        return $this->id_transaction;
    }

    /**
     * Set carte
     *
     * @param \GestionCarteBundle\Entity\Carte $carte
     *
     * @return Transaction
     */
    public function setCarte(\GestionCarteBundle\Entity\Carte $carte = null)
    {
        $this->carte = $carte;

        return $this;
    }

    /**
     * Get carte
     *
     * @return \GestionCarteBundle\Entity\Carte
     */
    public function getCarte()
    {
        return $this->carte;
    }

    /**
     * Set tpe
     *
     * @param \GestionTransactionBundle\Entity\TPE $tpe
     *
     * @return Transaction
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
     * Set terminal
     *
     * @param \GestionTransactionBundle\Entity\Terminal $terminal
     *
     * @return Transaction
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
     * Set station
     *
     * @param \GestionCarteBundle\Entity\Station $station
     *
     * @return Transaction
     */
    public function setStation(\GestionCarteBundle\Entity\Station $station = null)
    {
        $this->station = $station;

        return $this;
    }

    /**
     * Get station
     *
     * @return \GestionCarteBundle\Entity\Station
     */
    public function getStation()
    {
        return $this->station;
    }

    /**
     * Set client
     *
     * @param \GestionCarteBundle\Entity\Client $client
     *
     * @return Transaction
     */
    public function setClient(\GestionCarteBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \GestionCarteBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set type
     *
     * @param \GestionTransactionBundle\Entity\Type_Transaction $type
     *
     * @return Transaction
     */
    public function setType(\GestionTransactionBundle\Entity\Type_Transaction $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \GestionTransactionBundle\Entity\Type_Transaction
     */
    public function getType()
    {
        return $this->type;
    }

   /* function __toString()
    {
        return "{".
            $this->num_ticket.",".

    $this->date.",".

     $this->heure.",".


     $this->montant.",".

   $this->solde.",".

  $this->id_transaction.",".
$this->carte.",".

     $this->tpe.",".

            $this->terminal.",".

     $this->station.",".


            $this->client.",".

   $this->type.",".

            "}";
    }*/


    /**
     * @var string
     */
    private $produit;

    /**
     * @var string
     */
    private $volume;


    /**
     * Set produit
     *
     * @param string $produit
     *
     * @return Transaction
     */
    public function setProduit($produit)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return string
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * Set volume
     *
     * @param string $volume
     *
     * @return Transaction
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;

        return $this;
    }

    /**
     * Get volume
     *
     * @return string
     */
    public function getVolume()
    {
        return $this->volume;
    }
}
