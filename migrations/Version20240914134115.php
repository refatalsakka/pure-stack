<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240914134115 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project ADD sort SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE service ADD sort SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE work_stage ADD sort SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE work_value ADD sort SMALLINT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE work_value DROP sort');
        $this->addSql('ALTER TABLE service DROP sort');
        $this->addSql('ALTER TABLE work_stage DROP sort');
        $this->addSql('ALTER TABLE project DROP sort');
    }
}
