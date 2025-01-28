<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250123145548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE personnel (id INT AUTO_INCREMENT NOT NULL, poste_id INT NOT NULL, service_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, datenaisse DATE NOT NULL, dateentre DATE NOT NULL, INDEX IDX_A6BCF3DEA0905086 (poste_id), INDEX IDX_A6BCF3DEED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poste (id INT AUTO_INCREMENT NOT NULL, salaire_id INT NOT NULL, poste VARCHAR(255) NOT NULL, INDEX IDX_7C890FAB2678C781 (salaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salaire (id INT AUTO_INCREMENT NOT NULL, salaire INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DEA0905086 FOREIGN KEY (poste_id) REFERENCES poste (id)');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DEED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE poste ADD CONSTRAINT FK_7C890FAB2678C781 FOREIGN KEY (salaire_id) REFERENCES salaire (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DEA0905086');
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DEED5CA9E6');
        $this->addSql('ALTER TABLE poste DROP FOREIGN KEY FK_7C890FAB2678C781');
        $this->addSql('DROP TABLE personnel');
        $this->addSql('DROP TABLE poste');
        $this->addSql('DROP TABLE salaire');
        $this->addSql('DROP TABLE service');
    }
}
