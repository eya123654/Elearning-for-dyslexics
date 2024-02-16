<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240216192026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activite (id INT AUTO_INCREMENT NOT NULL, competition_id INT NOT NULL, titre VARCHAR(255) NOT NULL, score INT NOT NULL, enonce VARCHAR(255) NOT NULL, solution VARCHAR(255) NOT NULL, INDEX IDX_B87555157B39D312 (competition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competition (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, duree VARCHAR(255) NOT NULL, date VARCHAR(255) NOT NULL, heure VARCHAR(255) NOT NULL, nbr_participant INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_competition (user_id INT NOT NULL, competition_id INT NOT NULL, INDEX IDX_1C11E524A76ED395 (user_id), INDEX IDX_1C11E5247B39D312 (competition_id), PRIMARY KEY(user_id, competition_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B87555157B39D312 FOREIGN KEY (competition_id) REFERENCES competition (id)');
        $this->addSql('ALTER TABLE user_competition ADD CONSTRAINT FK_1C11E524A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_competition ADD CONSTRAINT FK_1C11E5247B39D312 FOREIGN KEY (competition_id) REFERENCES competition (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B87555157B39D312');
        $this->addSql('ALTER TABLE user_competition DROP FOREIGN KEY FK_1C11E524A76ED395');
        $this->addSql('ALTER TABLE user_competition DROP FOREIGN KEY FK_1C11E5247B39D312');
        $this->addSql('DROP TABLE activite');
        $this->addSql('DROP TABLE competition');
        $this->addSql('DROP TABLE user_competition');
    }
}
