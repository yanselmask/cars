<?php

namespace App\Repositories;

use App\Models\Currency;
use App\Models\Listing as ModelsListing;
use App\Models\MakeModel;
use Illuminate\Support\Facades\Cache;

class Listing implements ListingInterface
{
    public function getQuery()
    {
        return $this->listingWithResourcers()
            ->when(request()->query('location'), function ($sql) {
                $sql->where(function ($q) {
                    $q->whereLike('city', '%' . request()->query('location') . '%');
                });
            })
            ->when(request()->query('keywords'), function ($sql) {
                $sql->where('name', 'like', '%' . request()->query('keywords') . '%');
            })
            ->when(request()->query('make'), function ($sql) {
                $sql->where(function ($q) {
                    $q->where('make_id', request()->query('make'))
                        ->orWhereHas('make', function ($subQuery) {
                            $subQuery->whereLike('name',  '%' . request()->query('make') . '%');
                        });
                });
            })
            ->when(request()->query('model'), function ($sql) {
                $sql->where(function ($q) {
                    $q->where('makemodel_id', request()->query('model'))
                        ->orWhereHas('makemodel', function ($subQuery) {
                            $subQuery->whereLike('name', '%' . request()->query('model') . '%');
                        });
                });
            })
            ->when(request()->query('min_price') || request()->query('max_price'), function ($sql) {
              $sql->where(function ($query) {
                  $minPrice = request()->query('min_price', config('listing.min_price'));
                  $maxPrice = request()->query('max_price', config('listing.max_price'));

                  if (!is_numeric($minPrice) || !is_numeric($maxPrice)) {
                      $minPrice = config('listing.min_price');
                      $maxPrice = config('listing.max_price');
                  }

                  $defaultCode =  config('currency.default');
                  $query
                      ->whereHas('currency', function ($subQuery) use ($defaultCode,$minPrice,$maxPrice) {
                          $subQuery->where(function ($q) use ($defaultCode, $minPrice, $maxPrice) {
                              $q->whereRaw('(listings.price * IF(currencies.code = ?, 1, currencies.exchange_rate)) BETWEEN ? AND ?', [$defaultCode, $minPrice, $maxPrice]);
                          });
                      });
              });
            })
            ->when(request()->query('is_negotiated'), function ($sql) {
                $sql->where(function ($q) {
                    $q->where('is_negotiated', true);
                });
            })
            ->when(request()->query('from_year') || request()->query('to_year'), function ($sql) {
                $sql->where(function ($q) {
                    $q->whereBetween('year', [request()->query('from_year', config('listing.years_from')), request()->query('to_year', config('listing.years_to'))]);
                });
            })
            ->when(request()->query('mileage_min') || request()->query('mileage_max'), function ($sql) {
                $sql->where(function ($q) {
                    $q->whereBetween('mileage', [request()->query('mileage_min', config('listing.mileage_min')), request()->query('mileage_max', config('listing.mileage_max'))]);
                });
            })
            ->when(request()->query('condition'), function ($sql) {
                $sql->where(function ($q) {
                    $q->where('condition_id', request()->query('condition'))
                        ->orWhereHas('condition', function ($query) {
                            $query->where('name', 'like', '%' . request()->query('condition') . '%');
                        });
                });
            })
            ->when(request()->query('transmission'), function ($sql) {
                $sql->where(function ($q) {
                    $q->where('transmission_id', request()->query('transmission'));
                });
            })
            ->when(request()->query('type'), function ($sql) {
                $sql->where(function ($q) {
                    $q->where('type_id', request()->query('type'))
                        ->orWhereHas('type', function ($query) {
                            $query->where('name', 'like', '%' . request()->query('type') . '%');
                        });
                });
            })
            ->when(request()->query('drive'), function ($sql) {
                $sql->where(function ($q) {
                    $q->where('drivetype_id', request()->query('drive'));
                });
            })
            ->when(request()->query('cylinder'), function ($sql) {
                $sql->where(function ($q) {
                    $q->where('cylinders', request()->query('cylinder'));
                });
            })
            ->when(request()->query('fuel'), function ($sql) {
                $sql->where(function ($q) {
                    $q->where('fueltype_id', request()->query('fuel'))
                        ->orWhereHas('fueltype', function ($query) {
                            $query->where('name', 'like', '%' . request()->query('fuel') . '%');
                        });
                });
            })
            ->when(request()->query('exterior_color'), function ($sql) {
                $sql->where(function ($q) {
                    $q->where('exterior_color_id', request()->query('exterior_color'));
                });
            })
            ->when(request()->query('interior_color'), function ($sql) {
                $sql->where(function ($q) {
                    $q->where('interior_color_id', request()->query('interior_color'));
                });
            })
            ->when(request()->query('seller'), function ($sql) {
                $sql->where(function ($q) {
                    $q->where('listedby_id', request()->query('seller'));
                });
            })
            ->when(request()->query('only_ad_video'), function ($sql) {
                $sql->where(function ($q) {
                    $q->whereNotNull('video_link');
                });
            })
            ->when(request()->query('features'), function ($sql) {
                $sql->whereHas('features', function ($query) {
                    $query->whereIn('id', request()->query('features'));
                }, '=', count(request()->query('features')));
            })
            ->when(request()->query('sort'), function ($sql) {
                return match (request()->query('sort')) {
                    'asc' => $sql->orderBy('id', 'asc'),
                    'desc' => $sql->orderBy('id', 'desc'),
                    'price_low' => $sql->orderBy('price', 'asc'),
                    'price_hight' => $sql->orderBy('price', 'desc'),
                    'popular' => $sql->withCount('visitLogs')
                        ->orderByDesc('visit_logs_count'),
                    default => $sql->orderBy('id', 'desc'),
                };
            });
    }
    public function getPaginated($limit = 8)
    {
        return $this
            ->getQuery()
            ->sorting()
            ->paginate($limit);
    }

