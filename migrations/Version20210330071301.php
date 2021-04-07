<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330071301 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE unit');
        $this->addSql('DROP TABLE vat');
        $this->addSql('DROP INDEX IDX_4FBF094FF92F3E70');
        $this->addSql('CREATE TEMPORARY TABLE __temp__company AS SELECT id, country_id, name, description, company_id, vat_number, created, modify, street, city, zip_code, account_number, iban FROM company');
        $this->addSql('DROP TABLE company');
        $this->addSql('CREATE TABLE company (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, country_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, description VARCHAR(255) DEFAULT NULL COLLATE BINARY, company_id VARCHAR(50) DEFAULT NULL COLLATE BINARY, vat_number VARCHAR(50) DEFAULT NULL COLLATE BINARY, created DATETIME NOT NULL, modify DATETIME DEFAULT NULL, street VARCHAR(255) DEFAULT NULL COLLATE BINARY, city VARCHAR(255) DEFAULT NULL COLLATE BINARY, zip_code VARCHAR(20) DEFAULT NULL COLLATE BINARY, account_number VARCHAR(255) DEFAULT NULL COLLATE BINARY, iban VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_4FBF094FF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO company (id, country_id, name, description, company_id, vat_number, created, modify, street, city, zip_code, account_number, iban) SELECT id, country_id, name, description, company_id, vat_number, created, modify, street, city, zip_code, account_number, iban FROM __temp__company');
        $this->addSql('DROP TABLE __temp__company');
        $this->addSql('CREATE INDEX IDX_4FBF094FF92F3E70 ON company (country_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__country AS SELECT id, name FROM country');
        $this->addSql('DROP TABLE country');
        $this->addSql('CREATE TABLE country (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO country (id, name) SELECT id, name FROM __temp__country');
        $this->addSql('DROP TABLE __temp__country');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5373C9665E237E06 ON country (name)');
        $this->addSql('DROP INDEX IDX_90651744F987D8A8');
        $this->addSql('DROP INDEX IDX_90651744DC058279');
        $this->addSql('DROP INDEX IDX_906517447808B1AD');
        $this->addSql('DROP INDEX IDX_906517442ADD6D8C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__invoice AS SELECT id, supplier_id, subscriber_id, payment_type_id, user_created_id, due, invoice_created, due_date, payment_day, vs, ks FROM invoice');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('CREATE TABLE invoice (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, supplier_id INTEGER NOT NULL, subscriber_id INTEGER NOT NULL, payment_type_id INTEGER NOT NULL, user_id INTEGER DEFAULT NULL, due SMALLINT NOT NULL, invoice_created DATETIME NOT NULL, due_date DATE NOT NULL, payment_day DATE DEFAULT NULL, vs VARCHAR(20) NOT NULL COLLATE BINARY, ks VARCHAR(20) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_906517442ADD6D8C FOREIGN KEY (supplier_id) REFERENCES company (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_906517447808B1AD FOREIGN KEY (subscriber_id) REFERENCES company (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_90651744DC058279 FOREIGN KEY (payment_type_id) REFERENCES payment_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_90651744A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO invoice (id, supplier_id, subscriber_id, payment_type_id, user_id, due, invoice_created, due_date, payment_day, vs, ks) SELECT id, supplier_id, subscriber_id, payment_type_id, user_created_id, due, invoice_created, due_date, payment_day, vs, ks FROM __temp__invoice');
        $this->addSql('DROP TABLE __temp__invoice');
        $this->addSql('CREATE INDEX IDX_90651744DC058279 ON invoice (payment_type_id)');
        $this->addSql('CREATE INDEX IDX_906517447808B1AD ON invoice (subscriber_id)');
        $this->addSql('CREATE INDEX IDX_906517442ADD6D8C ON invoice (supplier_id)');
        $this->addSql('CREATE INDEX IDX_90651744A76ED395 ON invoice (user_id)');
        $this->addSql('DROP INDEX IDX_1DDE477BF8BD700D');
        $this->addSql('DROP INDEX IDX_1DDE477BB5B63A6B');
        $this->addSql('DROP INDEX IDX_1DDE477B2989F1FD');
        $this->addSql('CREATE TEMPORARY TABLE __temp__invoice_item AS SELECT id, invoice_id, name, unit_count, price, discount, margin FROM invoice_item');
        $this->addSql('DROP TABLE invoice_item');
        $this->addSql('CREATE TABLE invoice_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, invoice_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, unit_count SMALLINT NOT NULL, price NUMERIC(10, 2) NOT NULL, discount SMALLINT NOT NULL, margin SMALLINT DEFAULT NULL, vat SMALLINT NOT NULL, CONSTRAINT FK_1DDE477B2989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO invoice_item (id, invoice_id, name, unit_count, price, discount, margin) SELECT id, invoice_id, name, unit_count, price, discount, margin FROM __temp__invoice_item');
        $this->addSql('DROP TABLE __temp__invoice_item');
        $this->addSql('CREATE INDEX IDX_1DDE477B2989F1FD ON invoice_item (invoice_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE unit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(50) NOT NULL COLLATE BINARY, abbreviation VARCHAR(10) NOT NULL COLLATE BINARY)');
        $this->addSql('CREATE TABLE vat (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(50) NOT NULL COLLATE BINARY, multiplier DOUBLE PRECISION NOT NULL, is_default BOOLEAN NOT NULL, percent SMALLINT NOT NULL)');
        $this->addSql('DROP INDEX IDX_4FBF094FF92F3E70');
        $this->addSql('CREATE TEMPORARY TABLE __temp__company AS SELECT id, country_id, name, description, company_id, vat_number, created, modify, street, city, zip_code, account_number, iban FROM company');
        $this->addSql('DROP TABLE company');
        $this->addSql('CREATE TABLE company (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, country_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, company_id VARCHAR(50) DEFAULT NULL, vat_number VARCHAR(50) DEFAULT NULL, created DATETIME NOT NULL, modify DATETIME DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(20) DEFAULT NULL, account_number VARCHAR(255) DEFAULT NULL, iban VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO company (id, country_id, name, description, company_id, vat_number, created, modify, street, city, zip_code, account_number, iban) SELECT id, country_id, name, description, company_id, vat_number, created, modify, street, city, zip_code, account_number, iban FROM __temp__company');
        $this->addSql('DROP TABLE __temp__company');
        $this->addSql('CREATE INDEX IDX_4FBF094FF92F3E70 ON company (country_id)');
        $this->addSql('DROP INDEX UNIQ_5373C9665E237E06');
        $this->addSql('CREATE TEMPORARY TABLE __temp__country AS SELECT id, name FROM country');
        $this->addSql('DROP TABLE country');
        $this->addSql('CREATE TABLE country (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO country (id, name) SELECT id, name FROM __temp__country');
        $this->addSql('DROP TABLE __temp__country');
        $this->addSql('DROP INDEX IDX_906517442ADD6D8C');
        $this->addSql('DROP INDEX IDX_906517447808B1AD');
        $this->addSql('DROP INDEX IDX_90651744DC058279');
        $this->addSql('DROP INDEX IDX_90651744A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__invoice AS SELECT id, supplier_id, subscriber_id, payment_type_id, user_id, due, invoice_created, due_date, payment_day, vs, ks FROM invoice');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('CREATE TABLE invoice (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, supplier_id INTEGER NOT NULL, subscriber_id INTEGER NOT NULL, payment_type_id INTEGER NOT NULL, due SMALLINT NOT NULL, invoice_created DATETIME NOT NULL, due_date DATE NOT NULL, payment_day DATE DEFAULT NULL, vs VARCHAR(20) NOT NULL, ks VARCHAR(20) DEFAULT NULL, user_created_id INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO invoice (id, supplier_id, subscriber_id, payment_type_id, user_created_id, due, invoice_created, due_date, payment_day, vs, ks) SELECT id, supplier_id, subscriber_id, payment_type_id, user_id, due, invoice_created, due_date, payment_day, vs, ks FROM __temp__invoice');
        $this->addSql('DROP TABLE __temp__invoice');
        $this->addSql('CREATE INDEX IDX_906517442ADD6D8C ON invoice (supplier_id)');
        $this->addSql('CREATE INDEX IDX_906517447808B1AD ON invoice (subscriber_id)');
        $this->addSql('CREATE INDEX IDX_90651744DC058279 ON invoice (payment_type_id)');
        $this->addSql('CREATE INDEX IDX_90651744F987D8A8 ON invoice (user_created_id)');
        $this->addSql('DROP INDEX IDX_1DDE477B2989F1FD');
        $this->addSql('CREATE TEMPORARY TABLE __temp__invoice_item AS SELECT id, invoice_id, name, unit_count, price, discount, margin FROM invoice_item');
        $this->addSql('DROP TABLE invoice_item');
        $this->addSql('CREATE TABLE invoice_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, invoice_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, unit_count SMALLINT NOT NULL, price NUMERIC(10, 2) NOT NULL, discount SMALLINT NOT NULL, margin SMALLINT DEFAULT NULL, vat_id INTEGER NOT NULL, unit_id INTEGER NOT NULL)');
        $this->addSql('INSERT INTO invoice_item (id, invoice_id, name, unit_count, price, discount, margin) SELECT id, invoice_id, name, unit_count, price, discount, margin FROM __temp__invoice_item');
        $this->addSql('DROP TABLE __temp__invoice_item');
        $this->addSql('CREATE INDEX IDX_1DDE477B2989F1FD ON invoice_item (invoice_id)');
        $this->addSql('CREATE INDEX IDX_1DDE477BF8BD700D ON invoice_item (unit_id)');
        $this->addSql('CREATE INDEX IDX_1DDE477BB5B63A6B ON invoice_item (vat_id)');
    }
}
