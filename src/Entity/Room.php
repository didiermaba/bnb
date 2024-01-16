<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column(length: 100)]
    private ?string $description = null;

    #[ORM\Column(length: 50)]
    private ?string $city = null;

    #[ORM\ManyToOne(inversedBy: 'rooms')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $host = null;

    #[ORM\OneToMany(mappedBy: 'rooms', targetEntity: Review::class)]
    private Collection $create_at;

    #[ORM\OneToMany(mappedBy: 'room', targetEntity: Booking::class)]
    private Collection $booking;

    #[ORM\ManyToMany(targetEntity: Equipment::class, mappedBy: 'rooms')]
    private Collection $equipment;

    public function __construct()
    {
        $this->create_at = new ArrayCollection();
        $this->booking = new ArrayCollection();
        $this->equipment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getHost(): ?User
    {
        return $this->host;
    }

    public function setHost(?User $host): static
    {
        $this->host = $host;

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getCreateAt(): Collection
    {
        return $this->create_at;
    }

    public function addCreateAt(Review $createAt): static
    {
        if (!$this->create_at->contains($createAt)) {
            $this->create_at->add($createAt);
            $createAt->setRooms($this);
        }

        return $this;
    }

    public function removeCreateAt(Review $createAt): static
    {
        if ($this->create_at->removeElement($createAt)) {
            // set the owning side to null (unless already changed)
            if ($createAt->getRooms() === $this) {
                $createAt->setRooms(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Booking>
     */
    public function getBooking(): Collection
    {
        return $this->booking;
    }

    public function addBooking(Booking $booking): static
    {
        if (!$this->booking->contains($booking)) {
            $this->booking->add($booking);
            $booking->setRoom($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): static
    {
        if ($this->booking->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getRoom() === $this) {
                $booking->setRoom(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Equipment>
     */
    public function getEquipment(): Collection
    {
        return $this->equipment;
    }

    public function addEquipment(Equipment $equipment): static
    {
        if (!$this->equipment->contains($equipment)) {
            $this->equipment->add($equipment);
            $equipment->addRoom($this);
        }

        return $this;
    }

    public function removeEquipment(Equipment $equipment): static
    {
        if ($this->equipment->removeElement($equipment)) {
            $equipment->removeRoom($this);
        }

        return $this;
    }
}
