<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250202095814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnel ADD bureau_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DE32516FE2 FOREIGN KEY (bureau_id) REFERENCES bureau (id)');
        $this->addSql('CREATE INDEX IDX_A6BCF3DE32516FE2 ON personnel (bureau_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DE32516FE2');
        $this->addSql('DROP INDEX IDX_A6BCF3DE32516FE2 ON personnel');
        $this->addSql('ALTER TABLE personnel DROP bureau_id');
    }
}
