<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250305172134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cellar (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grapes (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artwork ADD image2_name VARCHAR(255) DEFAULT NULL, ADD image3_name VARCHAR(255) DEFAULT NULL, DROP picture1, DROP picture2, DROP picture3');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cellar');
        $this->addSql('DROP TABLE grapes');
        $this->addSql('ALTER TABLE artwork ADD picture1 VARCHAR(255) DEFAULT NULL, ADD picture2 VARCHAR(255) DEFAULT NULL, ADD picture3 VARCHAR(255) DEFAULT NULL, DROP image2_name, DROP image3_name');
    }
}
