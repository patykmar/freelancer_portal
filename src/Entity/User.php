<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ApiResource
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = 0;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email(message="Provided email is not in valid format")
     */
    private string $email;

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private string $password;

    /**
     * @Assert\Length(min=8, max=4096)
     */
    private string $plainTextPassword;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min=2)
     */
    private string $first_name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min=2)
     */
    private string $last_name;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $last_login;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeInterface $password_changed = null;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private Company $employeeOf;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->first_name . " " . $this->last_name . ' (' . $this->getEmail() . ')';
    }
    /**
     * @link https://github.com/symfony/symfony/issues/35660#issuecomment-585787119
     * @note Symfony issue #35660
     * @return array
     */
    public function __serialize(): array
    {
        return [
            'id' => $this->getId(),
            'password' => $this->getPassword(),
            'email' => $this->getEmail(),
        ];
    }

    /**
     * @param array $data
     */
    public function __unserialize(array $data): void
    {
        $this->id = $data['id'];
        $this->password = $data['password'];
        $this->email = $data['email'];
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
    public function getUsername(): string
    {
        return $this->email;
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
     * @see UserInterface
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

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getLastLogin(): ?DateTimeInterface
    {
        return $this->last_login;
    }

    public function setLastLogin(DateTimeInterface $last_login): self
    {
        $this->last_login = $last_login;

        return $this;
    }

    public function getCreated(): ?DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getPasswordChanged(): ?DateTimeInterface
    {
        return $this->password_changed;
    }

    public function setPasswordChanged(?DateTimeInterface $password_changed): self
    {
        $this->password_changed = $password_changed;

        return $this;
    }

    /**
     * @return string
     */
    public function getPlainTextPassword(): string
    {
        return $this->plainTextPassword;
    }

    /**
     * @param string $plainTextPassword
     * @return User
     */
    public function setPlainTextPassword(string $plainTextPassword): self
    {
        $this->plainTextPassword = $plainTextPassword;
        return $this;
    }

    public function getEmployeeOf(): Company
    {
        return $this->employeeOf;
    }

    public function setEmployeeOf(Company $employeeOf): self
    {
        $this->employeeOf = $employeeOf;

        return $this;
    }

}
