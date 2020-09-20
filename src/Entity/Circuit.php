<?php

namespace App\Entity;

use App\Repository\CircuitRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CircuitRepository::class)
 */
class Circuit implements \JsonSerializable
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
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @ORM\Column(type="float")
     */
    private $fast_lap;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fast_lap_driver;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;

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

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getFastLap(): ?float
    {
        return $this->fast_lap;
    }

    public function setFastLap(float $fast_lap): self
    {
        $this->fast_lap = $fast_lap;

        return $this;
    }

    public function getFastLapDriver(): ?string
    {
        return $this->fast_lap_driver;
    }

    public function setFastLapDriver(string $fast_lap_driver): self
    {
        $this->fast_lap_driver = $fast_lap_driver;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'location' => $this->getLocation(),
            'fast_lap' => $this->getFastLap(),
            'fast_lap_driver' => $this->getFastLapDriver(),
            'photo' => $this->getPhoto(),
            '_links' => [
                [
                    'rel' => 'self',
                    'path' => '/circuit/' . $this->getId()
                ]
            ]

        ];
    }
}
