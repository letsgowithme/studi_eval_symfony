<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230213160426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, full_name VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient_allergen (patient_id INT NOT NULL, allergen_id INT NOT NULL, INDEX IDX_123A506B6B899279 (patient_id), INDEX IDX_123A506B6E775A4A (allergen_id), PRIMARY KEY(patient_id, allergen_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient_diet (patient_id INT NOT NULL, diet_id INT NOT NULL, INDEX IDX_147528E86B899279 (patient_id), INDEX IDX_147528E8E1E13ACE (diet_id), PRIMARY KEY(patient_id, diet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient_recipe (patient_id INT NOT NULL, recipe_id INT NOT NULL, INDEX IDX_D1C658CD6B899279 (patient_id), INDEX IDX_D1C658CD59D8A214 (recipe_id), PRIMARY KEY(patient_id, recipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE patient_allergen ADD CONSTRAINT FK_123A506B6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patient_allergen ADD CONSTRAINT FK_123A506B6E775A4A FOREIGN KEY (allergen_id) REFERENCES allergen (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patient_diet ADD CONSTRAINT FK_147528E86B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patient_diet ADD CONSTRAINT FK_147528E8E1E13ACE FOREIGN KEY (diet_id) REFERENCES diet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patient_recipe ADD CONSTRAINT FK_D1C658CD6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patient_recipe ADD CONSTRAINT FK_D1C658CD59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patient_allergen DROP FOREIGN KEY FK_123A506B6B899279');
        $this->addSql('ALTER TABLE patient_allergen DROP FOREIGN KEY FK_123A506B6E775A4A');
        $this->addSql('ALTER TABLE patient_diet DROP FOREIGN KEY FK_147528E86B899279');
        $this->addSql('ALTER TABLE patient_diet DROP FOREIGN KEY FK_147528E8E1E13ACE');
        $this->addSql('ALTER TABLE patient_recipe DROP FOREIGN KEY FK_D1C658CD6B899279');
        $this->addSql('ALTER TABLE patient_recipe DROP FOREIGN KEY FK_D1C658CD59D8A214');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE patient_allergen');
        $this->addSql('DROP TABLE patient_diet');
        $this->addSql('DROP TABLE patient_recipe');
    }
}
