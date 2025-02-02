<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250202183714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnel ADD ville_id INT DEFAULT NULL, ADD pays_id INT DEFAULT NULL, CHANGE poste_id poste_id INT DEFAULT NULL, CHANGE service_id service_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DEA73F0036 FOREIGN KEY (ville_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DEA6E44244 FOREIGN KEY (pays_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_A6BCF3DEA73F0036 ON personnel (ville_id)');
        $this->addSql('CREATE INDEX IDX_A6BCF3DEA6E44244 ON personnel (pays_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DEA73F0036');
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DEA6E44244');
        $this->addSql('DROP INDEX IDX_A6BCF3DEA73F0036 ON personnel');
        $this->addSql('DROP INDEX IDX_A6BCF3DEA6E44244 ON personnel');
        $this->addSql('ALTER TABLE personnel DROP ville_id, DROP pays_id, CHANGE poste_id poste_id INT NOT NULL, CHANGE service_id service_id INT NOT NULL');
    }
}
