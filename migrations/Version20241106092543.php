<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241106092543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_frais ADD etat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche_frais ALTER visitor_id DROP NOT NULL');
        $this->addSql('ALTER TABLE fiche_frais ADD CONSTRAINT FK_5FC0A6A7D5E86FF FOREIGN KEY (etat_id) REFERENCES etat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_5FC0A6A7D5E86FF ON fiche_frais (etat_id)');
        $this->addSql('ALTER TABLE ligne_frais_forfait ADD fiche_frais_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_frais_forfait ADD frais_forfait_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_frais_forfait ADD CONSTRAINT FK_BD293ECFD94F5755 FOREIGN KEY (fiche_frais_id) REFERENCES fiche_frais (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ligne_frais_forfait ADD CONSTRAINT FK_BD293ECF7B70375E FOREIGN KEY (frais_forfait_id) REFERENCES frais_forfait (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_BD293ECFD94F5755 ON ligne_frais_forfait (fiche_frais_id)');
        $this->addSql('CREATE INDEX IDX_BD293ECF7B70375E ON ligne_frais_forfait (frais_forfait_id)');
        $this->addSql('ALTER TABLE "user" ADD roles JSON');
        $this->addSql('ALTER TABLE "user" ALTER email TYPE VARCHAR(180)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE ligne_frais_forfait DROP CONSTRAINT FK_BD293ECFD94F5755');
        $this->addSql('ALTER TABLE ligne_frais_forfait DROP CONSTRAINT FK_BD293ECF7B70375E');
        $this->addSql('DROP INDEX IDX_BD293ECFD94F5755');
        $this->addSql('DROP INDEX IDX_BD293ECF7B70375E');
        $this->addSql('ALTER TABLE ligne_frais_forfait DROP fiche_frais_id');
        $this->addSql('ALTER TABLE ligne_frais_forfait DROP frais_forfait_id');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74');
        $this->addSql('ALTER TABLE "user" DROP roles');
        $this->addSql('ALTER TABLE "user" ALTER email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_frais DROP CONSTRAINT FK_5FC0A6A7D5E86FF');
        $this->addSql('DROP INDEX IDX_5FC0A6A7D5E86FF');
        $this->addSql('ALTER TABLE fiche_frais DROP etat_id');
        $this->addSql('ALTER TABLE fiche_frais ALTER visitor_id SET NOT NULL');
    }
}
