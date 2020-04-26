<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200426091743 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE shows ADD CONSTRAINT FK_6C3BF14464D218E FOREIGN KEY (location_id) REFERENCES locations (id) ON DELETE RESTRICT ON UPDATE CASCADE');
        $this->addSql('ALTER TABLE locations DROP FOREIGN KEY FK_17E64ABA88823A92');
        $this->addSql('ALTER TABLE locations ADD CONSTRAINT FK_17E64ABA88823A92 FOREIGN KEY (locality_id) REFERENCES localities (id) ON DELETE RESTRICT ON UPDATE CASCADE');
      
        
      
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE shows');
        $this->addSql('ALTER TABLE locations DROP FOREIGN KEY FK_17E64ABA88823A92');
        $this->addSql('ALTER TABLE locations ADD CONSTRAINT FK_17E64ABA88823A92 FOREIGN KEY (locality_id) REFERENCES localities (id) ON UPDATE CASCADE');

       
    }
}
