<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250202152801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artwork_style (artwork_id INT NOT NULL, style_id INT NOT NULL, INDEX IDX_A257D070DB8FFA4 (artwork_id), INDEX IDX_A257D070BACD6074 (style_id), PRIMARY KEY(artwork_id, style_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artwork_style ADD CONSTRAINT FK_A257D070DB8FFA4 FOREIGN KEY (artwork_id) REFERENCES artwork (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artwork_style ADD CONSTRAINT FK_A257D070BACD6074 FOREIGN KEY (style_id) REFERENCES style (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artwork ADD user_id INT NOT NULL, ADD image_name VARCHAR(255) DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE artwork ADD CONSTRAINT FK_881FC576A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_881FC576A76ED395 ON artwork (user_id)');
        $this->addSql('ALTER TABLE comment ADD user_id INT NOT NULL, ADD artwork_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CDB8FFA4 FOREIGN KEY (artwork_id) REFERENCES artwork (id)');
        $this->addSql('CREATE INDEX IDX_9474526CA76ED395 ON comment (user_id)');
        $this->addSql('CREATE INDEX IDX_9474526CDB8FFA4 ON comment (artwork_id)');
        $this->addSql('ALTER TABLE style ADD art_id INT NOT NULL');
        $this->addSql('ALTER TABLE style ADD CONSTRAINT FK_33BDB86A8C25E51A FOREIGN KEY (art_id) REFERENCES art (id)');
        $this->addSql('CREATE INDEX IDX_33BDB86A8C25E51A ON style (art_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artwork_style DROP FOREIGN KEY FK_A257D070DB8FFA4');
        $this->addSql('ALTER TABLE artwork_style DROP FOREIGN KEY FK_A257D070BACD6074');
        $this->addSql('DROP TABLE artwork_style');
        $this->addSql('ALTER TABLE artwork DROP FOREIGN KEY FK_881FC576A76ED395');
        $this->addSql('DROP INDEX IDX_881FC576A76ED395 ON artwork');
        $this->addSql('ALTER TABLE artwork DROP user_id, DROP image_name, DROP updated_at');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CDB8FFA4');
        $this->addSql('DROP INDEX IDX_9474526CA76ED395 ON comment');
        $this->addSql('DROP INDEX IDX_9474526CDB8FFA4 ON comment');
        $this->addSql('ALTER TABLE comment DROP user_id, DROP artwork_id');
        $this->addSql('ALTER TABLE style DROP FOREIGN KEY FK_33BDB86A8C25E51A');
        $this->addSql('DROP INDEX IDX_33BDB86A8C25E51A ON style');
        $this->addSql('ALTER TABLE style DROP art_id');
    }
}
