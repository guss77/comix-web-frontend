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

2. **Configure environment variables**

   Copy the example environment file and edit as needed:

   ```sh
   cp .env.example .env
   ```

3. **Start the application**

   ```sh
   docker compose up --build
   ```

4. **Access the application**

   Open your browser to [http://localhost:8080](http://localhost:8080)

## File Structure

- `app/` – PHP application files
- `docker/` – Docker-related files
- `docker-compose.yml` – Docker Compose configuration
- `.env.example` – Sample environment variables

## License

This project is licensed under the GNU General Public License version 3.0 or later - see `LICENSE` file for details.
