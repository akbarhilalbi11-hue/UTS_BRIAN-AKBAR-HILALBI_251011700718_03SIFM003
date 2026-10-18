<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Electronic;

class ElectronicSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'MacBook Pro M2 14-inch',
                'brand' => 'Apple',
                'specs' => 'Apple M2 Pro chip, 16GB RAM, 512GB SSD, Liquid Retina XDR display.',
                'price' => 29999000,
                'image' => '/images/MacBook Air M2 _ Ultra-Fast Performance, Lightweight Design & Best Price.jpg', // Mengambil dari public/images/macbook.jpg
                'category' => 'Laptop'
            ],
            [
                'name' => 'Galaxy S23 Ultra',
                'brand' => 'Samsung',
                'specs' => 'Snapdragon 8 Gen 2, 12GB RAM, 256GB Storage, 200MP Camera.',
                'price' => 19999000,
                'image' => '/images/UNBOXED  Google Pixel 8pro 256GB ⚫️.jpg', 
                'category' => 'Smartphone'
            ],
            [
                'name' => 'Sony WH-1000XM5',
                'brand' => 'Sony',
                'specs' => 'Industry Leading Noise Canceling, 30 hours battery life, Hi-Res Audio.',
                'price' => 5499000,
                'image' => '/images/Sony WH-1000XM5 Premium Noise Canceling Headphones, Auto NC Optimizer.jpg', 
                'category' => 'Audio'
            ],
            [
                'name' => 'LG OLED C3 55-inch',
                'brand' => 'LG',
                'specs' => 'OLED evo, 4K UHD, 120Hz Refresh Rate, WebOS.',
                'price' => 24999000,
                'image' => '/images/LG UR80 4K Smart TV.jpg', 
                'category' => 'Television'
            ],
            [
                'name' => 'iPad Pro 12.9-inch (M2)',
                'brand' => 'Apple',
                'specs' => 'Apple M2 chip, 12.9-inch Liquid Retina XDR display, ProMotion, Apple Pencil hover.',
                'price' => 21999000,
                'image' => '/images/Ipad pro 12_9 inch M2 chip.jpg', 
                'category' => 'Tablet'
            ],
            [
                'name' => 'PlayStation 5 Disc Edition',
                'brand' => 'Sony',
                'specs' => 'Ultra-High Speed SSD, Ray Tracing, 4K-TV Gaming, Up to 120fps with 120Hz output.',
                'price' => 9599000,
                'image' => '/images/PS 5 450$.jpg', 
                'category' => 'Gaming'
            ],
            [
                'name' => 'Sony Alpha a7 IV',
                'brand' => 'Sony',
                'specs' => '33MP Full-Frame Exmor R CMOS Sensor, Up to 10 fps Shooting, 4K 60p Video in 10-Bit.',
                'price' => 41999000,
                'image' => '/images/camera.jpg', 
                'category' => 'Camera'
            ],
            [
                'name' => 'ASUS ROG Zephyrus G14',
                'brand' => 'ASUS',
                'specs' => 'AMD Ryzen 9 7940HS, NVIDIA RTX 4060, 16GB DDR5, 14-inch QHD+ 165Hz Nebula Display.',
                'price' => 26999000,
                'image' => '/images/(Análise) ASUS ROG Zephyrus G14_ Tudo o que poderia desejar.jpg', 
                'category' => 'Laptop Gaming'
            ],
            [
                'name' => 'Apple Watch Series 9',
                'brand' => 'Apple',
                'specs' => 'S9 SiP, Double tap gesture, Blood oxygen app, Always-On Retina display.',
                'price' => 7499000,
                'image' => '/images/download (7).jpg', 
                'category' => 'Smartwatch'
            ],
            [
                'name' => 'Google Pixel 8 Pro',
                'brand' => 'Google',
                'specs' => 'Google Tensor G3, 12GB RAM, 128GB Storage, 50MP main camera with Magic Eraser.',
                'price' => 16499000,
                'image' => '/images/UNBOXED  Google Pixel 8pro 256GB ⚫️.jpg', 
                'category' => 'Smartphone'
            ],
            [
                'name' => 'Logitech MX Master 3S',
                'brand' => 'Logitech',
                'specs' => '8K DPI Any-Surface Tracking, Quiet Clicks, MagSpeed Scrolling, Ergonomic Design.',
                'price' => 1699000,
                'image' => '/images/download (8).jpg', 
                'category' => 'Mouse'
            ],
            [
                'name' => 'AirPods Pro (2nd Gen)',
                'brand' => 'Apple',
                'specs' => 'H2 chip, 2x better Active Noise Cancellation, Adaptive Transparency, MagSafe Charging.',
                'price' => 4299000,
                'image' => '/images/Airpods Pro 2nd Gen.jpg', 
                'category' => 'Audio'
            ],
            [
                'name' => 'Nintendo Switch OLED',
                'brand' => 'Nintendo',
                'specs' => '7-inch OLED screen, 64GB internal storage, Enhanced audio, Wide adjustable stand.',
                'price' => 5299000,
                'image' => '/images/Nintendo Switch OLED White Console.jpg', 
                'category' => 'Gaming'
            ],
            [
                'name' => 'DJI Mini 3 Pro',
                'brand' => 'DJI',
                'specs' => 'Weighs <249 g, Tri-Directional Obstacle Sensing, 4K HDR Video, Extended Battery Life.',
                'price' => 13499000,
                'image' => '/images/DJI Mini 3 Drone (with RC Remote Controller) _ JD Williams.jpg', 
                'category' => 'Drone'
            ]
        ];

        foreach ($products as $product) {
            Electronic::create($product);
        }
    }
}