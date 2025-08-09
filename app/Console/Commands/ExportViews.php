<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class ExportViews extends Command
{
    protected $signature = 'export:views';
    protected $description = 'Export all Blade views to static HTML in /dist';

    public function handle()
    {
        $viewsPath = resource_path('views');
        $distPath = public_path('dist');

        // Pastikan folder dist ada
        if (!File::exists($distPath)) {
            File::makeDirectory($distPath, 0755, true);
        }

        // Ambil semua file blade di folder views
        $files = File::allFiles($viewsPath);

        foreach ($files as $file) {
            if ($file->getExtension() === 'php' && str_contains($file->getFilename(), '.blade.php')) {
                $viewName = str_replace(
                    ['/', '\\', '.blade.php'],
                    ['.', '.', ''],
                    $file->getRelativePathname()
                );

                // Render view
                $html = View::make($viewName)->render();

                // Tentukan path output
                $outputFile = $distPath . '/' . basename($file->getFilename(), '.blade.php') . '.html';

                File::put($outputFile, $html);
                $this->info("Exported: {$outputFile}");
            }
        }

        $this->info('✅ Semua views berhasil di-export ke folder /public/dist');
    }
}
