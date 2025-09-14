# comix-web-frontend

A PHP frontend for your webcomics spider.

This project provides a web interface for browsing and managing webcomics data. It runs in a Docker composition that also includes a MariaDB database for storage.

## Features

- PHP web frontend for interacting with your webcomics database.
- MariaDB for persistent storage.
- Easy local development and deployment using Docker Compose.

## Quickstart

1. **Clone the repository**

   ```sh
   git clone https://github.com/guss77/comix-web-frontend.git
   cd comix-web-frontend
   ```

2. **Configure environment and database**

   Copy the example environment file and edit as needed:

   ```sh
   cp .env.example .env
   ```

   Copy the database configuration template and edit as needed:

   ```sh
   cp app/db_config.sample.php app/db_config.php
   ```

   Edit `app/db_config.php` to match your database setup. For Docker Compose, use `'host' => 'db'`.

3. **Start the application**

   ```sh
   docker compose up --build
   ```

4. **Access the application**

   Open your browser to [http://localhost:8080](http://localhost:8080)

## File Structure

- `app/` – PHP application files
  - `app/db_config.sample.php` – Database configuration template
  - `app/db_config.php` – Database configuration (create from sample, not in git)
- `docker/` – Docker-related files
- `docker-compose.yml` – Docker Compose configuration
- `.env.example` – Sample environment variables

## Database Configuration

The application uses a standalone configuration file for database credentials:

1. Copy `app/db_config.sample.php` to `app/db_config.php`
2. Edit the values in `app/db_config.php` to match your setup
3. For Docker Compose: use `'host' => 'db'`
4. For local development: use `'host' => 'localhost'`

The `app/db_config.php` file is excluded from version control to keep sensitive credentials secure.

## License

This project is licensed under the GNU General Public License version 3.0 or later - see `LICENSE` file for details.
