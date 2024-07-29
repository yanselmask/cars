<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class ListingUninstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'listing:uninstall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uninstall Web Site';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $installedFilePath = storage_path('installed');
        $publicStoragePath = storage_path('app/public');
        $LivewireTemp = storage_path('app/livewire-tmp');
        $mediLibraryTemp = storage_path('media-library/temp');
        $debugbar = storage_path('debugbar');

        $asked = $this->choice(__('Are you sure you want uninstall web site'), [
            0 => 'No',
            1 => 'Yes',
        ], 0);

        if ($asked == 'no') {
            return;
        }

        // Eliminar el archivo installed
        if (File::exists($installedFilePath)) {
            File::delete($installedFilePath);
            $this->info("Archivo 'installed' eliminado.");
        } else {
            $this->info("El archivo 'installed' no existe.");
        }

        // Limpiar el directorio public dentro de storage
        if (File::isDirectory($publicStoragePath)) {
            File::cleanDirectory($publicStoragePath);
            $this->info("El directorio 'public' dentro de storage ha sido limpiado.");
        } else {
            $this->info("El directorio 'public' dentro de storage no existe.");
        }

        // Limpiar el directorio public dentro de storage
        if (File::isDirectory($LivewireTemp)) {
            File::cleanDirectory($LivewireTemp);
            $this->info("El directorio 'Livewire Temp' dentro de storage ha sido limpiado.");
        } else {
            $this->info("El directorio 'Livewire Temp' dentro de storage no existe.");
        }

        if (File::isDirectory($mediLibraryTemp)) {
            File::cleanDirectory($mediLibraryTemp);
            $this->info("El directorio 'Media Library Temp' dentro de storage ha sido limpiado.");
        } else {
            $this->info("El directorio 'Media Library Temp' dentro de storage no existe.");
        }

        if (File::isDirectory($debugbar)) {
            File::cleanDirectory($debugbar);
            $this->info("El directorio 'Debugbar' dentro de storage ha sido limpiado.");
        } else {
            $this->info("El directorio 'Debugbar' dentro de storage no existe.");
        }

        Artisan::call('migrate:rollback', [
            '--force' => true
        ]);
        $this->info("Migration rollback successful");
        Artisan::call('optimize:clear');
        $this->info("Optimized successful");
    }
}
