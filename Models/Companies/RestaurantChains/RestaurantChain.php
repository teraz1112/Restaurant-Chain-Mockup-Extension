<?php

namespace Models\Companies\RestaurantChains;

use Interfaces\FileConvertible;
use Models\Companies\Company;

class RestaurantChain extends Company implements FileConvertible{
    private int $chainId;
    private array $restaurantLocation;
    private string $cuisineType;
    private int $numberOfLocations;
    private string $parentCompany;

    public function __construct(
        string $name,
        int $foundingYear,
        string $description,
        string $website,
        string $phone,
        string $industry,
        string $ceo,
        bool $isPubliclyTraded,
        string $country,
        string $founder,
        int $totalEmployees,
        int $chainId,
        array $restaurantLocation,
        string $cuisineType,
        int $numberOfLocations,
        string $parentCompany
    )
    {
        parent::__construct(
            $name,
            $foundingYear,
            $description,
            $website,
            $phone,
            $industry,
            $ceo,
            $isPubliclyTraded,
            $country,
            $founder,
            $totalEmployees
        );
        $this->chainId = $chainId;
        $this->restaurantLocation = $restaurantLocation;
        $this->cuisineType = $cuisineType;
        $this->numberOfLocations = $numberOfLocations;
        $this->parentCompany = $parentCompany;        
    }

    public function toString(): string{
        return sprintf(
            "Chain ID: %s\n
             Restaurant Location: %s\n
             Cuisine Type: %s/n
             Number Of Locations: %d\n
             Parent Cmpany: %s\n",
            $this->chainId,
            $this->restaurantLocation,
            $this->cuisineType,
            $this->numberOfLocations,
            $this->parentCompany
        );        
    }

    public function toHTML(): string{
        $locationsList= "";
        foreach($this->restaurantLocation as $restaurantLocation){
            $locationsList .= $restaurantLocation->toHTML();
        }
        return sprintf(
            "
            <div class='d-flex justify-content-center p-2 m-2'>
                <h1>Restaurant Chain %s</h1>
            </div>
            %s
            ",
            $this->parentCompany,
            $locationsList
        );        
    }

    public function toMarkdown(): string{
        return " - Chain Id: {$this->chainId} 
                 - Restaurant Location: {$this->restaurantLocation} 
                 - Cuisine Type: {$this->cuisineType} 
                 - Number Of Location: {$this->numberOfLocations} 
                 - Parent Company: {$this->parentCompany}";    
    }

    public function toArray(): array{
        return [
            "chainId" => $this->chainId,
            "restaurantLocation" => $this->restaurantLocation,
            "cuisineType" => $this->cuisineType,
            "numberOfLocations" => $this->numberOfLocations,
            "parentCompany" => $this->parentCompany
        ];
    }

    public function restaurantLocation():array{
        return $this->restaurantLocation;
    }
}

?>
