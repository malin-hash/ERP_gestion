<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250127211154 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE materiel (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, datebuy DATE NOT NULL, prix INT NOT NULL, quantite INT NOT NULL, rame INT NOT NULL, disque INT NOT NULL, core VARCHAR(255) NOT NULL, systeme VARCHAR(255) NOT NULL, generation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnel (id INT AUTO_INCREMENT NOT NULL, poste_id INT NOT NULL, service_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, datenaisse DATE NOT NULL, dateentre DATE NOT NULL, INDEX IDX_A6BCF3DEA0905086 (poste_id), INDEX IDX_A6BCF3DEED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DEA0905086 FOREIGN KEY (poste_id) REFERENCES poste (id)');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DEED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('DROP TABLE typemateriel');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE typemateriel (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DEA0905086');
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DEED5CA9E6');
        $this->addSql('DROP TABLE materiel');
        $this->addSql('DROP TABLE personnel');
    }
}
