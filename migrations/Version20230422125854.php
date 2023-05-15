<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230422125854 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE consultation (id INT AUTO_INCREMENT NOT NULL, matricule_id INT NOT NULL, num_ss_id INT NOT NULL, date_heure DATETIME NOT NULL, INDEX IDX_964685A69AAADC05 (matricule_id), INDEX IDX_964685A6DF59CF24 (num_ss_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_prescription (id INT AUTO_INCREMENT NOT NULL, numero_ordre_id INT NOT NULL, denomination_id INT NOT NULL, posologie VARCHAR(255) NOT NULL, INDEX IDX_A761F81633868EEC (numero_ordre_id), INDEX IDX_A761F816E9293F06 (denomination_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordonnance (id INT AUTO_INCREMENT NOT NULL, num_ss_id INT NOT NULL, matricule_id INT NOT NULL, numero_ordre VARCHAR(255) NOT NULL, date_heure DATETIME NOT NULL, INDEX IDX_924B326CDF59CF24 (num_ss_id), INDEX IDX_924B326C9AAADC05 (matricule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A69AAADC05 FOREIGN KEY (matricule_id) REFERENCES medecin (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A6DF59CF24 FOREIGN KEY (num_ss_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE ligne_prescription ADD CONSTRAINT FK_A761F81633868EEC FOREIGN KEY (numero_ordre_id) REFERENCES ordonnance (id)');
        $this->addSql('ALTER TABLE ligne_prescription ADD CONSTRAINT FK_A761F816E9293F06 FOREIGN KEY (denomination_id) REFERENCES medicament (id)');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326CDF59CF24 FOREIGN KEY (num_ss_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326C9AAADC05 FOREIGN KEY (matricule_id) REFERENCES medecin (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A69AAADC05');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A6DF59CF24');
        $this->addSql('ALTER TABLE ligne_prescription DROP FOREIGN KEY FK_A761F81633868EEC');
        $this->addSql('ALTER TABLE ligne_prescription DROP FOREIGN KEY FK_A761F816E9293F06');
        $this->addSql('ALTER TABLE ordonnance DROP FOREIGN KEY FK_924B326CDF59CF24');
        $this->addSql('ALTER TABLE ordonnance DROP FOREIGN KEY FK_924B326C9AAADC05');
        $this->addSql('DROP TABLE consultation');
        $this->addSql('DROP TABLE ligne_prescription');
        $this->addSql('DROP TABLE ordonnance');
    }
}
