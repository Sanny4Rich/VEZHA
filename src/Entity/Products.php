<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductsRepository")
 * @Vich\Uploadable()
 */
class Products
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
     * @var ProductImages[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\ProductImages", mappedBy="product", cascade={"all"}, orphanRemoval=true)
     */
    private $images;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Categories", inversedBy="products")
     */
    private $categories;

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
     * @ORM\OneToMany(targetEntity="App\Entity\ProductsTranslations", mappedBy="product", cascade={"all"}, orphanRemoval=true)
     */
    private $productsTranslations;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="image")
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
     * @var string
     */
    private $imageTop;

    /**
     * @Vich\UploadableField(mapping="product_images_top", fileNameProperty="imageTop")
     * @var File
     */
    private $imageFileTop;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAtTop;

    public function __toString()
    {
        return (string)$this->getName();
    }

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->createdAt = new \DateTime('now');
        $this->productsTranslations = new ArrayCollection();
        $this->updatedAt = new \DateTime('now');
        $this->updatedAtTop = new \DateTime('now');
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
     * @return ProductImages[]|ArrayCollection
     */

    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add image
     *
     * @param ProductImages $image
     *
     * @return Products
     */

    public function addImage(ProductImages $image)
    {
        $image->setProduct($this);
        $this->images[] = $image;

        dump($image);

        return $this;
    }

    public function removeImage(ProductImages $images): self
    {
        if ($this->images->contains($images)) {
            $this->images->removeElement($images);
            // set the owning side to null (unless already changed)
            if ($images->getProduct() === $this) {
                $images->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Categories[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categories $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Categories $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
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

    /**
     * @return Collection|ProductsTranslations[]
     */
    public function getProductsTranslations(): Collection
    {
        return $this->productsTranslations;
    }

    public function addProductsTranslation(ProductsTranslations $productsTranslation): self
    {
        if (!$this->productsTranslations->contains($productsTranslation)) {
            $this->productsTranslations[] = $productsTranslation;
            $productsTranslation->setProduct($this);
        }

        return $this;
    }

    public function removeProductsTranslation(ProductsTranslations $productsTranslation): self
    {
        if ($this->productsTranslations->contains($productsTranslation)) {
            $this->productsTranslations->removeElement($productsTranslation);
            // set the owning side to null (unless already changed)
            if ($productsTranslation->getProduct() === $this) {
                $productsTranslation->setProduct(null);
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

    public function getUpdatedAt() :\DateTime
    {
        return $this->updatedAt;
    }

    public function setImageFileTop(File $imageTop = null)
    {
        $this->imageFileTop = $imageTop;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($imageTop) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }
    public function getImageFileTop()
    {
        return $this->imageFileTop;
    }

    public function setImageTop($imageTop)
    {
        $this->imageTop = $imageTop;
    }

    public function getImageTop()
    {
        return $this->imageTop;
    }

    public function getUpdatedAtTop() :\DateTime
    {
        return $this->updatedAtTop;
    }
}
