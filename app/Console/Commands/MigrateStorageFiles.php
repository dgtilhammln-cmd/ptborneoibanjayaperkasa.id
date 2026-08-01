<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MigrateStorageFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:migrate-to-public 
                            {--dry-run : Show what would be migrated without actually moving files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate files from storage/app/public to public/storage (for shared hosting without symlink)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $oldPath = storage_path('app/public');
        $newPath = public_path('storage');
        $dryRun = $this->option('dry-run');

        if (!File::exists($oldPath)) {
            $this->error("Source directory not found: {$oldPath}");
            return Command::FAILURE;
        }

        // Ensure destination directory exists
        if (!$dryRun && !File::exists($newPath)) {
            File::makeDirectory($newPath, 0755, true);
            $this->info("Created destination directory: {$newPath}");
        }

        $this->info("Migrating files from: {$oldPath}");
        $this->info("To: {$newPath}");
        if ($dryRun) {
            $this->warn("DRY RUN MODE - No files will be moved");
        }
        $this->newLine();

        $files = File::allFiles($oldPath);
        $total = count($files);
        $moved = 0;
        $skipped = 0;
        $errors = 0;

        $bar = $this->output->createProgressBar($total);
        $bar->start();

        foreach ($files as $file) {
            $relativePath = $file->getRelativePathname();
            $destination = $newPath . '/' . $relativePath;
            $destinationDir = dirname($destination);

            try {
                // Check if file already exists in destination
                if (File::exists($destination)) {
                    $skipped++;
                    $bar->advance();
                    continue;
                }

                if (!$dryRun) {
                    // Create directory if it doesn't exist
                    if (!File::exists($destinationDir)) {
                        File::makeDirectory($destinationDir, 0755, true);
                    }

                    // Copy file
                    File::copy($file->getPathname(), $destination);
                }

                $moved++;
            } catch (\Exception $e) {
                $errors++;
                $this->newLine();
                $this->error("Error moving {$relativePath}: " . $e->getMessage());
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        // Summary
        $this->info("Migration Summary:");
        $this->line("  Total files: {$total}");
        $this->line("  " . ($dryRun ? "Would move" : "Moved") . ": {$moved}");
        $this->line("  Skipped (already exists): {$skipped}");
        if ($errors > 0) {
            $this->error("  Errors: {$errors}");
        }

        if ($dryRun) {
            $this->newLine();
            $this->info("Run without --dry-run to actually migrate the files");
        } else {
            $this->newLine();
            $this->info("✓ Migration completed! Files are now accessible via browser.");
            $this->warn("Note: Original files in storage/app/public are still there.");
            $this->warn("You can delete them manually after verifying everything works.");
        }

        return Command::SUCCESS;
    }
}
