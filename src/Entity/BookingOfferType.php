<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingOfferTypeRepository")
 */
class BookingOfferType
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
    private $typeName;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\BookingOffer", mappedBy="offerType")
     */
    private $bookingOffers;

    public function __construct()
    {
        $this->bookingOffers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeName(): ?string
    {
        return $this->typeName;
    }

    public function setTypeName(string $typeName): self
    {
        $this->typeName = $typeName;

        return $this;
    }

    /**
     * @return Collection|BookingOffer[]
     */
    public function getBookingOffers(): Collection
    {
        return $this->bookingOffers;
    }

    public function addBookingOffer(BookingOffer $bookingOffer): self
    {
        if (!$this->bookingOffers->contains($bookingOffer)) {
            $this->bookingOffers[] = $bookingOffer;
            $bookingOffer->addOfferType($this);
        }

        return $this;
    }

    public function removeBookingOffer(BookingOffer $bookingOffer): self
    {
        if ($this->bookingOffers->contains($bookingOffer)) {
            $this->bookingOffers->removeElement($bookingOffer);
            $bookingOffer->removeOfferType($this);
        }

        return $this;
    }
}
