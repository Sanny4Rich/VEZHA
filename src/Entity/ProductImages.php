<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductImagesRepository")
 * @Vich\Uploadable()
 */
class ProductImages
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Products", inversedBy="images")
     */
    private $product;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var File
     *
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="image")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    public function __toString()
    {
        return (string)$this->getImage();
    }

    public function __construct()
    {
        $this->updatedAt = new \DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Products
     */

    public function getProduct(): ?Products
    {
        return $this->product;
    }

    /**
     * Set Product
     *
     * @param Products $products
     *
     * @return ProductImages
     */

    public function setProduct(?Products $products): self
    {
        $this->product = $products;

        return $this;
    }

    /**
     * @param File|null $image
     * @return ProductImages
     * @throws \Exception
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $image
     * @return ProductImages
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

}
