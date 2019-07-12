<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190712081917 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contacts ADD second_phone_number VARCHAR(255) DEFAULT NULL, ADD is_second_phone_number_show TINYINT(1) DEFAULT \'0\' NOT NULL, ADD phone_number_title VARCHAR(255) DEFAULT NULL, ADD second_phone_number_title VARCHAR(255) DEFAULT NULL, ADD second_email VARCHAR(255) DEFAULT NULL, ADD is_second_email_show TINYINT(1) DEFAULT \'0\' NOT NULL, ADD first_email_title VARCHAR(255) DEFAULT NULL, ADD second_email_title VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contacts DROP second_phone_number, DROP is_second_phone_number_show, DROP phone_number_title, DROP second_phone_number_title, DROP second_email, DROP is_second_email_show, DROP first_email_title, DROP second_email_title');
    }
}
