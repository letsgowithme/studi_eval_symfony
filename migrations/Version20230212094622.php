<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230212094622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE patient_recipe (patient_id INT NOT NULL, recipe_id INT NOT NULL, INDEX IDX_D1C658CD6B899279 (patient_id), INDEX IDX_D1C658CD59D8A214 (recipe_id), PRIMARY KEY(patient_id, recipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE patient_recipe ADD CONSTRAINT FK_D1C658CD6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patient_recipe ADD CONSTRAINT FK_D1C658CD59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patient_recipe DROP FOREIGN KEY FK_D1C658CD6B899279');
        $this->addSql('ALTER TABLE patient_recipe DROP FOREIGN KEY FK_D1C658CD59D8A214');
        $this->addSql('DROP TABLE patient_recipe');
    }
}
