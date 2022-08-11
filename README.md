#alex-api
Concept project for Coredomino interview

Uses:
- Laravel 9
- Uses laravel/sanctum
- Uses restul api endpoints built using apiResource
- Uses spatie/sluggable 

Access the api at
 - all endpoints and required params will  be listed at
``http://alex-api.com/api``
``
```        $endpoints =
            [
                1 =>
                    [
                        'endpoint' => '/api/login',
                        'form_data' => 'username:password',
                        'returns' => 'User / Token',
                        'method' => 'POST',
                        'headers' => 'Accept: application/json'
                    ],

                2 =>
                    [
                        'endpoint' => '/api/authorize',
                        'form_data' => 'username:password',
                        'returns' => 'Token',
                        'method' => 'POST',
                        'headers' => 'Accept: application/json'
                    ],

                3 =>
                    [
                        'endpoint' => '/api/register',
                        'form_data' => 'first_name:last_name:email:password',
                        'returns' => 'User / Token',
                        'method' => 'POST',
                        'headers' => 'Accept: application/json'
                    ],
                4 =>
                    [
                        'endpoint' => '/api/v1/trips',
                        'endpoint_requirements' => 'Token (Authorization: Bearer)',
                        'endpoint_description' => 'Allows browsing trips',
                        'headers' => 'Accept: application/json',
                        'arguments' =>
                            [
                                [
                                    [
                                        'argument' => '{trip:id}',
                                        'method' => 'GET',
                                        'description' => 'Returns trip data based on id',
                                        'example' => '/api/v1/trips/1',
                                    ],
                                    [
                                        'argument' => '{trip:slug}',
                                        'method' => 'GET',
                                        'description' => 'Returns trip data based on slug',
                                        'example' => '/api/v1/trips/dr-chelsey-jacobi'
                                    ],
                                    [
                                        'argument' => null,
                                        'method' => 'POST',
                                        'description' => 'Inserts trip into the database',
                                        'inputs' =>
                                            [
                                                'title', 'description', 'start_date', 'end_date', 'location', 'price'
                                            ]
                                    ],
                                    [
                                        'argument' => '{trip:id}',
                                        'method' => 'PUT',
                                        'description' => 'Updates trip data',
                                        'example' => '/api/v1/trips/1',
                                        'inputs' =>
                                            [
                                                'title', 'description', 'start_date', 'end_date', 'location', 'price'
                                            ]
                                    ],
                                    [
                                        'argument' => '{trip:id}',
                                        'method' => 'DELETE',
                                        'description' => 'Deletes trip data based on id',
                                        'example' => '/api/v1/trips/1',
                                    ]
                                ],
                            ],

                    ],
                5 =>
                    [
                        'endpoint' => '/api/v1/trips/{query_string_params}',
                        'endpoint_description' => 'Allows filtering trips based on multiple query string params',
                        'headers' => 'Accept: application/json',
                        'parameters' =>
                            [
                                [
                                    'name' => 'title',
                                    'description' => 'Filters trips based on title',
                                    'example' => '/api/v1/trips/?title=my+title'
                                ],
                                [
                                    'name' => 'orderBy',
                                    'description' => 'Orders the results based on criteria',
                                    'values' =>
                                        [
                                            'dateAsc' => 'List the oldest entries based on update date',
                                            'dateDesc' => 'List the newest entries based on update date',
                                            'dateFromAsc' => 'List the entries based on the list date ascending',
                                            'dateToAsc' => 'List the entries based on the list date descending'
                                        ],
                                    'example' => '/api/v1/trips/?orderBy=dateDesc'
                                ],
                                [
                                    'name' => 'priceFrom',
                                    'description' => 'Starting price range',
                                    'example' => '/api/v1/trips/?priceFrom=100'
                                ],
                                [
                                    'name' => 'priceTo',
                                    'description' => 'Ending price range',
                                    'example' => '/api/v1/trips/?priceTo=200'
                                ]
                            ]
                    ],
                6 =>
                    [
                        'endpoint' => '/api/v1/bookings',
                        'endpoint_description' => 'Allows managing bookings',
                        'headers' => 'Accept: application/json',
                        'required_params' => 'Authentication: Bearer {token}',
                        'endpoints' =>
                            [
                                'method' => 'GET',
                                'endpoint' => '/api/v1/bookings/{id}',
                                'desc' => 'retrieves data'
                            ]
                    ],
                7 =>   [
                    'endpoint' => '/api/v1/reserve-trip',
                    'endpoint_description' => 'Reserves a trip',
                    'headers' => 'Accept: application/json',
                    'required_params' => 'Authentication: Bearer {token}',
                    'form-data' => '{id}'
                ],
            ];`

```

Uses default rete limiting found in api config. 
App could be better. But for demo purposes the logic is quite vague.
