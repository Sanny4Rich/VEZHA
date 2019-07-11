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

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $viber;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $isViberShow;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telegram;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $isTelegrammShow;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $facebook;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $twitter;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $isFacebookShow;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $isTwitterShow;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $instagram;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $isInstagramShow;

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

    public function getViber(): ?string
    {
        return $this->viber;
    }

    public function setViber(?string $viber): self
    {
        $this->viber = $viber;

        return $this;
    }

    public function getIsViberShow(): ?bool
    {
        return $this->isViberShow;
    }

    public function setIsViberShow(bool $isViberShow): self
    {
        $this->isViberShow = $isViberShow;

        return $this;
    }

    public function getTelegram(): ?string
    {
        return $this->telegram;
    }

    public function setTelegram(?string $telegram): self
    {
        $this->telegram = $telegram;

        return $this;
    }

    public function getIsTelegrammShow(): ?bool
    {
        return $this->isTelegrammShow;
    }

    public function setIsTelegrammShow(bool $isTelegrammShow): self
    {
        $this->isTelegrammShow = $isTelegrammShow;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getIsFacebookShow(): ?bool
    {
        return $this->isFacebookShow;
    }

    public function setIsFacebookShow(bool $isFacebookShow): self
    {
        $this->isFacebookShow = $isFacebookShow;

        return $this;
    }

    public function getIsTwitterShow(): ?bool
    {
        return $this->isTwitterShow;
    }

    public function setIsTwitterShow(bool $isTwitterShow): self
    {
        $this->isTwitterShow = $isTwitterShow;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(?string $instagram): self
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getIsInstagramShow(): ?bool
    {
        return $this->isInstagramShow;
    }

    public function setIsInstagramShow(bool $isInstagramShow): self
    {
        $this->isInstagramShow = $isInstagramShow;

        return $this;
    }
}
