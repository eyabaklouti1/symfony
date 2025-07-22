<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250722003622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_subcategory (category_id INT NOT NULL, subcategory_id INT NOT NULL, INDEX IDX_BA47E62312469DE2 (category_id), INDEX IDX_BA47E6235DC6FE57 (subcategory_id), PRIMARY KEY(category_id, subcategory_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_subcategory ADD CONSTRAINT FK_BA47E62312469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_subcategory ADD CONSTRAINT FK_BA47E6235DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES subcategory (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subcategory_category DROP FOREIGN KEY FK_B33C6E2712469DE2');
        $this->addSql('ALTER TABLE subcategory_category DROP FOREIGN KEY FK_B33C6E275DC6FE57');
        $this->addSql('DROP TABLE subcategory_category');
        $this->addSql('ALTER TABLE subcategory DROP FOREIGN KEY FK_DDCA448F63B5C93');
        $this->addSql('DROP INDEX UNIQ_DDCA448F63B5C93 ON subcategory');
        $this->addSql('ALTER TABLE subcategory CHANGE pr_id_id product_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE subcategory ADD CONSTRAINT FK_DDCA448DE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DDCA448DE18E50B ON subcategory (product_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE subcategory_category (subcategory_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_B33C6E275DC6FE57 (subcategory_id), INDEX IDX_B33C6E2712469DE2 (category_id), PRIMARY KEY(subcategory_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE subcategory_category ADD CONSTRAINT FK_B33C6E2712469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subcategory_category ADD CONSTRAINT FK_B33C6E275DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES subcategory (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_subcategory DROP FOREIGN KEY FK_BA47E62312469DE2');
        $this->addSql('ALTER TABLE category_subcategory DROP FOREIGN KEY FK_BA47E6235DC6FE57');
        $this->addSql('DROP TABLE category_subcategory');
        $this->addSql('ALTER TABLE subcategory DROP FOREIGN KEY FK_DDCA448DE18E50B');
        $this->addSql('DROP INDEX UNIQ_DDCA448DE18E50B ON subcategory');
        $this->addSql('ALTER TABLE subcategory CHANGE product_id_id pr_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE subcategory ADD CONSTRAINT FK_DDCA448F63B5C93 FOREIGN KEY (pr_id_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DDCA448F63B5C93 ON subcategory (pr_id_id)');
    }
}
