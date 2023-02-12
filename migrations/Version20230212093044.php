<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230212093044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recipe_allergen (recipe_id INT NOT NULL, allergen_id INT NOT NULL, INDEX IDX_532FAD5059D8A214 (recipe_id), INDEX IDX_532FAD506E775A4A (allergen_id), PRIMARY KEY(recipe_id, allergen_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipe_allergen ADD CONSTRAINT FK_532FAD5059D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe_allergen ADD CONSTRAINT FK_532FAD506E775A4A FOREIGN KEY (allergen_id) REFERENCES allergen (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe_allergen DROP FOREIGN KEY FK_532FAD5059D8A214');
        $this->addSql('ALTER TABLE recipe_allergen DROP FOREIGN KEY FK_532FAD506E775A4A');
        $this->addSql('DROP TABLE recipe_allergen');
    }
}
