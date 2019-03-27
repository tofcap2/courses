<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190326155057 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_recipe (user_id BIGINT NOT NULL, recipe_id BIGINT NOT NULL, INDEX IDX_BFDAAA0AA76ED395 (user_id), INDEX IDX_BFDAAA0A59D8A214 (recipe_id), PRIMARY KEY(user_id, recipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_recipe ADD CONSTRAINT FK_BFDAAA0AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_recipe ADD CONSTRAINT FK_BFDAAA0A59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category CHANGE id id BIGINT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE comment CHANGE user_id user_id BIGINT DEFAULT NULL, CHANGE recipe_id recipe_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE difficulty CHANGE level level TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE ingredient CHANGE ingredient_category_id ingredient_category_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu CHANGE user_id user_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE picture CHANGE recipe_id recipe_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE recipe CHANGE difficulty_id difficulty_id BIGINT DEFAULT NULL, CHANGE user_id user_id BIGINT DEFAULT NULL, CHANGE category_id category_id BIGINT DEFAULT NULL, CHANGE servings servings TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE recipe_has_tag RENAME INDEX fk_recipe_has_tag_recipe1_idx TO IDX_7BADE43959D8A214');
        $this->addSql('ALTER TABLE recipe_has_tag RENAME INDEX fk_recipe_has_tag_tag1_idx TO IDX_7BADE439BAD26311');
        $this->addSql('ALTER TABLE recipe_ingredient CHANGE recipe_id recipe_id BIGINT DEFAULT NULL, CHANGE ingredient_id ingredient_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE step CHANGE recipe_id recipe_id BIGINT DEFAULT NULL, CHANGE number number TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user_has_tag RENAME INDEX fk_user_has_tag_user1_idx TO IDX_6F44F473A76ED395');
        $this->addSql('ALTER TABLE user_has_tag RENAME INDEX fk_user_has_tag_tag1_idx TO IDX_6F44F473BAD26311');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user_recipe');
        $this->addSql('ALTER TABLE category CHANGE id id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE comment CHANGE recipe_id recipe_id BIGINT NOT NULL, CHANGE user_id user_id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE difficulty CHANGE level level TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE ingredient CHANGE ingredient_category_id ingredient_category_id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE menu CHANGE user_id user_id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE picture CHANGE recipe_id recipe_id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE recipe CHANGE category_id category_id BIGINT NOT NULL, CHANGE difficulty_id difficulty_id BIGINT NOT NULL, CHANGE user_id user_id BIGINT NOT NULL, CHANGE servings servings TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE recipe_has_tag RENAME INDEX idx_7bade439bad26311 TO fk_recipe_has_tag_tag1_idx');
        $this->addSql('ALTER TABLE recipe_has_tag RENAME INDEX idx_7bade43959d8a214 TO fk_recipe_has_tag_recipe1_idx');
        $this->addSql('ALTER TABLE recipe_ingredient CHANGE ingredient_id ingredient_id BIGINT NOT NULL, CHANGE recipe_id recipe_id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE step CHANGE recipe_id recipe_id BIGINT NOT NULL, CHANGE number number TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user_has_tag RENAME INDEX idx_6f44f473bad26311 TO fk_user_has_tag_tag1_idx');
        $this->addSql('ALTER TABLE user_has_tag RENAME INDEX idx_6f44f473a76ed395 TO fk_user_has_tag_user1_idx');
    }
}
