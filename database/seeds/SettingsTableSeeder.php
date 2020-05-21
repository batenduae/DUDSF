<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    protected $settings = [
        [
            'key' => 'site_name',
            'value' => 'E-Commerce Application'
        ],
        [
            'key' => 'site_title',
            'value' => 'E-commerce',
        ],
        [
            'key' => 'default_email_address',
            'value' => 'admin@admin.com'
        ],
        [
            'key' => 'currency_code',
            'value' => 'USD'
        ],
        [
            'key' => 'currency_symbol',
            'value' => '$'
        ],
        [
            'key' => 'site_logo',
            'value' => ''
        ],
        [
            'key' => 'site_favicon',
            'value' => ''
        ],
        [
            'key' => 'footer_copyright_text',
            'value' => 'All Rights Reserved Shopper'
        ],
        [
            'key' => 'seo_meta_title',
            'value' => ''
        ],
        [
            'key' => 'seo_meta_description',
            'value' => ''
        ],
        [
            'key' => 'social_facebook',
            'value' => 'https://www.Facebook.com'
        ],
        [
            'key' => 'social_twitter',
            'value' => 'https://www.Twitter.com'
        ],
        [
            'key' => 'social_instagram',
            'value' => 'https://www.Instagram.com'
        ],
        [
            'key' => 'social_linkedin',
            'value' => 'https://www.LinkedIn.com'
        ],
        [
            'key' => 'google_analytics',
            'value' => ''
        ],
        [
            'key' => 'facebook_pixels',
            'value' => ''
        ],
        [
            'key' => 'stripe_payment_method',
            'value' => 'Disabled'
        ],
        [
            'key' => 'stripe_key',
            'value' => ''
        ],
        [
            'key' => 'stripe_secret_key',
            'value' => ''
        ],
        [
            'key' => 'paypal_payment_method',
            'value' => 'Disabled'
        ],
        [
            'key' => 'paypal_client_id',
            'value' => ''
        ],
        [
            'key' => 'paypal_secret_id',
            'value' => ''
        ],
    ];

    public function run()
    {
        foreach ($this->settings as $index => $setting) {
            $result = Setting::create($setting);
            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }
//        $this->command->info('Inserted ' . count($this->settings) . ' records');
    }
}
