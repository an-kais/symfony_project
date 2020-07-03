<?php

namespace App\Entity;

use App\Repository\SubjectsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubjectsRepository::class)
 */
class Subjects
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
    private $subj_name;

    /**
     * @ORM\Column(type="integer")
     */
    private $hour;

    /**
     * @ORM\Column(type="integer")
     */
    private $kurs;

    /**
     * @ORM\OneToMany(targetEntity=SubjLect::class, mappedBy="subj_id")
     */
    private $subjLects;

    /**
     * @ORM\OneToMany(targetEntity=Exams::class, mappedBy="subj_id")
     */
    private $exams;

    public function __construct()
    {
        $this->subjLects = new ArrayCollection();
        $this->exams = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubjName(): ?string
    {
        return $this->subj_name;
    }

    public function setSubjName(string $subj_name): self
    {
        $this->subj_name = $subj_name;

        return $this;
    }

    public function getHour(): ?int
    {
        return $this->hour;
    }

    public function setHour(int $hour): self
    {
        $this->hour = $hour;

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
            $subjLect->setSubjId($this);
        }

        return $this;
    }

    public function removeSubjLect(SubjLect $subjLect): self
    {
        if ($this->subjLects->contains($subjLect)) {
            $this->subjLects->removeElement($subjLect);
            // set the owning side to null (unless already changed)
            if ($subjLect->getSubjId() === $this) {
                $subjLect->setSubjId(null);
            }
        }

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
            $exam->setSubjId($this);
        }

        return $this;
    }

    public function removeExam(Exams $exam): self
    {
        if ($this->exams->contains($exam)) {
            $this->exams->removeElement($exam);
            // set the owning side to null (unless already changed)
            if ($exam->getSubjId() === $this) {
                $exam->setSubjId(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return strval($this->id);
    }

}
