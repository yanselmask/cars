<?php

namespace App\Console\Commands;

use App\Models\Listing;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models;
use App\Models\MakeModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SeederListingWithApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'listing:listings {qty?} {page?} {make?} {model?} {--images}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'With this command you will generate listings with the api';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (config('listing.auto_dev_api')) {

            $makesOptionsUrl = 'https://auto.dev/api/models?apikey=' . config('listing.auto_dev_api');
            $makesOptionsRequest = Http::get($makesOptionsUrl);
            $makesOptionsData = $makesOptionsRequest->json();
            $makes = ['All'];
            $models = ['All'];

            if ($this->argument('qty')) {
                $url = 'https://auto.dev/api/listings?apikey=' . config('listing.auto_dev_api') . '&make=' . $this->argument('make') . '&model=' . $this->argument('model') . '&limit=' . $this->argument('qty') . '&page=' . $this->argument('page') ?? 1;
            } else {

                foreach ($makesOptionsData as $k => $v) {
                    $makes[] = $k;
                }

                $selectedMake = $this->choice(
                    'What is the make?',
                    $makes,
                    'All'
                );

                if ($selectedMake != 'All') {
                    $options = MakeModel::select('id', 'name')
                        ->whereHas('make', function ($query) use ($selectedMake) {
                            $query->where('name', $selectedMake);
                        })->get();

                    foreach ($options as $k) {
                        $models[$k->name] = $k->name;
                    }
                }

                $selectedModel = $this->choice(
                    'What is the model?',
                    $models,
                    'All'
                );

                $selectedQty = $this->ask('How many listing?') ?? 20;

                $selectedPage = $this->ask('What is the page?') ?? 0;

                if ($selectedMake != 'All') {
                    if ($selectedModel != 'All') {
                        $url = 'https://auto.dev/api/listings?apikey=' . config('listing.auto_dev_api') . '&make=' . $selectedMake . '&model=' . $selectedModel . '&limit=' . $selectedQty . '&page=' . $selectedPage;
                    } else {
                        $url = 'https://auto.dev/api/listings?apikey=' . config('listing.auto_dev_api') . '&make=' . $selectedMake . '&limit=' . $selectedQty . '&page=' . $selectedPage;
                    }
                } else {
                    $url = 'https://auto.dev/api/listings?apikey=' . config('listing.auto_dev_api') . '&limit=' . $selectedQty . '&page=' . $selectedPage;
                }
            }

            $request = Http::get($url);
            $data = $request->json();
            $bar = $this->output->createProgressBar($data['hitsCount']);
            foreach ($data['records'] as $listing) {
                $bar->advance();
                DB::transaction(function () use ($listing) {
                    $listingCreated = Listing::create([
                        'name' => $listing['make'] . ' ' . $listing['model'],
                        'condition_id' => Models\Condition::inRandomOrder()->first()->id,
                        'type_id' => Models\Type::inRandomOrder()->first()->id,
                        'make_id' => Models\Make::where('name', $listing['make'])->first()?->id ?? Models\Make::inRandomOrder()->first()->id,
                        'makemodel_id' => Models\MakeModel::where('name', $listing['model'])->first()?->id ?? Models\MakeModel::inRandomOrder()->first()->id,
                        'location' => [
                            'lat' => $listing['lat'],
                            'lng' => $listing['lon']
                        ],
                        'description' => 'Lorem tincidunt lectus vitae id vulputate diam quam. Imperdiet non scelerisque turpis sed etiam ultrices. Blandit mollis dignissim egestas consectetur porttitor. Vulputate dolor pretium, dignissim eu augue sit ut convallis. Lectus est, magna urna feugiat sed ultricies sed in lacinia. Fusce potenti sit id pharetra vel ornare. Vestibulum sed tellus ullamcorper arcu.',
                        'content' => 'Asperiores eos molestias, aspernatur assumenda vel corporis ex, magni excepturi totam exercitationem quia inventore quod amet labore impedit quae distinctio? Officiis blanditiis consequatur alias, atque, sed est incidunt accusamus repudiandae tempora repellendus obcaecati delectus ducimus inventore tempore harum numquam autem eligendi culpa.',
                        'currency_id' => Models\Currency::where('symbol', substr($listing['price'], 0, 1))->first()->id,
                        'price' =>  $listing['priceUnformatted'],
                        'mileage' => $listing['mileageUnformatted'],
                        'mileage_type' => rand(0, 2),
                        'is_mileage_verified' => rand(0, 1),
                        'year' => $listing['year'],
                        'vin' => $listing['vin'],
                        'exterior_color_id' => Models\Color::inRandomOrder()->first()->id,
                        'interior_color_id' => Models\Color::inRandomOrder()->first()->id,
                        'transmission_id' => Models\Transmission::inRandomOrder()->first()->id,
                        'fueltype_id' => Models\FuelType::inRandomOrder()->first()->id,
                        'drivetype_id' => Models\DriveType::inRandomOrder()->first()->id,
                        'engine_id' => Models\Engine::inRandomOrder()->first()->id,
                        'offertype_id' => Models\OfferType::inRandomOrder()->first()->id,
                        'listedby_id' => Models\ListedBy::inRandomOrder()->first()->id,
                        'cylinders' => rand(1, 16),
                        'doors' => rand(1, 10),
                        'passengers' => rand(1, 50),
                        'is_featured' => rand(0, 1),
                        'is_certified' => rand(0, 1),
                        'is_single_owner' => rand(0, 1),
                        'is_well_equipped' => rand(0, 1),
                        'no_accident' => rand(0, 1),
                        'city_mpg' => rand(0, 90000),
                        'is_city_mpg_verified' => rand(0, 1),
                        'highway_mpg' => rand(0, 90000),
                        'is_highway_mpg_verified' => rand(0, 1),
                        'charge' => rand(0, 90000),
                        'charge_type' => rand(0, 1),
                        'user_id' => Models\User::inRandomOrder()->first()->id,
                        'status' => \App\Enums\ListingStatus::APPROVED
                    ]);

                    $features = Models\Feature::inRandomOrder()->limit(rand(1, 20))->get();

                    $listingCreated->features()->attach($features);
                    if ($this->option('images')) {
                        $photos = [$listing['primaryPhotoUrl']];
                        $photos = array_merge($photos, $listing['photoUrls']);
                        foreach ($photos as $photo) {
                            try {
                                $listingCreated
                                    ->addMediaFromUrl($photo)
                                    ->preservingOriginal()
                                    ->toMediaCollection();
                            } catch (\Exception $e) {
                                $this->error('Error getting image');
                                continue;
                            }
                        }
                    } else {
                        try {
                            $listingCreated
                                ->addMediaFromUrl($listing['primaryPhotoUrl'])
                                ->preservingOriginal()
                                ->toMediaCollection();
                        } catch (\Exception $e) {
                            $this->error('Error getting image');
                        }
                    }
                });
            }
            $bar->finish();
        }
    }
}
