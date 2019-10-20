<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingOfferRepository")
 */
class BookingOffer
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
    private $offerName;

    /**
     * @ORM\Column(type="integer")
     */
    private $offerPrice;

    /**
     * @ORM\Column(type="float")
     */
    private $rating;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\BookingOfferType", inversedBy="bookingOffers")
     */
    private $offerType;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Destination", inversedBy="bookingOffers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $destination;

    public function __construct()
    {
        $this->offerType = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOfferName(): ?string
    {
        return $this->offerName;
    }

    public function setOfferName(string $offerName): self
    {
        $this->offerName = $offerName;

        return $this;
    }

    public function getOfferPrice(): ?int
    {
        return $this->offerPrice;
    }

    public function setOfferPrice(int $offerPrice): self
    {
        $this->offerPrice = $offerPrice;

        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(float $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * @return Collection|BookingOfferType[]
     */
    public function getOfferType(): Collection
    {
        return $this->offerType;
    }

    public function addOfferType(BookingOfferType $offerType): self
    {
        if (!$this->offerType->contains($offerType)) {
            $this->offerType[] = $offerType;
        }

        return $this;
    }

    public function removeOfferType(BookingOfferType $offerType): self
    {
        if ($this->offerType->contains($offerType)) {
            $this->offerType->removeElement($offerType);
        }

        return $this;
    }

    public function getDestination(): ?Destination
    {
        return $this->destination;
    }

    public function setDestination(?Destination $destination): self
    {
        $this->destination = $destination;

        return $this;
    }
}
