### Cara jalankan project

1. install php8.1
2. install mysql
3. install composer
4. buat database ``uas``
5. sesuaikan configurasi database pada file ``.env``
6. cd ke workdir dan jalankan ``composer install``
7. jalankan ``php artisan key:generate``
8. jalankan ``php artisan migrate --seed``
9. jalankan ``php artisan serve``
10. login sebagai admin menggunakan kredensial ``admin:password``