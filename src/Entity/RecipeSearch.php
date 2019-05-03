<?php


namespace App\Entity;


class RecipeSearch
{
    /**
     * @var string|null
     */
    private $category;

    /**
     * @var string|null
     */
    private $recipe;

    /**
     * @return string|null
     */
    public function getCategory(): ?string
    {
        return $this->category;
    }

    /**
     * @param string|null $category
     * @return RecipeSearch
     */
    public function setCategory(string $category): RecipeSearch
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRecipe(): ?string
    {
        return $this->recipe;
    }

    /**
     * @param string|null $recipe
     * @return RecipeSearch
     */
    public function setRecipe(string $recipe): RecipeSearch
    {
        $this->recipe = $recipe;
        return $this;
    }

}
