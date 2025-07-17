<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250716234111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE subcategory_category (subcategory_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_B33C6E275DC6FE57 (subcategory_id), INDEX IDX_B33C6E2712469DE2 (category_id), PRIMARY KEY(subcategory_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subcategory_category ADD CONSTRAINT FK_B33C6E275DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES subcategory (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subcategory_category ADD CONSTRAINT FK_B33C6E2712469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subcategory_category DROP FOREIGN KEY FK_B33C6E275DC6FE57');
        $this->addSql('ALTER TABLE subcategory_category DROP FOREIGN KEY FK_B33C6E2712469DE2');
        $this->addSql('DROP TABLE subcategory_category');
    }
}
