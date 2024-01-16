<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240116014239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE booking_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE equipment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE review_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE booking (id INT NOT NULL, guest_id INT NOT NULL, room_id INT DEFAULT NULL, review_id INT DEFAULT NULL, number VARCHAR(50) NOT NULL, check_in TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, check_out TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, occupants INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E00CEDDE9A4AA658 ON booking (guest_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE54177093 ON booking (room_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E00CEDDE3E2E969B ON booking (review_id)');
        $this->addSql('CREATE TABLE equipment (id INT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE equipment_room (equipment_id INT NOT NULL, room_id INT NOT NULL, PRIMARY KEY(equipment_id, room_id))');
        $this->addSql('CREATE INDEX IDX_481B809D517FE9FE ON equipment_room (equipment_id)');
        $this->addSql('CREATE INDEX IDX_481B809D54177093 ON equipment_room (room_id)');
        $this->addSql('CREATE TABLE review (id INT NOT NULL, guest_id INT NOT NULL, rooms_id INT NOT NULL, title VARCHAR(50) NOT NULL, comment TEXT NOT NULL, rating INT NOT NULL, create_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_794381C69A4AA658 ON review (guest_id)');
        $this->addSql('CREATE INDEX IDX_794381C68E2368AB ON review (rooms_id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE9A4AA658 FOREIGN KEY (guest_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE54177093 FOREIGN KEY (room_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE3E2E969B FOREIGN KEY (review_id) REFERENCES review (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE equipment_room ADD CONSTRAINT FK_481B809D517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE equipment_room ADD CONSTRAINT FK_481B809D54177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C69A4AA658 FOREIGN KEY (guest_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C68E2368AB FOREIGN KEY (rooms_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE booking_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE equipment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE review_id_seq CASCADE');
        $this->addSql('ALTER TABLE booking DROP CONSTRAINT FK_E00CEDDE9A4AA658');
        $this->addSql('ALTER TABLE booking DROP CONSTRAINT FK_E00CEDDE54177093');
        $this->addSql('ALTER TABLE booking DROP CONSTRAINT FK_E00CEDDE3E2E969B');
        $this->addSql('ALTER TABLE equipment_room DROP CONSTRAINT FK_481B809D517FE9FE');
        $this->addSql('ALTER TABLE equipment_room DROP CONSTRAINT FK_481B809D54177093');
        $this->addSql('ALTER TABLE review DROP CONSTRAINT FK_794381C69A4AA658');
        $this->addSql('ALTER TABLE review DROP CONSTRAINT FK_794381C68E2368AB');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE equipment_room');
        $this->addSql('DROP TABLE review');
    }
}
