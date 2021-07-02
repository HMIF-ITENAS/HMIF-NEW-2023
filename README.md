<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## About HMIF
Himpunan Mahasiswa Teknik Informatika (HMIF) Beridiri pada tanggal 15 Maret 2005 oleh Rendi Mawardi dkk sekaligus sebagai Ketua Himpunan pertama. VIsi awal didirikannya HMIF adalah dibutuhkannya membuat suatu wadah mahasiswa informatika, rekan rekan IF pada saat itu ber-koordinasi dengan jurusan. Pada saat itu, langsung didukung penuh oleh Pak Winarno Sugeng yang menjabat Ketua Jurusan.

## Installation
1. Git clone
```shell
git clone https://github.com/mmuqiitf/hmif.git
```
or if you have clone it you should just fetch with 
```shell
git checkout master
git pull origin master
```
and you can jump to step 4

2. Composer install

```shell
composer install
```

3. Make .env files from .env.example

4. Make migrations 
```shell
php artisan migrate:fresh
```

5. Install & compile node modules 
```shell
npm install && npm run dev
```

6. Run this project in the browser
```shell
http://localhost/hmif/public/
```

7. Create a new branch for example : name-and-features
```shell
git checkout muqiit-add-users
```

8. Make changes to the code

9. Commit your changes
```shell
git add .
git commit -m "your-message"
git push origin muqiit-add-users
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
