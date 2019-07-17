<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HomePageRepository")
 * @Vich\Uploadable()
 */
class HomePage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $imageFirstSection;

    /**
     * @Vich\UploadableField(mapping="home_page_images_1", fileNameProperty="imageFirstSection")
     * @var File
     */
    private $imageFileFirstSection;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $imageSecondSection;

    /**
     * @Vich\UploadableField(mapping="home_page_images_2", fileNameProperty="imageSecondSection")
     * @var File
     */
    private $imageFileSecondSection;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAtSecondSection;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $years;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $yearsDescript;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAtFirstSection;

    /**
     * @ORM\Column(type="string", length=2, unique=true)
     */
    private $language;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $imageCommentSection;

    /**
     * @Vich\UploadableField(mapping="home_page_images_2", fileNameProperty="imageCommentSection")
     * @var File
     */
    private $imageFileCommentSection;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAtCommentSection;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $greenTitle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $whiteTitle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    public function __toString()
    {
        return (string)$this->getLanguage();
    }

    public function __construct()
    {
        $this->updatedAtFirstSection = new \DateTime('now');
        $this->updatedAtSecondSection = new \DateTime('now');
        $this->updatedAtCommentSection = new \DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getYears(): ?string
    {
        return $this->years;
    }

    public function setYears(string $years): self
    {
        $this->years = $years;

        return $this;
    }

    public function getYearsDescript(): ?string
    {
        return $this->yearsDescript;
    }

    public function setYearsDescript(string $yearsDescript): self
    {
        $this->yearsDescript = $yearsDescript;

        return $this;
    }

    public function setImageFileFirstSection(File $image = null)
    {
        $this->imageFileFirstSection = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAtFirstSection = new \DateTime('now');
        }
    }

    public function getImageFileFirstSection()
    {
        return $this->imageFileFirstSection;
    }

    public function setImageFirstSection($image)
    {
        $this->imageFirstSection = $image;
    }

    public function getImageFirstSection()
    {
        return $this->imageFirstSection;
    }

    public function getUpdatedAtFirstSection() :\DateTime
    {
        return $this->updatedAtFirstSection;
    }


    public function setImageFileSecondSection(File $image = null)
    {
        $this->imageFileSecondSection = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAtSecondSection = new \DateTime('now');
        }
    }

    public function getImageFileSecondSection()
    {
        return $this->imageFileSecondSection;
    }

    public function setImageSecondSection($image)
    {
        $this->imageSecondSection = $image;
    }

    public function getImageSecondSection()
    {
        return $this->imageFirstSection;
    }

    public function getUpdatedAtSecondSection() :\DateTime
    {
        return $this->updatedAtSecondSection;
    }

    public function setImageFileCommentSection(File $image = null)
    {
        $this->imageFileCommentSection = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAtCommentSection = new \DateTime('now');
        }
    }

    public function getImageFileCommentSection()
    {
        return $this->imageFileCommentSection;
    }

    public function setImageCommentSection($image)
    {
        $this->imageCommentSection = $image;
    }

    public function getImageCommentSection()
    {
        return $this->imageCommentSection;
    }

    public function getUpdatedAtCommentSection() :\DateTime
    {
        return $this->updatedAtCommentSection;
    }

    public function getGreenTitle(): ?string
    {
        return $this->greenTitle;
    }

    public function setGreenTitle(?string $greenTitle): self
    {
        $this->greenTitle = $greenTitle;

        return $this;
    }

    public function getWhiteTitle(): ?string
    {
        return $this->whiteTitle;
    }

    public function setWhiteTitle(?string $whiteTitle): self
    {
        $this->whiteTitle = $whiteTitle;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

}
