<?php

namespace App\Entity;

use App\Repository\LecturerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LecturerRepository::class)
 */
class Lecturer
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
    private $surname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Universities::class, inversedBy="lecturers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $univ_id;

    /**
     * @ORM\OneToMany(targetEntity=SubjLect::class, mappedBy="lecturer_id")
     */
    private $subjLects;

    public function __construct()
    {
        $this->subjLects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
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

    public function getUnivId(): ?Universities
    {
        return $this->univ_id;
    }

    public function setUnivId(?Universities $univ_id): self
    {
        $this->univ_id = $univ_id;

        return $this;
    }

    /**
     * @return Collection|SubjLect[]
     */
    public function getSubjLects(): Collection
    {
        return $this->subjLects;
    }

    public function addSubjLect(SubjLect $subjLect): self
    {
        if (!$this->subjLects->contains($subjLect)) {
            $this->subjLects[] = $subjLect;
            $subjLect->setLecturerId($this);
        }

        return $this;
    }

    public function removeSubjLect(SubjLect $subjLect): self
    {
        if ($this->subjLects->contains($subjLect)) {
            $this->subjLects->removeElement($subjLect);
            // set the owning side to null (unless already changed)
            if ($subjLect->getLecturerId() === $this) {
                $subjLect->setLecturerId(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return strval($this->id);
    }

}
