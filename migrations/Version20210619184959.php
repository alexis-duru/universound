<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210619184959 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE track DROP FOREIGN KEY FK_D6E3F8A67EF04B88');
        $this->addSql('DROP TABLE track_user');
        $this->addSql('DROP INDEX IDX_D6E3F8A67EF04B88 ON track');
        $this->addSql('ALTER TABLE track DROP track_user_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE track_user (id INT AUTO_INCREMENT NOT NULL, user VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE track ADD track_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE track ADD CONSTRAINT FK_D6E3F8A67EF04B88 FOREIGN KEY (track_user_id) REFERENCES track_user (id)');
        $this->addSql('CREATE INDEX IDX_D6E3F8A67EF04B88 ON track (track_user_id)');
    }
}
