<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200616022921 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE board_column ADD board_id INT NOT NULL');
        $this->addSql('ALTER TABLE board_column ADD CONSTRAINT FK_D14DC3D9E7EC5785 FOREIGN KEY (board_id) REFERENCES board (id)');
        $this->addSql('CREATE INDEX IDX_D14DC3D9E7EC5785 ON board_column (board_id)');
        $this->addSql('ALTER TABLE task_column ADD board_column_id INT NOT NULL');
        $this->addSql('ALTER TABLE task_column ADD CONSTRAINT FK_46FA03ADCA372FE FOREIGN KEY (board_column_id) REFERENCES board_column (id)');
        $this->addSql('CREATE INDEX IDX_46FA03ADCA372FE ON task_column (board_column_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE board_column DROP FOREIGN KEY FK_D14DC3D9E7EC5785');
        $this->addSql('DROP INDEX IDX_D14DC3D9E7EC5785 ON board_column');
        $this->addSql('ALTER TABLE board_column DROP board_id');
        $this->addSql('ALTER TABLE task_column DROP FOREIGN KEY FK_46FA03ADCA372FE');
        $this->addSql('DROP INDEX IDX_46FA03ADCA372FE ON task_column');
        $this->addSql('ALTER TABLE task_column DROP board_column_id');
    }
}
