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
     * @var bool
     *
     * @ORM\Column(name="level", type="boolean", nullable=false)
     */
    private $level;

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
     * @return Difficulty
     */
    public function setLabel(string $label): Difficulty
    {
        $this->label = $label;
        return $this;
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
