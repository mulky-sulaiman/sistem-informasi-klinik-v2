# SIK : Sistem Informasi Klinik v2

## Installation

-   Make a clone from respository.

```bash
git clone git@github.com:mulky-sulaiman/sistem-informasi-klinik-v2.git
```

-   Downloading packages and requirements.

```bash
composer install
```

-   Creating a copy of .env.example file to `.env` .
-   Generate your .env file key.

```bash
php artisan key:generate
```

-   Create database with name `sistem_informasi_klinik_v2`.
-   Runing migration with seeding, this will all initial data for each models as sample.

```bash
php artisan migrate:fresh --seed
```

-   Runing server.

```bash
npm i && npm run dev
```

## License

MIT
