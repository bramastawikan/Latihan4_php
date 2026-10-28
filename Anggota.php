<?php
/* ---------- Class Anggota (induk) ---------- */
class Anggota {
    private $id;
    private $nama;
    private $jumlahDipinjam = 0;

    public function __construct($id, $nama) {
        $this->id   = $id;
        $this->nama = $nama;
    }

    public function getId()             { return $this->id; }
    public function getNama()           { return $this->nama; }
    public function getJumlahDipinjam() { return $this->jumlahDipinjam; }

    // Tiga method di bawah di-override oleh class turunan
    public function getJenis()       { return "Anggota Umum"; }
    public function getBatasPinjam() { return 2; }
    public function getLamaPinjam()  { return 7; } // hari

    public function bolehPinjam() {
        return $this->jumlahDipinjam < $this->getBatasPinjam();
    }

    public function tambahPinjaman() {
        $this->jumlahDipinjam++;
    }

    public function kurangiPinjaman() {
        if ($this->jumlahDipinjam > 0) {
            $this->jumlahDipinjam--;
        }
    }

    public function tampilkanInfo() {
        echo "{$this->getJenis()}: {$this->nama} ({$this->id}), "
           . "sedang meminjam {$this->jumlahDipinjam} dari maksimal {$this->getBatasPinjam()} buku<br>";
    }
}

/* ---------- Class turunan Anggota ---------- */
class Mahasiswa extends Anggota {
    public function getJenis()       { return "Mahasiswa"; }
    public function getBatasPinjam() { return 3; }
    public function getLamaPinjam()  { return 7; }
}

class Dosen extends Anggota {
    public function getJenis()       { return "Dosen"; }
    public function getBatasPinjam() { return 5; }
    public function getLamaPinjam()  { return 14; }
}
