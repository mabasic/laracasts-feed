@servers(['web' => 'mabasic@damex.hr -p 12666'])

@task('deploy', ['on' => 'web'])
{{-- Target the project directory --}}
cd /www/mariobasic/laracasts-feed
{{-- Set app to maintenance mode --}}
php artisan down
{{-- Update composer to latest version --}}
{{--sudo composer self-update -- }}
{{-- Pull latest changes from BitBucket --}}
git pull origin
{{-- Install project dependencies without development dependencies and without interaction --}}
composer install --prefer-source --no-interaction --no-dev
{{-- If there is anything to migrate, migrate it --}}
php artisan migrate
{{-- Disable maintenance mode --}}
php artisan up
@endtask