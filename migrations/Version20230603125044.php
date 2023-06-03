<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230603125044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car ADD type VARCHAR(255) DEFAULT NULL, ADD fuel VARCHAR(255) DEFAULT NULL, ADD color VARCHAR(255) DEFAULT NULL, ADD gearbox VARCHAR(255) DEFAULT NULL, ADD fiscal_power INT DEFAULT NULL, ADD real_power INT DEFAULT NULL, ADD number_of_door INT DEFAULT NULL, ADD number_of_place INT DEFAULT NULL, ADD emission VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP type, DROP fuel, DROP color, DROP gearbox, DROP fiscal_power, DROP real_power, DROP number_of_door, DROP number_of_place, DROP emission');
    }
}
