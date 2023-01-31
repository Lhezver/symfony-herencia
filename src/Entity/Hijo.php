<?php

namespace App\Entity;

use App\Repository\HijoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HijoRepository::class)
 */
class Hijo extends Padre
{

    /**
     * @ORM\Column(type="integer")
     */
    private $pelotas;

    public function getPelotas(): ?int
    {
        return $this->pelotas;
    }

    public function setPelotas(int $pelotas): self
    {
        $this->pelotas = $pelotas;

        return $this;
    }

    public function getClassName()
    {
        return (new \ReflectionClass($this))->getShortName();
    }
}
