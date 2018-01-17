<?php
/**
 * Collection of dummy data for car rows.
 *
 * @author: Cuesta
 */
namespace Database\Faker;

class CarFaker {
    public  $make,
            $model,
            $number;

    private $_makeModels = [
        'Ford' => [
            'Focus',
            'Fiesta',
            'Mustang'
        ],
        'Chevrolet' => [
            'Cruze',
            'Spark',
            'Impala'
        ]
    ];

    private $_vins = [
        '1GNCS13WXT2237074',
        '3FADP4EJ9CM135118',
        '1FMHK7F87BGA30217',
        '2FMDK39C77BB64327',
        '1G1ZA5EU9BF204592',
        '5Y2SP67049Z422679',
        '1FTSW31F3YEE40515',
        '1N4AL3AP0FC204691',
        '5NPDH4AE0DH251122',
        '2HKRM4H3XCH618368',
        '5NPEC4AC2DH556610',
        '1FT8W3BT7DEA68010',
        '5FNRL38289B028424'
    ];

    public function __construct()
    {
        $this->getMakeModel();
        $this->getVinNumber();
        unset($this->_vins);
        unset($this->_makeModels);

        return $this;
    }

    public function getVinNumber()
    {
        $this->number = $this->_vins[array_rand($this->_vins)];
    }

    public function getMakeModel()
    {
        $this->make = array_rand($this->_makeModels);
        $model = array_rand($this->_makeModels[$this->make]);
        $this->model = $this->_makeModels[$this->make][$model];
    }
}