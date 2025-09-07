Write-Host "Stopping containers..."
docker stop task-manager-backend task-manager-mysql

Write-Host "Removing containers..."
docker rm task-manager-backend task-manager-mysql

Write-Host "Cleanup complete!"