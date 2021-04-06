<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210325140412 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE invoice (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, supplier_id INTEGER NOT NULL, subscriber_id INTEGER NOT NULL, payment_type_id INTEGER NOT NULL, user_created_id INTEGER DEFAULT NULL, due SMALLINT NOT NULL, invoice_created DATETIME NOT NULL, due_date DATE NOT NULL, payment_day DATE DEFAULT NULL, vs VARCHAR(20) NOT NULL, ks VARCHAR(20) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_906517442ADD6D8C ON invoice (supplier_id)');
        $this->addSql('CREATE INDEX IDX_906517447808B1AD ON invoice (subscriber_id)');
        $this->addSql('CREATE INDEX IDX_90651744DC058279 ON invoice (payment_type_id)');
        $this->addSql('CREATE INDEX IDX_90651744F987D8A8 ON invoice (user_created_id)');
        $this->addSql('CREATE TABLE invoice_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, invoice_id INTEGER NOT NULL, vat_id INTEGER NOT NULL, unit_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, unit_count SMALLINT NOT NULL, price NUMERIC(10, 2) NOT NULL, discount SMALLINT NOT NULL, margin SMALLINT DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_1DDE477B2989F1FD ON invoice_item (invoice_id)');
        $this->addSql('CREATE INDEX IDX_1DDE477BB5B63A6B ON invoice_item (vat_id)');
        $this->addSql('CREATE INDEX IDX_1DDE477BF8BD700D ON invoice_item (unit_id)');
        $this->addSql('CREATE TABLE unit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(50) NOT NULL, abbreviation VARCHAR(10) NOT NULL)');
        $this->addSql('CREATE TABLE vat (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(50) NOT NULL, multiplier DOUBLE PRECISION NOT NULL, is_default BOOLEAN NOT NULL, percent SMALLINT NOT NULL)');
        $this->addSql('DROP INDEX IDX_4FBF094FF92F3E70');
        $this->addSql('CREATE TEMPORARY TABLE __temp__company AS SELECT id, country_id, name, description, company_id, vat_number, created, modify, street, city, zip_code, account_number, iban FROM company');
        $this->addSql('DROP TABLE company');
        $this->addSql('CREATE TABLE company (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, country_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, description VARCHAR(255) DEFAULT NULL COLLATE BINARY, company_id VARCHAR(50) DEFAULT NULL COLLATE BINARY, vat_number VARCHAR(50) DEFAULT NULL COLLATE BINARY, created DATETIME NOT NULL, modify DATETIME DEFAULT NULL, street VARCHAR(255) DEFAULT NULL COLLATE BINARY, city VARCHAR(255) DEFAULT NULL COLLATE BINARY, zip_code VARCHAR(20) DEFAULT NULL COLLATE BINARY, account_number VARCHAR(255) DEFAULT NULL COLLATE BINARY, iban VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_4FBF094FF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO company (id, country_id, name, description, company_id, vat_number, created, modify, street, city, zip_code, account_number, iban) SELECT id, country_id, name, description, company_id, vat_number, created, modify, street, city, zip_code, account_number, iban FROM __temp__company');
        $this->addSql('DROP TABLE __temp__company');
        $this->addSql('CREATE INDEX IDX_4FBF094FF92F3E70 ON company (country_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE invoice_item');
        $this->addSql('DROP TABLE unit');
        $this->addSql('DROP TABLE vat');
        $this->addSql('DROP INDEX IDX_4FBF094FF92F3E70');
        $this->addSql('CREATE TEMPORARY TABLE __temp__company AS SELECT id, country_id, name, description, company_id, vat_number, created, modify, street, city, zip_code, account_number, iban FROM company');
        $this->addSql('DROP TABLE company');
        $this->addSql('CREATE TABLE company (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, country_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, company_id VARCHAR(50) DEFAULT NULL, vat_number VARCHAR(50) DEFAULT NULL, created DATETIME NOT NULL, modify DATETIME DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(20) DEFAULT NULL, account_number VARCHAR(255) DEFAULT NULL, iban VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO company (id, country_id, name, description, company_id, vat_number, created, modify, street, city, zip_code, account_number, iban) SELECT id, country_id, name, description, company_id, vat_number, created, modify, street, city, zip_code, account_number, iban FROM __temp__company');
        $this->addSql('DROP TABLE __temp__company');
        $this->addSql('CREATE INDEX IDX_4FBF094FF92F3E70 ON company (country_id)');
    }
}
