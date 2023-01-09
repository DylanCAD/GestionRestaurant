<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230109141059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sauce (id INT AUTO_INCREMENT NOT NULL, nom_sauce VARCHAR(255) NOT NULL, prix_sauce DOUBLE PRECISION NOT NULL, image_sauce VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sauce_menu (sauce_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_553929FA7AB984B7 (sauce_id), INDEX IDX_553929FACCD7E912 (menu_id), PRIMARY KEY(sauce_id, menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sauce_menu ADD CONSTRAINT FK_553929FA7AB984B7 FOREIGN KEY (sauce_id) REFERENCES sauce (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sauce_menu ADD CONSTRAINT FK_553929FACCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sauce_menu DROP FOREIGN KEY FK_553929FA7AB984B7');
        $this->addSql('ALTER TABLE sauce_menu DROP FOREIGN KEY FK_553929FACCD7E912');
        $this->addSql('DROP TABLE sauce');
        $this->addSql('DROP TABLE sauce_menu');
    }
}
