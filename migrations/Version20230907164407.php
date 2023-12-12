<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230907164407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Added link_external_url to nodes_sources';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE nodes_sources ADD link_external_url VARCHAR(250) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE nodes_sources DROP link_external_url');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
