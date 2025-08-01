<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250727013706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subcategory DROP FOREIGN KEY FK_DDCA4484584665A');
        $this->addSql('DROP INDEX IDX_DDCA4484584665A ON subcategory');
        $this->addSql('ALTER TABLE subcategory DROP product_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subcategory ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE subcategory ADD CONSTRAINT FK_DDCA4484584665A FOREIGN KEY (product_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_DDCA4484584665A ON subcategory (product_id)');
    }
}
