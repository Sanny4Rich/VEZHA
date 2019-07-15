<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\DependencyInjection\Tests\Fixtures\Prototype\OtherDir\Component2\Dir1\Service4;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Gedmo\Mapping\Annotation as Gedmo;
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
     * @ORM\Column(type="boolean", options={"default" : false})
     */
    private $isVisible;

    /**
     * @ORM\Column(type="boolean", options={"default" : false})
     */
    private $isOnHomePage;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="integer", nullable=true)
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
     * @var ServicesImages[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\ServicesImages", mappedBy="service", cascade={"all"}, orphanRemoval=true)
     */
    private $images;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return (string)$this->getName();

    }

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->updatedAt = new \DateTime('now');
    }

    public function getUpdatedAt() :\DateTime
    {
        return $this->updatedAt;
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

    /**
     * @return ProductImages[]|ArrayCollection
     */

    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add image
     *
     * @param ServicesImages $image
     *
     * @return Services
     */

    public function addImage(ServicesImages $image)
    {
        $image->setService($this);
        $this->images[] = $image;

        dump($image);

        return $this;
    }

    public function removeImage(ServicesImages $images): self
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

    public function getOnHomePagePosition(): ?int
    {
        return $this->onHomePagePosition;
    }

    public function setOnHomePagePosition(?int $onHomePagePosition): self
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


}
