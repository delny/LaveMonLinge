<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170413131442 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE order_item_product');
        $this->addSql('ALTER TABLE product ADD order_items_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD8A484C35 FOREIGN KEY (order_items_id) REFERENCES order_item (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD8A484C35 ON product (order_items_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE order_item_product (order_item_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_DCD7B693E415FB15 (order_item_id), INDEX IDX_DCD7B6934584665A (product_id), PRIMARY KEY(order_item_id, product_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_item_product ADD CONSTRAINT FK_DCD7B6934584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_item_product ADD CONSTRAINT FK_DCD7B693E415FB15 FOREIGN KEY (order_item_id) REFERENCES order_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD8A484C35');
        $this->addSql('DROP INDEX IDX_D34A04AD8A484C35 ON product');
        $this->addSql('ALTER TABLE product DROP order_items_id');
    }
}
