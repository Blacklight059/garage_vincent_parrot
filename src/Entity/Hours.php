<?php

namespace App\Entity;

use App\Repository\HoursRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HoursRepository::class)]
class Hours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $open = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOpen(): ?string
    {
        return $this->open;
    }

    public function setOpen(string $open): static
    {
        $this->open = $open;

        return $this;
    }
}
