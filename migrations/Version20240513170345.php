<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240513170345 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Добавлена сущность игровых слотов';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE slot (id INT AUTO_INCREMENT NOT NULL, slot_machine_id INT DEFAULT NULL, prize_in_line DOUBLE PRECISION NOT NULL, descriptor INT NOT NULL, INDEX IDX_AC0E2067966E0264 (slot_machine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE slot_machine (id INT AUTO_INCREMENT NOT NULL, background_theme VARCHAR(255) NOT NULL, min_bet DOUBLE PRECISION NOT NULL, bet_step_counter INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE slot ADD CONSTRAINT FK_AC0E2067966E0264 FOREIGN KEY (slot_machine_id) REFERENCES slot_machine (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE slot DROP FOREIGN KEY FK_AC0E2067966E0264');
        $this->addSql('DROP TABLE slot');
        $this->addSql('DROP TABLE slot_machine');
    }
}
