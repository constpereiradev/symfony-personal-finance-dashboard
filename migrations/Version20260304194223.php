<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260304194223 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE finance_transaction ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE finance_transaction ADD CONSTRAINT FK_8D0AD41AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8D0AD41AA76ED395 ON finance_transaction (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE finance_transaction DROP FOREIGN KEY FK_8D0AD41AA76ED395');
        $this->addSql('DROP INDEX IDX_8D0AD41AA76ED395 ON finance_transaction');
        $this->addSql('ALTER TABLE finance_transaction DROP user_id');
    }
}
