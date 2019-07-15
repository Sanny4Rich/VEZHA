<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AboutRepository")
 * @Vich\Uploadable()
 */
class About
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $aboutTitle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $aboutDescription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $imageTop;

    /**
     * @Vich\UploadableField(mapping="about_images", fileNameProperty="imageTop")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstOurDirectionTitle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $secondOurDirectionTitle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thirdOurDirectionTitle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $firstOurDirectionDescription;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $secondOurDirectionDescription;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $thirdOurDirectionDescription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, unique=true)
     */
    private $language;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Partners", mappedBy="aboutPage")
     */
    private $partners;

    public function __toString()
    {
        return (string)$this->getAboutTitle();
    }

    public function __construct()
    {
        $this->updatedAt = new \DateTime('now');
        $this->partners = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAboutTitle(): ?string
    {
        return $this->aboutTitle;
    }

    public function setAboutTitle(?string $aboutTitle): self
    {
        $this->aboutTitle = $aboutTitle;

        return $this;
    }

    public function getAboutDescription(): ?string
    {
        return $this->aboutDescription;
    }

    public function setAboutDescription(?string $aboutDescription): self
    {
        $this->aboutDescription = $aboutDescription;

        return $this;
    }

    public function setImageTop($imageTop)
    {
        $this->imageTop = $imageTop;
    }

    public function getImageTop()
    {
        return $this->imageTop;
    }

    public function setImageFile(File $imageTop = null)
    {
        $this->imageFile = $imageTop;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($imageTop) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }
    public function getImageFile()
    {
        return $this->imageFile;
    }


    public function getFirstOurDirectionTitle(): ?string
    {
        return $this->firstOurDirectionTitle;
    }

    public function setFirstOurDirectionTitle(?string $firstOurDirectionTitle): self
    {
        $this->firstOurDirectionTitle = $firstOurDirectionTitle;

        return $this;
    }

    public function getSecondOurDirectionTitle(): ?string
    {
        return $this->secondOurDirectionTitle;
    }

    public function setSecondOurDirectionTitle(?string $secondOurDirectionTitle): self
    {
        $this->secondOurDirectionTitle = $secondOurDirectionTitle;

        return $this;
    }

    public function getThirdOurDirectionTitle(): ?string
    {
        return $this->thirdOurDirectionTitle;
    }

    public function setThirdOurDirectionTitle(?string $thirdOurDirectionTitle): self
    {
        $this->thirdOurDirectionTitle = $thirdOurDirectionTitle;

        return $this;
    }

    public function getFirstOurDirectionDescription(): ?string
    {
        return $this->firstOurDirectionDescription;
    }

    public function setFirstOurDirectionDescription(?string $firstOurDirectionDescription): self
    {
        $this->firstOurDirectionDescription = $firstOurDirectionDescription;

        return $this;
    }

    public function getSecondOurDirectionDescription(): ?string
    {
        return $this->secondOurDirectionDescription;
    }

    public function setSecondOurDirectionDescription(?string $secondOurDirectionDescription): self
    {
        $this->secondOurDirectionDescription = $secondOurDirectionDescription;

        return $this;
    }

    public function getThirdOurDirectionDescription(): ?string
    {
        return $this->thirdOurDirectionDescription;
    }

    public function setThirdOurDirectionDescription(?string $thirdOurDirectionDescription): self
    {
        $this->thirdOurDirectionDescription = $thirdOurDirectionDescription;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return Collection|Partners[]
     */
    public function getPartners(): Collection
    {
        return $this->partners;
    }

    public function addPartner(Partners $partner): self
    {
        if (!$this->partners->contains($partner)) {
            $this->partners[] = $partner;
            $partner->setAboutPage($this);
        }

        return $this;
    }

    public function removePartner(Partners $partner): self
    {
        if ($this->partners->contains($partner)) {
            $this->partners->removeElement($partner);
            // set the owning side to null (unless already changed)
            if ($partner->getAboutPage() === $this) {
                $partner->setAboutPage(null);
            }
        }

        return $this;
    }

}
