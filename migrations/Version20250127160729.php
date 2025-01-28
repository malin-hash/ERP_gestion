<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250127160729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE materiel ADD type_id INT NOT NULL, ADD rame INT NOT NULL, ADD disque INT NOT NULL, ADD core VARCHAR(255) NOT NULL, ADD systeme VARCHAR(255) NOT NULL, ADD generation VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE materiel ADD CONSTRAINT FK_18D2B091C54C8C93 FOREIGN KEY (type_id) REFERENCES typemateriel (id)');
        $this->addSql('CREATE INDEX IDX_18D2B091C54C8C93 ON materiel (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE materiel DROP FOREIGN KEY FK_18D2B091C54C8C93');
        $this->addSql('DROP INDEX IDX_18D2B091C54C8C93 ON materiel');
        $this->addSql('ALTER TABLE materiel DROP type_id, DROP rame, DROP disque, DROP core, DROP systeme, DROP generation');
    }
}
