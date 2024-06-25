<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Str;

class MyHelper
{
    public static function ubahFormatTanggal($tanggal)
    {
        $carbonDate = Carbon::parse($tanggal);
        return $carbonDate->format('d F Y');
    }

    public static function ubahFormatTimestamp($timestamp)
    {
        $carbonDate = Carbon::parse($timestamp);
        return $carbonDate->format('d F Y, H:i:s');
    }

    public static function potongString($string)
    {
        $result = Str::limit(strip_tags($string), 50);
        return $result;
    }

    public static function potongRequestUrl($currentUrl)
    {
        // Menggunakan parse_url untuk membagi URL menjadi komponen-komponennya
        $parsedUrl = parse_url($currentUrl);

        // Mengambil bagian path dari URL
        $path = $parsedUrl['path'];

        // Menghapus karakter slash dari awal string jika ada
        $path = ltrim($path, '/');

        // Mengembalikan hanya path dari URL tanpa slash di awal
        return $path;
    }

    public static function generateAvatar($name)
    {
        $obj = new self();
        $result = $obj->generateInitials($name);
        $initial = $result['initials'];
        $fontSize = $result['fontSize'];
        $avatarSize = 100;
        $image = imagecreatetruecolor($avatarSize, $avatarSize);

        // Set background color
        $bgColor = imagecolorallocate($image, 204, 9, 214);
        imagefill($image, 0, 0, $bgColor);

        // Set text color
        $textColor = imagecolorallocate($image, 255, 255, 255);

        // Path to a .ttf font file
        $fontPath = public_path('fonts/arial.ttf');

        // Calculate text position
        $bbox = imagettfbbox($fontSize, 0, $fontPath, $initial);
        // dd($bbox);
        $textWidth = $bbox[2] - $bbox[0]; // Lebar teks
        $textHeight = $bbox[7] - $bbox[1]; // Tinggi teks

        // Hitung posisi tengah untuk teks
        $x = ($avatarSize - $textWidth) / 2;
        $y = $result['y'];

        // Add the text
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $fontPath, $initial);

        // Save the image
        $storagePath = public_path('storage/avatars');
        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        $namePath = $name . '-' . uniqid() . '.png';
        $avatarPath = $storagePath . '/' . $namePath;

        imagepng($image, $avatarPath);
        imagedestroy($image);

        $imagePathOutput = 'avatars/' . $namePath;
        // dd($imagePathOutput);

        return $imagePathOutput;
    }

    public function generateInitials($name)
    {
        $words = explode(' ', $name);
        $initials = '';

        // Jika hanya satu kata, ambil inisial dari karakter pertama
        if (count($words) == 1) {
            $initials = strtoupper(substr($words[0], 0, 1));
        } else {
            // Jika lebih dari satu kata, ambil inisial dari dua kata pertama
            for ($i = 0; $i < min(count($words), 2); $i++) {
                $initials .= strtoupper(substr($words[$i], 0, 1));
            }

            // Jika lebih dari dua kata, gunakan font size 32
            if (count($words) > 1) {
                return ['initials' => $initials, 'fontSize' => 32, 'y' => 65];
            }
        }

        return ['initials' => $initials, 'fontSize' => 50, 'y' => 70];
    }
}
