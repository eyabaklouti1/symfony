<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250716235954 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subcategory ADD pr_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE subcategory ADD CONSTRAINT FK_DDCA448F63B5C93 FOREIGN KEY (pr_id_id) REFERENCES product (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DDCA448F63B5C93 ON subcategory (pr_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subcategory DROP FOREIGN KEY FK_DDCA448F63B5C93');
        $this->addSql('DROP INDEX UNIQ_DDCA448F63B5C93 ON subcategory');
        $this->addSql('ALTER TABLE subcategory DROP pr_id_id');
    }
}
