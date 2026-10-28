<?php
/* ---------- Class Buku ---------- */
class Buku {
    private $kode;
    private $judul;
    private $penulis;
    private $stok;

    public function __construct($kode, $judul, $penulis, $stok) {
        $this->kode    = $kode;
        $this->judul   = $judul;
        $this->penulis = $penulis;
        $this->setStok($stok);
    }

    public function getKode()    { return $this->kode; }
    public function getJudul()   { return $this->judul; }
    public function getPenulis() { return $this->penulis; }
    public function getStok()    { return $this->stok; }

    // Setter dengan validasi: stok tidak boleh negatif
    public function setStok($stok) {
        if ($stok >= 0) {
            $this->stok = $stok;
        } else {
            echo "Stok $stok tidak valid!<br>";
        }
    }

    public function tersedia() {
        return $this->stok > 0;
    }

    // Mengurangi stok satu eksemplar. Return false kalau stok habis.
    public function pinjam() {
        if (!$this->tersedia()) {
            return false;
        }
        $this->stok--;
        return true;
    }

    public function kembalikan() {
        $this->stok++;
    }

    public function tampilkanInfo() {
        echo "[{$this->kode}] {$this->judul} - {$this->penulis} (stok: {$this->stok})<br>";
    }
}
