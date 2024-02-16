<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240216195528 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_session (session_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_8849CBDE613FECDF (session_id), INDEX IDX_8849CBDEA76ED395 (user_id), PRIMARY KEY(session_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_session ADD CONSTRAINT FK_8849CBDE613FECDF FOREIGN KEY (session_id) REFERENCES session (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_session ADD CONSTRAINT FK_8849CBDEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_session DROP FOREIGN KEY FK_8849CBDE613FECDF');
        $this->addSql('ALTER TABLE user_session DROP FOREIGN KEY FK_8849CBDEA76ED395');
        $this->addSql('DROP TABLE user_session');
    }
}
