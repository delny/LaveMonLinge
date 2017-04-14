<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170413151832 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, compute_price_by_weight TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orderlaundry ADD date_collect DATETIME NOT NULL, ADD date_delivery DATETIME NOT NULL, ADD price_delivery INT NOT NULL, DROP dataCollect, DROP dataDelivery, DROP nbBags, DROP priceDelivery');
        $this->addSql('ALTER TABLE product ADD type_id INT DEFAULT NULL, DROP type');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADC54C8C93 FOREIGN KEY (type_id) REFERENCES product_type (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADC54C8C93 ON product (type_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADC54C8C93');
        $this->addSql('DROP TABLE product_type');
        $this->addSql('ALTER TABLE orderlaundry ADD dataCollect DATETIME NOT NULL, ADD dataDelivery DATETIME NOT NULL, ADD priceDelivery INT NOT NULL, DROP date_collect, DROP date_delivery, CHANGE price_delivery nbBags INT NOT NULL');
        $this->addSql('DROP INDEX IDX_D34A04ADC54C8C93 ON product');
        $this->addSql('ALTER TABLE product ADD type VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, DROP type_id');
    }
}
