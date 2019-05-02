<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ingredient
 *
 * @ORM\Entity(repositoryClass="App\Repository\IngredientRepository")
 * @ORM\Table(name="ingredient", indexes={@ORM\Index(name="fk_ingredient_ingredient_category1_idx", columns={"ingredient_category_id"})})
 * @ORM\Entity
 */
class Ingredient
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
     * @ORM\Column(name="label", type="string", length=255, nullable=false)
     */
    private $label;

    /**
     * @var IngredientCategory
     *
     * @ORM\ManyToOne(targetEntity="IngredientCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ingredient_category_id", referencedColumnName="id")
     * })
     */
    private $ingredientCategory;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return IngredientCategory
     */
    public function getIngredientCategory(): ?IngredientCategory
    {
        return $this->ingredientCategory;
    }

    /**
     * @param IngredientCategory $ingredientCategory
     */
    public function setIngredientCategory(IngredientCategory $ingredientCategory): void
    {
        $this->ingredientCategory = $ingredientCategory;
    }

    public function __toString()
    {
        return $this->getLabel();
    }


}
