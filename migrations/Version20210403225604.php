<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210403225604 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_4FBF094FF92F3E70');
        $this->addSql('CREATE TEMPORARY TABLE __temp__company AS SELECT id, country_id, name, description, company_id, vat_number, created, modify, street, city, zip_code, account_number, iban FROM company');
        $this->addSql('DROP TABLE company');
        $this->addSql('CREATE TABLE company (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, country_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, description VARCHAR(255) DEFAULT NULL COLLATE BINARY, company_id VARCHAR(50) DEFAULT NULL COLLATE BINARY, vat_number VARCHAR(50) DEFAULT NULL COLLATE BINARY, created DATETIME NOT NULL, modify DATETIME DEFAULT NULL, street VARCHAR(255) DEFAULT NULL COLLATE BINARY, city VARCHAR(255) DEFAULT NULL COLLATE BINARY, zip_code VARCHAR(20) DEFAULT NULL COLLATE BINARY, account_number VARCHAR(255) DEFAULT NULL COLLATE BINARY, iban VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_4FBF094FF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO company (id, country_id, name, description, company_id, vat_number, created, modify, street, city, zip_code, account_number, iban) SELECT id, country_id, name, description, company_id, vat_number, created, modify, street, city, zip_code, account_number, iban FROM __temp__company');
        $this->addSql('DROP TABLE __temp__company');
        $this->addSql('CREATE INDEX IDX_4FBF094FF92F3E70 ON company (country_id)');
        $this->addSql('DROP INDEX IDX_90651744DC058279');
        $this->addSql('DROP INDEX IDX_906517447808B1AD');
        $this->addSql('DROP INDEX IDX_906517442ADD6D8C');
        $this->addSql('DROP INDEX IDX_90651744A76ED395');
        $this->addSql('DROP INDEX UNIQ_90651744F1B0EC09');
        $this->addSql('CREATE TEMPORARY TABLE __temp__invoice AS SELECT id, supplier_id, subscriber_id, payment_type_id, user_id, due, invoice_created, due_date, payment_day, vs, ks FROM invoice');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('CREATE TABLE invoice (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, supplier_id INTEGER NOT NULL, subscriber_id INTEGER NOT NULL, payment_type_id INTEGER NOT NULL, user_id INTEGER DEFAULT NULL, due SMALLINT NOT NULL, invoice_created DATETIME NOT NULL, due_date DATE NOT NULL, payment_day DATE DEFAULT NULL, vs VARCHAR(20) NOT NULL COLLATE BINARY, ks VARCHAR(20) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_906517442ADD6D8C FOREIGN KEY (supplier_id) REFERENCES company (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_906517447808B1AD FOREIGN KEY (subscriber_id) REFERENCES company (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_90651744DC058279 FOREIGN KEY (payment_type_id) REFERENCES payment_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_90651744A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO invoice (id, supplier_id, subscriber_id, payment_type_id, user_id, due, invoice_created, due_date, payment_day, vs, ks) SELECT id, supplier_id, subscriber_id, payment_type_id, user_id, due, invoice_created, due_date, payment_day, vs, ks FROM __temp__invoice');
        $this->addSql('DROP TABLE __temp__invoice');
        $this->addSql('CREATE INDEX IDX_90651744DC058279 ON invoice (payment_type_id)');
        $this->addSql('CREATE INDEX IDX_906517447808B1AD ON invoice (subscriber_id)');
        $this->addSql('CREATE INDEX IDX_906517442ADD6D8C ON invoice (supplier_id)');
        $this->addSql('CREATE INDEX IDX_90651744A76ED395 ON invoice (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_90651744F1B0EC09 ON invoice (vs)');
        $this->addSql('DROP INDEX IDX_1DDE477B2989F1FD');
        $this->addSql('CREATE TEMPORARY TABLE __temp__invoice_item AS SELECT id, invoice_id, name, unit_count, price, discount, margin, vat, discount_total, margin_total, price_total, price_total_inc_vat FROM invoice_item');
        $this->addSql('DROP TABLE invoice_item');
        $this->addSql('CREATE TABLE invoice_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, invoice_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, unit_count SMALLINT NOT NULL, price NUMERIC(10, 2) NOT NULL, discount SMALLINT NOT NULL, margin SMALLINT DEFAULT NULL, vat SMALLINT NOT NULL, discount_total NUMERIC(10, 2) NOT NULL, margin_total NUMERIC(10, 2) NOT NULL, price_total NUMERIC(10, 2) NOT NULL, price_total_inc_vat NUMERIC(10, 2) NOT NULL, CONSTRAINT FK_1DDE477B2989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO invoice_item (id, invoice_id, name, unit_count, price, discount, margin, vat, discount_total, margin_total, price_total, price_total_inc_vat) SELECT id, invoice_id, name, unit_count, price, discount, margin, vat, discount_total, margin_total, price_total, price_total_inc_vat FROM __temp__invoice_item');
        $this->addSql('DROP TABLE __temp__invoice_item');
        $this->addSql('CREATE INDEX IDX_1DDE477B2989F1FD ON invoice_item (invoice_id)');
        $this->addSql('DROP INDEX IDX_D325E26392348FD2');
        $this->addSql('DROP INDEX IDX_D325E263979B1AD6');
        $this->addSql('DROP INDEX IDX_D325E263A76ED395');
        $this->addSql('DROP INDEX IDX_D325E2632989F1FD');
        $this->addSql('CREATE TEMPORARY TABLE __temp__work_inventory AS SELECT id, user_id, invoice_id, company_id, tariff_id, describe, work_start, work_end, work_duration FROM work_inventory');
        $this->addSql('DROP TABLE work_inventory');
        $this->addSql('CREATE TABLE work_inventory (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, invoice_id INTEGER DEFAULT NULL, company_id INTEGER NOT NULL, tariff_id INTEGER NOT NULL, describe VARCHAR(255) NOT NULL COLLATE BINARY, work_start DATETIME NOT NULL, work_end DATETIME DEFAULT NULL, work_duration DOUBLE PRECISION DEFAULT NULL, CONSTRAINT FK_D325E26392348FD2 FOREIGN KEY (tariff_id) REFERENCES tariff (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D325E263A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D325E2632989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D325E263979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO work_inventory (id, user_id, invoice_id, company_id, tariff_id, describe, work_start, work_end, work_duration) SELECT id, user_id, invoice_id, company_id, tariff_id, describe, work_start, work_end, work_duration FROM __temp__work_inventory');
        $this->addSql('DROP TABLE __temp__work_inventory');
        $this->addSql('CREATE INDEX IDX_D325E26392348FD2 ON work_inventory (tariff_id)');
        $this->addSql('CREATE INDEX IDX_D325E263979B1AD6 ON work_inventory (company_id)');
        $this->addSql('CREATE INDEX IDX_D325E263A76ED395 ON work_inventory (user_id)');
        $this->addSql('CREATE INDEX IDX_D325E2632989F1FD ON work_inventory (invoice_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_4FBF094FF92F3E70');
        $this->addSql('CREATE TEMPORARY TABLE __temp__company AS SELECT id, country_id, name, description, company_id, vat_number, created, modify, street, city, zip_code, account_number, iban FROM company');
        $this->addSql('DROP TABLE company');
        $this->addSql('CREATE TABLE company (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, country_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, company_id VARCHAR(50) DEFAULT NULL, vat_number VARCHAR(50) DEFAULT NULL, created DATETIME NOT NULL, modify DATETIME DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(20) DEFAULT NULL, account_number VARCHAR(255) DEFAULT NULL, iban VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO company (id, country_id, name, description, company_id, vat_number, created, modify, street, city, zip_code, account_number, iban) SELECT id, country_id, name, description, company_id, vat_number, created, modify, street, city, zip_code, account_number, iban FROM __temp__company');
        $this->addSql('DROP TABLE __temp__company');
        $this->addSql('CREATE INDEX IDX_4FBF094FF92F3E70 ON company (country_id)');
        $this->addSql('DROP INDEX UNIQ_90651744F1B0EC09');
        $this->addSql('DROP INDEX IDX_906517442ADD6D8C');
        $this->addSql('DROP INDEX IDX_906517447808B1AD');
        $this->addSql('DROP INDEX IDX_90651744DC058279');
        $this->addSql('DROP INDEX IDX_90651744A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__invoice AS SELECT id, supplier_id, subscriber_id, payment_type_id, user_id, due, invoice_created, due_date, payment_day, vs, ks FROM invoice');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('CREATE TABLE invoice (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, supplier_id INTEGER NOT NULL, subscriber_id INTEGER NOT NULL, payment_type_id INTEGER NOT NULL, user_id INTEGER DEFAULT NULL, due SMALLINT NOT NULL, invoice_created DATETIME NOT NULL, due_date DATE NOT NULL, payment_day DATE DEFAULT NULL, vs VARCHAR(20) NOT NULL, ks VARCHAR(20) DEFAULT NULL)');
        $this->addSql('INSERT INTO invoice (id, supplier_id, subscriber_id, payment_type_id, user_id, due, invoice_created, due_date, payment_day, vs, ks) SELECT id, supplier_id, subscriber_id, payment_type_id, user_id, due, invoice_created, due_date, payment_day, vs, ks FROM __temp__invoice');
        $this->addSql('DROP TABLE __temp__invoice');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_90651744F1B0EC09 ON invoice (vs)');
        $this->addSql('CREATE INDEX IDX_906517442ADD6D8C ON invoice (supplier_id)');
        $this->addSql('CREATE INDEX IDX_906517447808B1AD ON invoice (subscriber_id)');
        $this->addSql('CREATE INDEX IDX_90651744DC058279 ON invoice (payment_type_id)');
        $this->addSql('CREATE INDEX IDX_90651744A76ED395 ON invoice (user_id)');
        $this->addSql('DROP INDEX IDX_1DDE477B2989F1FD');
        $this->addSql('CREATE TEMPORARY TABLE __temp__invoice_item AS SELECT id, invoice_id, vat, name, unit_count, price, discount, margin, discount_total, margin_total, price_total, price_total_inc_vat FROM invoice_item');
        $this->addSql('DROP TABLE invoice_item');
        $this->addSql('CREATE TABLE invoice_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, invoice_id INTEGER NOT NULL, vat SMALLINT NOT NULL, name VARCHAR(255) NOT NULL, unit_count SMALLINT NOT NULL, price NUMERIC(10, 2) NOT NULL, discount SMALLINT NOT NULL, margin SMALLINT DEFAULT NULL, discount_total NUMERIC(10, 2) NOT NULL, margin_total NUMERIC(10, 2) NOT NULL, price_total NUMERIC(10, 2) NOT NULL, price_total_inc_vat NUMERIC(10, 2) NOT NULL)');
        $this->addSql('INSERT INTO invoice_item (id, invoice_id, vat, name, unit_count, price, discount, margin, discount_total, margin_total, price_total, price_total_inc_vat) SELECT id, invoice_id, vat, name, unit_count, price, discount, margin, discount_total, margin_total, price_total, price_total_inc_vat FROM __temp__invoice_item');
        $this->addSql('DROP TABLE __temp__invoice_item');
        $this->addSql('CREATE INDEX IDX_1DDE477B2989F1FD ON invoice_item (invoice_id)');
        $this->addSql('DROP INDEX IDX_D325E26392348FD2');
        $this->addSql('DROP INDEX IDX_D325E263A76ED395');
        $this->addSql('DROP INDEX IDX_D325E2632989F1FD');
        $this->addSql('DROP INDEX IDX_D325E263979B1AD6');
        $this->addSql('CREATE TEMPORARY TABLE __temp__work_inventory AS SELECT id, tariff_id, user_id, invoice_id, company_id, describe, work_start, work_end, work_duration FROM work_inventory');
        $this->addSql('DROP TABLE work_inventory');
        $this->addSql('CREATE TABLE work_inventory (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, tariff_id INTEGER NOT NULL, user_id INTEGER NOT NULL, invoice_id INTEGER DEFAULT NULL, company_id INTEGER NOT NULL, describe VARCHAR(255) NOT NULL, work_start DATETIME NOT NULL, work_end DATETIME DEFAULT NULL, work_duration DOUBLE PRECISION DEFAULT NULL)');
        $this->addSql('INSERT INTO work_inventory (id, tariff_id, user_id, invoice_id, company_id, describe, work_start, work_end, work_duration) SELECT id, tariff_id, user_id, invoice_id, company_id, describe, work_start, work_end, work_duration FROM __temp__work_inventory');
        $this->addSql('DROP TABLE __temp__work_inventory');
        $this->addSql('CREATE INDEX IDX_D325E26392348FD2 ON work_inventory (tariff_id)');
        $this->addSql('CREATE INDEX IDX_D325E263A76ED395 ON work_inventory (user_id)');
        $this->addSql('CREATE INDEX IDX_D325E2632989F1FD ON work_inventory (invoice_id)');
        $this->addSql('CREATE INDEX IDX_D325E263979B1AD6 ON work_inventory (company_id)');
    }
}
