<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DestinationRepository")
 */
class Destination
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
    private $destinationName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BookingOffer", mappedBy="destination")
     */
    private $bookingOffers;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\File(mimeTypes={ "image/jpeg", "image/jpg", "image/png"},
     *              maxSize = "1024k")
     */
    private $image;

    public function __construct()
    {
        $this->bookingOffers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDestinationName(): ?string
    {
        return $this->destinationName;
    }

    public function setDestinationName(string $destinationName): self
    {
        $this->destinationName = $destinationName;

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
            $bookingOffer->setDestination($this);
        }

        return $this;
    }

    public function removeBookingOffer(BookingOffer $bookingOffer): self
    {
        if ($this->bookingOffers->contains($bookingOffer)) {
            $this->bookingOffers->removeElement($bookingOffer);
            // set the owning side to null (unless already changed)
            if ($bookingOffer->getDestination() === $this) {
                $bookingOffer->setDestination(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
