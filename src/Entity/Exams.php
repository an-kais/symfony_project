<?php

namespace App\Entity;

use App\Repository\ExamsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExamsRepository::class)
 */
class Exams
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Students::class, inversedBy="exams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $student_id;

    /**
     * @ORM\ManyToOne(targetEntity=Subjects::class, inversedBy="exams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subj_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mark;

    /**
     * @ORM\Column(type="date")
     */
    private $exam_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudentId(): ?Students
    {
        return $this->student_id;
    }

    public function setStudentId(?Students $student_id): self
    {
        $this->student_id = $student_id;

        return $this;
    }

    public function getSubjId(): ?Subjects
    {
        return $this->subj_id;
    }

    public function setSubjId(?Subjects $subj_id): self
    {
        $this->subj_id = $subj_id;

        return $this;
    }

    public function getMark(): ?int
    {
        return $this->mark;
    }

    public function setMark(?int $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getExamDate(): ?\DateTimeInterface
    {
        return $this->exam_date;
    }

    public function setExamDate(\DateTimeInterface $exam_date): self
    {
        $this->exam_date = $exam_date;

        return $this;
    }

    
}
