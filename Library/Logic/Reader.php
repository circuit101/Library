<?php
    class Reader{
        private int $card_number;
        private string $first_name;
        private string $last_name;
        private string $address;
        private $fingerprints = [];
        //Construct
        public function __construct($card_number,$first_name,$last_name,$address)
        {
            $this->card_number = $card_number;
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->address = $address;
        }
        //Methods
        public function add_fingerprints(Fingerprints $fingerprints){
            $this->fingerprints[] = $fingerprints;
        }
        //Getter
        public function getCardNumber(): int {
            return $this->card_number;
        }
    
        public function getFirstName(): string {
            return $this->first_name;
        }
    
        public function getLastName(): string {
            return $this->last_name;
        }
    
        public function getAddress(): string {
            return $this->address;
        }
    
        public function getFingerprints(): array {
            return $this->fingerprints;
        }
    }

    class Fingerprints{
        private $start_date;
        private string $expected_return_date;
        private string $real_return_date;
        private string $fingerprinted_books;
        private string $readers;
        //Construct
        public function __construct($start_date,$expected_return_date,$real_return_date,$fingerprinted_books,$readers)
        {
            $this->start_date = $start_date;
            $this->expected_return_date = $expected_return_date;
            $this->real_return_date = $real_return_date;
            $this->fingerprinted_books = $fingerprinted_books;
            $this->readers = $readers;
        }
        //Getter
        public function getStartDate(): string {
            return $this->start_date;
        }
    
        public function getExpectedReturnDate(): string {
            return $this->expected_return_date;
        }
    
        public function getRealReturnDate(): string {
            return $this->real_return_date;
        }
    
        public function getFingerprintedBooks(): string {
            return $this->fingerprinted_books;
        }
    
        public function getReaders(): string {
            return $this->readers;
        }
    }

    $fingerprints1 = new Fingerprints("start","expected","real","fingerprinted","readers");
    $reader1 = new Reader(1234,"name","name","address");
    $reader1-> add_fingerprints($fingerprints1);

    // Prepare the data for JSON encoding by converting the objects to an associative array
    $reader_data = [
        'card_number' => $reader1->getCardNumber(),
        'first_name' => $reader1->getFirstName(),
        'last_name' => $reader1->getLastName(),
        'address' => $reader1->getAddress(),
        'fingerprints' => array_map(function($fingerprint) {
            return [
                'start_date' => $fingerprint->getStartDate(),
                'expected_return_date' => $fingerprint->getExpectedReturnDate(),
                'real_return_date' => $fingerprint->getRealReturnDate(),
                'fingerprinted_books' => $fingerprint->getFingerprintedBooks(),
                'readers' => $fingerprint->getReaders()
            ];
        }, $reader1->getFingerprints())
    ];

    $reader_data = json_encode($reader_data,JSON_PRETTY_PRINT);

    echo $reader_data;
    file_put_contents("../Data/Reader.json",$reader_data);
?>