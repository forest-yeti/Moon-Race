<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240516014354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Обновлена сущность SlotJackpot';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE slot_jackpot ADD player_looseness DOUBLE PRECISION NOT NULL, ADD min_player_games INT NOT NULL, ADD draw_date_from DATETIME NOT NULL');
        $this->addSql('ALTER TABLE slot_machine ADD slot_jackpot_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE slot_machine ADD CONSTRAINT FK_FB03BD20B4464999 FOREIGN KEY (slot_jackpot_id) REFERENCES slot_jackpot (id)');
        $this->addSql('CREATE INDEX IDX_FB03BD20B4464999 ON slot_machine (slot_jackpot_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE slot_machine DROP FOREIGN KEY FK_FB03BD20B4464999');
        $this->addSql('DROP INDEX IDX_FB03BD20B4464999 ON slot_machine');
        $this->addSql('ALTER TABLE slot_machine DROP slot_jackpot_id');
        $this->addSql('ALTER TABLE slot_jackpot DROP player_looseness, DROP min_player_games, DROP draw_date_from');
    }
}
