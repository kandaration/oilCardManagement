<?php

namespace GestionAccesBundle\Entity;

/**
 * Utilisateur
 */
class Utilisateur
{
    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $mot_passe;

    /**
     * @var string
     */
    public $nom;

    /**
     * @var string
     */
    public $prenom;

    /**
     * @var \DateTime
     */
    public $Date_Naissance;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    private $tel;

    /**
     * @var integer
     */
    private $id_Utilisateur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $Roles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Roles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return Utilisateur
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set motPasse
     *
     * @param string $motPasse
     *
     * @return Utilisateur
     */
    public function setMotPasse($motPasse)
    {
        $this->mot_passe = $motPasse;

        return $this;
    }

    /**
     * Get motPasse
     *
     * @return string
     */
    public function getMotPasse()
    {
        return $this->mot_passe;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Utilisateur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Utilisateur
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->Date_Naissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->Date_Naissance;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Utilisateur
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return Utilisateur
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Get idUtilisateur
     *
     * @return integer
     */
    public function getIdUtilisateur()
    {
        return $this->id_Utilisateur;
    }

    /**
     * Add role
     *
     * @param \GestionAccesBundle\Entity\ProfilUtilisateur $role
     *
     * @return Utilisateur
     */
    public function addRole(\GestionAccesBundle\Entity\ProfilUtilisateur $role)
    {
        $this->Roles[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param \GestionAccesBundle\Entity\ProfilUtilisateur $role
     */
    public function removeRole(\GestionAccesBundle\Entity\ProfilUtilisateur $role)
    {
        $this->Roles->removeElement($role);
    }

    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoles()
    {
        return $this->Roles;
    }

    public function serialize()
    {
        return serialize(
            [
                $this->id_Utilisateur,
                $this->mot_passe,
                $this->nom,
                $this->prenom,
                $this->Date_Naissance,
                $this->email,
                $this->tel,
                $this->login,
                $this->Roles,
            ]
        );
    }

    public function unserialize($serialized)
    {
        $data = unserialize($serialized);
        list(
            $this->id_Utilisateur,
            $this->mot_passe,
            $this->nom,
            $this->prenom,
            $this->Date_Naissance,
            $this->email,
            $this->tel,
            $this->login,
            $this->Roles,
            ) = $data;
    }

    /**
     * @var integer
     */
    private $type;


    /**
     * Set type
     *
     * @param integer $type
     *
     * @return Utilisateur
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * @var \GestionCarteBundle\Entity\Carte
     */
    private $carte;


    /**
     * Set carte
     *
     * @param \GestionCarteBundle\Entity\Carte $carte
     *
     * @return Utilisateur
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
     * @var \GestionCarteBundle\Entity\Client
     */
    private $compte_clt;


    /**
     * Set compteClt
     *
     * @param \GestionCarteBundle\Entity\Client $compteClt
     *
     * @return Utilisateur
     */
    public function setCompteClt(\GestionCarteBundle\Entity\Client $compteClt = null)
    {
        $this->compte_clt = $compteClt;

        return $this;
    }

    /**
     * Get compteClt
     *
     * @return \GestionCarteBundle\Entity\Client
     */
    public function getCompteClt()
    {
        return $this->compte_clt;
    }
    /**
     * @var \GestionCarteBundle\Entity\Gerant
     */
    private $compte_gerant;


    /**
     * Set compteGerant
     *
     * @param \GestionCarteBundle\Entity\Gerant $compteGerant
     *
     * @return Utilisateur
     */
    public function setCompteGerant(\GestionCarteBundle\Entity\Gerant $compteGerant = null)
    {
        $this->compte_gerant = $compteGerant;

        return $this;
    }

    /**
     * Get compteGerant
     *
     * @return \GestionCarteBundle\Entity\Gerant
     */
    public function getCompteGerant()
    {
        return $this->compte_gerant;
    }
}
