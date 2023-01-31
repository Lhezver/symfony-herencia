<?php

namespace App\Entity;

use App\Repository\HijaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HijaRepository::class)
 */
class Hija extends Padre
{

    /**
     * @ORM\Column(type="integer")
     */
    private $muniecas;

    public function getMuniecas(): ?int
    {
        return $this->muniecas;
    }

    public function setMuniecas(int $muniecas): self
    {
        $this->muniecas = $muniecas;

        return $this;
    }

    public function getClassName()
    {
        return (new \ReflectionClass($this))->getShortName();
    }
}
