<?php
    class Book{
        //Properties
        private int $ISBN;
        private string $title;
        private $authors = [];
        private string $publication_date;
        private bool $availability;
        //Construct
        public function __construct($ISBN,$title,$publication_date,$availability)
        {
            $this->ISBN = $ISBN;
            $this->title = $title;
            $this->publication_date = $publication_date;
            $this->availability = $availability;
        }
        //Methods
        public function add_authors(Author $authors){
            $this->authors[] = $authors;
        }
        //Getter
        public function get_ISBN(): int{
            return $this->ISBN;
        }
        public function get_title(): string {
            return $this->title;
        }
        public function get_authors(): array {
            return $this->authors;
        }
        public function get_publication_date(): string {
            return $this->publication_date;
        }
        public function get_availability(): bool {
            return $this->availability;
        }
        //Delete
        public function delete_book($filename){
            $books_json = file_get_contents($filename);
            $books_array = json_decode($books_json, true);

        // Find the book to delete by ISBN and remove it
        $books_array = array_filter($books_array, function($book) {
            return $book['ISBN'] !== $this->ISBN; // Remove book with this ISBN
        });

        // Save the updated books array back to the JSON file
        file_put_contents($filename, json_encode(array_values($books_array), JSON_PRETTY_PRINT));
        }
    };

    class Author{
        //Properties
        private string $first_name;
        private string $last_name;
        private string $nationality;
        private $books = [];
        //Construct
        public function __construct($first_name,$last_name,$nationality)
        {
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->nationality = $nationality;
        }
        //Methods
        public function add_books(Book $books){
            $this->books[] = $books;
        }
        //Getter
        public function get_first_name(): string {
            return $this->first_name;
        }
        public function get_last_name(): string {
            return $this->last_name;
        }
        public function get_nationality(): string {
            return $this->nationality;
        }
        public function get_books(): array {
            return $this->books;
        }
    }

    $book1 = new Book(8765,"title","date",true);
    $author1 = new Author("name","name","natio");

    // Adding author to book and book to author
    $book1->add_authors($author1);
    $author1->add_books($book1);
 
    $book_data = [
        "ISBN" => $book1->get_ISBN(),
        "title" => $book1->get_title(),
        "publication_date" => $book1->get_publication_date(),
        "availability" => $book1->get_availability(),
        'authors' => array_map(function ($author) {
            return [
                'first_name' => $author->get_first_name(),
                'last_name' => $author->get_last_name(),
                'nationality' => $author->get_nationality(),
                'books' => array_map(function ($book) {
                    return $book->get_title();
                }, $author->get_books()),
            ];
        }, $book1->get_authors())
    ];

    $book_data = json_encode($book_data,JSON_PRETTY_PRINT);
    echo $book_data;

    file_put_contents("../Data/Books.json",$book_data);

    $book_data->delete_book("../Data/Books.json");
