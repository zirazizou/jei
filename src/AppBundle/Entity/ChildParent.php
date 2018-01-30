<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 1/18/2018
 * Time: 6:08 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="child_parent")
 */
class ChildParent
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $email;
    /**
     * @ORM\Column(type="string")
     */
    private $nom;
    /**
     * @ORM\Column(type="string")
     */
    private $prenom;
    /**
     * @ORM\Column(type="string")
     */
    private $profession;
    /**
     * @ORM\Column(type="string")
     */
    private $num_portable;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $adresse;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $data_naissance;

    function __construct(
        $nom,
        $prenom,
        $profession,
        $num_portable
    )
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->profession = $profession;
        $this->num_portable = $num_portable;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * @param mixed $profession
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;
    }

    /**
     * @return mixed
     */
    public function getNumPortable()
    {
        return $this->num_portable;
    }

    /**
     * @param mixed $num_portable
     */
    public function setNumPortable($num_portable)
    {
        $this->num_portable = $num_portable;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return mixed
     */
    public function getDataNaissance()
    {
        return $this->data_naissance;
    }

    /**
     * @param mixed $data_naissance
     */
    public function setDataNaissance($data_naissance)
    {
        $this->data_naissance = $data_naissance;
    }

    public function __toString()
    {
        return $this->name +" "+ $this->prenom;
    }


}