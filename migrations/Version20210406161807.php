<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210406161807 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, country_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, company_id VARCHAR(50) DEFAULT NULL, vat_number VARCHAR(50) DEFAULT NULL, created DATETIME NOT NULL, modify DATETIME DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(20) DEFAULT NULL, account_number VARCHAR(255) DEFAULT NULL, iban VARCHAR(255) DEFAULT NULL, is_supplier BOOLEAN DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_4FBF094FF92F3E70 ON company (country_id)');
        $this->addSql('CREATE TABLE country (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5373C9665E237E06 ON country (name)');
        $this->addSql('CREATE TABLE invoice (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, supplier_id INTEGER NOT NULL, subscriber_id INTEGER NOT NULL, payment_type_id INTEGER NOT NULL, user_id INTEGER DEFAULT NULL, due SMALLINT NOT NULL, invoice_created DATETIME NOT NULL, due_date DATE NOT NULL, payment_day DATE DEFAULT NULL, vs VARCHAR(20) DEFAULT NULL, ks VARCHAR(20) DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_90651744F1B0EC09 ON invoice (vs)');
        $this->addSql('CREATE INDEX IDX_906517442ADD6D8C ON invoice (supplier_id)');
        $this->addSql('CREATE INDEX IDX_906517447808B1AD ON invoice (subscriber_id)');
        $this->addSql('CREATE INDEX IDX_90651744DC058279 ON invoice (payment_type_id)');
        $this->addSql('CREATE INDEX IDX_90651744A76ED395 ON invoice (user_id)');
        $this->addSql('CREATE TABLE invoice_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, invoice_id INTEGER NOT NULL, vat SMALLINT NOT NULL, name VARCHAR(255) NOT NULL, unit_count DOUBLE PRECISION NOT NULL, price NUMERIC(10, 2) NOT NULL, discount SMALLINT NOT NULL, margin SMALLINT DEFAULT NULL, discount_total NUMERIC(10, 2) NOT NULL, margin_total NUMERIC(10, 2) NOT NULL, price_total NUMERIC(10, 2) NOT NULL, price_total_inc_vat NUMERIC(10, 2) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_1DDE477B2989F1FD ON invoice_item (invoice_id)');
        $this->addSql('CREATE TABLE payment_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, is_default BOOLEAN DEFAULT NULL)');
        $this->addSql('CREATE TABLE tariff (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price NUMERIC(10, 2) NOT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, last_login DATETIME NOT NULL, created DATETIME NOT NULL, password_changed DATETIME DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE TABLE vat (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, is_default BOOLEAN DEFAULT NULL, percent SMALLINT NOT NULL, multiplier NUMERIC(1, 2) NOT NULL)');
        $this->addSql('CREATE TABLE work_inventory (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, tariff_id INTEGER NOT NULL, user_id INTEGER NOT NULL, invoice_id INTEGER DEFAULT NULL, company_id INTEGER NOT NULL, describe VARCHAR(255) NOT NULL, work_start DATETIME NOT NULL, work_end DATETIME DEFAULT NULL, work_duration DOUBLE PRECISION DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_D325E26392348FD2 ON work_inventory (tariff_id)');
        $this->addSql('CREATE INDEX IDX_D325E263A76ED395 ON work_inventory (user_id)');
        $this->addSql('CREATE INDEX IDX_D325E2632989F1FD ON work_inventory (invoice_id)');
        $this->addSql('CREATE INDEX IDX_D325E263979B1AD6 ON work_inventory (company_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE invoice_item');
        $this->addSql('DROP TABLE payment_type');
        $this->addSql('DROP TABLE tariff');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vat');
        $this->addSql('DROP TABLE work_inventory');
    }
}
