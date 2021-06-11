<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210608144549 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, voiture_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, tel INT NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_C7440455181A8BA (voiture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_voiture (client_id INT NOT NULL, voiture_id INT NOT NULL, INDEX IDX_BBDFC57219EB6921 (client_id), INDEX IDX_BBDFC572181A8BA (voiture_id), PRIMARY KEY(client_id, voiture_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, votrelieu VARCHAR(50) NOT NULL, lieualler VARCHAR(50) NOT NULL, tel VARCHAR(20) NOT NULL, datevoyage DATE NOT NULL, dateretour DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, clients_id INT NOT NULL, voitures_id INT NOT NULL, datedebut DATE NOT NULL, datefin DATE NOT NULL, valider INT NOT NULL, INDEX IDX_5E9E89CBAB014612 (clients_id), INDEX IDX_5E9E89CBCCC4661F (voitures_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voiture (id INT AUTO_INCREMENT NOT NULL, marques_id INT NOT NULL, nom VARCHAR(255) NOT NULL, modele VARCHAR(255) NOT NULL, couleur VARCHAR(255) NOT NULL, prixparjour INT NOT NULL, image VARCHAR(255) NOT NULL, porte INT NOT NULL, place INT NOT NULL, bagage VARCHAR(50) NOT NULL, transmission VARCHAR(20) NOT NULL, age VARCHAR(20) NOT NULL, disponible VARCHAR(10) NOT NULL, pubvoiture VARCHAR(10) NOT NULL, remise INT NOT NULL, INDEX IDX_E9E2810FC256483C (marques_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id)');
        $this->addSql('ALTER TABLE client_voiture ADD CONSTRAINT FK_BBDFC57219EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_voiture ADD CONSTRAINT FK_BBDFC572181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBAB014612 FOREIGN KEY (clients_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBCCC4661F FOREIGN KEY (voitures_id) REFERENCES voiture (id)');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810FC256483C FOREIGN KEY (marques_id) REFERENCES marque (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client_voiture DROP FOREIGN KEY FK_BBDFC57219EB6921');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBAB014612');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FC256483C');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455181A8BA');
        $this->addSql('ALTER TABLE client_voiture DROP FOREIGN KEY FK_BBDFC572181A8BA');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBCCC4661F');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE client_voiture');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE voiture');
    }
}
