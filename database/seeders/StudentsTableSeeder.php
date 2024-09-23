<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StudentsTableSeeder extends Seeder
{
    public function run()
    {
        // Path to your CSV file
        $csvPath = storage_path('app/results.csv');

        Log::info('Looking for CSV file at: ' . $csvPath);

        if (!file_exists($csvPath)) {
            Log::error('CSV file not found at ' . $csvPath);
            return;
        }

        // Open the CSV file
        if (($handle = fopen($csvPath, 'r')) !== false) {
            $isFirstRow = true; // To skip the first row (headers)
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                // Skip the header row
                if ($isFirstRow) {
                    $isFirstRow = false;
                    continue;
                }

                // Log the row data for debugging
                Log::info('Processing row: ', $data);

                // Check if the row has at least 7 columns
                if (count($data) < 7) {
                    Log::error('Skipping row: Invalid number of columns');
                    continue; // Skip rows with fewer than 7 columns
                }

                // Ensure that the `subjects` column is valid JSON
                $subjectsJson = $data[4];

                // Replace empty "marks" fields (without value) with a default value `null`
                $subjectsJson = preg_replace_callback('/"marks"\s*:\s*([^,}\]]*)/', function ($matches) {
                    // If the match is empty or invalid, set the value to `null`
                    return (trim($matches[1]) === '') ? '"marks":null' : $matches[0];
                }, $subjectsJson);

                // Decode the JSON and validate
                $decodedSubjects = json_decode($subjectsJson, true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    Log::error('Invalid JSON in subjects column for roll number: ' . $data[0]);
                    continue; // Skip rows with invalid JSON
                }

                // Insert the data into the database
                DB::table('students')->insert([
                    'roll_number'   => $data[0],
                    'name'          => $data[1],
                    'school_code'   => $data[2],
                    'category_code' => $data[3],
                    'subjects'      => json_encode($decodedSubjects),  // Ensure it's a valid JSON string
                    'total_marks'   => $data[5],
                    'grade'         => $data[6],
                ]);

                Log::info('Inserted student with roll number: ' . $data[0]);
            }
            fclose($handle);

            Log::info('CSV file processing completed.');
        } else {
            Log::error('Failed to open CSV file.');
        }
    }
}
