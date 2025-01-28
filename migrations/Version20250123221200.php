<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250123221200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prime (id INT AUTO_INCREMENT NOT NULL, poste_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, montant INT NOT NULL, INDEX IDX_544B0F57A0905086 (poste_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prime ADD CONSTRAINT FK_544B0F57A0905086 FOREIGN KEY (poste_id) REFERENCES poste (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prime DROP FOREIGN KEY FK_544B0F57A0905086');
        $this->addSql('DROP TABLE prime');
    }
}
