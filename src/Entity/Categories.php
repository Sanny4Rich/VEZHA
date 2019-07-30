<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @Gedmo\Tree(type="nested")
 * @ORM\Entity(repositoryClass="App\Repository\CategoriesRepository")
 * @Vich\Uploadable()
 */
class Categories
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Products", mappedBy="categories")
     */
    private $products;

    /**
     * @ORM\Column(type="boolean", options={"default" : false})
     */
    private $isVisible;

    /**
     * @ORM\Column(type="boolean", options={"default" : false}, nullable=true)
     */
    private $isOnHomePage;

    /**
     * @ORM\Column(type="integer", options={"default" : 0}, nullable=true)
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
     * @Vich\UploadableField(mapping="category_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CategoriesTranslations", mappedBy="category", cascade={"persist"}, orphanRemoval=true)
     */
    private $categoriesTranslations;


    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer")
     */
    private $left;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     */
    private $level;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     */
    private $right;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="App\Entity\Categories", inversedBy="children")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Categories", mappedBy="parent", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"left" = "ASC"})
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Products", inversedBy="primaryCategory")
     */
    private $prodInPrimCat;

    public function __toString()
    {
        return (string)$this->getName();
    }

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->updatedAt = new \DateTime('now');
        $this->categoriesTranslations = new ArrayCollection();
        $this->children = new ArrayCollection();
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

    /**
     * @return Collection|Products[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Products $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->addCategory($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            $product->removeCategory($this);
        }

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
     * @return Collection|CategoriesTranslations[]
     */
    public function getCategoriesTranslations(): Collection
    {
        return $this->categoriesTranslations;
    }

    public function addCategoriesTranslation(CategoriesTranslations $categoriesTranslation): self
    {
        if (!$this->categoriesTranslations->contains($categoriesTranslation)) {
            $this->categoriesTranslations[] = $categoriesTranslation;
            $categoriesTranslation->setCategory($this);
        }

        return $this;
    }

    public function removeCategoriesTranslation(CategoriesTranslations $categoriesTranslation): self
    {
        if ($this->categoriesTranslations->contains($categoriesTranslation)) {
            $this->categoriesTranslations->removeElement($categoriesTranslation);
            // set the owning side to null (unless already changed)
            if ($categoriesTranslation->getCategory() === $this) {
                $categoriesTranslation->setCategory(null);
            }
        }

        return $this;
    }

    public function getLeft(): ?int
    {
        return $this->left;
    }

    public function setLeft(int $left): self
    {
        $this->left = $left;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getRight(): ?int
    {
        return $this->right;
    }

    public function setRight(int $right): self
    {
        $this->right = $right;

        return $this;
    }


    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChild(self $child): self
    {
        if (!$this->children->contains($child)) {
            $this->children[] = $child;
            $child->setParent($this);
        }

        return $this;
    }

    public function removeChild(self $child): self
    {
        if ($this->children->contains($child)) {
            $this->children->removeElement($child);
            // set the owning side to null (unless already changed)
            if ($child->getParent() === $this) {
                $child->setParent(null);
            }
        }

        return $this;
    }

    public function getProdInPrimCat(): ?Products
    {
        return $this->prodInPrimCat;
    }

    public function setProdInPrimCat(?Products $prodInPrimCat): self
    {
        $this->prodInPrimCat = $prodInPrimCat;

        return $this;
    }

}
