<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230108232302 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE accompagnement (id INT AUTO_INCREMENT NOT NULL, nom_accompagnement VARCHAR(255) NOT NULL, prix_accompagnement DOUBLE PRECISION NOT NULL, image_accompagnement VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accompagnement_menu (accompagnement_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_8A7C5D248E768805 (accompagnement_id), INDEX IDX_8A7C5D24CCD7E912 (menu_id), PRIMARY KEY(accompagnement_id, menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE accompagnement_menu ADD CONSTRAINT FK_8A7C5D248E768805 FOREIGN KEY (accompagnement_id) REFERENCES accompagnement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE accompagnement_menu ADD CONSTRAINT FK_8A7C5D24CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accompagnement_menu DROP FOREIGN KEY FK_8A7C5D248E768805');
        $this->addSql('ALTER TABLE accompagnement_menu DROP FOREIGN KEY FK_8A7C5D24CCD7E912');
        $this->addSql('DROP TABLE accompagnement');
        $this->addSql('DROP TABLE accompagnement_menu');
    }
}
