<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Difficulty
 *
 * @ORM\Table(name="difficulty")
 * @ORM\Entity
 */
class Difficulty
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
     * @var int
     *
     * @ORM\Column(name="level", type="integer", nullable=false)
     */
    private $level;

    public function __toString()
    {
        return $this->getLabel();
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
     * @return Difficulty
     */
    public function setId(int $id): Difficulty
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): string
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
     * @return bool
     */
    public function isLevel(): bool
    {
        return $this->level;
    }

    /**
     * @param bool $level
     * @return Difficulty
     */
    public function setLevel(bool $level): Difficulty
    {
        $this->level = $level;
        return $this;
    }


}
