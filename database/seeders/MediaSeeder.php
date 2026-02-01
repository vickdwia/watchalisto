<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Media;
use App\Models\Genre;

class MediaSeeder extends Seeder
{
    public function run(): void
    {
        $media = Media::updateOrCreate(
            [
                'title' => 'Twenty Five Twenty One',
                'type'  => 'drama',
            ],
            [
                'synopsis' => 'Di saat mimpi tampak tidak mungkin dapat diraih...',
                'poster' => 'posters/2521.jpg',
                'release_year' => 2019,
                'status' => 'finished',
            ]
        );

        $media->genres()->sync(
            Genre::whereIn('name', ['Romance', 'Drama'])->pluck('id')
        );

        $media = Media::updateOrCreate(
            [
                'title' => 'Twinkling Watermelon',
                'type'  => 'drama',
            ],
            [
                'synopsis' => 'Twinkling Watermelon adalah drama fantasi...',
                'poster' => 'posters/TwinklingWatermelon.jpg',
                'release_year' => 2016,
                'status' => 'finished'
            ]
        );

        $media->genres()->sync(
            Genre::whereIn('name', ['Fantasy', 'Romance'])->pluck('id')
        );

        $media = Media::updateOrCreate(
            [   'title' => 'Crash Landing on You',
                'type' => 'drama',
            ],
            [
                'synopsis' => 'Seorang pewaris Korea Selatan terdampar di Korea Utara dan bertemu perwira militer yang mengubah hidupnya.',
                'poster' => 'posters/crash_landing_on_you.jpg',
                'release_year' => 2019,
                'status' => 'finished'
            ]
        );
        $media->genres()->sync(
            Genre::whereIn('name', ['Romance', 'Drama'])->pluck('id')
        );

        $media = Media::updateOrCreate(
            [   'title' => 'Itaewon Class',
                'type' => 'drama',
            ],
            [
                'synopsis' => 'Pemuda dengan masa lalu kelam membangun bisnis restoran untuk membalas ketidakadilan yang menimpanya.',
                'poster' => 'posters/itaewon_class.jpg',
                'release_year' => 2020,
                'status' => 'finished'
            ]
        );
        $media->genres()->sync(
            Genre::whereIn('name', ['Drama'])->pluck('id')
        );

        $media = Media::updateOrCreate(
            [   'title' => 'Dear X',
                'type' => 'drama',
            ],
            [
                'synopsis' => 'Dear X menceritakan kisah pemeran Korea Selatan Baek A-jin yang tanpa henti menapaki karier dengan menyembunyikan masa lalunya yang gelap.',
                'poster' => 'posters/dear_x.png',
                'release_year' => 2025,
                'status' => 'ongoing'
            ]
        );
        $media->genres()->sync(
            Genre::whereIn('name', ['Thriller', 'Drama'])->pluck('id')
        );

        $media = Media::updateOrCreate(
            [   'title' => 'Reply 1988',
                'type' => 'drama',
            ],
            [
                'synopsis' => 'Kehidupan keluarga dan persahabatan lima remaja di lingkungan Ssangmun-dong tahun 1988.',
                'poster' => 'posters/reply_1988.jpg',
                'release_year' => 2015,
                'status' => 'finished'
            ]
        );
        $media->genres()->sync(
            Genre::whereIn('name', ['Drama', 'Slice of Life'])->pluck('id')
        );

        $media = Media::updateOrCreate(
            [   'title' => 'Vincenzo',
                'type' => 'drama',
            ],
            [
                'synopsis' => 'Pengacara mafia Italia-Korea menggunakan cara ekstrem untuk melawan korporasi korup.',
                'poster' => 'posters/vincenzo.jpg',
                'release_year' => 2021,
                'status' => 'ongoing'
            ]
        );
        $media->genres()->sync(
            Genre::whereIn('name', ['Action', 'Drama'])->pluck('id')
        );

        $media = Media::updateOrCreate(
            [   'title' => 'Signal',
                'type' => 'drama',
            ],
            [
                'synopsis' => 'Detektif dari masa kini berkomunikasi dengan detektif masa lalu melalui walkie-talkie misterius.',
                'poster' => 'posters/signal.jpg',
                'release_year' => 2016,
                'status' => 'finished'
            ]
        );
        $media->genres()->sync(
            Genre::whereIn('name', ['Thriller', 'Mystery'])->pluck('id')
        );

        $media = Media::updateOrCreate(
            [   'title' => 'Mr. Sunshine',
                'type' => 'drama',
            ],
            [
                'synopsis' => 'Kisah cinta dan patriotisme di Korea pada awal abad ke-20.',
                'poster' => 'posters/mr_sunshine.jpg',
                'release_year' => 2018,
                'status' => 'finished'
            ]
        );
        $media->genres()->sync(
            Genre::whereIn('name', ['Drama', 'Historical'])->pluck('id')
        );

        $media = Media::updateOrCreate(
            [   'title' => 'Night Has Come',
                'type' => 'drama',
            ],
            [
                'synopsis' => 'Sekelompok siswa SMA dipaksa memainkan permainan Mafia yang mematikan di sebuah pusat retret.',
                'poster' => 'posters/night_has_come.jpg',
                'release_year' => 2023,
                'status' => 'finished'
            ]
        );
        $media->genres()->sync(
            Genre::whereIn('name', ['Thriller', 'Mystery'])->pluck('id')
        );

        $media = Media::updateOrCreate(
            [   'title' => 'Hospital Playlist',
                'type' => 'drama',
            ],
            [
                'synopsis' => 'Kisah persahabatan lima dokter yang telah bersama sejak kuliah kedokteran.',
                'poster' => 'posters/hospital_playlist.jpg',
                'release_year' => 2020,
                'status' => 'finished'
            ]
        );
        $media->genres()->sync(
            Genre::whereIn('name', ['Drama', 'Slice of Life'])->pluck('id')
        );

        $media = Media::updateOrCreate(
            [   'title' => 'Crash Course in Romance',
                'type' => 'drama',
            ],
            [
                'synopsis' => 'Seorang ibu berhati emas menghadapi dunia kursus swasta yang keras saat putrinya mencoba masuk ke kelas pengajar matematika yang terkenal',
                'poster' => 'posters/Crash_Course_in_Romance.jpg',
                'release_year' => 2023,
                'status' => 'finished'
            ]
        );
        $media->genres()->sync(
            Genre::whereIn('name', ['Romance', 'Comedy'])->pluck('id')
        );

        $media = Media::updateOrCreate(
            [   'title' => 'Revenge of Others',
                'type' => 'drama',
            ],
            [
                'synopsis' => 'Ok Chan Mi yang kehilangan kembarannya dan bertekad untuk membalas dendam atas kematian tersebut',
                'poster' => 'posters/Revenge_of_Others.jpg',
                'release_year' => 2022,
                'status' => 'ongoing'
            ]
        );
        $media->genres()->sync(
            Genre::whereIn('name', ['Thriller', 'Action', 'Mystery'])->pluck('id')
        );

        $media = Media::updateOrCreate(
            [   'title' => 'Study Group',
                'type' => 'drama',
            ],
            [
                'synopsis' => 'Yoon Ga-min, yang hanya berbakat dalam berkelahi, berusaha belajar keras untuk mencapai tujuannya masuk universitas dengan membentuk kelompok belajar di Sekolah Menengah Teknik Yusung yang terkenal buruk reputasinya.',
                'poster' => 'posters/Study_Group.png',
                'release_year' => 2025,
                'status' => 'ongoing'
            ]
        );
        $media->genres()->sync(
            Genre::whereIn('name', ['Action', 'Comedy'])->pluck('id')
        );

        $media = Media::updateOrCreate(
            [   'title' => '18 Again',
                'type' => 'drama',
            ],
            [
                'synopsis' => 'Atlet angkat besi muda menjalani kehidupan kampus, mimpi, dan cinta pertamanya.',
                'poster' => 'posters/18_Again.jpg',
                'release_year' => 2020,
                'status' => 'finished'
            ]
        );
        $media->genres()->sync(
            Genre::whereIn('name', ['Romance', 'Drama', 'Fantasy'])->pluck('id')
        );

        $media = Media::updateOrCreate(
            [   'title' => 'High Cookie',
                'type' => 'drama',
            ],
            [
                'synopsis' => 'High Cookie adalah drama thriller misteri tentang sebuah kue ajaib yang bisa mewujudkan keinginan seseorang hanya dengan satu gigitan.',
                'poster' => 'posters/High_Cookie.jpg',
                'release_year' => 2024,
                'status' => 'finished'
            ]
        );
        $media->genres()->sync(
            Genre::whereIn('name', ['Thriller', 'Mystery'])->pluck('id')
        );

        $media = Media::updateOrCreate(
            [   'title' => 'Hometown Cha-Cha-Cha',
                'type' => 'drama',
            ],
            [
                'synopsis' => 'Dokter gigi perfeksionis pindah ke desa pesisir dan bertemu pria serba bisa yang hangat.',
                'poster' => 'posters/Hometown_Cha-Cha-Cha.jpg',
                'release_year' => 2021,
                'status' => 'finished'
            ]
        );
        $media->genres()->sync(
            Genre::whereIn('name', ['Romance', 'Drama', 'Slice of Life'])->pluck('id')
        );

        $media = Media::updateOrCreate(
            [   'title' => 'Mouse',
                'type' => 'drama',
            ],
            [
                'synopsis' => 'Perburuan psikopat kejam mengungkap sisi gelap moral dan genetika manusia.',
                'poster' => 'posters/mouse.jpg',
                'release_year' => 2021,
                'status' => 'ongoing'
            ]
        );
        $media->genres()->sync(
            Genre::whereIn('name', ['Thriller', 'Mystery'])->pluck('id')
        );
    }
}
