<?php

namespace AppBundle\Service;

use Faker\Factory;

class DataGenerator
{
    const LOCALE = 'fr_FR';
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create(self::LOCALE);
    }

    public function generateFormData()
    {
        // 30% de chance de renvoyer des data vides
        if ($this->faker->boolean(20)) {
            return [];
        }

        $personal = $this->generatePersonalInfo();
        $phone = $this->generatePhone();
        $address = $this->generateAddress();
        $salesPartner = $this->generateSalesPartner();

        return array_merge($personal, $phone, $address, $salesPartner);
    }

    private function generatePersonalInfo()
    {
        $gender = $this->faker->randomElement(['male', 'female']);

        return [
            'civility_id' => $this->faker->boolean(80) ?
                ($gender === 'male' ? 819 : 818) :
                null,
            'firstname' => $this->faker->optional(0.8)->firstname($gender),
            'lastname' => $this->faker->optional(0.8)->lastname($gender),
            'email' => $this->faker->email

        ];
    }

    private function generatePhone()
    {
        $phone = [
            'phone' => [
                'number' => null,
                'type' => null
            ]
        ];
        if ($this->faker->boolean(80)) {
            $phone = [
                'phone' => $this->faker->randomElement([
                    [
                        'number' => str_replace([' ', '(', ')'], '', $this->faker->phoneNumber),
                        'type' => $this->faker->randomElement([822, 823, 824])
                    ],
                    [
                        'number' => str_replace([' ', '(', ')'], '', $this->faker->phoneNumber),
                        'type' => null
                    ],
                    [
                        'number' => $this->faker->regexify('[0-9]{10}'),
                        'type' => $this->faker->randomElement([822, 823, 824])
                    ]
                ])
            ];
        }

        return $phone;
    }

    private function generateAddress()
    {
        $address = [
            'address' => [
                'number' => null,
                'street' => null,
                'city' => null,
                'zipcode' => null
            ]
        ];

        if ($this->faker->boolean(80)) {
            $address = [
                'address' => $this->faker->randomElement([
                    [
                        'number' => $this->faker->buildingNumber,
                        'street_type' => $this->faker->randomElement(['AUTRES', 'ALLEE', 'AVENUE', 'BOULEVARD', 'IMPASSE', 'PASSAGE', 'PLACE', 'QUAI', 'RUE', 'SQUARE', 'VILLAGE']),
                        'street_name' => $this->faker->streetName,
                        'city' => $this->faker->city,
                        'zipcode' => str_replace(' ', '', $this->faker->postcode)
                    ],
                    [
                        'number' => $this->faker->optional(0.5)->buildingNumber,
                        'street_type' => $this->faker->optional(0.5)->randomElement(['AUTRES', 'ALLEE', 'AVENUE', 'BOULEVARD', 'IMPASSE', 'PASSAGE', 'PLACE', 'QUAI', 'RUE', 'SQUARE', 'VILLAGE']),
                        'street_name' => $this->faker->optional(0.5)->streetName,
                        'city' => $this->faker->optional(0.5)->city,
                        'zipcode' => str_replace(' ', '', $this->faker->optional(0.5)->postcode)
                    ],
                    [
                        'number' => $this->faker->boolean(0.5) ?
                            $this->faker->buildingNumber :
                            $this->faker->regexify('[a-zA-Z0-9]{2,4}'),
                        'street_type' => $this->faker->optional(0.5)->randomElement(['AUTRES', 'ALLEE', 'AVENUE', 'BOULEVARD', 'IMPASSE', 'PASSAGE', 'PLACE', 'QUAI', 'RUE', 'SQUARE', 'VILLAGE']),
                        'street_name' => $this->faker->boolean(0.5) ?
                            $this->faker->optional(0.5)->streetName :
                            $this->faker->words(2, true),
                        'city' => $this->faker->boolean(0.5) ?
                            $this->faker->city :
                            $this->faker->words(2, true),
                        'zipcode' => $this->faker->boolean(0.5) ?
                            str_replace(' ', '', $this->faker->postcode) :
                            (string) $this->faker->numberBetween(9, 9999)
                    ]
                ])
            ];
        }

        return $address;
    }

    private function generateSalesPartner()
    {
        $sales_partner = [
            'sales_partner' => [
                'id' => null,
                'name' => null
            ]
        ];
        if ($this->faker->boolean(80)) {
            $sales_partner = [
                'sales_partner' => $this->faker->randomElement([
                    [
                        'id' => '01002681',
                        'name' => 'AUDI CITY PARIS ( 75001 )'
                    ],
                    [
                        'id' => '01002680',
                        'name' => 'BAUER PARIS SAINT-OUEN ( 93400 )'
                    ],
                    [
                        'id' => '01001940',
                        'name' => 'CARLIER AUTOMOBILES SAS ( 59552 )'
                    ],
                    [
                        'id' => '01002053',
                        'name' => 'SAS PREMIUM METROPOLE ( 59650 )'
                    ],
                    [
                        'id' => '01004900',
                        'name' => 'AVENIR AUTOMOBILES SA ( 49071 )'
                    ]
                ])
            ];
        }

        return $sales_partner;
    }
}