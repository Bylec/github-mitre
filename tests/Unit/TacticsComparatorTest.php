<?php

namespace Tests\Unit;

use App\Mitre\Comparators\TacticsComparator;
use Tests\TestCase;

class TacticsComparatorTest extends TestCase
{
    public function test_all_elements_to_insert()
    {
        $tacticsFromDatabase = collect();

        $tacticsFromSource = collect(
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

        $tacticsComparator = new TacticsComparator($tacticsFromDatabase, $tacticsFromSource);
        $tacticsComparator->compare();

        $this->assertCount(2, $tacticsComparator->getEntriesToInsert());
        $this->assertCount(0, $tacticsComparator->getEntriesToUpdate());
    }

    public function test_all_elements_to_update()
    {
        $tacticsFromDatabase = collect(
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

        $tacticsFromSource = collect(
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

        $tacticsComparator = new TacticsComparator($tacticsFromDatabase, $tacticsFromSource);
        $tacticsComparator->compare();

        $this->assertCount(0, $tacticsComparator->getEntriesToInsert());
        $this->assertCount(2, $tacticsComparator->getEntriesToUpdate());
    }

    public function test_one_entry_to_insert_one_to_update()
    {
        $tacticsFromDatabase = collect(
            [
                (object) [
                    "id" => 1,
                    "modified" => "2020-01-24T14:14:05.452Z"
                ],
            ]
        );

        $tacticsFromSource = collect(
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

        $tacticsComparator = new TacticsComparator($tacticsFromDatabase, $tacticsFromSource);
        $tacticsComparator->compare();

        $this->assertCount(1, $tacticsComparator->getEntriesToInsert());
        $this->assertCount(1, $tacticsComparator->getEntriesToUpdate());
    }

    public function test_data_from_source_and_from_database_is_the_same()
    {
        $tacticsFromDatabase = collect(
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

        $tacticsFromSource = collect(
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

        $tacticsComparator = new TacticsComparator($tacticsFromDatabase, $tacticsFromSource);
        $tacticsComparator->compare();

        $this->assertCount(0, $tacticsComparator->getEntriesToInsert());
        $this->assertCount(0, $tacticsComparator->getEntriesToUpdate());
    }
}
