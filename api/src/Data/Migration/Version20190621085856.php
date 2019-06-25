<?php declare(strict_types=1);

namespace Api\Data\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190621085856 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE baza_old_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE baza_new (id INT NOT NULL, action VARCHAR(20) NOT NULL, model VARCHAR(20) NOT NULL, created INT NOT NULL, data JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE baza_old (id INT NOT NULL, action VARCHAR(20) NOT NULL, model VARCHAR(20) NOT NULL, created INT NOT NULL, data JSON NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE baza_old_id_seq CASCADE');
        $this->addSql('DROP TABLE baza_new');
        $this->addSql('DROP TABLE baza_old');
    }
}
