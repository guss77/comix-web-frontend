-- This script will be executed on MariaDB container startup
-- You can modify it to initialize your schema

CREATE TABLE IF NOT EXISTS comics (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  url VARCHAR(512) NOT NULL,
  last_checked DATETIME DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS strips (
  id INT AUTO_INCREMENT PRIMARY KEY,
  comic_id INT NOT NULL,
  strip_date DATE NOT NULL,
  image_url VARCHAR(512) NOT NULL,
  UNIQUE KEY (comic_id, strip_date),
  FOREIGN KEY (comic_id) REFERENCES comics(id) ON DELETE CASCADE
);

-- Insert example data
INSERT INTO comics (title, url) VALUES ('Example Comic', 'https://example.com');
