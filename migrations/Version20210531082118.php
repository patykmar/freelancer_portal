<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210531082118 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, country_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, company_id VARCHAR(50) DEFAULT NULL, vat_number VARCHAR(50) DEFAULT NULL, created DATETIME NOT NULL, modify DATETIME DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(20) DEFAULT NULL, account_number VARCHAR(255) DEFAULT NULL, iban VARCHAR(255) DEFAULT NULL, is_supplier TINYINT(1) DEFAULT NULL, INDEX IDX_4FBF094FF92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_5373C9665E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice (id INT UNSIGNED AUTO_INCREMENT NOT NULL, supplier_id INT NOT NULL, subscriber_id INT NOT NULL, payment_type_id INT NOT NULL, user_id INT DEFAULT NULL, due SMALLINT UNSIGNED NOT NULL, invoice_created DATETIME NOT NULL, due_date DATE NOT NULL, payment_day DATE DEFAULT NULL, vs VARCHAR(20) DEFAULT NULL, ks VARCHAR(20) DEFAULT NULL, UNIQUE INDEX UNIQ_90651744F1B0EC09 (vs), INDEX IDX_906517442ADD6D8C (supplier_id), INDEX IDX_906517447808B1AD (subscriber_id), INDEX IDX_90651744DC058279 (payment_type_id), INDEX IDX_90651744A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice_item (id INT UNSIGNED AUTO_INCREMENT NOT NULL, invoice_id INT UNSIGNED NOT NULL, vat SMALLINT NOT NULL, name VARCHAR(255) NOT NULL, unit_count DOUBLE PRECISION NOT NULL, price INT UNSIGNED NOT NULL, discount SMALLINT NOT NULL, margin SMALLINT DEFAULT NULL, discount_total NUMERIC(10, 2) NOT NULL, margin_total NUMERIC(10, 2) NOT NULL, price_total NUMERIC(10, 2) NOT NULL, price_total_inc_vat NUMERIC(10, 2) NOT NULL, INDEX IDX_1DDE477B2989F1FD (invoice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, is_default TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tariff (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price INT UNSIGNED NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, last_login DATETIME NOT NULL, created DATETIME NOT NULL, password_changed DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vat (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, is_default TINYINT(1) DEFAULT NULL, percent SMALLINT NOT NULL, multiplier INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_inventory (id INT AUTO_INCREMENT NOT NULL, tariff_id INT UNSIGNED NOT NULL, user_id INT NOT NULL, invoice_id INT UNSIGNED DEFAULT NULL, company_id INT NOT NULL, `describe` VARCHAR(255) NOT NULL, work_start DATETIME NOT NULL, work_end DATETIME DEFAULT NULL, work_duration DOUBLE PRECISION DEFAULT NULL, INDEX IDX_D325E26392348FD2 (tariff_id), INDEX IDX_D325E263A76ED395 (user_id), INDEX IDX_D325E2632989F1FD (invoice_id), INDEX IDX_D325E263979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_906517442ADD6D8C FOREIGN KEY (supplier_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_906517447808B1AD FOREIGN KEY (subscriber_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744DC058279 FOREIGN KEY (payment_type_id) REFERENCES payment_type (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE invoice_item ADD CONSTRAINT FK_1DDE477B2989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id)');
        $this->addSql('ALTER TABLE work_inventory ADD CONSTRAINT FK_D325E26392348FD2 FOREIGN KEY (tariff_id) REFERENCES tariff (id)');
        $this->addSql('ALTER TABLE work_inventory ADD CONSTRAINT FK_D325E263A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE work_inventory ADD CONSTRAINT FK_D325E2632989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id)');
        $this->addSql('ALTER TABLE work_inventory ADD CONSTRAINT FK_D325E263979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_906517442ADD6D8C');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_906517447808B1AD');
        $this->addSql('ALTER TABLE work_inventory DROP FOREIGN KEY FK_D325E263979B1AD6');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FF92F3E70');
        $this->addSql('ALTER TABLE invoice_item DROP FOREIGN KEY FK_1DDE477B2989F1FD');
        $this->addSql('ALTER TABLE work_inventory DROP FOREIGN KEY FK_D325E2632989F1FD');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_90651744DC058279');
        $this->addSql('ALTER TABLE work_inventory DROP FOREIGN KEY FK_D325E26392348FD2');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_90651744A76ED395');
        $this->addSql('ALTER TABLE work_inventory DROP FOREIGN KEY FK_D325E263A76ED395');
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
