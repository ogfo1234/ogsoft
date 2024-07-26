<?php

namespace App\Console\Commands;

use App\Models\Holiday;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Init extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->call('migrate:fresh');

        $csv_holidays_path = base_path('data/holidays.csv');
        $holidays = collect();

        try {

            $file = fopen($csv_holidays_path, 'r') or $this->error('File not found');

            while (($data = fgetcsv($file, null, ";")) !== false) {

                if ($data[0] === 'name') {
                    continue;
                }

                $holidays = $holidays->push([
                    'name' => $data[0],
                    'date' => $data[1],
                    'country' => $data[2],
                ]);
            }

            fclose($file);

            $this->info("Inserting holidays...\n");

            $this->withProgressBar($holidays, function ($holiday) {
                Holiday::create([
                    'name' => $holiday['name'],
                    'date' => Carbon::createFromFormat('Y-m-d', $holiday['date']),
                    'country' => $holiday['country'],
                ]);
            });

            $this->info("Holidays inserted successfully!\n");
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
