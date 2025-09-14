# Comix Web Frontend - Angular App Usage

## Overview
This Angular application provides a Material Design UI for managing web comic feeds via the PHP REST API. You can view, add, update, and delete feeds from the UI.

## Prerequisites
- Node.js and npm installed
- The PHP backend (REST API) running and accessible (default: `/`)

## Running the Angular App

1. Install dependencies:
   ```bash
   npm install --prefix frontend
   ```
2. Start the development server:
   ```bash
   npm start --prefix frontend
   ```
3. Open your browser to [http://localhost:4200](http://localhost:4200)

## Features
- **List Feeds:** View all web comic feeds in a Material table.
- **Add Feed:** Use the form to add a new feed (name and homepage required).
- **Delete Feed:** Remove a feed using the delete button.
- **Update Feed:** Edit feed details inline and save changes.

## API Integration
The app communicates with the PHP REST API endpoints:
- `GET /app/index.php/feeds` — List all feeds
- `POST /app/index.php/feeds` — Add a new feed
- `DELETE /app/index.php/feed/{id}` — Delete a feed
- `PATCH /app/index.php/feed/{id}` — Update a feed

If your API is hosted elsewhere, update the `apiUrl` in `src/app/feed.service.ts`.

## Customization
- UI is built with Angular Material for a modern look.
- You can extend the app by adding more features or customizing the design.

## Troubleshooting
- Ensure the backend API is running and accessible from the frontend.
- Check browser console and terminal for errors if the app fails to load feeds.

---
For more details, see the main project README or the Angular CLI documentation.
