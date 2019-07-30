<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ServicesRepository")
 * @Vich\Uploadable()
 */
class Services
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
     * @ORM\Column(type="boolean", options={"default" : true}, nullable=true))
     */
    private $isVisible;

    /**
     * @ORM\Column(type="boolean", options={"default" : true}, nullable=true))
     */
    private $isTop;

    /**
     * @ORM\Column(type="boolean", options={"default" : false}, nullable=true))
     */
    private $isOnHomePage;

    /**
     * @var ServiceImages[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\ServiceImages", mappedBy="service", cascade={"all"}, orphanRemoval=true)
     */
    private $images;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $url;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="integer", options={"default":0}, nullable=true)
     */
    private $onHomePagePosition;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ServiceTranslations", mappedBy="service")
     */
    private $serviceTranslations;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="service_logo_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    public function __toString()
    {
        return (string)$this->getName();
    }

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
        $this->serviceTranslations = new ArrayCollection();
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

    public function setShortDescription(string $shortDescription): self
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

    public function getIsTop(): ?bool
    {
        return $this->isTop;
    }

    public function setIsTop(bool $isTop): self
    {
        $this->isTop = $isTop;

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

    /**
     * @return ServiceImages[]|ArrayCollection
     */

    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add image
     *
     * @param ServiceImages $image
     *
     * @return Services
     */

    public function addImage(ServiceImages $image)
    {
        $image->setService($this);
        $this->images[] = $image;
        return $this;
    }

    public function removeImage(ServiceImages $images): self
    {
        if ($this->images->contains($images)) {
            $this->images->removeElement($images);
            // set the owning side to null (unless already changed)
            if ($images->getService() === $this) {
                $images->setService(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

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

    public function getUpdatedAt() :\DateTime
    {
        return $this->updatedAt;
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

    /**
     * @return Collection|ServiceTranslations[]
     */
    public function getServiceTranslations(): Collection
    {
        return $this->serviceTranslations;
    }

    public function addServiceTranslation(ServiceTranslations $serviceTranslation): self
    {
        if (!$this->serviceTranslations->contains($serviceTranslation)) {
            $this->serviceTranslations[] = $serviceTranslation;
            $serviceTranslation->setService($this);
        }

        return $this;
    }

    public function removeServiceTranslation(ServiceTranslations $serviceTranslation): self
    {
        if ($this->serviceTranslations->contains($serviceTranslation)) {
            $this->serviceTranslations->removeElement($serviceTranslation);
            // set the owning side to null (unless already changed)
            if ($serviceTranslation->getService() === $this) {
                $serviceTranslation->setService(null);
            }
        }

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
}
