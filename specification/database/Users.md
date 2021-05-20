# Users
Users table.

```sql
CREATE TABLE users (
	`id` INT NOT NULL AUTO_INCREMENT,
    `nip` VARCHAR(50) NULL,
    `name` VARCHAR(100) NULL,
	`email` VARCHAR(50) NULL,
    `position_id` INT NULL,
    `image` VARCHAR(50) NULL,
    `birth_place` VARCHAR(255) NULL,
    `religion` VARCHAR(50) NULL,
    `sex` BIT NULL,
    `address` TEXT NULL,
    `phone_number` VARCHAR(20) NULL,
    `password` VARCHAR(255) NULL,
    `role_id` TINYINT NULL,
    `status` TINYINT NULL,
   	`created_at` TIMESTAMP NULL,
	`updated_at` TIMESTAMP NULL,
   	`creator_id` INT NULL,
	`updater_id` INT NULL,
	PRIMARY KEY (`id`)
);
```

## Role
| Code | Name |
| ---- | ---- |
| 0 | Administrator |
| 1 | Kasi |
| 2 | Staff Ahli |
| 3 | Visitor |