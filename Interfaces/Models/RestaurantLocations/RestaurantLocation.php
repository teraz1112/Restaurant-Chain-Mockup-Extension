<?php

namespace Models\RestaurantLocations;

use Interfaces\FileConvertible;

class RestaurantLocation implements FileConvertible{
    private string $name;
    private string $address;
    private string $city;
    private string $state;
    private string $zipCode;
    private array $employees;
    private bool $isOpen;
    private bool $hasDriveThru;

    public function __construct(
        string $name,
        string $address,
        string $city,
        string $state,
        string $zipCode,
        array $employees,
        bool $isOpen,
        bool $hasDriveThru
    )
    {
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zipCode = $zipCode;
        $this->employees = $employees;
        $this->isOpen = $isOpen;
        $this->hasDriveThru = $hasDriveThru;        
    }

    public function toString(): string{
        return sprintf(
            "
            Name: %s\n
            Address: %s\n
            City: %s\n
            State: %s\n
            Zip Code: %s\n
            Employees: %s\n
            Open: %s\n
            Drive-Through: %s\n
            ",
            $this->name,
            $this->address,
            $this->city,
            $this->state,
            $this->zipCode,
            $this->employees,
            $this->isOpen ? 'Yes' : 'No',
            $this->hasDriveThru ? 'Yes' : 'No'
        );
    }



    public function toHTML(): string{
        $employeeList = "";
        foreach($this->employees as $employee){
                $employeeList .= $employee->toHTML();
        }

        return sprintf("
            <div class='accordion mx-4' id='accordionPanelsStayOpenExample'>
                <div class='accordion-item'>
                    <h2 class='accordion-header'>
                        <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#panelsStayOpen-%s' aria-expanded='false' aria-controls='panelsStayOpen-%s'>
                            %s
                        </button>
                    </h2>
                    <div id='panelsStayOpen-%s' class='accordion-collapse collapse'>
                        <div class='accordion-body'>
                            <h2>Employees</h2>
                            <table class='table'>
                                <thead>
                                    <tr>
                                        <th scope='col'>ID</th>
                                        <th scope='col'>Title</th>
                                        <th scope='col'>Name</th>
                                        <th scope='col'>Start Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    %s
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            ",
            $this->zipCode,
            $this->zipCode,
            $this->name,
            $this->zipCode,
            $employeeList
        );
    }

    public function toMarkdown(): string{
        return "## Name: {$this->name} 
                 - Address: {$this->address} 
                 - City: {$this->city} 
                 - State: {$this->state} 
                 - Zip Code: {$this->zipCode} 
                 - Employees: {$this->employees} 
                 - Open: {$this->isOpen} 
                 - Drive-Through: {$this->hasDriveThru}";
    }

    public function toArray(): array{
        return [
            "name" => $this->name,
            "address" => $this->address,
            "city" => $this->city,
            "state" => $this->state,
            "zipCode" => $this->zipCode,
            "employees" => $this->employees,
            "isOpen" => $this->isOpen,
            "hasDriveThru" => $this->hasDriveThru
        ];        
    }
}

?>
