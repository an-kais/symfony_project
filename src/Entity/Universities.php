<?php

namespace App\Entity;

use App\Repository\UniversitiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UniversitiesRepository::class)
 */
class Universities
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
    private $univ_name;

    /**
     * @ORM\Column(type="integer")
     */
    private $rating;

    /**
     * @ORM\OneToMany(targetEntity=Students::class, mappedBy="univ_id")
     */
    private $students;

    /**
     * @ORM\OneToMany(targetEntity=Lecturer::class, mappedBy="univ_id")
     */
    private $lecturers;

    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->lecturers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUnivName(): ?string
    {
        return $this->univ_name;
    }

    public function setUnivName(string $univ_name): self
    {
        $this->univ_name = $univ_name;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * @return Collection|Students[]
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Students $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students[] = $student;
            $student->setUnivId($this);
        }

        return $this;
    }

    public function removeStudent(Students $student): self
    {
        if ($this->students->contains($student)) {
            $this->students->removeElement($student);
            // set the owning side to null (unless already changed)
            if ($student->getUnivId() === $this) {
                $student->setUnivId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Lecturer[]
     */
    public function getLecturers(): Collection
    {
        return $this->lecturers;
    }

    public function addLecturer(Lecturer $lecturer): self
    {
        if (!$this->lecturers->contains($lecturer)) {
            $this->lecturers[] = $lecturer;
            $lecturer->setUnivId($this);
        }

        return $this;
    }

    public function removeLecturer(Lecturer $lecturer): self
    {
        if ($this->lecturers->contains($lecturer)) {
            $this->lecturers->removeElement($lecturer);
            // set the owning side to null (unless already changed)
            if ($lecturer->getUnivId() === $this) {
                $lecturer->setUnivId(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return strval($this->id);
    }
}
