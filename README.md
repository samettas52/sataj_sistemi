# Staj Takip Sistemi

PHP tabanlı staj yönetim sistemi.

## Özellikler

- Kullanıcı rolleri (Koordinatör, Firma, Öğrenci)
- Firma yönetimi
- Staj ilanları
- Başvuru sistemi
- Haftalık raporlama
- Modern arayüz

## Kurulum

1. Veritabanı oluşturun:
   ```sql
   CREATE DATABASE staj_sistemi;
   ```

2. `config.php` dosyasında veritabanı bilgilerinizi güncelleyin.

3. Web sunucusunda projeyi çalıştırın.

## Kullanıcı Rolleri

- **Koordinatör**: Firma ekleme, başvuru onaylama, raporlama
- **Firma**: Staj ilanı açma, öğrenci değerlendirme
- **Öğrenci**: Başvuru yapma, haftalık rapor girme

## Teknolojiler

- PHP
- MySQL
- HTML5
- CSS3
- JavaScript

