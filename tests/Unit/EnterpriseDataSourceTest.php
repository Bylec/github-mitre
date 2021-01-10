<?php

namespace Tests\Unit;

use App\Mitre\Sources\Enterprise;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class EnterpriseDataSourceTest extends TestCase
{
    public function test_returns_no_tactics_and_techniques_when_no_source_data_provided()
    {
        Config::set('mitre.enterprise_url', null);

        $enterpriseDataSource = new Enterprise();

        $data = $enterpriseDataSource->prepareData();

        $this->assertEquals(collect(), $data['tactics']);
        $this->assertEquals(collect(), $data['techniques']);
    }

    public function test_one_tactic_and_one_technique_provided()
    {
        Config::set('mitre.enterprise_url', base_path('tests/EnterpriseSourceMock/one_tactic_one_technique.json'));

        $enterpriseDataSource = new Enterprise();

        $data = $enterpriseDataSource->prepareData();

        $this->assertCount(1, $data['tactics']);
        $this->assertCount(1, $data['techniques']);
    }

    public function test_no_data_provided()
    {
        Config::set('mitre.enterprise_url', base_path('tests/EnterpriseSourceMock/no_data.json'));

        $enterpriseDataSource = new Enterprise();

        $data = $enterpriseDataSource->prepareData();

        $this->assertCount(0, $data['tactics']);
        $this->assertCount(0, $data['techniques']);
    }
}
