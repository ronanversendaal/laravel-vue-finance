<?php

namespace App\Console\Commands\Wallet;

use App\Http\Service\Wallet\Account\Client as AccountClient;
use App\Http\Service\Wallet\Record\Client as RecordClient;
use App\Http\Service\Wallet\Category\Client as CategoryClient;
use App\Http\Service\Wallet\Currency\Client as CurrencyClient;
use App\Wallet\Account;
use App\Wallet\Category;
use App\Wallet\Currency;
use App\Wallet\Record;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Spatie\ResponseCache\Facades\ResponseCache;

class SyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wallet:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Syncs the current database with Wallet';

    /** @var AccountClient */
    private $accounts;

    /** @var RecordClient */
    private $records;

    /** @var CategoryClient */
    private $categories;

    /** @var CurrencyClient */
    private $currencies;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(AccountClient $accounts, RecordClient $records, CategoryClient $categories, CurrencyClient $currencies)
    {
        parent::__construct();

        $this->accounts = $accounts;
        $this->records = $records;
        $this->categories = $categories;
        $this->currencies = $currencies;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->output->writeln('Starting import');
        $bar = $this->output->createProgressBar(4);

        $bar->start();

        $class = null;

        /**
         * @todo only insert new records so tables dont need truncatin'
         */

        Artisan::call('migrate:refresh', ['--force' => true]);

        try{

            foreach ($this->accounts->getAccounts() as $account) {
                $record = new Account();
                $class = get_class($record);

                $record->buildAndCreate($account);

                $balance = $this->accounts->getBalance($record->wallet_id);
                $record->setBalance($balance['amount']);

                $record->save();
            }

            $bar->advance();

            foreach ($this->categories->getCategories() as $category){
                $record = new Category();
                $class = get_class($record);

                $record->buildAndCreate($category);
            }

            $bar->advance();

            foreach ($this->currencies->getCurrencies() as $currency){
                $record = new Currency();
                $class = get_class($record);

                $record->buildAndCreate($currency);
            }

            $bar->advance();

            foreach ($this->records->getRecords() as $wallet_record){

                $record = new Record();
                $class = get_class($record);

                $record->buildAndCreate($wallet_record);

                $record->setAccount();
                $record->setCategory();
                $record->setCurrency();

                $record->save();
            }

            $bar->advance();

            $bar->finish();

            $this->output->newLine();
            $this->output->writeln('Import done.');

            ResponseCache::clear();

            logger('Import done at '. Carbon::createFromTimestamp(1558829653)->toDateTimeLocalString());

        } catch (\PDOException $e) {
            logger("Exception thrown while saving {$class}: {$e->getMessage()} ". Carbon::createFromTimestamp(1558829653)->toDateTimeLocalString());
        }


        // Get/save all Accounts
        // Get/save all Categories
        // Get/save all Currencies
        // Get/save all Records

        // Loop through all records.

    }
}
