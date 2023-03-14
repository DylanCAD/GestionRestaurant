<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230314091537 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accompagnement_menu DROP FOREIGN KEY FK_8A7C5D248E768805');
        $this->addSql('ALTER TABLE accompagnement_menu DROP FOREIGN KEY FK_8A7C5D24CCD7E912');
        $this->addSql('ALTER TABLE boisson_menu DROP FOREIGN KEY FK_1391FF6C734B8089');
        $this->addSql('ALTER TABLE boisson_menu DROP FOREIGN KEY FK_1391FF6CCCD7E912');
        $this->addSql('ALTER TABLE sauce_menu DROP FOREIGN KEY FK_553929FACCD7E912');
        $this->addSql('ALTER TABLE sauce_menu DROP FOREIGN KEY FK_553929FA7AB984B7');
        $this->addSql('DROP TABLE accompagnement_menu');
        $this->addSql('DROP TABLE boisson_menu');
        $this->addSql('DROP TABLE sauce_menu');
        $this->addSql('ALTER TABLE menu ADD boissons_id INT DEFAULT NULL, ADD sauces_id INT DEFAULT NULL, ADD accompagnements_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A937366CD21 FOREIGN KEY (boissons_id) REFERENCES boisson (id)');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93B20E228E FOREIGN KEY (sauces_id) REFERENCES sauce (id)');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A9397953F22 FOREIGN KEY (accompagnements_id) REFERENCES accompagnement (id)');
        $this->addSql('CREATE INDEX IDX_7D053A937366CD21 ON menu (boissons_id)');
        $this->addSql('CREATE INDEX IDX_7D053A93B20E228E ON menu (sauces_id)');
        $this->addSql('CREATE INDEX IDX_7D053A9397953F22 ON menu (accompagnements_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE accompagnement_menu (accompagnement_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_8A7C5D248E768805 (accompagnement_id), INDEX IDX_8A7C5D24CCD7E912 (menu_id), PRIMARY KEY(accompagnement_id, menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE boisson_menu (boisson_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_1391FF6CCCD7E912 (menu_id), INDEX IDX_1391FF6C734B8089 (boisson_id), PRIMARY KEY(boisson_id, menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sauce_menu (sauce_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_553929FA7AB984B7 (sauce_id), INDEX IDX_553929FACCD7E912 (menu_id), PRIMARY KEY(sauce_id, menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE accompagnement_menu ADD CONSTRAINT FK_8A7C5D248E768805 FOREIGN KEY (accompagnement_id) REFERENCES accompagnement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE accompagnement_menu ADD CONSTRAINT FK_8A7C5D24CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE boisson_menu ADD CONSTRAINT FK_1391FF6C734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE boisson_menu ADD CONSTRAINT FK_1391FF6CCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sauce_menu ADD CONSTRAINT FK_553929FACCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sauce_menu ADD CONSTRAINT FK_553929FA7AB984B7 FOREIGN KEY (sauce_id) REFERENCES sauce (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A937366CD21');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93B20E228E');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A9397953F22');
        $this->addSql('DROP INDEX IDX_7D053A937366CD21 ON menu');
        $this->addSql('DROP INDEX IDX_7D053A93B20E228E ON menu');
        $this->addSql('DROP INDEX IDX_7D053A9397953F22 ON menu');
        $this->addSql('ALTER TABLE menu DROP boissons_id, DROP sauces_id, DROP accompagnements_id');
    }
}
