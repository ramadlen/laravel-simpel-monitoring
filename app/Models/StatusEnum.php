<?php
// app/Models/StatusEnum.php
namespace App\Models;

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
    case ADMISI = 'admisi'; 

}
