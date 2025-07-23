<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250723003433 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1F78A56EE');
        $this->addSql('DROP INDEX IDX_64C19C1F78A56EE ON category');
        $this->addSql('ALTER TABLE category CHANGE subcategory_id subcategory_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE subcategory_id subcategory_id INT NOT NULL');
        $this->addSql('CREATE INDEX IDX_64C19C1F78A56EE ON category (subcategory_id)');
    }
}
