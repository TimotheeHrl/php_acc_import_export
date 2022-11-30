Swagger gen : $./vendor/bin/openapi --format json --output ./public/swagger/swagger.json ./swagger/swagger.php src

./vendor/bin/openapi --format json --output ./public/swagger/swagger.json ./src

https://localhost:8000/api/caracteristiques/get_car_by_location/nela=53.633333/nelo=5.057256/swla=50.633333/swlo=3.057256

dump db

docker exec 69faf3668967 mysqldump --user=root --password=root --databases acc > /home/tim/Desktop/php/23/acc\_$(date +%Y-%m-%d).sql
(sans le \ )
--user=login_mysql --password=password_mysql
