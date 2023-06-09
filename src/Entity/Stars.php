<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\StarsRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass=StarsRepository::class)
 */

class Stars {
    // * @UniqueEntity(
    // * fields={"title"},
    // * message="Une étoile ayant ce nom a déjà été créée"
    // * )
    

    // -------------------------------- Properties ----------------------------------


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
    * @ORM\Column(type="string", length=255)
    * @Assert\NotBlank()
    * @Assert\Length(min=3,max=255,minMessage="Ce champs doit contenir au mois 4 caractères",maxMessage="Ce champ ne doit pas excéder 255 caractères")
    */
    private $title;

    /**
    * @ORM\Column(type="integer")
    * @Assert\NotBlank()
    * @Assert\Positive()
    */
    private $distance;

    /**
    * @ORM\Column(type="text")
    * @Assert\NotBlank()
    * @Assert\Length(
    *      min = 20,
    *      max = 500,
    *      minMessage = "La description ne peut pas être inférieur à 20 caractères",
    *      maxMessage = "La description ne peut pas excéder 500 caractères",
    *      allowEmptyString = false
    * )
    * )
    */
    private $smallDescription;
    

    /**
    * @ORM\Column(type="text")
    * @Assert\NotBlank()
    * @Assert\Length(
    *      min = 100,
    *      max = 10000,
    *      minMessage = "La description ne peut pas être inférieur à 100 caractères",
    *      maxMessage = "La description ne peut pas excéder 10000 caractères",
    *      allowEmptyString = false
    * )
    */
    private $description;
    

    /**
    * @ORM\Column(type="string", length=255)
    * @Assert\NotBlank()
    * @Assert\Length(
    *      min = 10,
    *      max = 255,
    *      minMessage = "Ce champ ne peut pas être inférieur à 10 caractères",
    *      maxMessage = "Ce champ ne peut pas excéder 255 caractères",
    *      allowEmptyString = false
    * )
    */
    private $image;
    

    /**
    * @ORM\Column(type="integer")
    * @Assert\NotBlank()
    * @Assert\Positive()
    */
    private $size;

    /**
    * @ORM\Column(type="integer")
    * @Assert\PositiveOrZero()
    */
    private $planetsNumber;

    /**
    * @ORM\Column(type="string", length=255)
    * @Assert\NotBlank()
    * @Assert\Length(
    *      min = 3,
    *      max = 255,
    *      minMessage = "Ce champ ne peut pas être inférieur à 10 caractères",
    *      maxMessage = "Ce champ ne peut pas excéder 255 caractères",
    *      allowEmptyString = false
    * )
    */
    private $constellation;

    /**
    * @ORM\Column(type="bigint")
    * @Assert\NotBlank()
    * @Assert\PositiveOrZero()
    */
    private $price;

    /**
    * @ORM\Column(type="float", nullable=true)
    * @Assert\PositiveOrZero()
    */
    private $discount;

    /**
    * @ORM\OneToMany(targetEntity=Images::class, mappedBy="starsID")
    * 
    */
    private $images;

    /**
    * @ORM\OneToMany(targetEntity=Images::class, mappedBy="starsID", orphanRemoval=true)
    */
    private $caption;

    /**
     * @ORM\OneToMany(targetEntity=Images::class, mappedBy="starsID")
     */
    private $otherImages;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="stars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Author;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="starId", orphanRemoval=true)
     */
    private $comments;


    // -------------------------------- Methods ----------------------------------


    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->caption = new ArrayCollection();
        $this->otherImages = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDistance(): ?int
    {
        return $this->distance;
    }

    public function setDistance(int $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getSmallDescription(): ?string
    {
        return $this->smallDescription;
    }

    public function setSmallDescription(string $smallDescription): self
    {
        $this->smallDescription = $smallDescription;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getPlanetsNumber(): ?int
    {
        return $this->planetsNumber;
    }

    public function setPlanetsNumber(int $planetsNumber): self
    {
        $this->planetsNumber = $planetsNumber;

        return $this;
    }

    public function getConstellation(): ?string
    {
        return $this->constellation;
    }

    public function setConstellation(string $constellation): self
    {
        $this->constellation = $constellation;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function setDiscount(?float $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getOtherImages(): Collection
    {
        return $this->otherImages;
    }

    public function addOtherImage(Images $otherImage): self
    {
        if (!$this->otherImages->contains($otherImage)) {
            $this->otherImages[] = $otherImage;
            $otherImage->setStarsID($this);
        }

        return $this;
    }

    public function removeOtherImage(Images $otherImage): self
    {
        if ($this->otherImages->removeElement($otherImage)) {
            // set the owning side to null (unless already changed)
            if ($otherImage->getStarsID() === $this) {
                $otherImage->setStarsID(null);
            }
        }

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->Author;
    }

    public function setAuthor(?User $Author): self
    {
        $this->Author = $Author;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setStarId($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getStarId() === $this) {
                $comment->setStarId(null);
            }
        }

        return $this;
    }
}
