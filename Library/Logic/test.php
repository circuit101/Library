<!-- public function delete_book($filename) {
        // Load existing book data from JSON
        $books_json = file_get_contents($filename);
        $books_array = json_decode($books_json, true);

        // Find the book to delete by ISBN and remove it
        $books_array = array_filter($books_array, function($book) {
            return $book['ISBN'] !== $this->ISBN; // Remove book with this ISBN
        });

        // Save the updated books array back to the JSON file
        file_put_contents($filename, json_encode(array_values($books_array), JSON_PRETTY_PRINT));
    }
} -->