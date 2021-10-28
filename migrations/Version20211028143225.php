<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211028143225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE snowtricks ADD user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE snowtricks ADD CONSTRAINT FK_1A4AF30B9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_1A4AF30B9D86650F ON snowtricks (user_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE snowtricks DROP FOREIGN KEY FK_1A4AF30B9D86650F');
        $this->addSql('DROP INDEX IDX_1A4AF30B9D86650F ON snowtricks');
        $this->addSql('ALTER TABLE snowtricks DROP user_id_id');
    }
}
