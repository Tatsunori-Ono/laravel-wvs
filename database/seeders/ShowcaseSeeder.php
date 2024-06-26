<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShowcaseItem;
use App\Models\ShowcaseWork;
use Illuminate\Support\Facades\Storage;

class ShowcaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ensure the storage directory exists
        Storage::disk('public')->makeDirectory('showcase_works');

        // Create an approved showcase item
        $approvedItem = ShowcaseItem::create([
            'name' => 'Eunji',
            'title' => 'WVS-chan',
            'description' => 'This is WVS-chan drawn by Eunji from Drawing Social Project. The original character design of WVS-chan was by Charlie.',
            'user_id' => 1, // Assuming user with ID 1 exists
            'approved' => true,
        ]);

        $approvedItem2 = ShowcaseItem::create([
            'name' => 'Rohan',
            'title' => 'Stand Alone feat. Kasane Teto and Hatsune Miku',
            'description' => 'Stand Alone cover of Kasane Teto and Hatsune Miku. Stand Alone is a song by Dios.',
            'user_id' => 1, // Assuming user with ID 1 exists
            'approved' => true,
        ]);

        ShowcaseWork::create([
            'showcase_item_id' => $approvedItem->id,
            'file_path' => 'showcase_seed/sample_approved_image.png',
        ]);

        ShowcaseWork::create([
            'showcase_item_id' => $approvedItem2->id,
            'file_path' => 'showcase_seed/sample2_approved_music.mp3',
        ]);

        // Add a sample file to the storage
        Storage::disk('public')->put('showcase_seed/sample_approved_image.png', file_get_contents(public_path('showcase_seed/sample_approved_image.png')));
        Storage::disk('public')->put('showcase_seed/sample_approved_music.mp3', file_get_contents(public_path('showcase_seed/sample2_approved_music.mp3')));

        // Create an unapproved showcase item
        $unapprovedItem = ShowcaseItem::create([
            'name' => 'Hashim',
            'title' => 'Eurobeat Riff',
            'description' => 'Epic beat created by Hashim, our ex-secretary.',
            'user_id' => 1, // Assuming user with ID 1 exists
            'approved' => false,
        ]);

        $unapprovedItem2 = ShowcaseItem::create([
            'name' => 'Bernard',
            'title' => 'WVS-chan',
            'description' => 'This is WVS-chan drawn by Bernard from Drawing Social project. The original character design of WVS-chan was by Charlie.',
            'user_id' => 1, // Assuming user with ID 1 exists
            'approved' => false,
        ]);

        ShowcaseWork::create([
            'showcase_item_id' => $unapprovedItem->id,
            'file_path' => 'showcase_seed/sample_unapproved_music.mp3',
        ]);

        ShowcaseWork::create([
            'showcase_item_id' => $unapprovedItem2->id,
            'file_path' => 'showcase_seed/sample2_unapproved_image.png',
        ]);

        // Add a sample file to the storage
        Storage::disk('public')->put('showcase_seed/sample_unapproved_music.mp3', file_get_contents(public_path('showcase_seed/sample_unapproved_music.mp3')));
        Storage::disk('public')->put('showcase_seed/sample2_unapproved_image.png', file_get_contents(public_path('showcase_seed/sample2_unapproved_image.png')));
    }
}
