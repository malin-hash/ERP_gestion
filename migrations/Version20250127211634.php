<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250127211634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnel ADD material_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DEE308AC6F FOREIGN KEY (material_id) REFERENCES materiel (id)');
        $this->addSql('CREATE INDEX IDX_A6BCF3DEE308AC6F ON personnel (material_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DEE308AC6F');
        $this->addSql('DROP INDEX IDX_A6BCF3DEE308AC6F ON personnel');
        $this->addSql('ALTER TABLE personnel DROP material_id');
    }
}
