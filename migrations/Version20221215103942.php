<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221215103942 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE app_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE booking_offer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE booking_offer_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE career_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE continent_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE customers_rating_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE destination_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE newsletter_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reservation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE app_user (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, registration_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88BDF3E9E7927C74 ON app_user (email)');
        $this->addSql('CREATE TABLE booking_offer (id INT NOT NULL, offer_type_id INT NOT NULL, destination_id INT NOT NULL, offer_name VARCHAR(255) NOT NULL, package_id INT NOT NULL, offer_price NUMERIC(6, 2) NOT NULL, child_price NUMERIC(6, 2) NOT NULL, description TEXT NOT NULL, booking_start_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, booking_end_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, departure_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, comeback_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, departure_spot VARCHAR(255) NOT NULL, comeback_spot VARCHAR(255) NOT NULL, is_featured BOOLEAN NOT NULL, photos_directory VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B8AA7A8B64444A9A ON booking_offer (offer_type_id)');
        $this->addSql('CREATE INDEX IDX_B8AA7A8B816C6140 ON booking_offer (destination_id)');
        $this->addSql('CREATE TABLE booking_offer_type (id INT NOT NULL, type_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE career (id INT NOT NULL, job_title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, requirements VARCHAR(255) NOT NULL, salary NUMERIC(7, 2) DEFAULT NULL, recruitment_start_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, recruitment_end_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE continent (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE customers_rating (id INT NOT NULL, user_id INT NOT NULL, package INT NOT NULL, rating INT NOT NULL, comment VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_93BE1206A76ED395 ON customers_rating (user_id)');
        $this->addSql('CREATE TABLE destination (id INT NOT NULL, continent_id INT NOT NULL, destination_name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3EC63EAA921F4C77 ON destination (continent_id)');
        $this->addSql('CREATE TABLE newsletter (id INT NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE reservation (id INT NOT NULL, user_id INT NOT NULL, booking_offer_id INT NOT NULL, date_of_booking TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, adult_number INT NOT NULL, child_number INT NOT NULL, is_paid_for BOOLEAN NOT NULL, bank_transfer_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, bank_transfer_title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_42C84955A76ED395 ON reservation (user_id)');
        $this->addSql('CREATE INDEX IDX_42C8495568F2EA63 ON reservation (booking_offer_id)');
        $this->addSql('ALTER TABLE booking_offer ADD CONSTRAINT FK_B8AA7A8B64444A9A FOREIGN KEY (offer_type_id) REFERENCES booking_offer_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE booking_offer ADD CONSTRAINT FK_B8AA7A8B816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customers_rating ADD CONSTRAINT FK_93BE1206A76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE destination ADD CONSTRAINT FK_3EC63EAA921F4C77 FOREIGN KEY (continent_id) REFERENCES continent (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495568F2EA63 FOREIGN KEY (booking_offer_id) REFERENCES booking_offer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE customers_rating DROP CONSTRAINT FK_93BE1206A76ED395');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C84955A76ED395');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C8495568F2EA63');
        $this->addSql('ALTER TABLE booking_offer DROP CONSTRAINT FK_B8AA7A8B64444A9A');
        $this->addSql('ALTER TABLE destination DROP CONSTRAINT FK_3EC63EAA921F4C77');
        $this->addSql('ALTER TABLE booking_offer DROP CONSTRAINT FK_B8AA7A8B816C6140');
        $this->addSql('DROP SEQUENCE app_user_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE booking_offer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE booking_offer_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE career_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE continent_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE customers_rating_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE destination_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE newsletter_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reservation_id_seq CASCADE');
        $this->addSql('DROP TABLE app_user');
        $this->addSql('DROP TABLE booking_offer');
        $this->addSql('DROP TABLE booking_offer_type');
        $this->addSql('DROP TABLE career');
        $this->addSql('DROP TABLE continent');
        $this->addSql('DROP TABLE customers_rating');
        $this->addSql('DROP TABLE destination');
        $this->addSql('DROP TABLE newsletter');
        $this->addSql('DROP TABLE reservation');
    }
}
