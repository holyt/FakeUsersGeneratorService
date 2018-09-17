<?php

namespace App\UserGenerator;
use Faker\Factory;
use Faker\Generator;

class UserGenerator
{
    private  $faker;

    protected static $userFields = [
        'first_name' => 'firstName',
        'last_name' => ['value' => 'lastName', 'gender' => true ],
        'email' => 'email',
        'phone' => 'e164PhoneNumber'
    ];

    public static function getUserFields(): array
    {
        return array_keys(static::$userFields);
    }

    public function __construct(Generator $faker = null)
    {
        if ($faker) {
            $this->faker = $faker;
        }

        $this->faker = Factory::create();
    }

    public function generateUser(string $gender = null): array
    {
        return collect(static::$userFields)
            ->mapWithKeys(function ($fakerField, string $userField) use($gender): array {

                if (is_array($fakerField)) {
                    $fakerFieldValue = $fakerField['value'];

                    if ($gender && $fakerField['gender']) {
                        return [$userField => $this->faker->$fakerFieldValue($gender)];
                    }

                    return [$userField => $this->faker->$fakerFieldValue];
                }

                return [$userField => $this->faker->$fakerField];
            })->toArray();
    }

    public function generateUsers(int $numberOfUsers, string $gender = null): array
    {
        $users = [];

        for ($i=0; $i < $numberOfUsers; ++$i) {
            $users[] = $this->generateUser($gender);
        }

        return $users;
    }
}
