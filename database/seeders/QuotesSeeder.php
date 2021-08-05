<?php

namespace Database\Seeders;

use App\Models\Quote;
use Illuminate\Database\Seeder;

class QuotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quotes = json_decode(file_get_contents('database/dump/quotes.json'));
        foreach ($quotes as $quote) {
            if (strlen($quote->quote) < 140) {
                Quote::create((array)$quote);
            }
        }
    }
}
