<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\UserRepository;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private string $email;

    #[ORM\Column(type: 'json')]
    private array $roles = ['ROLE_USER'];

    #[ORM\Column(type: "string")]
    private ?string $password = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $postal = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?\DateTimeInterface $dateEmbauche = null;

    #[ORM\Column(type: "string", nullable: true)]
    private ?string $oldId = null;


    /**
     * @var Collection<int, FicheFrais>
     */
    #[ORM\OneToMany(targetEntity: FicheFrais::class, mappedBy: 'visitor')]
    private Collection $fichesFrais;

    public function __construct()
    {
        $this->fichesFrais = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): static
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;
        return $this;
    }

    public function getPostal(): ?int
    {
        return $this->postal;
    }

    public function setPostal(?int $postal): static
    {
        $this->postal = $postal;
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): static
    {
        $this->city = $city;
        return $this;
    }

    public function getDateEmbauche(): ?\DateTimeInterface
    {
        return $this->dateEmbauche;
    }

    public function setDateEmbauche(?\DateTimeInterface $dateEmbauche): self
    {
        $this->dateEmbauche = $dateEmbauche;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;

        // ensures that a user always has at least one role for security
        if (empty($roles)) {
            $roles[] = 'ROLE_USER';
        }

        return array_unique($roles);
    }

    public function setRoles(array $roles = []): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getSalt(): ?string
    {
        return null;  // vous utilisez bcrypt ou argon donc vous n'avez pas besoin de sel
    }

    public function getOldId(): ?string
    {
        return $this->oldId;
    }

    public function setOldId(?string $oldId): void
    {
        $this->oldId = $oldId;
    }

    public function eraseCredentials(): void
    {
        // Supprimez toute donnée sensible
    }

    public function getUsername(): string
    {
        return (string) $this->email;  // Utilisez l'e-mail comme nom d'utilisateur
    }

    /**
     * @return Collection<int, FicheFrais>
     */
    public function getFichesFrais(): Collection
    {
        return $this->fichesFrais;
    }

    public function addFichesFrai(FicheFrais $fichesFrai): static
    {
        if (!$this->fichesFrais->contains($fichesFrai)) {
            $this->fichesFrais->add($fichesFrai);
            $fichesFrai->setVisitor($this);
        }

        return $this;
    }

    public function removeFichesFrai(FicheFrais $fichesFrai): static
    {
        if ($this->fichesFrais->removeElement($fichesFrai)) {
            // set the owning side to null (unless already changed)
            if ($fichesFrai->getVisitor() === $this) {
                $fichesFrai->setVisitor(null);
            }
        }

        return $this;
    }
}