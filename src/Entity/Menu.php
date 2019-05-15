<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Menu
 * @ORM\Entity(repositoryClass="App\Repository\MenuRepository")
 * @ORM\Table(name="menu", indexes={@ORM\Index(name="fk_menu_recipe2_idx", columns={"main_course_id"}), @ORM\Index(name="fk_menu_user1_idx", columns={"user_id"}), @ORM\Index(name="fk_menu_recipe1_idx", columns={"starter_id"}), @ORM\Index(name="fk_menu_recipe3_idx", columns={"dessert_id"})})
 *
 */
class Menu
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var Recipe
     *
     * @ORM\ManyToOne(targetEntity="Recipe", inversedBy="menu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="starter_id", referencedColumnName="id")
     * })
     */
    private $starter;

    /**
     * @var Recipe
     *
     * @ORM\ManyToOne(targetEntity="Recipe", inversedBy="menu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="main_course_id", referencedColumnName="id")
     * })
     */
    private $mainCourse;

    /**
     * @var Recipe
     *
     * @ORM\ManyToOne(targetEntity="Recipe", inversedBy="menu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dessert_id", referencedColumnName="id")
     * })
     */
    private $dessert;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="menus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Menu
     */
    public function setId(int $id): Menu
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return Menu
     */
    public function setDate(\DateTime $date): Menu
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return Recipe
     */
    public function getStarter(): ?Recipe
    {
        return $this->starter;
    }

    /**
     * @param Recipe $starter
     * @return Menu
     */
    public function setStarter(Recipe $starter): Menu
    {
        $this->starter = $starter;
        return $this;
    }

    /**
     * @return Recipe
     */
    public function getMainCourse(): ?Recipe
    {
        return $this->mainCourse;
    }

    /**
     * @param Recipe $mainCourse
     * @return Menu
     */
    public function setMainCourse(Recipe $mainCourse): Menu
    {
        $this->mainCourse = $mainCourse;
        return $this;
    }

    /**
     * @return Recipe
     */
    public function getDessert(): ?Recipe
    {
        return $this->dessert;
    }

    /**
     * @param Recipe $dessert
     * @return Menu
     */
    public function setDessert(Recipe $dessert): Menu
    {
        $this->dessert = $dessert;
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
     * @return Menu
     */
    public function setUser(User $user): Menu
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return Recipe
     */
    public function __toString(): string
    {
        return $this->getMainCourse();
    }


}
