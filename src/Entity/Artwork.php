<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArtworkRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[vich\Uploadable]
#[ORM\Entity(repositoryClass: ArtworkRepository::class)]
class Artwork
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    //IMG VICH start--------
    #[Vich\UploadableField(mapping: 'images', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[Vich\UploadableField(mapping: 'images', fileNameProperty: 'image2Name')]
    private ?File $image2File = null;

    #[ORM\Column(nullable: true)]
    private ?string $image2Name = null;

    #[Vich\UploadableField(mapping: 'images', fileNameProperty: 'image3Name')]
    private ?File $image3File = null;

    #[ORM\Column(nullable: true)]
    private ?string $image3Name = null;

    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $updatedAt = null;
	//IMG VICH end--------------

    #[ORM\ManyToOne(inversedBy: 'artworks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'artwork')]
    private Collection $comments;

    /**
     * @var Collection<int, Style>
     */
    #[ORM\ManyToMany(targetEntity: Style::class, inversedBy: 'artworks')]
    private Collection $style;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->style = new ArrayCollection();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function setImageFile(?File $imageFile = null):void
    {
        $this->imageFile = $imageFile;

        if ($imageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

     public function setImage2File(?File $image2File = null):void
    {
        $this->image2File = $image2File;

        if ($image2File) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImage2File(): ?File
    {
        return $this->image2File;
    }

    public function setImage2Name(?string $image2Name): void
    {
        $this->image2Name = $image2Name;
    }

    public function getImage2Name(): ?string
    {
        return $this->image2Name;
    }

    public function setImage3File(?File $image3File = null):void
    {
        $this->image3File = $image3File;

        if ($image3File) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImage3File(): ?File
    {
        return $this->image3File;
    }

    public function setImage3Name(?string $image3Name): void
    {
        $this->image3Name = $image3Name;
    }

    public function getImage3Name(): ?string
    {
        return $this->image3Name;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setArtwork($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getArtwork() === $this) {
                $comment->setArtwork(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Style>
     */
    public function getStyle(): Collection
    {
        return $this->style;
    }

    public function addStyle(Style $style): static
    {
        if (!$this->style->contains($style)) {
            $this->style->add($style);
        }

        return $this;
    }

    public function removeStyle(Style $style): static
    {
        $this->style->removeElement($style);

        return $this;
    }
}
