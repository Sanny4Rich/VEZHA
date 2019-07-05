<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190702121542 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE products CHANGE is_on_home_page is_on_home_page TINYINT(1) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE categories ADD on_home_page_position INT NOT NULL, CHANGE is_visible is_visible TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE is_on_home_page is_on_home_page TINYINT(1) DEFAULT \'0\' NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categories DROP on_home_page_position, CHANGE is_visible is_visible TINYINT(1) NOT NULL, CHANGE is_on_home_page is_on_home_page TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE products CHANGE is_on_home_page is_on_home_page TINYINT(1) DEFAULT \'1\'');
    }
}
