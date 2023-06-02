<?php

namespace App\Entity;

use App\Repository\ImagesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ImagesRepository::class)
 */
class Images
{
    /**
    * @ORM\Id
    * @ORM\GeneratedValue
    * @ORM\Column(type="integer")
    */
    private $id;

    /**
    * @ORM\Column(type="string", length=255)
    * @Assert\NotBlank()
    * @Assert\Length(
    *      min = 4,
    *      max = 255,
    *      minMessage = "Ce champ ne peut pas être inférieur à 5 caractères",
    *      maxMessage = "Ce champ ne peut pas excéder 255 caractères"
    * )
    */
    private $url;

    /**
    * @ORM\Column(type="string", length=255)
    * @Assert\NotBlank()
    * @Assert\Length(min=3,max=255,minMessage="Ce champs doit contenir au mois 4 caractères",maxMessage="Ce champ ne doit pas excéder 255 caractères")
    */
    private $caption;

    /**
    * @ORM\ManyToOne(targetEntity=Stars::class, inversedBy="otherImages")
    * @ORM\JoinColumn(nullable=false)
    */
    private $starsID;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }

    public function getStarsID(): ?Stars
    {
        return $this->starsID;
    }

    public function setStarsID(?Stars $starsID): self
    {
        $this->starsID = $starsID;

        return $this;
    }
}
