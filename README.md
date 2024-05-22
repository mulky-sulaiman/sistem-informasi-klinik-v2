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
-   Runing migration with seeding, this will generate all the initial data for each models as sample to be used.

```bash
php artisan migrate:fresh --seed
```

-   Runing server.

```bash
npm i && npm run dev
```

### Sample User

Super Admin : _superadmin@example.com_ / _password_
Admin : _admin@example.com_ / _password_
Operator : _operator@example.com_ / _password_
Pharmacist 1 : _pharmacist.1@example.com_ / _password_
Pharmacist 2 : _pharmacist.2@example.com_ / _password_
Doctor 1 : _doctor.1@example.com_ / _password_
Doctor 2 : _doctor.2@example.com_ / _password_
Doctor 3 : _doctor.3@example.com_ / _password_

## License

MIT - For testing purpose only

## Progress

_Ketentuan aplikasi secara umum yang dibuat terdiri dari_ :

1. ~~Terdapat user login berdasarkan hak aksesnya (SRBAC)~~ DONE
2. ~~Terdapat master CRUD untuk pembuatan master wilayah, user, dan pegawai, tindakan, obat~~ DONE
3. ~~Terdapat menu transaksi untuk pendaftaran pasien~~ DONE
4. ~~Terdapat menu transaksi untuk memberikan tindakan dan obat pada pasien~~ DONE
5. ~~Terdapat menu informasi untuk melakukan pembayaran tagihan pasien~~ DONE
6. Terdapat menu laporan yang dapat ditampilkan dengan grafik
