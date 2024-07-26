<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Spark\Plan;
use Spark\Spark;

class SparkServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Spark::billable(User::class)->resolve(function (Request $request) {
            return $request->user();
        });

        Spark::billable(User::class)->authorize(function (User $billable, Request $request) {
            return $request->user() &&
                $request->user()->id == $billable->id;
        });
        if (config('listing.billing') == 'plans') {
            Spark::billable(User::class)->checkPlanEligibility(function (User $billable, Plan $plan) {
                if ($billable->listings()->count() > 5 && $plan->name == 'Basic') {
                    throw ValidationException::withMessages([
                        'plan' => __('You have too many listing for the selected plan.')
                    ]);
                }

                if ($plan->name == 'Basic' && $billable->listings()->featured()->count() > $plan->options['listing_featured']) {
                    throw ValidationException::withMessages([
                        'plan' => __('You have many featured listings')
                    ]);
                }

                if ($billable->listings()->count() > 25 && $plan->name == 'Standard') {
                    throw ValidationException::withMessages([
                        'plan' => __('You have too many listing for the selected plan.')
                    ]);
                }

                if ($plan->name == 'Standard' && $billable->listings()->featured()->count() > $plan->options['listing_featured']) {
                    throw ValidationException::withMessages([
                        'plan' => __('You have many featured listings')
                    ]);
                }

                if ($billable->listings()->count() > 100 && $plan->name == 'Premium') {
                    throw ValidationException::withMessages([
                        'plan' => __('You have too many listing for the selected plan.')
                    ]);
                }

                if ($plan->name == 'Premium' && $billable->listings()->featured()->count() > $plan->options['listing_featured']) {
                    throw ValidationException::withMessages([
                        'plan' => __('You have many featured listings')
                    ]);
                }
            });
        }

        if (config('listing.billing') == 'chargePerSeat') {
            Spark::billable(User::class)->chargePerSeat('listing', function ($billable) {
                return $billable->listings()->count();
            });
        }
    }
}
