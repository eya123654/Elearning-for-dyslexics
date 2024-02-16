<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240216134625 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lecon ADD cours_id INT NOT NULL');
        $this->addSql('ALTER TABLE lecon ADD CONSTRAINT FK_94E6242E7ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('CREATE INDEX IDX_94E6242E7ECF78B0 ON lecon (cours_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lecon DROP FOREIGN KEY FK_94E6242E7ECF78B0');
        $this->addSql('DROP INDEX IDX_94E6242E7ECF78B0 ON lecon');
        $this->addSql('ALTER TABLE lecon DROP cours_id');
    }
}
