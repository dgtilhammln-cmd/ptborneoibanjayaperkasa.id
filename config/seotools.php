<?php
/**
 * SEO Tools Configuration
 * PT Borneo Iban Jaya Perkasa
 * @see https://github.com/artesaos/seotools
 */

return [
    'inertia' => env('SEO_TOOLS_INERTIA', false),
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults' => [
            'title'        => 'PT Borneo Iban Jaya Perkasa', // set false to total remove
            'titleBefore'  => false,
            'description'  => 'Pabrik Fabrikasi Logam & Produsen Sparepart Presisi Sidoarjo. Spesialis jasa potong, plong, tekuk plat, dan pembuatan sparepart industri berkualitas tinggi.',
            'separator'    => ' - ',
            'keywords'     => ['fabrikasi logam', 'sparepart presisi', 'jasa potong plat', 'jasa plong plat', 'jasa tekuk plat', 'sidoarjo', 'PT Borneo Iban Jaya Perkasa'],
            'canonical'    => 'full', // use full URL as canonical
            'robots'       => false,
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => 'PT Borneo Iban Jaya Perkasa', // set false to total remove
            'description' => 'Pabrik Fabrikasi Logam & Produsen Sparepart Presisi Sidoarjo. Spesialis jasa potong, plong, tekuk plat, dan pembuatan sparepart industri.',
            'url'         => null, // uses Url::current()
            'type'        => 'website',
            'site_name'   => 'PT Borneo Iban Jaya Perkasa',
            'images'      => [],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            //'card'        => 'summary',
            //'site'        => '@ptborneo',
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title'       => 'PT Borneo Iban Jaya Perkasa', // set false to total remove
            'description' => 'Pabrik Fabrikasi Logam & Produsen Sparepart Presisi Sidoarjo. Spesialis jasa potong, plong, tekuk plat, dan pembuatan sparepart industri.',
            'url'         => null, // uses Url::current()
            'type'        => 'Organization',
            'images'      => [],
        ],
    ],
];
