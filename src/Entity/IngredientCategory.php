<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IngredientCategory
 *
 * @ORM\Table(name="ingredient_category")
 * @ORM\Entity
 */
class IngredientCategory
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return IngredientCategory
     */
    public function setId(int $id): IngredientCategory
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
     * @return IngredientCategory
     */
    public function setLibelle(string $libelle): IngredientCategory
    {
        $this->libelle = $libelle;
        return $this;
    }

    public function __toString()
    {
        return $this->getLibelle();
    }


}
