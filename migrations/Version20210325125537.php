<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210325125537 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE payment_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, last_login DATETIME NOT NULL, created DATETIME NOT NULL, password_changed DATETIME DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
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
        $this->addSql('DROP TABLE payment_type');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_4FBF094FF92F3E70');
        $this->addSql('CREATE TEMPORARY TABLE __temp__company AS SELECT id, country_id, name, description, company_id, vat_number, created, modify, street, city, zip_code, account_number, iban FROM company');
        $this->addSql('DROP TABLE company');
        $this->addSql('CREATE TABLE company (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, country_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, company_id VARCHAR(50) DEFAULT NULL, vat_number VARCHAR(50) DEFAULT NULL, created DATETIME NOT NULL, modify DATETIME DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(20) DEFAULT NULL, account_number VARCHAR(255) DEFAULT NULL, iban VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO company (id, country_id, name, description, company_id, vat_number, created, modify, street, city, zip_code, account_number, iban) SELECT id, country_id, name, description, company_id, vat_number, created, modify, street, city, zip_code, account_number, iban FROM __temp__company');
        $this->addSql('DROP TABLE __temp__company');
        $this->addSql('CREATE INDEX IDX_4FBF094FF92F3E70 ON company (country_id)');
    }
}
