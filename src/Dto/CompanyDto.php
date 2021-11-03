<?php

namespace App\Dto;

use DateTimeInterface;

class CompanyDto
{
    private int $id;
    private string $name;
    private string $description;
    private ?string $company_id;
    private ?string $vat_number;
    private DateTimeInterface $created;
    private ?DateTimeInterface $modify;
    private ?string $street;
    private ?string $city;
    private ?string $zip_code;
    private int $country;
    private ?string $account_number;
    private ?string $iban;
    private ?bool $isSupplier;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return CompanyDto
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CompanyDto
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return CompanyDto
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getCompanyId(): ?string
    {
        return $this->company_id;
    }

    /**
     * @param null|string $company_id
     * @return CompanyDto
     */
    public function setCompanyId(?string $company_id): self
    {
        $this->company_id = $company_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getVatNumber(): ?string
    {
        return $this->vat_number;
    }

    /**
     * @param string|null $vat_number
     * @return CompanyDto
     */
    public function setVatNumber(?string $vat_number): self
    {
        $this->vat_number = $vat_number;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreated(): DateTimeInterface
    {
        return $this->created;
    }

    /**
     * @param DateTimeInterface $created
     * @return CompanyDto
     */
    public function setCreated(DateTimeInterface $created): self
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getModify(): ?DateTimeInterface
    {
        return $this->modify;
    }

    /**
     * @param DateTimeInterface|null $modify
     * @return CompanyDto
     */
    public function setModify(?DateTimeInterface $modify): self
    {
        $this->modify = $modify;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string|null $street
     * @return CompanyDto
     */
    public function setStreet(?string $street): self
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     * @return CompanyDto
     */
    public function setCity(?string $city): self
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getZipCode(): ?string
    {
        return $this->zip_code;
    }

    /**
     * @param string|null $zip_code
     * @return CompanyDto
     */
    public function setZipCode(?string $zip_code): self
    {
        $this->zip_code = $zip_code;
        return $this;
    }

    /**
     * @return int
     */
    public function getCountry(): int
    {
        return $this->country;
    }

    /**
     * @param int $country
     * @return CompanyDto
     */
    public function setCountry(int $country): self
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccountNumber(): ?string
    {
        return $this->account_number;
    }

    /**
     * @param string|null $account_number
     * @return CompanyDto
     */
    public function setAccountNumber(?string $account_number): self
    {
        $this->account_number = $account_number;
        return $this;
    }

    /**
     * @return string
     */
    public function getIban(): ?string
    {
        return $this->iban;
    }

    /**
     * @param string|null $iban
     * @return CompanyDto
     */
    public function setIban(?string $iban): self
    {
        $this->iban = $iban;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSupplier(): ?bool
    {
        return $this->isSupplier;
    }

    /**
     * @param bool $isSupplier
     * @return CompanyDto
     */
    public function setIsSupplier(?bool $isSupplier): self
    {
        $this->isSupplier = $isSupplier;
        return $this;
    }
}