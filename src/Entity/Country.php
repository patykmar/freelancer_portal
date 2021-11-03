<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CountryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CountryRepository::class)
 * @ApiResource
 */
class Country
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private ?int $id = 0;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private string $iso3166alpha3;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string name of country
     */
    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getIso3166alpha3(): string
    {
        return $this->iso3166alpha3;
    }

    /**
     * @param string $iso3166alpha3
     */
    public function setIso3166alpha3(string $iso3166alpha3): self
    {
        $this->iso3166alpha3 = $iso3166alpha3;
        return $this;
    }


}
