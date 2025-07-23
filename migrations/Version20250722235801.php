<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250722235801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1F78A56EE FOREIGN KEY (subcategory_id_id) REFERENCES subcategory (id)');
        $this->addSql('CREATE INDEX IDX_64C19C1F78A56EE ON category (subcategory_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1F78A56EE');
        $this->addSql('DROP INDEX IDX_64C19C1F78A56EE ON category');
    }
}
