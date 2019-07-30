<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PicturesRepository")
 */
class Pictures
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
     * @var Images[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Images", mappedBy="picture", cascade={"all"}, orphanRemoval=true)
     */
    private $images;

    public function __toString()
    {
        return (string)$this->getName();
    }

    public function __construct()
    {
        $this->images = new ArrayCollection();
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

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Images[]|ArrayCollection
     */

    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add image
     *
     * @param Images $image
     *
     * @return Pictures
     */

    public function addImage(Images $image)
    {
        $image->setPicture($this);
        $this->images[] = $image;
        return $this;
    }

    public function removeImage(Images $images): self
    {
        if ($this->images->contains($images)) {
            $this->images->removeElement($images);
            // set the owning side to null (unless already changed)
            if ($images->getPicture() === $this) {
                $images->setPicture(null);
            }
        }

        return $this;
    }
}
