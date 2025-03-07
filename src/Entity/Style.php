<?php

namespace App\Entity;

use App\Repository\StyleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StyleRepository::class)]
class Style
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $style = null;

    /**
     * @var Collection<int, Artwork>
     */
    #[ORM\ManyToMany(targetEntity: Artwork::class, mappedBy: 'style')]
    private Collection $artworks;

    #[ORM\ManyToOne(inversedBy: 'styles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Art $art = null;

    public function __construct()
    {
        $this->artworks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStyle(): ?string
    {
        return $this->style;
    }

    public function setStyle(string $style): static
    {
        $this->style = $style;

        return $this;
    }

    /**
     * @return Collection<int, Artwork>
     */
    public function getArtworks(): Collection
    {
        return $this->artworks;
    }

    public function addArtwork(Artwork $artwork): static
    {
        if (!$this->artworks->contains($artwork)) {
            $this->artworks->add($artwork);
            $artwork->addStyle($this);
        }

        return $this;
    }

    public function removeArtwork(Artwork $artwork): static
    {
        if ($this->artworks->removeElement($artwork)) {
            $artwork->removeStyle($this);
        }

        return $this;
    }

    public function getArt(): ?Art
    {
        return $this->art;
    }

    public function setArt(?Art $art): static
    {
        $this->art = $art;

        return $this;
    }
}
