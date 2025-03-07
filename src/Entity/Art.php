<?php

namespace App\Entity;

use App\Repository\ArtRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtRepository::class)]
class Art
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $art = null;

    /**
     * @var Collection<int, Style>
     */
    #[ORM\OneToMany(targetEntity: Style::class, mappedBy: 'art')]
    private Collection $styles;

    public function __construct()
    {
        $this->styles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArt(): ?string
    {
        return $this->art;
    }

    public function setArt(string $art): static
    {
        $this->art = $art;

        return $this;
    }

    /**
     * @return Collection<int, Style>
     */
    public function getStyles(): Collection
    {
        return $this->styles;
    }

    public function addStyle(Style $style): static
    {
        if (!$this->styles->contains($style)) {
            $this->styles->add($style);
            $style->setArt($this);
        }

        return $this;
    }

    public function removeStyle(Style $style): static
    {
        if ($this->styles->removeElement($style)) {
            // set the owning side to null (unless already changed)
            if ($style->getArt() === $this) {
                $style->setArt(null);
            }
        }

        return $this;
    }
}
