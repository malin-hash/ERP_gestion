<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250124142836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prime (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, montant INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prime_poste (prime_id INT NOT NULL, poste_id INT NOT NULL, INDEX IDX_42CA15F969247986 (prime_id), INDEX IDX_42CA15F9A0905086 (poste_id), PRIMARY KEY(prime_id, poste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prime_poste ADD CONSTRAINT FK_42CA15F969247986 FOREIGN KEY (prime_id) REFERENCES prime (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prime_poste ADD CONSTRAINT FK_42CA15F9A0905086 FOREIGN KEY (poste_id) REFERENCES poste (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prime_poste DROP FOREIGN KEY FK_42CA15F969247986');
        $this->addSql('ALTER TABLE prime_poste DROP FOREIGN KEY FK_42CA15F9A0905086');
        $this->addSql('DROP TABLE prime');
        $this->addSql('DROP TABLE prime_poste');
    }
}
