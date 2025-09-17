<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Student;

class MigrateSqliteToPostgres extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:sqlite-to-postgres {--dry-run : Show what would be migrated without actually doing it} {--force : Force migration even if data exists}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate data from SQLite database to PostgreSQL database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting SQLite to PostgreSQL migration...');
        
        // Check if SQLite database exists
        $sqlitePath = database_path('database.sqlite');
        if (!file_exists($sqlitePath)) {
            $this->error('SQLite database not found at: ' . $sqlitePath);
            return 1;
        }

        $dryRun = $this->option('dry-run');
        $force = $this->option('force');
        
        if ($dryRun) {
            $this->warn('DRY RUN MODE - No data will be actually migrated');
        }

        try {
            // Configure SQLite connection temporarily
            config(['database.connections.sqlite_source' => [
                'driver' => 'sqlite',
                'database' => $sqlitePath,
                'prefix' => '',
            ]]);

            // Test connections
            $this->info('Testing database connections...');
            
            // Test SQLite connection
            $sqliteCount = DB::connection('sqlite_source')->table('students')->count();
            $this->info("SQLite database found with {$sqliteCount} students");
            
            // Test PostgreSQL connection
            $postgresCount = DB::connection()->table('students')->count();
            
            if ($postgresCount > 0 && !$force) {
                $this->error("PostgreSQL database already contains {$postgresCount} students.");
                $this->error("Use --force flag to overwrite existing data, or --dry-run to preview migration.");
                return 1;
            }

            // Migrate Users
            $this->migrateUsers($dryRun);
            
            // Migrate Students
            $this->migrateStudents($dryRun);
            
            if (!$dryRun) {
                // Update PostgreSQL sequences
                $this->updateSequences();
            }
            
            $this->info('Migration completed successfully!');
            
        } catch (\Exception $e) {
            $this->error('Migration failed: ' . $e->getMessage());
            return 1;
        }
        
        return 0;
    }

    /**
     * Migrate users from SQLite to PostgreSQL
     */
    private function migrateUsers($dryRun = false)
    {
        $this->info('Migrating users...');
        
        $users = DB::connection('sqlite_source')->table('users')->get();
        $this->info("Found {$users->count()} users in SQLite");
        
        if ($dryRun) {
            $this->table(['ID', 'Name', 'Email', 'Is Admin'], 
                $users->map(function($user) {
                    return [
                        $user->id,
                        $user->name,
                        $user->email ?? 'N/A',
                        $user->is_admin ? 'Yes' : 'No'
                    ];
                })->toArray()
            );
            return;
        }

        $migrated = 0;
        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user->email ?? $user->name . '@example.com'],
                [
                    'name' => $user->name,
                    'email' => $user->email ?? $user->name . '@example.com',
                    'password' => $user->password,
                    'is_admin' => $user->is_admin ?? false,
                    'email_verified_at' => $user->email_verified_at,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                ]
            );
            $migrated++;
        }
        
        $this->info("Migrated {$migrated} users successfully");
    }

    /**
     * Migrate students from SQLite to PostgreSQL
     */
    private function migrateStudents($dryRun = false)
    {
        $this->info('Migrating students...');
        
        $students = DB::connection('sqlite_source')->table('students')->get();
        $this->info("Found {$students->count()} students in SQLite");
        
        if ($dryRun) {
            $this->table(['Roll Number', 'Name', 'School', 'Grade', 'Total Marks'], 
                $students->take(10)->map(function($student) {
                    return [
                        $student->roll_number,
                        $student->name,
                        $student->school_code,
                        $student->grade,
                        $student->total_marks
                    ];
                })->toArray()
            );
            
            if ($students->count() > 10) {
                $this->info("... and " . ($students->count() - 10) . " more students");
            }
            return;
        }

        $migrated = 0;
        $batch = [];
        $batchSize = 100;
        
        foreach ($students as $student) {
            $batch[] = [
                'roll_number' => $student->roll_number,
                'name' => $student->name,
                'school_code' => $student->school_code,
                'category_code' => $student->category_code,
                'subjects' => $student->subjects, // PostgreSQL will handle JSON conversion
                'total_marks' => $student->total_marks,
                'grade' => $student->grade,
                'created_at' => $student->created_at,
                'updated_at' => $student->updated_at,
            ];
            
            if (count($batch) >= $batchSize) {
                DB::connection()->table('students')->upsert(
                    $batch,
                    ['roll_number'], // Unique key
                    ['name', 'school_code', 'category_code', 'subjects', 'total_marks', 'grade', 'updated_at']
                );
                $migrated += count($batch);
                $batch = [];
                $this->info("Migrated {$migrated} students...");
            }
        }
        
        // Handle remaining batch
        if (!empty($batch)) {
            DB::connection()->table('students')->upsert(
                $batch,
                ['roll_number'],
                ['name', 'school_code', 'category_code', 'subjects', 'total_marks', 'grade', 'updated_at']
            );
            $migrated += count($batch);
        }
        
        $this->info("Migrated {$migrated} students successfully");
    }

    /**
     * Update PostgreSQL sequences to prevent primary key conflicts
     */
    private function updateSequences()
    {
        $this->info('Updating PostgreSQL sequences...');
        
        // Update users sequence
        $maxUserId = DB::connection()->table('users')->max('id') ?: 0;
        DB::connection()->statement("SELECT setval('users_id_seq', " . ($maxUserId + 1) . ", false)");
        
        // Update students sequence
        $maxStudentId = DB::connection()->table('students')->max('id') ?: 0;
        DB::connection()->statement("SELECT setval('students_id_seq', " . ($maxStudentId + 1) . ", false)");
        
        $this->info('Sequences updated successfully');
    }
}
