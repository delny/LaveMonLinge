<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170420124331 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE orderlaundry ADD time_slot_delivery_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE orderlaundry ADD CONSTRAINT FK_B9AB8CD919911165 FOREIGN KEY (time_slot_delivery_id) REFERENCES timeslot (id)');
        $this->addSql('CREATE INDEX IDX_B9AB8CD919911165 ON orderlaundry (time_slot_delivery_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE orderlaundry DROP FOREIGN KEY FK_B9AB8CD919911165');
        $this->addSql('DROP INDEX IDX_B9AB8CD919911165 ON orderlaundry');
        $this->addSql('ALTER TABLE orderlaundry DROP time_slot_delivery_id');
    }
}
