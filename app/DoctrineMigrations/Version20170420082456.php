<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170420082456 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE timeslot (id INT AUTO_INCREMENT NOT NULL, order_laundry_id INT DEFAULT NULL, slot VARCHAR(255) NOT NULL, isAvailable TINYINT(1) NOT NULL, INDEX IDX_3BE452F770EA41A1 (order_laundry_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE timeslot ADD CONSTRAINT FK_3BE452F770EA41A1 FOREIGN KEY (order_laundry_id) REFERENCES orderlaundry (id)');
        $this->addSql('ALTER TABLE address DROP street_number');
        $this->addSql('ALTER TABLE orderlaundry CHANGE date_collect date_collect DATE NOT NULL, CHANGE date_delivery date_delivery DATE NOT NULL');
        $this->addSql('ALTER TABLE user DROP roles');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE timeslot');
        $this->addSql('ALTER TABLE address ADD street_number INT NOT NULL');
        $this->addSql('ALTER TABLE orderlaundry CHANGE date_collect date_collect DATETIME NOT NULL, CHANGE date_delivery date_delivery DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user ADD roles LONGTEXT NOT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:json_array)\'');
    }
}
