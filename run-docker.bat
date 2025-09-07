@echo off
echo Building Docker image...
docker build -t task-manager-backend:latest .

echo Running container...
docker run -d --name task-manager-backend -p 9000:9000 -p 8000:8000 -v "%cd%:/var/www" task-manager-backend:latest

echo Container started! Access Laravel on port 8000 and PHP-FPM on port 9000