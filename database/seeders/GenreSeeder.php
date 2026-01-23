<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;


class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            'Romance',
            'Drama',
            'Fantasy',
            'Action',
            'Thriller',
            'Comedy',
            'Slice of Life',
            'Mystery',
        ];

        foreach ($genres as $genre) {
            Genre::firstOrCreate(['name' => $genre]);
        }
    }
}
