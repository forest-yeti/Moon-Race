<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240512180823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Добавлена сущность кошелька пользователя';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE wallet (id INT AUTO_INCREMENT NOT NULL, balance DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD wallet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649712520F3 FOREIGN KEY (wallet_id) REFERENCES wallet (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649712520F3 ON user (wallet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649712520F3');
        $this->addSql('DROP TABLE wallet');
        $this->addSql('DROP INDEX IDX_8D93D649712520F3 ON user');
        $this->addSql('ALTER TABLE user DROP wallet_id');
    }
}
