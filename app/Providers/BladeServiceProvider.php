<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootDirectives();
    }

    /**
     * Boot custom Blade directives.
     */
    protected function bootDirectives()
    {
        Blade::directive('money', function ($expression) {
            $args = explode(',', $expression);

            $amount = $args[0];
            $decimals = isset($args[1]) ? trim($args[1]) : 2;

            return "<?php echo number_format($amount, $decimals, ',', '.') . ' €'; ?>";
        });

        Blade::directive('hours', function ($time) {
            return "<?php echo time_formatted($time); ?>";
        });

        Blade::directive('date', function ($date) {
            return "<?php echo date_formatted($date); ?>";
        });

        Blade::directive('datetime', function ($date) {
            return "<?php echo date_formatted($date, 'L LT'); ?>";
        });

        Blade::directive('printConvertedBytes', function ($bytes) {
            return "<?php echo print_converted_bytes($bytes); ?>";
        });
    }
}
