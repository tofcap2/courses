<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Step
 *
 * @ORM\Table(name="step", indexes={@ORM\Index(name="fk_step_recipe1_idx", columns={"recipe_id"})})
 * @ORM\Entity
 */
class Step
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
     * @var int
     *
     * @ORM\Column(name="number", type="integer", nullable=false)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=65535, nullable=false)
     */
    private $content;

    /**
     * @var Recipe
     *
     * @ORM\ManyToOne(targetEntity="Recipe", inversedBy="step")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="recipe_id", referencedColumnName="id")
     * })
     */
    private $recipe;

    public function __toString()
    {
        return $this->getContent();
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
     * @return Step
     */
    public function setId(int $id): Step
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumber(): ?int
    {
        return $this->number;
    }

    /**
     * @param int $number
     * @return Step
     */
    public function setNumber(int $number): Step
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Step
     */
    public function setContent(string $content): Step
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return Recipe
     */
    public function getRecipe(): Recipe
    {
        return $this->recipe;
    }

    /**
     * @param Recipe $recipe
     * @return Step
     */
    public function setRecipe(Recipe $recipe): Step
    {
        $this->recipe = $recipe;
        return $this;
    }

}
