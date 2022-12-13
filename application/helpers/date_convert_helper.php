<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function convertTglLahir($tgl)
{
    $return = 'Invalid format date.';

    if (strpos($tgl, '-') !== false) {
        $arrTgl = explode('-', $tgl);
        $d = str_pad($arrTgl[0], 2, '0', STR_PAD_LEFT);
        $m = $arrTgl[1];

        $y = $arrTgl[2];
        if (strlen($y) == 2) {
            $y = '19' . $y;
        }

        switch (strtoupper($m)) {
            case 'JAN':
                $m = 'Januari';
                break;
            case 'FEB':
                $m = 'Februari';
                break;
            case 'MAR':
                $m = 'Maret';
                break;
            case 'APR':
                $m = 'April';
                break;
            case 'MAY':
                $m = 'Mei';
                break;
            case 'JUN':
                $m = 'Juni';
                break;
            case 'JUL':
                $m = 'Juli';
                break;
            case 'AUG':
                $m = 'Agustus';
                break;
            case 'SEP':
                $m = 'September';
                break;
            case 'OCT':
                $m = 'Oktober';
                break;
            case 'NOV':
                $m = 'November';
                break;
            case 'DEC':
                $m = 'Desember';
                break;
            default:
                $m = '';
                break;
        }

        if ($m != '') {
            $return = $d . ' ' . $m . ' ' . $y;
        }
    }

    return $return;
}

function convertDateIndo($tgl)
{
    $return = 'Invalid format date.';

    if (strpos($tgl, '-') !== false) {
        $arrTgl = explode('-', $tgl);
        $d = str_pad($arrTgl[2], 2, '0', STR_PAD_LEFT);
        $m = $arrTgl[1];

        $y = $arrTgl[0];

        switch ((int) $m) {
            case '1':
                $m = 'Januari';
                break;
            case '2':
                $m = 'Februari';
                break;
            case '3':
                $m = 'Maret';
                break;
            case '4':
                $m = 'April';
                break;
            case '5':
                $m = 'Mei';
                break;
            case '6':
                $m = 'Juni';
                break;
            case '7':
                $m = 'Juli';
                break;
            case '8':
                $m = 'Agustus';
                break;
            case '9':
                $m = 'September';
                break;
            case '10':
                $m = 'Oktober';
                break;
            case '11':
                $m = 'November';
                break;
            case '12':
                $m = 'Desember';
                break;
            default:
                $m = '';
                break;
        }

        if ($m != '') {
            $return = $d . ' ' . $m . ' ' . $y;
        }
    }

    return $return;
}

function convertDateIndoFromEn($tgl)
{
    $return = 'Invalid format date.';

    if (strpos($tgl, '-') !== false) {
        $arrTgl = explode('-', $tgl);
        $d = str_pad($arrTgl[0], 2, '0', STR_PAD_LEFT);
        $m = $arrTgl[1];

        $y = $arrTgl[2];

        switch ((int) $m) {
            case '1':
                $m = 'Januari';
                break;
            case '2':
                $m = 'Februari';
                break;
            case '3':
                $m = 'Maret';
                break;
            case '4':
                $m = 'April';
                break;
            case '5':
                $m = 'Mei';
                break;
            case '6':
                $m = 'Juni';
                break;
            case '7':
                $m = 'Juli';
                break;
            case '8':
                $m = 'Agustus';
                break;
            case '9':
                $m = 'September';
                break;
            case '10':
                $m = 'Oktober';
                break;
            case '11':
                $m = 'November';
                break;
            case '12':
                $m = 'Desember';
                break;
            default:
                $m = '';
                break;
        }

        if ($m != '') {
            $return = $d . ' ' . $m . ' ' . $y;
        }
    }

    return $return;
}

function convertMonthIndo($month)
{
    $m = 'Invalid format month.';

    switch ((int) $month) {
        case '1':
            $m = 'Januari';
            break;
        case '2':
            $m = 'Februari';
            break;
        case '3':
            $m = 'Maret';
            break;
        case '4':
            $m = 'April';
            break;
        case '5':
            $m = 'Mei';
            break;
        case '6':
            $m = 'Juni';
            break;
        case '7':
            $m = 'Juli';
            break;
        case '8':
            $m = 'Agustus';
            break;
        case '9':
            $m = 'September';
            break;
        case '10':
            $m = 'Oktober';
            break;
        case '11':
            $m = 'November';
            break;
        case '12':
            $m = 'Desember';
            break;
        default:
            $m = '';
            break;
    }

    return $m;
}
