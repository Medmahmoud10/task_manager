# Build the Docker image with a tag
docker build -t task-manager-backend:latest .

# Run the container with proper volume mounting
docker run -d --name task-manager-backend `
  -p 9000:9000 `
  -p 8000:8000 `
  -v "${PWD}:/var/www" `
  task-manager-backend:latest

Write-Host "Container started! Access Laravel on port 8000 and PHP-FPM on port 9000"