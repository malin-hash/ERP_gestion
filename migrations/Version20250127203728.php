<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250127203728 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnel ADD materiel_id INT NOT NULL');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DE16880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id)');
        $this->addSql('CREATE INDEX IDX_A6BCF3DE16880AAF ON personnel (materiel_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DE16880AAF');
        $this->addSql('DROP INDEX IDX_A6BCF3DE16880AAF ON personnel');
        $this->addSql('ALTER TABLE personnel DROP materiel_id');
    }
}
