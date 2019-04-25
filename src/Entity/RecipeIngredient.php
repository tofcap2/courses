<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecipeIngredient
 *
 * @ORM\Table(name="recipe_ingredient", indexes={@ORM\Index(name="fk_recipe_has_ingredient_recipe1_idx", columns={"recipe_id"}), @ORM\Index(name="fk_recipe_has_ingredient_ingredient1_idx", columns={"ingredient_id"}), @ORM\Index(name="fk_recipe_has_ingredient_unit1_idx", columns={"unit_id"})})
 * @ORM\Entity
 */
class RecipeIngredient
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
     * @ORM\Column(name="qte", type="decimal", precision=10, scale=3, nullable=false)
     */
    private $qte;

    /**
     * @var Ingredient
     *
     * @ORM\ManyToOne(targetEntity="Ingredient")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ingredient_id", referencedColumnName="id")
     * })
     */
    private $ingredient;

    /**
     * @var Recipe
     *
     * @ORM\ManyToOne(targetEntity="Recipe", inversedBy="recipeIngredient")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="recipe_id", referencedColumnName="id")
     * })
     */
    private $recipe;

    /**
     * @var Unit|null
     *
     * @ORM\ManyToOne(targetEntity="Unit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="unit_id", referencedColumnName="id")
     * })
     */
    private $unit;

    public function __toString()
    {
        return $this->getIngredient();
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return RecipeIngredient
     */
    public function setId(int $id): RecipeIngredient
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getQte(): ?string
    {
        return $this->qte;
    }

    /**
     * @param string $qte
     * @return RecipeIngredient
     */
    public function setQte(string $qte): ?RecipeIngredient
    {
        $this->qte = $qte;
        return $this;
    }

    /**
     * @return Ingredient
     */
    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    /**
     * @param Ingredient $ingredient
     * @return RecipeIngredient
     */
    public function setIngredient(Ingredient $ingredient): RecipeIngredient
    {
        $this->ingredient = $ingredient;
        return $this;
    }

    /**
     * @return Recipe
     */
    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    /**
     * @param Recipe $recipe
     * @return RecipeIngredient
     */
    public function setRecipe(Recipe $recipe): RecipeIngredient
    {
        $this->recipe = $recipe;
        return $this;
    }

    /**
     * @return Unit|null
     */
    public function getUnit(): ?Unit
    {
        return $this->unit;
    }

    /**
     * @param Unit|null $unit
     */
    public function setUnit(?Unit $unit): void
    {
        $this->unit = $unit;
    }




}
