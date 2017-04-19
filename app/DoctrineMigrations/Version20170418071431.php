<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 18/04/2017
 * Time: 17:45
 */

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170418071431 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_item DROP INDEX UNIQ_52EA1F094584665A, ADD INDEX IDX_52EA1F094584665A (product_id)');
        $this->addSql('ALTER TABLE order_item ADD qte INT NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_item DROP INDEX IDX_52EA1F094584665A, ADD UNIQUE INDEX UNIQ_52EA1F094584665A (product_id)');
        $this->addSql('ALTER TABLE order_item DROP qte');
    }
}