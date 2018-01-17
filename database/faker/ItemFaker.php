<?php
/**
 * Collection of dummy data for items (parts, labor) rows.
 *
 * @author: Cuesta
 */

namespace Database\Faker;


class ItemFaker
{
    public  $name;
    private $_parts = [
        'radiator', 'rocker', 'spoiler', 'rims','tire pressure gauge',
        'vacuum gauge', 'voltmeter', 'tachometer', 'speedometer', 'oil pressure gauge',
        'battery', 'ignition switch', 'power window switch', 'switch cover', 'door switch'
    ];

    public function __construct()
    {
        $this->getPart();
        unset($this->_parts);
    }

    private function getPart()
    {
        $this->name = $this->_parts[array_rand($this->_parts)];
    }
}