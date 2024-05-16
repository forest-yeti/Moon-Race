<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240515234243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Добавлена сущность GameLog';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game_log (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, game_type VARCHAR(255) NOT NULL, game_id INT NOT NULL, random_number DOUBLE PRECISION NOT NULL, win TINYINT(1) NOT NULL, meta_data LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', created_at DATETIME NOT NULL, INDEX IDX_94657B00A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_log ADD CONSTRAINT FK_94657B00A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game_log DROP FOREIGN KEY FK_94657B00A76ED395');
        $this->addSql('DROP TABLE game_log');
    }
}
