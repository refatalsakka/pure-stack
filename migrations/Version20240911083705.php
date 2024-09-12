<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240911083705 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, demo VARCHAR(255) NOT NULL, translation_key VARCHAR(255) NOT NULL, summary LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_2FB3D0EE989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_technology (project_id INT NOT NULL, technology_id INT NOT NULL, INDEX IDX_ECC5297F166D1F9C (project_id), INDEX IDX_ECC5297F4235D463 (technology_id), PRIMARY KEY(project_id, technology_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, summary_title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, summary LONGTEXT NOT NULL, translation_key VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_E19D9AD25E237E06 (name), UNIQUE INDEX UNIQ_E19D9AD2989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_service (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, summary_title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, summary LONGTEXT NOT NULL, translation_key VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_9E45C6265E237E06 (name), INDEX IDX_9E45C626ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE technology (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, translation_key VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_F463524D5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_stage (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, summary LONGTEXT NOT NULL, summary_title VARCHAR(255) NOT NULL, icon VARCHAR(255) NOT NULL, translation_key VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_EA87E8465E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_value (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, summary LONGTEXT NOT NULL, icon VARCHAR(255) NOT NULL, translation_key VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_358C231B5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project_technology ADD CONSTRAINT FK_ECC5297F166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_technology ADD CONSTRAINT FK_ECC5297F4235D463 FOREIGN KEY (technology_id) REFERENCES technology (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sub_service ADD CONSTRAINT FK_9E45C626ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project_technology DROP FOREIGN KEY FK_ECC5297F166D1F9C');
        $this->addSql('ALTER TABLE project_technology DROP FOREIGN KEY FK_ECC5297F4235D463');
        $this->addSql('ALTER TABLE sub_service DROP FOREIGN KEY FK_9E45C626ED5CA9E6');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_technology');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE sub_service');
        $this->addSql('DROP TABLE technology');
        $this->addSql('DROP TABLE work_stage');
        $this->addSql('DROP TABLE work_value');
    }
}
