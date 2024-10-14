<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241012022046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE geo_ip (
                        id INT AUTO_INCREMENT NOT NULL,
                        ip VARCHAR(15) NOT NULL comment \'IP адрес\',
                        country VARCHAR(255) NOT NULL comment \'Стрнана в которой находится ip\',
                        city VARCHAR(255) NOT NULL comment \'Город страны в которой находится ip\',
                        source VARCHAR(255) NOT NULL comment \'Источник от которого получены данные\',
                        PRIMARY KEY(id)
              ) 
              DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql('create unique index index_geo_ips_ip_index using btree on geo_ip (ip)');
        $this->addSql('create index index_geo_ip_country_index using btree on geo_ip(country)');
        $this->addSql('create index index_geo_ip_source_index using btree on geo_ip(source)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('drop index index_geo_ip_ip_index on geo_ips');
        $this->addSql('drop index index_geo_ip_country_index on geo_ips');
        $this->addSql('drop index index_geo_ip_source_index using on geo_ips');
        $this->addSql('DROP TABLE geo_ip');
    }
}