    public function getShortsPaginated($limit = 12)
    {
        return $this
            ->getQuery()
            ->withVideo()
            ->sorting()
            ->paginate($limit);
    }

    public function getFavorites($limit = 6)
    {
        return auth()->user()?->favoritedListings()->paginate($limit) ?? [];
    }

    public function getCompares()
    {
        return auth()->user()?->comparedListings()->limit(3)->paginate() ?? [];
    }

    public function getRelated($id, $limit = 6)
    {
        $listing  = $this->findById($id);

        return $this->listingWithResourcers()
            ->where('id', '!=', $listing->id)
            ->where(function ($query) use ($listing) {
                $query->where('user_id', $listing->user_id)
                    ->OrWhere('make_id', $listing->make_id)
                    ->OrWhere('makemodel_id', $listing->makemodel_id);
            })
            ->orderBy('price')
            ->orderByDesc('created_at')
            ->paginate($limit);
    }

    public function getPaginateForVendor($userId, $limit = 6)
    {
        return $this->listingWithResourcers()
            ->where('user_id', $userId)
            ->when(request()->query('sort'), function ($sql) {
                return match (request()->query('sort')) {
                    'asc' => $sql->orderBy('id', 'asc'),
                    'desc' => $sql->orderBy('id', 'desc'),
                    'price_low' => $sql->orderBy('price', 'asc'),
                    'price_hight' => $sql->orderBy('price', 'desc'),
                    'popular' => $sql->withCount('visitLogs')
                        ->orderByDesc('visit_logs_count'),
                    default => $sql->orderByDesc('id'),
                };
            })
            ->when(!request()->query('sort'), function ($sql) {
                return $sql->orderByDesc('is_featured')
                           ->orderByDesc('id');
            })
            ->sorting()
            ->paginate($limit);
    }

    public function makemodelsJson($make)
    {
        return MakeModel::select('id', 'name')
            ->where('make_id', $make)
            ->orWhereHas('make', function ($query) use ($make) {
                $query->where('name', $make);
            })
            ->sorting()
            ->get();
    }

    public function findById($id)
    {
        $listing = $this->listingWithResourcers()
            ->whereId($id)
            ->first();

        visitor()->visit($listing);

        if($listing->make)
        {
            visitor()->visit($listing->make);
        }

        if($listing->makemodel)
        {
            visitor()->visit($listing->makemodel);
        }

        return $listing;
    }

    public function listingWithResourcers()
    {
        return ModelsListing::with(['user', 'make', 'makemodel', 'features', 'condition', 'drivetype', 'type', 'transmission', 'fueltype', 'engine', 'exteriorcolor', 'interiorcolor', 'offertype', 'listedby', 'currency']);
    }
}
