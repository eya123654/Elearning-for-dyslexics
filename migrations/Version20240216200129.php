<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240216200129 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_quiz (quiz_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_DE93B65B853CD175 (quiz_id), INDEX IDX_DE93B65BA76ED395 (user_id), PRIMARY KEY(quiz_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_quiz ADD CONSTRAINT FK_DE93B65B853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_quiz ADD CONSTRAINT FK_DE93B65BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_quiz DROP FOREIGN KEY FK_DE93B65B853CD175');
        $this->addSql('ALTER TABLE user_quiz DROP FOREIGN KEY FK_DE93B65BA76ED395');
        $this->addSql('DROP TABLE user_quiz');
    }
}
