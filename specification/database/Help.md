# Users
Users table.

```sql
CREATE TABLE help (
	`id` INT NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(50) NULL,
    `content` TEXT NULL,
    `status` TINYINT DEFAULT(1),
    `creator_id` INT NULL,
    `created_at` TIMESTAMP NULL,
	PRIMARY KEY (`id`)
);
```