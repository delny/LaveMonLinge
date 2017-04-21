<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170420134216 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE timeslot (id INT AUTO_INCREMENT NOT NULL, slot VARCHAR(255) NOT NULL, isAvailable TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orderlaundry ADD time_slot_collect_id INT DEFAULT NULL, ADD time_slot_delivery_id INT DEFAULT NULL, CHANGE date_collect date_collect DATE NOT NULL, CHANGE date_delivery date_delivery DATE NOT NULL');
        $this->addSql('ALTER TABLE orderlaundry ADD CONSTRAINT FK_B9AB8CD93383D747 FOREIGN KEY (time_slot_collect_id) REFERENCES timeslot (id)');
        $this->addSql('ALTER TABLE orderlaundry ADD CONSTRAINT FK_B9AB8CD919911165 FOREIGN KEY (time_slot_delivery_id) REFERENCES timeslot (id)');
        $this->addSql('CREATE INDEX IDX_B9AB8CD93383D747 ON orderlaundry (time_slot_collect_id)');
        $this->addSql('CREATE INDEX IDX_B9AB8CD919911165 ON orderlaundry (time_slot_delivery_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE orderlaundry DROP FOREIGN KEY FK_B9AB8CD93383D747');
        $this->addSql('ALTER TABLE orderlaundry DROP FOREIGN KEY FK_B9AB8CD919911165');
        $this->addSql('DROP TABLE timeslot');
        $this->addSql('DROP INDEX IDX_B9AB8CD93383D747 ON orderlaundry');
        $this->addSql('DROP INDEX IDX_B9AB8CD919911165 ON orderlaundry');
        $this->addSql('ALTER TABLE orderlaundry DROP time_slot_collect_id, DROP time_slot_delivery_id, CHANGE date_collect date_collect DATETIME NOT NULL, CHANGE date_delivery date_delivery DATETIME NOT NULL');
    }
}
