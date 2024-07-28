<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use RyanChandler\FilamentNavigation\Models\Navigation;

class InstallMenuDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Navigation::create([
            'name' => 'Header',
            'handle' => 'header',
            'items' => json_decode('{"05171be7-6ee8-4078-8ae7-1ccecc10b4bf":{"label":"Home","type":"external-link","data":{"url":"\/","target":null},"children":[]},"31ad95d7-9cec-4690-bd94-fddabbdb3b2e":{"label":"Blog","type":"external-link","data":{"url":"\/blog","target":null},"children":[]},"afdf8b18-112a-47bf-9616-100b5615f362":{"label":"Favorites","type":"external-link","data":{"url":"\/favorites","target":null},"children":[]},"232acb30-b9a2-4556-a674-b8b6d5fc98ab":{"label":"Compares","type":"external-link","data":{"url":"\/compares","target":null},"children":[]},"22fd32a2-1b09-4c08-b810-053a3df264cd":{"label":"Contact Us","type":"external-link","data":{"url":"\/page\/contact-us","target":null},"children":[]},"656d0369-0ba7-48b9-a4aa-188a0f08585c":{"label":"About Us","type":"external-link","data":{"url":"\/page\/about-us","target":null},"children":[]}}')
        ]);
        Navigation::create([
            'name' => 'Buying & Selling',
            'handle' => 'footer_menu_1',
            'items' => json_decode('{"b108a94a-327e-43bd-9aae-b4578d2aa287":{"label":"Find a car","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]},"75b471d7-7778-4d0a-94ec-3c160f8086b1":{"label":"Sell your car","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]},"a2401515-6ac0-48b8-b559-b09277b29049":{"label":"Car dealers","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]},"73d72bd2-c829-4be5-a71e-25eda7c2c19a":{"label":"Compare cars","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]},"db2e4f4a-169d-4f31-bc0e-08f70213ab1e":{"label":"Online car appraisal","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]}}')
        ]);
        Navigation::create([
            'name' => 'About',
            'handle' => 'footer_menu_2',
            'items' => json_decode('{"5f78eefe-1939-4807-a737-af226faf6115":{"label":"About Finder","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]},"ff82f7f0-7a7b-4d70-bdc6-7e80a38217f1":{"label":"Contact us","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]},"983c36c7-c22d-4c74-b99a-c1762aa2c0d2":{"label":"FAQs & support","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":false},"children":[]},"d28e161a-2888-41b1-8c8a-b0ea7741b8b8":{"label":"Mobile app","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]},"15e414c9-a975-4f23-b686-e1ca574f4d28":{"label":"Blog","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]}}')
        ]);
        Navigation::create([
            'name' => 'Profile',
            'handle' => 'footer_menu_3',
            'items' => json_decode('{"dce43be0-3bb0-4931-afb2-3dc7a0fc46bc":{"label":"My account","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]},"7ddb5e97-7f2b-4122-b9dc-63ec30e2ccce":{"label":"Wishlist","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]},"f97f8336-130f-4167-8f3d-063919e0f67c":{"label":"My listings","type":"external-link","data":{"icon":null,"icon_position":null,"classes":null,"divider":false,"url":"#","target":""},"children":[]},"8c96aab5-9288-4fdf-b8f5-fd50c2410992":{"label":"Add listing","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]}}')
        ]);
        Navigation::create([
            'name' => 'Footer Bottom Menu',
            'handle' => 'footer_bottom',
            'items' => json_decode('{"a4793e74-2f3e-42ef-a629-1c20645eba72":{"label":"Terms of use","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]},"7f0e00f4-008c-4cb4-8a91-47e187680787":{"label":"Privacy policy","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]},"47410830-b64c-440d-9e44-42c62e738cc7":{"label":"Accessibility statement","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]},"46c0634f-6c38-4455-92c1-7e2bf940ec67":{"label":"Interest based ads","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]}}')
        ]);
    }
}
