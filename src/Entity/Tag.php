<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity
 */
class Tag
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255, nullable=false)
     */
    private $libelle;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Recipe", mappedBy="tag")
     */
    private $recipe;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="User", mappedBy="tag")
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->recipe = new \Doctrine\Common\Collections\ArrayCollection();
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Tag
     */
    public function setId(int $id): Tag
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getLibelle(): string
    {
        return $this->libelle;
    }

    /**
     * @param string $libelle
     * @return Tag
     */
    public function setLibelle(string $libelle): Tag
    {
        $this->libelle = $libelle;
        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRecipe(): \Doctrine\Common\Collections\Collection
    {
        return $this->recipe;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $recipe
     * @return Tag
     */
    public function setRecipe(\Doctrine\Common\Collections\Collection $recipe): Tag
    {
        $this->recipe = $recipe;
        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser(): \Doctrine\Common\Collections\Collection
    {
        return $this->user;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $user
     * @return Tag
     */
    public function setUser(\Doctrine\Common\Collections\Collection $user): Tag
    {
        $this->user = $user;
        return $this;
    }


}
