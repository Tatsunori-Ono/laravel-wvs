<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EquipmentItem;
use App\Models\EquipmentImage;

class EquipmentItemsTableSeeder extends Seeder
{
    /**
     * データベースのシードを実行します。
     * Run the database seeds.
     */
    public function run(): void
    {
        // デフォルトの機材アイテムを作成
        // Create default equipment items
        $equipmentItems = [
            [
                'product_name' => 'Focusrite Scarlett 2i2 4th Gen',
                'product_type' => 'Audio Interface',
                'manufacturer' => 'Focusrite',
                'category' => 'Audio Equipment',
                'location_stored' => 'President\'s House',
                'description' => 'USB Audio Interface for Recording, Songwriting, Streaming and Podcasting — High-Fidelity, Studio Quality Recording, and All the Software You Need to Record.',
                'purchase_date' => '2023-11-15',
                'quantity' => 1,
                'rented_quantity' => 0,
                'max_rental_days' => 7,
                'price' => 0.00,
                'rental_count' => 5,
                'average_rating' => 4.5,
                'images' => [
                    ['image_path' => 'seed_images/audio-interface-1.png'],
                    ['image_path' => 'seed_images/audio-interface-2.png'],
                    ['image_path' => 'seed_images/audio-interface-3.png'],
                    ['image_path' => 'seed_images/audio-interface-4.png'],
                    ['image_path' => 'seed_images/audio-interface-5.png'],
                    ['image_path' => 'seed_images/audio-interface-6.png'],
                    ['image_path' => 'seed_images/audio-interface-7.png'],
                    ['image_path' => 'seed_images/audio-interface-8.png'],
                ]
            ],
            [
                'product_name' => 'Pioneer DJ DDJ-200',
                'product_type' => 'DJ Controller',
                'manufacturer' => 'Pioneer',
                'category' => 'Audio Equipment',
                'location_stored' => 'President\'s House',
                'description' => '2-channel Smart DJ controller. Start DJing with our easy-to-use DDJ-200 smart DJ controller. Lightweight and compact with a pro-style layout, it’ll help you learn to mix and, if you want to, develop DJing from a hobby into something more. Put your own twist on the music as you mix for friends at parties.',
                'purchase_date' => '2024-05-09',
                'quantity' => 1,
                'rented_quantity' => 0,
                'max_rental_days' => 7,
                'price' => 0.00,
                'rental_count' => 2,
                'average_rating' => 4.5,
                'images' => [
                    ['image_path' => 'seed_images/dj-1.png'],
                    ['image_path' => 'seed_images/dj-2.png'],
                    ['image_path' => 'seed_images/dj-3.png'],
                    ['image_path' => 'seed_images/dj-4.png'],
                    ['image_path' => 'seed_images/dj-5.png'],
                    ['image_path' => 'seed_images/dj-6.png'],
                    ['image_path' => 'seed_images/dj-7.png'],
                    ['image_path' => 'seed_images/dj-8.png'],
                    ['image_path' => 'seed_images/dj-9.png'],
                ]
            ],
            [
                'product_name' => 'Electric Rotating Turntable',
                'product_type' => 'Figure Rotation Table',
                'manufacturer' => 'CDIYTOOL',
                'category' => 'Photography',
                'location_stored' => 'President\'s House',
                'description' => '90/180 Degree Motorized Rotating Stand Display Table for Live Video Automatic Revolving Platform with 6 Backgrounds. Used to take video of figures.',
                'purchase_date' => '2024-05-12',
                'quantity' => 1,
                'rented_quantity' => 0,
                'max_rental_days' => 7,
                'price' => 0.00,
                'rental_count' => 2,
                'average_rating' => 4.5,
                'images' => [
                    ['image_path' => 'seed_images/figure-rotation-stand-1.png'],
                    ['image_path' => 'seed_images/figure-rotation-stand-2.png'],
                    ['image_path' => 'seed_images/figure-rotation-stand-3.png'],
                ]
            ],
            [
                'product_name' => 'Unofficial Hatsune Mix',
                'product_type' => 'Book',
                'manufacturer' => 'KEI, Dark Horse Manga',
                'category' => 'Book',
                'location_stored' => 'President\'s House',
                'description' => 'It\'s Hatsune Miku, the Vocaloid - the synthesizer superstar who\'s singing whatever song you like! She\'s a global cyber celebrity and a cosplay favourite at conventions. Now Miku\'s creator, KEI, brings readers Hatsune Miku: Unofficial Hatsune Mix - an omnibus manga of the musical adventures of Miku and her fellow Vocaloids Rin, Len, Luka and more - in both beautiful black-and-white and charming colour!',
                'purchase_date' => '2024-01-14',
                'quantity' => 1,
                'rented_quantity' => 0,
                'max_rental_days' => 7,
                'price' => 0.00,
                'rental_count' => 10,
                'average_rating' => 4.7,
                'images' => [
                    ['image_path' => 'seed_images/hatsunemix-1.png'],
                    ['image_path' => 'seed_images/hatsunemix-2.png'],
                    ['image_path' => 'seed_images/hatsunemix-3.png'],
                ]
            ],
            [
                'product_name' => 'TONOR Dynamic Microphone',
                'product_type' => 'Microphone',
                'manufacturer' => 'TONOR',
                'category' => 'Audio Equipment',
                'location_stored' => 'President\'s House',
                'description' => 'TONOR Dynamic Karaoke Microphone for Singing with 16.4ft/ 5M XLR Cable, Metal Handheld Mic Compatible with Karaoke Machine/Speaker/Amp/Mixer for Karaoke Singing, Speech, Wedding and Outdoor Activity.',
                'purchase_date' => '2023-11-12',
                'quantity' => 2,
                'rented_quantity' => 0,
                'max_rental_days' => 7,
                'price' => 0.00,
                'rental_count' => 20,
                'average_rating' => 4.3,
                'images' => [
                    ['image_path' => 'seed_images/mic-1.png'],
                    ['image_path' => 'seed_images/mic-2.png'],
                    ['image_path' => 'seed_images/mic-3.png'],
                    ['image_path' => 'seed_images/mic-4.png'],
                    ['image_path' => 'seed_images/mic-5.png'],
                    ['image_path' => 'seed_images/mic-6.png'],
                    ['image_path' => 'seed_images/mic-7.png'],
                ]
            ],
            [
                'product_name' => 'PreSonus ATOM SQ',
                'product_type' => 'MIDI Keyboard',
                'manufacturer' => 'PreSonus',
                'category' => 'Audio Equipment',
                'location_stored' => 'President\'s House',
                'description' => 'PreSonus ATOM SQ, hybrid MIDI Keyboard / Pad Performance and Production Controller with Studio One Artist, Ableton Live Lite and Studio Magic recording software bundle.',
                'purchase_date' => '2023-11-17',
                'quantity' => 1,
                'rented_quantity' => 0,
                'max_rental_days' => 7,
                'price' => 0.00,
                'rental_count' => 1,
                'average_rating' => 4.4,
                'images' => [
                    ['image_path' => 'seed_images/midi-1.png'],
                    ['image_path' => 'seed_images/midi-2.png'],
                    ['image_path' => 'seed_images/midi-3.png'],
                    ['image_path' => 'seed_images/midi-4.png'],
                    ['image_path' => 'seed_images/midi-5.png'],
                    ['image_path' => 'seed_images/midi-6.png'],
                    ['image_path' => 'seed_images/midi-7.png'],
                    ['image_path' => 'seed_images/midi-8.png'],
                    ['image_path' => 'seed_images/midi-9.png'],
                ]
            ],
            [
                'product_name' => 'OTL Hatsune Miku Karaoke Microphone',
                'product_type' => 'Microphone',
                'manufacturer' => 'OTL',
                'category' => 'Entertainment',
                'location_stored' => 'President\'s House',
                'description' => 'This stylish Hatsune Miku microphone is perfect for virtual concerts on stage!',
                'purchase_date' => '2023-11-12',
                'quantity' => 1,
                'rented_quantity' => 0,
                'max_rental_days' => 7,
                'price' => 0.00,
                'rental_count' => 15,
                'average_rating' => 4.0,
                'images' => [
                    ['image_path' => 'seed_images/miku-mic-1.png'],
                    ['image_path' => 'seed_images/miku-mic-2.png'],
                    ['image_path' => 'seed_images/miku-mic-3.png'],
                    ['image_path' => 'seed_images/miku-mic-4.png'],
                    ['image_path' => 'seed_images/miku-mic-5.png'],
                    ['image_path' => 'seed_images/miku-mic-6.png'],
                    ['image_path' => 'seed_images/miku-mic-7.png'],
                ]
            ],
            [
                'product_name' => 'LED Live Concert Penlight',
                'product_type' => 'Penlight',
                'manufacturer' => 'Daiso',
                'category' => 'Entertainment',
                'location_stored' => 'President\'s House',
                'description' => 'Material: Grip: ABS resin Tube: Vinyl chloride resin Product size: 3.3 cm x 3.3 cm x 20.6 cm Content quantity: 1 bottle. Type (colour, pattern, design): No assortment. This light can switch between 8 different colours, ideal for concerts, cheering and events. Battery used: 3 x LR44 (1.5V) button batteries. It includes batteries.',
                'purchase_date' => '2023-12-24',
                'quantity' => 20,
                'rented_quantity' => 0,
                'max_rental_days' => 7,
                'price' => 0.00,
                'rental_count' => 40,
                'average_rating' => 5.0,
                'images' => [
                    ['image_path' => 'seed_images/penlights-1.png'],
                    ['image_path' => 'seed_images/penlights-2.png'],
                    ['image_path' => 'seed_images/penlights-3.png'],
                    ['image_path' => 'seed_images/penlights-4.png'],
                    ['image_path' => 'seed_images/penlights-5.png'],
                    ['image_path' => 'seed_images/penlights-6.png'],
                    ['image_path' => 'seed_images/penlights-7.png'],
                    ['image_path' => 'seed_images/penlights-8.png'],
                    ['image_path' => 'seed_images/penlights-9.png'],
                ]
            ],
            [
                'product_name' => '100 DTM techniques of Vocaloid Producers',
                'product_type' => 'Book',
                'manufacturer' => 'Rittor Music',
                'category' => 'Book',
                'location_stored' => 'President\'s House',
                'description' => 'Ten famous Vocaloid Ps gave us plenty of tips on how to make songs in their home studios! Each person explains ten DTM techniques used in popular songs posted on Nico Nico Douga. Also included are photos of their studios and equipment, as well as interviews about their songwriting know-how. The magazine is called "100", but in fact it is packed with more than 100 ideas and techniques. The contributors include DECO*27, OSTER project, sasakure.UK, 40mP, Pinocchioopy, Shiina Mota, monaca:factory, Zanoi, whoo and Utsu P. All of them are important artists in the Vocaloid scene, known for their many Hall of Fame songs or songs with million views. This is a very exciting book that all DTMers must see!',
                'purchase_date' => '2020-12-09',
                'quantity' => 1,
                'rented_quantity' => 0,
                'max_rental_days' => 7,
                'price' => 0.00,
                'rental_count' => 10,
                'average_rating' => 3.9,
                'images' => [
                    ['image_path' => 'seed_images/producer-book-1.png'],
                    ['image_path' => 'seed_images/producer-book-2.png'],
                    ['image_path' => 'seed_images/producer-book-3.png'],
                ]
            ],
            [
                'product_name' => 'Sony MDR-CD900ST',
                'product_type' => 'Dynamic Stereo Headphones',
                'manufacturer' => 'Sony',
                'category' => 'Audio Equipment',
                'location_stored' => 'President\'s House',
                'description' => 'A professional-grade monitor headphone that is widely used in the music industry. It is a sealed dynamic type headphone with a 40mm dome type driver unit (with CCAW) that delivers high-quality sound.',
                'purchase_date' => '2020-10-29',
                'quantity' => 1,
                'rented_quantity' => 0,
                'max_rental_days' => 7,
                'price' => 0.00,
                'rental_count' => 5,
                'average_rating' => 5.0,
                'images' => [
                    ['image_path' => 'seed_images/sony-1.png'],
                    ['image_path' => 'seed_images/sony-2.png'],
                    ['image_path' => 'seed_images/sony-3.png'],
                    ['image_path' => 'seed_images/sony-4.png'],
                    ['image_path' => 'seed_images/sony-5.png'],
                    ['image_path' => 'seed_images/sony-6.png'],
                ]
            ],
            [
                'product_name' => 'Nicpro 6 Pack A4 Whiteboard',
                'product_type' => 'Whiteboard',
                'manufacturer' => 'Nicpro',
                'category' => 'Entertainment',
                'location_stored' => 'President\'s House',
                'description' => 'Nicpro 6 Pack Dry Erase Mini Whiteboard A4, 22 x 30 cm Double Sided Lapboard Bulk with 18 Water-Based Pens Erasers Learning Small White Board Portable Drawing Writing for Student and Classroom Use.',
                'purchase_date' => '2023-11-18',
                'quantity' => 1,
                'rented_quantity' => 0,
                'max_rental_days' => 7,
                'price' => 0.00,
                'rental_count' => 10,
                'average_rating' => 4.6,
                'images' => [
                    ['image_path' => 'seed_images/whiteboard-1.png'],
                    ['image_path' => 'seed_images/whiteboard-2.png'],
                    ['image_path' => 'seed_images/whiteboard-3.png'],
                    ['image_path' => 'seed_images/whiteboard-4.png'],
                    ['image_path' => 'seed_images/whiteboard-5.png'],
                    ['image_path' => 'seed_images/whiteboard-6.png'],
                ]
            ],
            // ここから他にもデフォルトの機材を追加できる
        ];

        foreach ($equipmentItems as $itemData) {
            $images = $itemData['images'];
            unset($itemData['images']);

            $equipmentItem = EquipmentItem::create($itemData);

            foreach ($images as $image) {
                $equipmentItem->images()->create($image);
            }
        }
    }
}
