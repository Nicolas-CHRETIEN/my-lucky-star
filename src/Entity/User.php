<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="Un compte utilisant cet email a déjà été créé.")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
    * @Assert\NotBlank()
    * @Assert\Length(
    *      min = 2,
    *      max = 255,
    *      minMessage = "Ce champ ne peut pas être inférieur à 2 caractères",
    *      maxMessage = "Ce champ ne peut pas excéder 255 caractères",
    *      allowEmptyString = false
    * )
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
    * @Assert\NotBlank()
    * @Assert\Length(
    *      min = 2,
    *      max = 255,
    *      minMessage = "Ce champ ne peut pas être inférieur à 2 caractères",
    *      maxMessage = "Ce champ ne peut pas excéder 255 caractères",
    *      allowEmptyString = false
    * )
     */
    private $lastname;

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
    private $introduction;

    /**
     * @ORM\Column(type="text", nullable=true)
    * @Assert\NotBlank()
    * @Assert\Length(
    *      min = 20,
    *      max = 1000,
    *      minMessage = "Ce champ ne peut pas être inférieur à 20 caractères",
    *      maxMessage = "Ce champ ne peut pas excéder 1000 caractères",
    *      allowEmptyString = false
    * )
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
    * @Assert\NotBlank()
    * @Assert\Length(
    *      min = 3,
    *      max = 255,
    *      minMessage = "Ce champ ne peut pas être inférieur à 3 caractères",
    *      maxMessage = "Ce champ ne peut pas excéder 255 caractères",
    *      allowEmptyString = false
    * )
     */
    private $avatar;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity=Stars::class, mappedBy="Author", orphanRemoval=true)
     */
    private $stars;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="userId", orphanRemoval=true)
     */
    private $comments;

    public function __construct()
    {
        $this->stars = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    /**
     * Function to initialize the slug (before persist and update)
     * @ORM\PrePersist
     * @ORM\PreUpdate
     *
     * @return void
     */
    public function initializeSlug () {
        if (empty($this->slug)) {
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->firstname . ucfirst($this->lastname));
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getIntroduction(): ?string
    {
        return $this->introduction;
    }

    public function setIntroduction(string $introduction): self
    {
        $this->introduction = $introduction;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, Stars>
     */
    public function getStars(): Collection
    {
        return $this->stars;
    }

    public function addStar(Stars $star): self
    {
        if (!$this->stars->contains($star)) {
            $this->stars[] = $star;
            $star->setAuthor($this);
        }

        return $this;
    }

    public function removeStar(Stars $star): self
    {
        if ($this->stars->removeElement($star)) {
            // set the owning side to null (unless already changed)
            if ($star->getAuthor() === $this) {
                $star->setAuthor(null);
            }
        }
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
            $comment->setUserId($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUserId() === $this) {
                $comment->setUserId(null);
            }
        }

        return $this;
    }

}
