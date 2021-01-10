<?php

namespace Tests\Unit;

use App\Mitre\Comparators\TechniquesComparator;
use Tests\TestCase;

class TechniquesComparatorTest extends TestCase
{
    public function test_all_elements_to_insert()
    {
        $techniquesFromDatabase = collect();

        $techniquesFromSource = collect(
            [
                [
                    "id" => 1,
                    "modified" => "2020-01-24T14:14:05.452Z"
                ],
                [
                    "id" => 2,
                    "modified" => "2020-01-24T14:14:05.452Z"
                ]
            ]
        );

        $techniquesComparator = new TechniquesComparator($techniquesFromDatabase, $techniquesFromSource);
        $techniquesComparator->compare();

        $this->assertCount(2, $techniquesComparator->getEntriesToInsert());
        $this->assertCount(0, $techniquesComparator->getEntriesToUpdate());
    }

    public function test_all_elements_to_update()
    {
        $techniquesFromDatabase = collect(
            [
                (object) [
                    "id" => 1,
                    "modified" => "2020-01-24T14:14:05.452Z"
                ],
                (object) [
                    "id" => 2,
                    "modified" => "2020-01-24T14:14:05.452Z"
                ]
            ]
        );

        $techniquesFromSource = collect(
            [
                [
                    "id" => 1,
                    "modified" => "2020-01-25T14:14:05.452Z"
                ],
                [
                    "id" => 2,
                    "modified" => "2020-01-25T14:14:05.452Z"
                ]
            ]
        );

        $techniquesComparator = new TechniquesComparator($techniquesFromDatabase, $techniquesFromSource);
        $techniquesComparator->compare();

        $this->assertCount(0, $techniquesComparator->getEntriesToInsert());
        $this->assertCount(2, $techniquesComparator->getEntriesToUpdate());
    }

    public function test_one_entry_to_insert_one_to_update()
    {
        $techniquesFromDatabase = collect(
            [
                (object) [
                    "id" => 1,
                    "modified" => "2020-01-24T14:14:05.452Z"
                ],
            ]
        );

        $techniquesFromSource = collect(
            [
                [
                    "id" => 1,
                    "modified" => "2020-01-25T14:14:05.452Z"
                ],
                [
                    "id" => 2,
                    "modified" => "2020-01-25T14:14:05.452Z"
                ]
            ]
        );

        $techniquesComparator = new TechniquesComparator($techniquesFromDatabase, $techniquesFromSource);
        $techniquesComparator->compare();

        $this->assertCount(1, $techniquesComparator->getEntriesToInsert());
        $this->assertCount(1, $techniquesComparator->getEntriesToUpdate());
    }

    public function test_data_from_source_and_from_database_is_the_same()
    {
        $techniquesFromDatabase = collect(
            [
                (object) [
                    "id" => 1,
                    "modified" => "2020-01-24T14:14:05.452Z"
                ],
                (object) [
                    "id" => 2,
                    "modified" => "2020-01-24T14:14:05.452Z"
                ]
            ]
        );

        $techniquesFromSource = collect(
            [
                [
                    "id" => 1,
                    "modified" => "2020-01-24T14:14:05.452Z"
                ],
                [
                    "id" => 2,
                    "modified" => "2020-01-24T14:14:05.452Z"
                ]
            ]
        );

        $techniquesComparator = new TechniquesComparator($techniquesFromDatabase, $techniquesFromSource);
        $techniquesComparator->compare();

        $this->assertCount(0, $techniquesComparator->getEntriesToInsert());
        $this->assertCount(0, $techniquesComparator->getEntriesToUpdate());
    }
}
