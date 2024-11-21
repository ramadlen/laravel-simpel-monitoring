<?php

namespace App\Enums;

enum StatusEnum: string
{
    case RawatInap = 'rawatInap';
    case PoliPenyakitDalam = 'poliPenyakitDalam';
    case PoliKandungan = 'poliKandungan';
    case PoliAnak = 'poliAnak';
    case PoliMata = 'poliMata';
    case PoliKonservasiGigi = 'poliKonservasiGigi';
    case PoliKulitKelamin = 'poliKulitKelamin';
    case PoliGigiUmum = 'poliGigiUmum';
    case PoliSaraf = 'poliSaraf';

    /**
     * Mendapatkan label untuk nilai enum.
     *
     * @return string
     */
    public function label(): string
    {
        return match($this) {
            self::RawatInap=> 'Rawat Inap',
            self::PoliPenyakitDalam => 'Poli Penyakit Dalam',
            self::PoliKandungan => 'Poli Kandungan',
            self::PoliAnak => 'Poli Anak',
            self::PoliMata => 'PoliMata',
            self::PoliKonservasiGigi => 'Poli Konservasi Gigi',
            self::PoliKulitKelamin => 'Poli Kulit Kelamin',
            self::PoliGigiUmum => 'Poli Gigi Umum',
            self::PoliSaraf => 'Poli Saraf',
            self::ADMISI => 'admisi',
        };
    }

    /**
     * Mendapatkan pilihan untuk form.
     *
     * @return array
     */
    public static function options(): array
    {
        return [
            self::RawatInap->value => self::RawatInap->label(),
            self::PoliPenyakitDalam->value => self::PoliPenyakitDalam->label(),
            self::PoliKandungan->value => self::PoliKandungan->label(),
            self::PoliAnak->value => self::PoliAnak->label(),
            self::PoliMata->value => self::PoliMata->label(),
            self::PoliKonservasiGigi->value => self::PoliKonservasiGigi->label(),
            self::PoliKulitKelamin->value => self::PoliKulitKelamin->label(),
            self::PoliGigiUmum->value => self::PoliGigiUmum->label(),
            self::PoliSaraf->value => self::PoliSaraf->label(),
            self::ADMISI->value => self::ADMISI->label(),
        ];
    }
}
