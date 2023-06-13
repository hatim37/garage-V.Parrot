<?php

namespace App\Entity;

use App\Repository\HourlyRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[UniqueEntity(fields: ['day'], message: 'Ce jour existe déjà')]
#[ORM\Entity(repositoryClass: HourlyRepository::class)]
class Hourly
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message:'Veulliez renseigner un jour')]
    #[Assert\Length(min: 2, minMessage:"Le nom doit faire au moins 2 caractères.")]
    private ?string $day = null;

    #[ORM\Column(type: 'string',length: 255, nullable: true)]
    private ?string $timeStartMorning = null;

    #[ORM\Column(type: 'string',length: 255, nullable: true)]
    private ?string $timeEndMorning = null;

    #[ORM\Column]
    private ?bool $closeMorning = false;

    #[ORM\Column(type: 'string',length: 255, nullable: true)]
    private ?string $timeStartAfternoon = null;

    #[ORM\Column(type: 'string',length: 255, nullable: true)]
    private ?string $timeEndAfternoon = null;

    #[ORM\Column]
    private ?bool $closeAfternoon = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getTimeStartMorning(): ?string
    {
        return $this->timeStartMorning;
    }

    public function setTimeStartMorning(?string $timeStartMorning): self
    {
        $this->timeStartMorning = $timeStartMorning;

        return $this;
    }

    public function getTimeEndMorning(): ?string
    {
        return $this->timeEndMorning;
    }

    public function setTimeEndMorning(?string $timeEndMorning): self
    {
        $this->timeEndMorning = $timeEndMorning;

        return $this;
    }

    public function isCloseMorning(): ?bool
    {
        return $this->closeMorning;
    }

    public function setCloseMorning(bool $closeMorning): self
    {
        $this->closeMorning = $closeMorning;

        return $this;
    }

    public function getTimeStartAfternoon(): ?string
    {
        return $this->timeStartAfternoon;
    }

    public function setTimeStartAfternoon(?string $timeStartAfternoon): self
    {
        $this->timeStartAfternoon = $timeStartAfternoon;

        return $this;
    }

    public function getTimeEndAfternoon(): ?string
    {
        return $this->timeEndAfternoon;
    }

    public function setTimeEndAfternoon(?string $timeEndAfternoon): self
    {
        $this->timeEndAfternoon = $timeEndAfternoon;

        return $this;
    }

    

    public function isCloseAfternoon(): ?bool
    {
        return $this->closeAfternoon;
    }

    public function setCloseAfternoon(bool $closeAfternoon): self
    {
        $this->closeAfternoon = $closeAfternoon;

        return $this;
    }
}
