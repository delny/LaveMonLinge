<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170420082830 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE orderlaundry ADD time_slot_collect_id INT DEFAULT NULL, ADD time_slot_delivery_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE orderlaundry ADD CONSTRAINT FK_B9AB8CD93383D747 FOREIGN KEY (time_slot_collect_id) REFERENCES timeslot (id)');
        $this->addSql('ALTER TABLE orderlaundry ADD CONSTRAINT FK_B9AB8CD919911165 FOREIGN KEY (time_slot_delivery_id) REFERENCES timeslot (id)');
        $this->addSql('CREATE INDEX IDX_B9AB8CD93383D747 ON orderlaundry (time_slot_collect_id)');
        $this->addSql('CREATE INDEX IDX_B9AB8CD919911165 ON orderlaundry (time_slot_delivery_id)');
        $this->addSql('ALTER TABLE timeslot DROP FOREIGN KEY FK_3BE452F770EA41A1');
        $this->addSql('DROP INDEX IDX_3BE452F770EA41A1 ON timeslot');
        $this->addSql('ALTER TABLE timeslot DROP order_laundry_id');
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
        $this->addSql('DROP INDEX IDX_B9AB8CD93383D747 ON orderlaundry');
        $this->addSql('DROP INDEX IDX_B9AB8CD919911165 ON orderlaundry');
        $this->addSql('ALTER TABLE orderlaundry DROP time_slot_collect_id, DROP time_slot_delivery_id');
        $this->addSql('ALTER TABLE timeslot ADD order_laundry_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE timeslot ADD CONSTRAINT FK_3BE452F770EA41A1 FOREIGN KEY (order_laundry_id) REFERENCES orderlaundry (id)');
        $this->addSql('CREATE INDEX IDX_3BE452F770EA41A1 ON timeslot (order_laundry_id)');
    }
}
