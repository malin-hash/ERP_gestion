<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250202093216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE imprimante ADD marque_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE imprimante ADD CONSTRAINT FK_4DF2C3AA4827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('CREATE INDEX IDX_4DF2C3AA4827B9B2 ON imprimante (marque_id)');
        $this->addSql('ALTER TABLE ordinateur ADD marque_id INT DEFAULT NULL, ADD systeme_id INT DEFAULT NULL, ADD generation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ordinateur ADD CONSTRAINT FK_8712E8DB4827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE ordinateur ADD CONSTRAINT FK_8712E8DB346F772E FOREIGN KEY (systeme_id) REFERENCES `system` (id)');
        $this->addSql('ALTER TABLE ordinateur ADD CONSTRAINT FK_8712E8DB553A6EC4 FOREIGN KEY (generation_id) REFERENCES generation (id)');
        $this->addSql('CREATE INDEX IDX_8712E8DB4827B9B2 ON ordinateur (marque_id)');
        $this->addSql('CREATE INDEX IDX_8712E8DB346F772E ON ordinateur (systeme_id)');
        $this->addSql('CREATE INDEX IDX_8712E8DB553A6EC4 ON ordinateur (generation_id)');
        $this->addSql('ALTER TABLE unitecentral ADD marque_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE unitecentral ADD CONSTRAINT FK_928763D44827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('CREATE INDEX IDX_928763D44827B9B2 ON unitecentral (marque_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE unitecentral DROP FOREIGN KEY FK_928763D44827B9B2');
        $this->addSql('DROP INDEX IDX_928763D44827B9B2 ON unitecentral');
        $this->addSql('ALTER TABLE unitecentral DROP marque_id');
        $this->addSql('ALTER TABLE ordinateur DROP FOREIGN KEY FK_8712E8DB4827B9B2');
        $this->addSql('ALTER TABLE ordinateur DROP FOREIGN KEY FK_8712E8DB346F772E');
        $this->addSql('ALTER TABLE ordinateur DROP FOREIGN KEY FK_8712E8DB553A6EC4');
        $this->addSql('DROP INDEX IDX_8712E8DB4827B9B2 ON ordinateur');
        $this->addSql('DROP INDEX IDX_8712E8DB346F772E ON ordinateur');
        $this->addSql('DROP INDEX IDX_8712E8DB553A6EC4 ON ordinateur');
        $this->addSql('ALTER TABLE ordinateur DROP marque_id, DROP systeme_id, DROP generation_id');
        $this->addSql('ALTER TABLE imprimante DROP FOREIGN KEY FK_4DF2C3AA4827B9B2');
        $this->addSql('DROP INDEX IDX_4DF2C3AA4827B9B2 ON imprimante');
        $this->addSql('ALTER TABLE imprimante DROP marque_id');
    }
}
