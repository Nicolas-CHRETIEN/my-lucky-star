<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230616102111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stars ADD filter_color VARCHAR(255) NOT NULL, ADD filter_size VARCHAR(255) NOT NULL, ADD filter_distance VARCHAR(255) NOT NULL, ADD filter_planets_number VARCHAR(255) NOT NULL, ADD filter_constellation VARCHAR(255) NOT NULL, ADD filter_price VARCHAR(255) NOT NULL, ADD filter_discount VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stars DROP filter_color, DROP filter_size, DROP filter_distance, DROP filter_planets_number, DROP filter_constellation, DROP filter_price, DROP filter_discount');
    }
}
