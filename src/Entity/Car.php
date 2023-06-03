<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[UniqueEntity(fields: ['title', 'kilometer'], message: 'Ce véhicule existe déjà')]
#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message:'Veulliez renseigner un titre')]
    #[Assert\Length(min: 2, minMessage:"Le titre doit faire au moins 2 caractères.")]
    private ?string $title = null;

    #[ORM\Column(type: 'float')]
    #[Assert\NotNull(message:'Veulliez renseigner un prix')]
    #[Assert\Positive(message:'Veulliez renseigner un prix positive')]
    private ?float $price = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotNull(message:'Veulliez renseigner une date de mise en circulation')]
    private ?\DateTimeInterface $year = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotNull(message:'Veulliez renseigner un kilomètrage')]
    #[Assert\Positive(message:'Veulliez renseigner un kilomètrage positive')]
    private ?int $kilometer = null;

    #[ORM\OneToMany(mappedBy: 'car', targetEntity: Images::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $Images;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToMany(targetEntity: Equipment::class, inversedBy: 'cars')]
    private Collection $equipment;

    #[ORM\Column(type: 'string',length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(type: 'string',length: 255, nullable: true)]
    private ?string $fuel = null;

    #[ORM\Column(type: 'string',length: 255, nullable: true)]
    private ?string $color = null;

    #[ORM\Column(type: 'string',length: 255, nullable: true)]
    private ?string $gearbox = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Assert\Positive()]
    #[Assert\LessThan(200)]
    private ?int $fiscalPower = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Assert\Positive()]
    #[Assert\LessThan(500)]
    private ?int $realPower = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Assert\Positive()]
    #[Assert\LessThan(10)]
    private ?int $numberOfDoor = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Assert\Positive()]
    #[Assert\LessThan(20)]
    private ?int $numberOfPlace = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $emission = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable;
        $this->updatedAt = new \DateTimeImmutable();
        $this->Images = new ArrayCollection();
        $this->equipment = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function gettitle(): ?string
    {
        return $this->title;
    }

    public function settitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getYear(): ?\DateTimeInterface
    {
        return $this->year;
    }

    public function setYear(\DateTimeInterface $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getKilometer(): ?int
    {
        return $this->kilometer;
    }

    public function setKilometer(int $kilometer): self
    {
        $this->kilometer = $kilometer;

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->Images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->Images->contains($image)) {
            $this->Images->add($image);
            $image->setCar($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->Images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getCar() === $this) {
                $image->setCar(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

   //public function __toString()
   //{
   //    return $this->additionalOption;
   //}

   /**
    * @return Collection<int, Equipment>
    */
   public function getEquipment(): Collection
   {
       return $this->equipment;
   }

   public function addEquipment(Equipment $equipment): self
   {
       if (!$this->equipment->contains($equipment)) {
           $this->equipment->add($equipment);
       }

       return $this;
   }

   public function removeEquipment(Equipment $equipment): self
   {
       $this->equipment->removeElement($equipment);

       return $this;
   }

   public function getType(): ?string
   {
       return $this->type;
   }

   public function setType(?string $type): self
   {
       $this->type = $type;

       return $this;
   }

   public function getFuel(): ?string
   {
       return $this->fuel;
   }

   public function setFuel(?string $fuel): self
   {
       $this->fuel = $fuel;

       return $this;
   }

   public function getColor(): ?string
   {
       return $this->color;
   }

   public function setColor(?string $color): self
   {
       $this->color = $color;

       return $this;
   }

   public function getGearbox(): ?string
   {
       return $this->gearbox;
   }

   public function setGearbox(?string $gearbox): self
   {
       $this->gearbox = $gearbox;

       return $this;
   }

   public function getFiscalPower(): ?int
   {
       return $this->fiscalPower;
   }

   public function setFiscalPower(?int $fiscalPower): self
   {
       $this->fiscalPower = $fiscalPower;

       return $this;
   }

   public function getRealPower(): ?int
   {
       return $this->realPower;
   }

   public function setRealPower(?int $realPower): self
   {
       $this->realPower = $realPower;

       return $this;
   }

   public function getNumberOfDoor(): ?int
   {
       return $this->numberOfDoor;
   }

   public function setNumberOfDoor(?int $numberOfDoor): self
   {
       $this->numberOfDoor = $numberOfDoor;

       return $this;
   }

   public function getNumberOfPlace(): ?int
   {
       return $this->numberOfPlace;
   }

   public function setNumberOfPlace(?int $numberOfPlace): self
   {
       $this->numberOfPlace = $numberOfPlace;

       return $this;
   }

   public function getEmission(): ?string
   {
       return $this->emission;
   }

   public function setEmission(?string $emission): self
   {
       $this->emission = $emission;

       return $this;
   }

  

}
