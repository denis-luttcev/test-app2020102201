<?php
declare(strict_types=1);

namespace App\Datamodel;

/**
 * Declares geoposition
 */
class Location
{
    /**
     * @var float
     */
    private $latitude;
    /**
     * @var float
     */
    private $longitude;
    
    public function __construct(float $latitude, float $longitude)
    {
        if ($this->isValid($latitude, $longitude)) {
            $this->latitude = $latitude;
            $this->longitude = $longitude;
        } else {
            throw new DomainException('Invalid coordinate values.');
        }
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }
    
    private function isValid(float $latitude, float $longitude): bool
    {
        return -90.0 <= $latitude && 90.0 >= $latitude && -180.0 <= $longitude && 180.0 >= $longitude;
    }
}
