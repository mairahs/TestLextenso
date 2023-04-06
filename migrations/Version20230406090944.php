<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230406090944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse CHANGE siret siret VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE etablissement CHANGE siren siren VARCHAR(255) NOT NULL, CHANGE siret siret VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse CHANGE siret siret INT NOT NULL');
        $this->addSql('ALTER TABLE etablissement CHANGE siren siren INT NOT NULL, CHANGE siret siret INT NOT NULL');
    }
}
