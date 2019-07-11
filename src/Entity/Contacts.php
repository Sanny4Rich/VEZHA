<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactsRepository")
 */
class Contacts
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $companyName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $adress;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $isAddressShow;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $isPhoneShow;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $isEmailShow;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $language;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $workStart;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $workEnd;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(?string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getIsAddressShow(): ?bool
    {
        return $this->isAddressShow;
    }

    public function setIsAddressShow(bool $isAddressShow): self
    {
        $this->isAddressShow = $isAddressShow;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getIsPhoneShow(): ?bool
    {
        return $this->isPhoneShow;
    }

    public function setIsPhoneShow(bool $isPhoneShow): self
    {
        $this->isPhoneShow = $isPhoneShow;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getIsEmailShow(): ?bool
    {
        return $this->isEmailShow;
    }

    public function setIsEmailShow(bool $isEmailShow): self
    {
        $this->isEmailShow = $isEmailShow;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getWorkStart(): ?string
    {
        return $this->workStart;
    }

    public function setWorkStart(?string $workStart): self
    {
        $this->workStart = $workStart;

        return $this;
    }

    public function getWorkEnd(): ?string
    {
        return $this->workEnd;
    }

    public function setWorkEnd(?string $workEnd): self
    {
        $this->workEnd = $workEnd;

        return $this;
    }
}
