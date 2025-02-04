<?php

namespace GestionCarteBundle\Entity;

/**
 * Gerant
 */
class Gerant implements \JsonSerializable
{
    /**
     * @var integer
     */
    private $id_gerant;

    /**
     * @var \GestionAccesBundle\Entity\Utilisateur
     */
    private $compte_carte_gerant;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $stations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->stations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function jsonSerialize() {
        if($this->getCompteCarteGerant()!=null) {
            return (object)get_object_vars($this->getCompteCarteGerant());
        }
        else
        {
            return null;
        }
    }
    /**
     * Set idGerant
     *
     * @param integer $idGerant
     *
     * @return Gerant
     */
    public function setIdGerant($idGerant)
    {
        $this->id_gerant = $idGerant;

        return $this;
    }

    /**
     * Get idGerant
     *
     * @return integer
     */
    public function getIdGerant()
    {
        return $this->id_gerant;
    }

    /**
     * Set compteCarteGerant
     *
     * @param \GestionAccesBundle\Entity\Utilisateur $compteCarteGerant
     *
     * @return Gerant
     */
    public function setCompteCarteGerant(\GestionAccesBundle\Entity\Utilisateur $compteCarteGerant = null)
    {
        $this->compte_carte_gerant = $compteCarteGerant;

        return $this;
    }

    /**
     * Get compteCarteGerant
     *
     * @return \GestionAccesBundle\Entity\Utilisateur
     */
    public function getCompteCarteGerant()
    {
        return $this->compte_carte_gerant;
    }

    /**
     * Add station
     *
     * @param \GestionCarteBundle\Entity\Station $station
     *
     * @return Gerant
     */
    public function addStation(\GestionCarteBundle\Entity\Station $station)
    {
        $this->stations[] = $station;

        return $this;
    }

    /**
     * Remove station
     *
     * @param \GestionCarteBundle\Entity\Station $station
     */
    public function removeStation(\GestionCarteBundle\Entity\Station $station)
    {
        $this->stations->removeElement($station);
    }

    /**
     * Get stations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStations()
    {
        return $this->stations;
    }
}
