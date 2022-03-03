<?php

declare(strict_types=1);

namespace App\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220301124232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE family (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, age INT NOT NULL, gender VARCHAR(255) NOT NULL, legal_guardian INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, sku VARCHAR(255) DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, thumbnail_url VARCHAR(255) DEFAULT NULL, color VARCHAR(255) DEFAULT NULL, color_family VARCHAR(255) DEFAULT NULL, size VARCHAR(255) DEFAULT NULL, size_family VARCHAR(255) DEFAULT NULL, occassion JSON DEFAULT NULL, season JSON DEFAULT NULL, rating_avg DOUBLE PRECISION DEFAULT NULL, rating_count DOUBLE PRECISION DEFAULT NULL, active TINYINT(1) DEFAULT NULL, retail_price DOUBLE PRECISION DEFAULT NULL, INDEX IDX_1F1B251E4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, nr VARCHAR(255) DEFAULT NULL, product_url VARCHAR(255) DEFAULT NULL, search_keyword VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, category VARCHAR(255) DEFAULT NULL, category_id INT DEFAULT NULL, sub_category VARCHAR(255) DEFAULT NULL, brand VARCHAR(255) DEFAULT NULL, product_id INT DEFAULT NULL, sub_category_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE warehouse (id INT AUTO_INCREMENT NOT NULL, item_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, inventory_count INT DEFAULT NULL, INDEX IDX_ECB38BFC126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE warehouse ADD CONSTRAINT FK_ECB38BFC126F525E FOREIGN KEY (item_id) REFERENCES item (id)');


    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE warehouse DROP FOREIGN KEY FK_ECB38BFC126F525E');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E4584665A');
        $this->addSql('DROP TABLE family');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE warehouse');
    }
}
