<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartnersRepository")
 * @Vich\Uploadable()
 */
class Partners
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
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $shortDescription;

    /**
     * @ORM\Column(type="boolean", options={"default" : false})
     */
    private $isVisible;

    /**
     * @ORM\Column(type="boolean", options={"default" : false}, nullable=true)
     */
    private $isOnHomePage;

    /**
     * @ORM\Column(type="integer", options={"default":0}, nullable=true)
     */
    private $onHomePagePosition;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="partners_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $imageLogo;

    /**
     * @Vich\UploadableField(mapping="partners_logo_images", fileNameProperty="imageLogo")
     * @var File
     */
    private $imageLogoFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;


    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAtLogo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PartnersTranslations", mappedBy="partner")
     */
    private $partnersTranslations;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\About", inversedBy="partners")
     */
    private $aboutPage;

    public function __toString()
    {
        return (string)$this->getName();
    }

    public function __construct()
    {
        $this->updatedAtLogo = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
        $this->partnersTranslations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getIsVisible(): ?bool
    {
        return $this->isVisible;
    }

    public function setIsVisible(bool $isVisible): self
    {
        $this->isVisible = $isVisible;

        return $this;
    }

    public function getIsOnHomePage(): ?bool
    {
        return $this->isOnHomePage;
    }

    public function setIsOnHomePage(bool $isOnHomePage): self
    {
        $this->isOnHomePage = $isOnHomePage;

        return $this;
    }

    public function getOnHomePagePosition(): ?int
    {
        return $this->onHomePagePosition;
    }

    public function setOnHomePagePosition(int $onHomePagePosition): self
    {
        $this->onHomePagePosition = $onHomePagePosition;

        return $this;
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

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getUpdatedAt() :\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @return Collection|PartnersTranslations[]
     */
    public function getPartnersTranslations(): Collection
    {
        return $this->partnersTranslations;
    }

    public function addCategoriesTranslation(PartnersTranslations $categoriesTranslation): self
    {
        if (!$this->partnersTranslations->contains($categoriesTranslation)) {
            $this->partnersTranslations[] = $categoriesTranslation;
            $categoriesTranslation->setPartner($this);
        }

        return $this;
    }

    public function removeCategoriesTranslation(PartnersTranslations $partnersTranslations): self
    {
        if ($this->partnersTranslations->contains($partnersTranslations)) {
            $this->partnersTranslations->removeElement($partnersTranslations);
            // set the owning side to null (unless already changed)
            if ($partnersTranslations->getPartner() === $this) {
                $partnersTranslations->setPartner(null);
            }
        }

        return $this;
    }


    public function setImageLogoFile(File $image = null)
    {
        $this->imageLogoFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAtLogo = new \DateTime('now');
        }
    }

    public function getImageLogoFile()
    {
        return $this->imageLogoFile;
    }

    public function setImageLogo($image)
    {
        $this->imageLogo = $image;
    }

    public function getImageLogo()
    {
        return $this->imageLogo;
    }

    public function getUpdatedAtLogo() :\DateTime
    {
        return $this->updatedAtLogo;
    }

    public function getAboutPage(): ?About
    {
        return $this->aboutPage;
    }

    public function setAboutPage(?About $aboutPage): self
    {
        $this->aboutPage = $aboutPage;

        return $this;
    }

}
