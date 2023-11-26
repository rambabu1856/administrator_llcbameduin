php artisan migrate:refresh --path=/database/migrations/2023_11_11_221452_create_fee_structures_table.php


DELETE users
FROM users
LEFT JOIN students ON users.id = students.user_id
WHERE students.user_id IS NULL
