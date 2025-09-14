
# Comix Web Frontend (Angular)

This Angular application provides a Material Design UI for managing web comic feeds via the PHP REST API backend.

**For detailed usage and integration instructions, see [`USAGE.md`](USAGE.md).**

---

This project was generated using [Angular CLI](https://github.com/angular/angular-cli) version 20.3.1.


## Quick Start

1. Install dependencies:
	```bash
	npm install --prefix frontend
	```
2. Start the development server:
	```bash
	npm start --prefix frontend
	```
3. Open your browser to [http://localhost:4200](http://localhost:4200)

The app will automatically reload when you modify source files.


## API Integration

This app communicates with the PHP REST API (see main project README for backend details).

Endpoints used:
- `GET /app/index.php/feeds` — List all feeds
- `POST /app/index.php/feeds` — Add a new feed
- `DELETE /app/index.php/feed/{id}` — Delete a feed
- `PATCH /app/index.php/feed/{id}` — Update a feed

If your API is hosted elsewhere, update the `apiUrl` in `src/app/feed.service.ts`.


## Building

To build the project for production:

```bash
npm run build --prefix frontend
```

Build artifacts will be stored in the `dist/` directory.


## Running unit tests

To execute unit tests with the [Karma](https://karma-runner.github.io) test runner:

```bash
npm test --prefix frontend
```


## Running end-to-end tests

For end-to-end (e2e) testing, run:

```bash
ng e2e
```

Angular CLI does not come with an end-to-end testing framework by default. You can choose one that suits your needs.


## Additional Resources

For more information on using the Angular CLI, including detailed command references, visit the [Angular CLI Overview and Command Reference](https://angular.dev/tools/cli) page.
