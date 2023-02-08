<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230208143405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe_ingredient DROP FOREIGN KEY FK_22D1FE1359D8A214');
        $this->addSql('ALTER TABLE recipe_ingredient DROP FOREIGN KEY FK_22D1FE13933FE08C');
        $this->addSql('ALTER TABLE ingredient_allergen DROP FOREIGN KEY FK_57B95840933FE08C');
        $this->addSql('ALTER TABLE ingredient_allergen DROP FOREIGN KEY FK_57B958406E775A4A');
        $this->addSql('ALTER TABLE recipe_allergen DROP FOREIGN KEY FK_532FAD5059D8A214');
        $this->addSql('ALTER TABLE recipe_allergen DROP FOREIGN KEY FK_532FAD506E775A4A');
        $this->addSql('DROP TABLE allergen');
        $this->addSql('DROP TABLE recipe_ingredient');
        $this->addSql('DROP TABLE ingredient_allergen');
        $this->addSql('DROP TABLE recipe_allergen');
        $this->addSql('ALTER TABLE ingredient ADD allergen TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allergen (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE recipe_ingredient (recipe_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_22D1FE13933FE08C (ingredient_id), INDEX IDX_22D1FE1359D8A214 (recipe_id), PRIMARY KEY(recipe_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ingredient_allergen (ingredient_id INT NOT NULL, allergen_id INT NOT NULL, INDEX IDX_57B958406E775A4A (allergen_id), INDEX IDX_57B95840933FE08C (ingredient_id), PRIMARY KEY(ingredient_id, allergen_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE recipe_allergen (recipe_id INT NOT NULL, allergen_id INT NOT NULL, INDEX IDX_532FAD506E775A4A (allergen_id), INDEX IDX_532FAD5059D8A214 (recipe_id), PRIMARY KEY(recipe_id, allergen_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE recipe_ingredient ADD CONSTRAINT FK_22D1FE1359D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe_ingredient ADD CONSTRAINT FK_22D1FE13933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_allergen ADD CONSTRAINT FK_57B95840933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_allergen ADD CONSTRAINT FK_57B958406E775A4A FOREIGN KEY (allergen_id) REFERENCES allergen (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe_allergen ADD CONSTRAINT FK_532FAD5059D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe_allergen ADD CONSTRAINT FK_532FAD506E775A4A FOREIGN KEY (allergen_id) REFERENCES allergen (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient DROP allergen');
    }
}
