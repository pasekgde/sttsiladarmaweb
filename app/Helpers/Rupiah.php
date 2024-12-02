<?php

if (!function_exists('currency_IDR')) {
   function currency_IDR($value)
   {
       // Pastikan value adalah angka (float atau int), bukan string
       $value = (float) $value;

       // Menggunakan number_format untuk format mata uang
       return "Rp. " . number_format($value, 0, ',', '.');
   }
}


if (!function_exists('currencyIDRToNumeric')) {
   function currencyIDRToNumeric($value)
   {
      // Hapus karakter selain angka, koma, dan titik desimal
      $value = preg_replace('/[^\d,]/', '', $value); // Hanya biarkan angka dan koma

      // Jika terdapat koma (untuk desimal), ganti koma dengan titik
      $value = str_replace(',', '.', $value);

      // Mengembalikan nilai sebagai angka float
      return is_numeric($value) ? floatval($value) : null;
   }
}