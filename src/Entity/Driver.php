<?php

namespace App\Entity;

use App\Repository\DriverRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DriverRepository::class)
 */
class Driver implements \JsonSerializable
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
     * @ORM\Column(type="string")
     */
    private $born;

    /**
     * @ORM\Column(type="integer")
     */
    private $race_wins;

    /**
     * @ORM\Column(type="integer")
     */
    private $championship_win;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $team;

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

    public function getBorn(): ?string
    {
        return $this->born;
    }

    public function setBorn(string $born): self
    {
        $this->born = $born;

        return $this;
    }

    public function getRaceWins(): ?int
    {
        return $this->race_wins;
    }

    public function setRaceWins(int $race_wins): self
    {
        $this->race_wins = $race_wins;

        return $this;
    }

    public function getChampionshipWin(): ?int
    {
        return $this->championship_win;
    }

    public function setChampionshipWin(int $championship_win): self
    {
        $this->championship_win = $championship_win;

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

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
    }

    public function jsonSerialize()
    {
        $team = $this->getTeam();
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'born' => $this->getBorn(),
            'location' => $this->getLocation(),
            'race_wins' => $this->getRaceWins(),
            'championship_wins' => $this->getChampionshipWin(),
            'photo' => $this->getPhoto(),
            'team' => $team->getName(),
            '_links' =>[
                [
                    'rel' => 'team',
                    'path' => 'team/' . $team->getId(),
                ],
                [
                    'rel' => 'self',
                    'path' => 'driver/' . $this->getId()
                ]
            ]
        ];
    }
}
