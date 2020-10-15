<?php

namespace GestionAccesBundle\Entity;

/**
 * Profil
 */
class Profil
{
    /**
     * @var string
     */
    private $nom_Profil;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $id_Profil;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $roles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set nomProfil
     *
     * @param string $nomProfil
     *
     * @return Profil
     */
    public function setNomProfil($nomProfil)
    {
        $this->nom_Profil = $nomProfil;

        return $this;
    }

 public function __toString()
 {
     return "id: ".$this->id_Profil." nom: ".$this->nom_Profil." description: ".$this->description;
 }

    /**
     * Get nomProfil
     *
     * @return string
     */
    public function getNomProfil()
    {
        return $this->nom_Profil;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Profil
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
     * Get idProfil
     *
     * @return integer
     */
    public function getIdProfil()
    {
        return $this->id_Profil;
    }

    /**
     * Add role
     *
     * @param \GestionAccesBundle\Entity\ProfilUtilisateur $role
     *
     * @return Profil
     */
    public function addRole(\GestionAccesBundle\Entity\ProfilUtilisateur $role)
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param \GestionAccesBundle\Entity\ProfilUtilisateur $role
     */
    public function removeRole(\GestionAccesBundle\Entity\ProfilUtilisateur $role)
    {
        $this->roles->removeElement($role);
    }

    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoles()
    {
        return $this->roles;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $functions;


    /**
     * Add function
     *
     * @param \GestionAccesBundle\Entity\Profil_FN $function
     *
     * @return Profil
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
}
