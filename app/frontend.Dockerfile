# Stage 1: Build the Angular app
FROM node:lts AS build
WORKDIR /usr/src/app
COPY frontend/package*.json ./frontend/
RUN cd frontend && npm install
COPY frontend ./frontend
RUN cd frontend && npm run build -- --output-path=dist

# Stage 2: Serve with Nginx
FROM nginx:alpine
COPY --from=build /usr/src/app/frontend/dist /usr/share/nginx/html
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
