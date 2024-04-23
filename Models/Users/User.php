<?php 

namespace Models\Users;

use DateTime;
use Interfaces\FileConvertible;

class User implements FileConvertible{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $hashedPassword;
    private string $phoneNumber;
    private string $address;
    private DateTime $birthDate;
    private DateTime $membershipExpirationDate;
    private string $role;
    
    public function __construct(
        int $id,
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        string $phoneNumber,
        string $address,
        DateTime $birthDate,
        DateTime $membershipExpirationDate,
        string $role
    )
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->hashedPassword = password_hash($password,PASSWORD_DEFAULT);
        $this->phoneNumber = $phoneNumber;
        $this->address = $address;
        $this->birthDate = $birthDate;
        $this->membershipExpirationDate = $membershipExpirationDate;
        $this->role = $role;
    }

    public function login(string $password):bool{
        return password_verify($password,$this->hashedPassword);
    }

    public function updateProfile(string $address,string $phoneNumber):void{
        $this->address = $address;
        $this->phoneNumber = $phoneNumber;
    }

    public function renewMembership(DateTime $expirationDate):void{
        $this->membershipExpirationDate = $expirationDate;
    }

    public function changePassword(string $newPassword):void{
        $this->hashedPassword = password_hash($newPassword,PASSWORD_DEFAULT);
    }

    public function hasMembershipExpired():bool{
        $currentDate = new DateTime();
        return $currentDate > $this->membershipExpirationDate;
    }

    public function toString(): string {
        return sprintf(
            "
            User ID: %d\n
            Name: %s %s\n
            Email: %s\n
            Phone Number: %s\n
            Address: %s\n
            Birth Date: %s\n
            Membership Expiration Date: %s\n
            Role: %s\n
            ",
            $this->id,
            $this->firstName,
            $this->lastName,
            $this->email,
            $this->phoneNumber,
            $this->address,
            $this->birthDate->format('Y-m-d'),
            $this->membershipExpirationDate->format('Y-m-d'),
            $this->role
        );
    }

    public function toHTML():string{
        return sprintf("
            <div class='user-card'>
                <div class='avatar'>SAMPLE</div>
                <h2>Name: %s %s</h2>
                <p>Email: %s</p>
                <p>Phone Number: %s</p>
                <p>Address: %s</p>
                <p>Birth Date: %s</p>
                <p>Membership Expiration Date: %s</p>
                <p>Role: %s</p>
            </div>",
            $this->firstName,
            $this->lastName,
            $this->email,
            $this->phoneNumber,
            $this->address,
            $this->birthDate->format('Y-m-d'),
            $this->membershipExpirationDate->format('Y-m-d'),
            $this->role
        );
    }

    public function toMarkdown():string{
        return "## User: {$this->firstName} {$this->lastName}
                 - Email: {$this->email}
                 - Phone Number: {$this->phoneNumber}
                 - Address: {$this->address}
                 - Birth Date: {$this->birthDate}
                 - Role: {$this->role}";
    }

    public function toArray():array{
        return [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'password' => $this->hashedPassword,
            'phoneNumber' => $this->phoneNumber,
            'address' => $this->address,
            'birthDate' => $this->birthDate,
            'role' => $this->role
        ];
    }

    public function getID():int{
        return $this->id;
    }

    public function getUserName():string{
        return $this->firstName. " ".$this->lastName;
    }
}

?>
