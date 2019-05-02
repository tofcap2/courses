<?php


namespace App\Entity;


class RecipeSearch
{
    /**
     * @var
     */
    private $category;

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     * @return RecipeSearch
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }



}
