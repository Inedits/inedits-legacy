<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160702135349 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_profile (id INT AUTO_INCREMENT NOT NULL, avatar VARCHAR(255) DEFAULT NULL, cover VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, twitter VARCHAR(255) DEFAULT NULL, website VARCHAR(255) DEFAULT NULL, biographie LONGTEXT DEFAULT NULL, favorite_book VARCHAR(255) DEFAULT NULL, inspiration VARCHAR(255) DEFAULT NULL, style VARCHAR(255) DEFAULT NULL, experience LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD user_profile_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496B9DD454 FOREIGN KEY (user_profile_id) REFERENCES user_profile (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6496B9DD454 ON user (user_profile_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496B9DD454');
        $this->addSql('DROP TABLE user_profile');
        $this->addSql('DROP INDEX UNIQ_8D93D6496B9DD454 ON user');
        $this->addSql('ALTER TABLE user DROP user_profile_id');
    }
}
