<?php
/*
 * Tugas Mandiri: Sistem peminjaman buku perpustakaan sederhana.
 * File ini hanya untuk pengujian. Class ada di file lain.
 * Jalankan dengan: php -S localhost:8000 lalu buka index.php di browser.
 */
require_once __DIR__ . '/Buku.php';
require_once __DIR__ . '/Anggota.php';      // berisi Anggota, Mahasiswa, Dosen
require_once __DIR__ . '/Peminjaman.php';

// Data buku
$buku1 = new Buku("B001", "Attack on Titan", "Penulis Hajime Isayama", 1);
$buku2 = new Buku("B002", "Prinsip Ekonomi", "Penulis Ferry Irwandi", 4);
$buku3 = new Buku("B003", "Naruto Shippuden", "Penulis Masashi Kishimoto", 2);

// Data anggota
$wikan = new Mahasiswa("M001", "Wikan");
$quanta = new Dosen("D001", "Quanta");

echo "<b>Data awal</b><br>";
$buku1->tampilkanInfo();
$buku2->tampilkanInfo();
$buku3->tampilkanInfo();
$wikan->tampilkanInfo();
$quanta->tampilkanInfo();

// Polimorfisme: satu pemanggilan, hasil berbeda tiap objek
echo "<br><b>Batas dan lama pinjam</b><br>";
$daftar = [new Anggota("U001", "Tamu"), $wikan, $quanta];
foreach ($daftar as $a) {
    echo "{$a->getJenis()}: maks {$a->getBatasPinjam()} buku, {$a->getLamaPinjam()} hari<br>";
}

// Enkapsulasi : baris di bawah akan error karena $stok private
// $buku1->stok = 99;
$buku1->setStok(-5); // ditolak oleh validasi

echo "<br><b>Transaksi</b><br>";
$p1 = new Peminjaman($buku1, $wikan, "2026-06-01");
$p2 = new Peminjaman($buku2, $quanta, "2026-06-01");
$p3 = new Peminjaman($buku1, $quanta, "2026-06-01"); // stok B002 sudah habis
$p4 = new Peminjaman($buku3, $wikan, "2026-06-03");

$p1->proses();
$p2->proses();
$p3->proses(); // gagal
$p4->proses();

// Wikan terlambat 4 hari (jatuh tempo 08-06-2026, kembali 12-06-2026)
$p1->kembalikan("2026-06-12");
// Quanta tepat waktu (jatuh tempo 15-06-2026)
$p2->kembalikan("2026-06-10");
$p4->kembalikan("2026-06-14");

echo "<br><b>Rekap</b><br>";
$p1->tampilkanInfo();
$p2->tampilkanInfo();
$p3->tampilkanInfo();
$buku1->tampilkanInfo();
$buku2->tampilkanInfo();
$buku3->tampilkanInfo();