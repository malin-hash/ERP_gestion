<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250127205953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE materiel DROP FOREIGN KEY FK_18D2B091C54C8C93');
        $this->addSql('DROP TABLE typemateriel');
        $this->addSql('DROP INDEX IDX_18D2B091C54C8C93 ON materiel');
        $this->addSql('ALTER TABLE materiel DROP type_id');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DE16880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id)');
        $this->addSql('CREATE INDEX IDX_A6BCF3DE16880AAF ON personnel (materiel_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE typemateriel (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DE16880AAF');
        $this->addSql('DROP INDEX IDX_A6BCF3DE16880AAF ON personnel');
        $this->addSql('ALTER TABLE materiel ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE materiel ADD CONSTRAINT FK_18D2B091C54C8C93 FOREIGN KEY (type_id) REFERENCES typemateriel (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_18D2B091C54C8C93 ON materiel (type_id)');
    }
}
