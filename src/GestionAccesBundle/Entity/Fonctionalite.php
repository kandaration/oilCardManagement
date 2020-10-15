<?php

namespace GestionAccesBundle\Entity;

/**
 * Fonctionalite
 */
class Fonctionalite
{
    /**
     * @var string
     */
    private $nom_FN;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $id_FN;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $functions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->functions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set nomFN
     *
     * @param string $nomFN
     *
     * @return Fonctionalite
     */
    public function setNomFN($nomFN)
    {
        $this->nom_FN = $nomFN;

        return $this;
    }
    public function __toString()
    {
        return "id: ".$this->id_FN." nom: ".$this->nom_FN." description: ".$this->description;
    }
    /**
     * Get nomFN
     *
     * @return string
     */
    public function getNomFN()
    {
        return $this->nom_FN;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Fonctionalite
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get idFN
     *
     * @return integer
     */
    public function getIdFN()
    {
        return $this->id_FN;
    }

    /**
     * Add function
     *
     * @param \GestionAccesBundle\Entity\Profil_FN $function
     *
     * @return Fonctionalite
     */
    public function addFunction(\GestionAccesBundle\Entity\Profil_FN $function)
    {
        $this->functions[] = $function;

        return $this;
    }

    /**
     * Remove function
     *
     * @param \GestionAccesBundle\Entity\Profil_FN $function
     */
    public function removeFunction(\GestionAccesBundle\Entity\Profil_FN $function)
    {
        $this->functions->removeElement($function);
    }

    /**
     * Get functions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFunctions()
    {
        return $this->functions;
    }
    /**
     * @var string
     */
    private $icon;


    /**
     * Set icon
     *
     * @param string $icon
     *
     * @return Fonctionalite
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }
    /**
     * @var string
     */
    private $routeid;


    /**
     * Set routeid
     *
     * @param string $routeid
     *
     * @return Fonctionalite
     */
    public function setRouteid($routeid)
    {
        $this->routeid = $routeid;

        return $this;
    }

    /**
     * Get routeid
     *
     * @return string
     */
    public function getRouteid()
    {
        return $this->routeid;
    }
}
