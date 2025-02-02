<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250202092126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ordinateur DROP FOREIGN KEY FK_8712E8DB346F772E');
        $this->addSql('ALTER TABLE ordinateur DROP FOREIGN KEY FK_8712E8DB553A6EC4');
        $this->addSql('DROP TABLE `system`');
        $this->addSql('DROP TABLE generation');
        $this->addSql('DROP INDEX IDX_8712E8DB346F772E ON ordinateur');
        $this->addSql('DROP INDEX IDX_8712E8DB553A6EC4 ON ordinateur');
        $this->addSql('ALTER TABLE ordinateur ADD type_id INT NOT NULL, ADD nom VARCHAR(255) NOT NULL, DROP generation_id, DROP systeme_id, DROP equipement_id, DROP marque_id');
        $this->addSql('ALTER TABLE ordinateur ADD CONSTRAINT FK_8712E8DBC54C8C93 FOREIGN KEY (type_id) REFERENCES equipement (id)');
        $this->addSql('CREATE INDEX IDX_8712E8DBC54C8C93 ON ordinateur (type_id)');
        $this->addSql('DROP INDEX IDX_A6BCF3DE32516FE2 ON personnel');
        $this->addSql('ALTER TABLE personnel DROP bureau_id');
        $this->addSql('ALTER TABLE unitecentral DROP FOREIGN KEY FK_928763D4C8121CE9');
        $this->addSql('DROP INDEX IDX_928763D4C8121CE9 ON unitecentral');
        $this->addSql('DROP INDEX IDX_928763D44827B9B2 ON unitecentral');
        $this->addSql('ALTER TABLE unitecentral ADD type_id INT NOT NULL, ADD nom VARCHAR(255) NOT NULL, DROP nom_id, DROP marque_id');
        $this->addSql('ALTER TABLE unitecentral ADD CONSTRAINT FK_928763D4C54C8C93 FOREIGN KEY (type_id) REFERENCES equipement (id)');
        $this->addSql('CREATE INDEX IDX_928763D4C54C8C93 ON unitecentral (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `system` (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE generation (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE unitecentral DROP FOREIGN KEY FK_928763D4C54C8C93');
        $this->addSql('DROP INDEX IDX_928763D4C54C8C93 ON unitecentral');
        $this->addSql('ALTER TABLE unitecentral ADD nom_id INT DEFAULT NULL, ADD marque_id INT DEFAULT NULL, DROP type_id, DROP nom');
        $this->addSql('ALTER TABLE unitecentral ADD CONSTRAINT FK_928763D4C8121CE9 FOREIGN KEY (nom_id) REFERENCES equipement (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_928763D4C8121CE9 ON unitecentral (nom_id)');
        $this->addSql('CREATE INDEX IDX_928763D44827B9B2 ON unitecentral (marque_id)');
        $this->addSql('ALTER TABLE ordinateur DROP FOREIGN KEY FK_8712E8DBC54C8C93');
        $this->addSql('DROP INDEX IDX_8712E8DBC54C8C93 ON ordinateur');
        $this->addSql('ALTER TABLE ordinateur ADD generation_id INT DEFAULT NULL, ADD systeme_id INT DEFAULT NULL, ADD equipement_id INT DEFAULT NULL, ADD marque_id INT DEFAULT NULL, DROP type_id, DROP nom');
        $this->addSql('ALTER TABLE ordinateur ADD CONSTRAINT FK_8712E8DB346F772E FOREIGN KEY (systeme_id) REFERENCES `system` (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE ordinateur ADD CONSTRAINT FK_8712E8DB553A6EC4 FOREIGN KEY (generation_id) REFERENCES generation (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8712E8DB346F772E ON ordinateur (systeme_id)');
        $this->addSql('CREATE INDEX IDX_8712E8DB553A6EC4 ON ordinateur (generation_id)');
        $this->addSql('ALTER TABLE personnel ADD bureau_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_A6BCF3DE32516FE2 ON personnel (bureau_id)');
    }
}
