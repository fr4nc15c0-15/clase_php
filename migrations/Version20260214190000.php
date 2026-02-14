<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Migración inicial que crea todas las tablas del proyecto BookMarket.
 */
final class Version20260214190000 extends AbstractMigration
{
    /** Descripción visible al listar migraciones. */
    public function getDescription(): string
    {
        return 'Crea tablas de usuario, categoria, libro, mensaje, valoracion y pedido';
    }

    /** Ejecuta cambios "up" (crear estructura). */
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(100) NOT NULL, descripcion LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(100) NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, rol VARCHAR(30) NOT NULL, fecha_registro DATETIME NOT NULL COMMENT "(DC2Type:datetime_immutable)", UNIQUE INDEX UNIQ_B6D1B88EE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE libro (id INT AUTO_INCREMENT NOT NULL, categoria_id INT NOT NULL, usuario_id INT DEFAULT NULL, titulo VARCHAR(255) NOT NULL, autor VARCHAR(150) NOT NULL, descripcion LONGTEXT NOT NULL, precio DOUBLE PRECISION NOT NULL, estado VARCHAR(50) NOT NULL, fecha_publicacion DATE NOT NULL COMMENT "(DC2Type:date_immutable)", INDEX IDX_E62A4DC53397707A (categoria_id), INDEX IDX_E62A4DC5DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mensaje (id INT AUTO_INCREMENT NOT NULL, contenido LONGTEXT NOT NULL, fecha DATETIME NOT NULL COMMENT "(DC2Type:datetime_immutable)", PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pedido (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, fecha DATETIME NOT NULL COMMENT "(DC2Type:datetime_immutable)", total DOUBLE PRECISION NOT NULL, estado VARCHAR(40) NOT NULL, INDEX IDX_C4EC55E4DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE valoracion (id INT AUTO_INCREMENT NOT NULL, puntuacion INT NOT NULL, comentario LONGTEXT DEFAULT NULL, fecha DATETIME NOT NULL COMMENT "(DC2Type:datetime_immutable)", PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE libro ADD CONSTRAINT FK_E62A4DC53397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id)');
        $this->addSql('ALTER TABLE libro ADD CONSTRAINT FK_E62A4DC5DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE pedido ADD CONSTRAINT FK_C4EC55E4DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
    }

    /** Revierte cambios "down" (eliminar estructura). */
    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE libro DROP FOREIGN KEY FK_E62A4DC53397707A');
        $this->addSql('ALTER TABLE libro DROP FOREIGN KEY FK_E62A4DC5DB38439E');
        $this->addSql('ALTER TABLE pedido DROP FOREIGN KEY FK_C4EC55E4DB38439E');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE libro');
        $this->addSql('DROP TABLE mensaje');
        $this->addSql('DROP TABLE pedido');
        $this->addSql('DROP TABLE valoracion');
    }
}
