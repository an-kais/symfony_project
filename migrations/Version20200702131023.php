<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200702131023 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_880E0D76E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exams (id INT AUTO_INCREMENT NOT NULL, student_id_id INT NOT NULL, subj_id_id INT NOT NULL, mark INT DEFAULT NULL, exam_date DATE NOT NULL, INDEX IDX_69311328F773E7CA (student_id_id), INDEX IDX_69311328BD76B772 (subj_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lecturer (id INT AUTO_INCREMENT NOT NULL, univ_id_id INT NOT NULL, surname VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_14CF514663E9F175 (univ_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE students (id INT AUTO_INCREMENT NOT NULL, univ_id_id INT NOT NULL, surname VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, kurs INT NOT NULL, INDEX IDX_A4698DB263E9F175 (univ_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subj_lect (id INT AUTO_INCREMENT NOT NULL, lecturer_id_id INT NOT NULL, subj_id_id INT NOT NULL, INDEX IDX_E2C691911C0F883D (lecturer_id_id), INDEX IDX_E2C69191BD76B772 (subj_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subjects (id INT AUTO_INCREMENT NOT NULL, subj_name VARCHAR(255) NOT NULL, hour INT NOT NULL, kurs INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE universities (id INT AUTO_INCREMENT NOT NULL, univ_name VARCHAR(255) NOT NULL, rating INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exams ADD CONSTRAINT FK_69311328F773E7CA FOREIGN KEY (student_id_id) REFERENCES students (id)');
        $this->addSql('ALTER TABLE exams ADD CONSTRAINT FK_69311328BD76B772 FOREIGN KEY (subj_id_id) REFERENCES subjects (id)');
        $this->addSql('ALTER TABLE lecturer ADD CONSTRAINT FK_14CF514663E9F175 FOREIGN KEY (univ_id_id) REFERENCES universities (id)');
        $this->addSql('ALTER TABLE students ADD CONSTRAINT FK_A4698DB263E9F175 FOREIGN KEY (univ_id_id) REFERENCES universities (id)');
        $this->addSql('ALTER TABLE subj_lect ADD CONSTRAINT FK_E2C691911C0F883D FOREIGN KEY (lecturer_id_id) REFERENCES lecturer (id)');
        $this->addSql('ALTER TABLE subj_lect ADD CONSTRAINT FK_E2C69191BD76B772 FOREIGN KEY (subj_id_id) REFERENCES subjects (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subj_lect DROP FOREIGN KEY FK_E2C691911C0F883D');
        $this->addSql('ALTER TABLE exams DROP FOREIGN KEY FK_69311328F773E7CA');
        $this->addSql('ALTER TABLE exams DROP FOREIGN KEY FK_69311328BD76B772');
        $this->addSql('ALTER TABLE subj_lect DROP FOREIGN KEY FK_E2C69191BD76B772');
        $this->addSql('ALTER TABLE lecturer DROP FOREIGN KEY FK_14CF514663E9F175');
        $this->addSql('ALTER TABLE students DROP FOREIGN KEY FK_A4698DB263E9F175');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE exams');
        $this->addSql('DROP TABLE lecturer');
        $this->addSql('DROP TABLE students');
        $this->addSql('DROP TABLE subj_lect');
        $this->addSql('DROP TABLE subjects');
        $this->addSql('DROP TABLE universities');
    }
}
