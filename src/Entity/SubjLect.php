<?php

namespace App\Entity;

use App\Repository\SubjLectRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubjLectRepository::class)
 */
class SubjLect
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Lecturer::class, inversedBy="subjLects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lecturer_id;

    /**
     * @ORM\ManyToOne(targetEntity=Subjects::class, inversedBy="subjLects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subj_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLecturerId(): ?Lecturer
    {
        return $this->lecturer_id;
    }

    public function setLecturerId(?Lecturer $lecturer_id): self
    {
        $this->lecturer_id = $lecturer_id;

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

}
