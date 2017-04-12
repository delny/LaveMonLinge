<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170412095402 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product_type_vetement DROP FOREIGN KEY FK_2BA67DC1DD845CF6');
        $this->addSql('CREATE TABLE product_type_clothing (product_id INT NOT NULL, type_clothing_id INT NOT NULL, INDEX IDX_48E03BF4584665A (product_id), INDEX IDX_48E03BF7E2E501 (type_clothing_id), PRIMARY KEY(product_id, type_clothing_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_clothing (id INT AUTO_INCREMENT NOT NULL, `label` VARCHAR(255) NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_type_clothing ADD CONSTRAINT FK_48E03BF4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_type_clothing ADD CONSTRAINT FK_48E03BF7E2E501 FOREIGN KEY (type_clothing_id) REFERENCES type_clothing (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE product_type_vetement');
        $this->addSql('DROP TABLE type_vetement');
        $this->addSql('ALTER TABLE option_laundry CHANGE libelle `label` VARCHAR(255) NOT NULL, CHANGE prix price INT NOT NULL');
        $this->addSql('ALTER TABLE orderlaundry ADD dataCollect DATETIME NOT NULL, ADD dataDelivery DATETIME NOT NULL, ADD nbBags INT NOT NULL, ADD priceDelivery INT NOT NULL, DROP datecollecte, DROP datelivraison, DROP nombreSacs, DROP prixLivraison');
        $this->addSql('ALTER TABLE product CHANGE nom name VARCHAR(255) NOT NULL, CHANGE prix price INT NOT NULL');
        $this->addSql('ALTER TABLE statut DROP FOREIGN KEY FK_E564F0BF28D3A508');
        $this->addSql('ALTER TABLE statut DROP FOREIGN KEY FK_E564F0BF82EA2E54');
        $this->addSql('DROP INDEX IDX_E564F0BF82EA2E54 ON statut');
        $this->addSql('DROP INDEX IDX_E564F0BF28D3A508 ON statut');
        $this->addSql('ALTER TABLE statut ADD order_laundry_id INT DEFAULT NULL, ADD order_item_id INT DEFAULT NULL, DROP orderitem_id, DROP commande_id, CHANGE libelle `label` VARCHAR(255) NOT NULL, CHANGE datechangement dataUpdate DATETIME NOT NULL');
        $this->addSql('ALTER TABLE statut ADD CONSTRAINT FK_E564F0BF70EA41A1 FOREIGN KEY (order_laundry_id) REFERENCES orderlaundry (id)');
        $this->addSql('ALTER TABLE statut ADD CONSTRAINT FK_E564F0BFE415FB15 FOREIGN KEY (order_item_id) REFERENCES order_item (id)');
        $this->addSql('CREATE INDEX IDX_E564F0BF70EA41A1 ON statut (order_laundry_id)');
        $this->addSql('CREATE INDEX IDX_E564F0BFE415FB15 ON statut (order_item_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product_type_clothing DROP FOREIGN KEY FK_48E03BF7E2E501');
        $this->addSql('CREATE TABLE product_type_vetement (product_id INT NOT NULL, type_vetement_id INT NOT NULL, INDEX IDX_2BA67DC14584665A (product_id), INDEX IDX_2BA67DC1DD845CF6 (type_vetement_id), PRIMARY KEY(product_id, type_vetement_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_vetement (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, prix INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_type_vetement ADD CONSTRAINT FK_2BA67DC14584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_type_vetement ADD CONSTRAINT FK_2BA67DC1DD845CF6 FOREIGN KEY (type_vetement_id) REFERENCES type_vetement (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE product_type_clothing');
        $this->addSql('DROP TABLE type_clothing');
        $this->addSql('ALTER TABLE option_laundry CHANGE `label` libelle VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE price prix INT NOT NULL');
        $this->addSql('ALTER TABLE orderlaundry ADD datecollecte DATETIME NOT NULL, ADD datelivraison DATETIME NOT NULL, ADD nombreSacs INT NOT NULL, ADD prixLivraison INT NOT NULL, DROP dataCollect, DROP dataDelivery, DROP nbBags, DROP priceDelivery');
        $this->addSql('ALTER TABLE product CHANGE name nom VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE price prix INT NOT NULL');
        $this->addSql('ALTER TABLE statut DROP FOREIGN KEY FK_E564F0BF70EA41A1');
        $this->addSql('ALTER TABLE statut DROP FOREIGN KEY FK_E564F0BFE415FB15');
        $this->addSql('DROP INDEX IDX_E564F0BF70EA41A1 ON statut');
        $this->addSql('DROP INDEX IDX_E564F0BFE415FB15 ON statut');
        $this->addSql('ALTER TABLE statut ADD orderitem_id INT DEFAULT NULL, ADD commande_id INT DEFAULT NULL, DROP order_laundry_id, DROP order_item_id, CHANGE `label` libelle VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE dataupdate dateChangement DATETIME NOT NULL');
        $this->addSql('ALTER TABLE statut ADD CONSTRAINT FK_E564F0BF28D3A508 FOREIGN KEY (orderitem_id) REFERENCES order_item (id)');
        $this->addSql('ALTER TABLE statut ADD CONSTRAINT FK_E564F0BF82EA2E54 FOREIGN KEY (commande_id) REFERENCES orderlaundry (id)');
        $this->addSql('CREATE INDEX IDX_E564F0BF82EA2E54 ON statut (commande_id)');
        $this->addSql('CREATE INDEX IDX_E564F0BF28D3A508 ON statut (orderitem_id)');
    }
}
