<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Recipe
 *
 * @ORM\Table(name="recipe", indexes={@ORM\Index(name="fk_recipe_user1_idx", columns={"user_id"}), @ORM\Index(name="fk_recipe_category1_idx", columns={"category_id"}), @ORM\Index(name="fk_recipe_difficulty1_idx", columns={"difficulty_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\RecipeRepository")
 * @Vich\Uploadable()
 * @ORM\HasLifecycleCallbacks()
 */
class Recipe
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
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="preparation_time", type="time", nullable=false)
     */
    private $preparationTime;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="cooking_time", type="time", nullable=true)
     */
    private $cookingTime;

    /**
     * @var int
     *
     * @ORM\Column(name="servings", type="integer", nullable=false)
     */
    private $servings;

    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;

    /**
     * @var Difficulty
     *
     * @ORM\ManyToOne(targetEntity="Difficulty")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="difficulty_id", referencedColumnName="id")
     * })
     */
    private $difficulty;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="recipe")
     * @ORM\JoinTable(name="recipe_has_tag",
     *   joinColumns={
     *     @ORM\JoinColumn(name="recipe_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="tag_id", referencedColumnName="id")
     *   }
     * )
     */
    private $tag;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="recipes")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="Picture", mappedBy="recipe", cascade={"persist"})
     */
    private $pictures;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="recipe", cascade={"persist"})
     */
    private $comments;

    /**
     * @var int
     *
     * @ORM\OneToMany(targetEntity="Step", mappedBy="recipe", cascade={"persist"})
     */
    private $step;

    /**
     * @var RecipeIngredient
     *
     * @ORM\OneToMany(targetEntity="RecipeIngredient", mappedBy="recipe", cascade={"persist"})
     */
    private $recipeIngredient;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tag = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pictures = new \Doctrine\Common\Collections\ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addRecipe($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removeRecipe($this);
        }

        return $this;
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
     * @return Recipe
     */
    public function setId(int $id): Recipe
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Recipe
     */
    public function setTitle(string $title): Recipe
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPreparationTime(): ?\DateTime
    {
        return $this->preparationTime;
    }

    /**
     * @param \DateTime $preparationTime
     * @return Recipe
     */
    public function setPreparationTime(\DateTime $preparationTime): Recipe
    {
        $this->preparationTime = $preparationTime;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCookingTime(): ?\DateTime
    {
        return $this->cookingTime;
    }

    /**
     * @param \DateTime|null $cookingTime
     * @return Recipe
     */
    public function setCookingTime(?\DateTime $cookingTime): Recipe
    {
        $this->cookingTime = $cookingTime;
        return $this;
    }

    /**
     * @return int
     */
    public function isServings(): ?int
    {
        return $this->servings;
    }

    /**
     * @param int $servings
     * @return Recipe
     */
    public function setServings(int $servings): Recipe
    {
        $this->servings = $servings;
        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     * @return Recipe
     */
    public function setCategory(Category $category): Recipe
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return Difficulty
     */
    public function getDifficulty(): ?Difficulty
    {
        return $this->difficulty;
    }

    /**
     * @param Difficulty $difficulty
     * @return Recipe
     */
    public function setDifficulty(Difficulty $difficulty): Recipe
    {
        $this->difficulty = $difficulty;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Recipe
     */
    public function setUser(User $user): Recipe
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getTag(): ?Collection
    {
        return $this->tag;
    }

    /**
     * @param Collection $tag
     * @return Recipe
     */
    public function setTag(Collection $tag): Recipe
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * @param mixed $pictures
     * @return Recipe
     */
    public function setPictures(ArrayCollection $pictures)
    {
        $this->pictures = $pictures;
        return $this;
    }

    /**
     * @param Picture $pictures
     * @return $this
     */
    public function addPicture(Picture $pictures)
    {
        $this->pictures[] = $pictures;
        $pictures->setRecipe($this);
        return $this;
    }

    /**
     * @param Picture $pictures
     */
    public function removePicture(Picture $pictures)
    {
        $this->pictures->removeElement($pictures);
    }

    /**
     * @return int
     */
    public function getStep()
    {
        return $this->step;
    }

    /**
     * @param mixed $step
     */
    public function setStep(int $step): void
    {
        $this->step = $step;
    }

    /**
     * @param Step $steps
     * @return $this
     */
    public function addStep(Step $steps)
    {
        $this->step[] = $steps;
        $steps->setRecipe($this);
        return $this;
    }

    /**
     * @param Step $steps
     */
    public function removeStep(Step $steps)
    {
        $this->steps->removeElement($steps);
    }

    /**
     * @return mixed
     */
    public function getRecipeIngredient()
    {
        return $this->recipeIngredient;
    }

    /**
     * @param RecipeIngredient $recipeIngredient
     * @return $this
     */
    public function addRecipeIngredient(RecipeIngredient $recipeIngredient)
    {
        $this->recipeIngredient[] = $recipeIngredient;
        $recipeIngredient->setRecipe($this);
        return $this;
    }

    /**
     * @param RecipeIngredient $recipeIngredient
     */
    public function removeRecipeIngredient(RecipeIngredient $recipeIngredient)
    {
        $this->recipeIngredient->removeElement($recipeIngredient);
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     * @return Recipe
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
        return $this;
    }



}
