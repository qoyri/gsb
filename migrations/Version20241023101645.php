<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241023101645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_frais ADD visitor_id INT NOT NULL');
        $this->addSql('ALTER TABLE fiche_frais ADD CONSTRAINT FK_5FC0A6A770BEE6D FOREIGN KEY (visitor_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_5FC0A6A770BEE6D ON fiche_frais (visitor_id)');
        $this->addSql('ALTER TABLE ligne_frais_hors_forfait ADD fiche_frais_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_frais_hors_forfait ADD CONSTRAINT FK_EC01626DD94F5755 FOREIGN KEY (fiche_frais_id) REFERENCES fiche_frais (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_EC01626DD94F5755 ON ligne_frais_hors_forfait (fiche_frais_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE fiche_frais DROP CONSTRAINT FK_5FC0A6A770BEE6D');
        $this->addSql('DROP INDEX IDX_5FC0A6A770BEE6D');
        $this->addSql('ALTER TABLE fiche_frais DROP visitor_id');
        $this->addSql('ALTER TABLE ligne_frais_hors_forfait DROP CONSTRAINT FK_EC01626DD94F5755');
        $this->addSql('DROP INDEX IDX_EC01626DD94F5755');
        $this->addSql('ALTER TABLE ligne_frais_hors_forfait DROP fiche_frais_id');
    }
}
