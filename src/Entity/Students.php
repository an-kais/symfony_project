<?php

namespace App\Entity;

use App\Repository\StudentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentsRepository::class)
 */
class Students
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
     * @ORM\Column(type="integer")
     */
    private $kurs;

    /**
     * @ORM\ManyToOne(targetEntity=Universities::class, inversedBy="students")
     * @ORM\JoinColumn(nullable=false)
     */
    private $univ_id;

    /**
     * @ORM\OneToMany(targetEntity=Exams::class, mappedBy="student_id")
     */
    private $exams;

    public function __construct()
    {
        $this->exams = new ArrayCollection();
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

    public function getKurs(): ?int
    {
        return $this->kurs;
    }

    public function setKurs(int $kurs): self
    {
        $this->kurs = $kurs;

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
     * @return Collection|Exams[]
     */
    public function getExams(): Collection
    {
        return $this->exams;
    }

    public function addExam(Exams $exam): self
    {
        if (!$this->exams->contains($exam)) {
            $this->exams[] = $exam;
            $exam->setStudentId($this);
        }

        return $this;
    }

    public function removeExam(Exams $exam): self
    {
        if ($this->exams->contains($exam)) {
            $this->exams->removeElement($exam);
            // set the owning side to null (unless already changed)
            if ($exam->getStudentId() === $this) {
                $exam->setStudentId(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return strval($this->id);
    }

}
