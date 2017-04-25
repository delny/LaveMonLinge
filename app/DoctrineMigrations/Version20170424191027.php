<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170424191027 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product ADD priceIfMultiple INT NOT NULL');
        $this->addSql('ALTER TABLE timeslot ADD slot_start VARCHAR(255) NOT NULL, ADD slot_end VARCHAR(255) NOT NULL, DROP slotStart, DROP slotEnd');
        $this->addSql('ALTER TABLE user CHANGE token token VARCHAR(255) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product DROP priceIfMultiple');
        $this->addSql('ALTER TABLE timeslot ADD slotStart VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD slotEnd VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, DROP slot_start, DROP slot_end');
        $this->addSql('ALTER TABLE user CHANGE token token VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
