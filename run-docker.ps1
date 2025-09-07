Write-Host "Creating MySQL container..."
docker run -d --name task-manager-mysql -e MYSQL_ROOT_PASSWORD=password -e MYSQL_DATABASE=laravel -p 3306:3306 mysql:8.0

Write-Host "Building Docker image..."
docker build -t task-manager-backend:latest .

Write-Host "Running container..."
docker run -d --name task-manager-backend `
  -p 9000:9000 `
  -p 8000:8000 `
  -p 80:8000 `
  --link task-manager-mysql:mysql `
  -e DB_CONNECTION=mysql `
  -e DB_HOST=task-manager-mysql `
  -e DB_PORT=3306 `
  -e DB_DATABASE=laravel `
  -e DB_USERNAME=root `
  -e DB_PASSWORD=password `
  -v "${PWD}:/var/www" `
  task-manager-backend:latest

Write-Host "Container started! Access Laravel on port 80 or 8000 and PHP-FPM on port 9000"
Write-Host "Running migrations..."
Start-Sleep -s 10
docker exec task-manager-backend php artisan migrate --force