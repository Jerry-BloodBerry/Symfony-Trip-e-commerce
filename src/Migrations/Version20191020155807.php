<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191020155807 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE booking_offer_booking_offer_type (booking_offer_id INT NOT NULL, booking_offer_type_id INT NOT NULL, INDEX IDX_D8845E2968F2EA63 (booking_offer_id), INDEX IDX_D8845E296F7D0A5A (booking_offer_type_id), PRIMARY KEY(booking_offer_id, booking_offer_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking_offer_booking_offer_type ADD CONSTRAINT FK_D8845E2968F2EA63 FOREIGN KEY (booking_offer_id) REFERENCES booking_offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booking_offer_booking_offer_type ADD CONSTRAINT FK_D8845E296F7D0A5A FOREIGN KEY (booking_offer_type_id) REFERENCES booking_offer_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booking_offer ADD destination_id INT NOT NULL');
        $this->addSql('ALTER TABLE booking_offer ADD CONSTRAINT FK_B8AA7A8B816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id)');
        $this->addSql('CREATE INDEX IDX_B8AA7A8B816C6140 ON booking_offer (destination_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE booking_offer_booking_offer_type');
        $this->addSql('ALTER TABLE booking_offer DROP FOREIGN KEY FK_B8AA7A8B816C6140');
        $this->addSql('DROP INDEX IDX_B8AA7A8B816C6140 ON booking_offer');
        $this->addSql('ALTER TABLE booking_offer DROP destination_id');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
