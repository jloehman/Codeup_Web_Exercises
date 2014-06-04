<?php

class AddressDataStore {

    public $filename = '';
    //set to empty string
    // will name filename
    public function __construct($filename)
    {
    	$this->filename = $filename;
    }


    public function read_address_book() 
    {
        $handle = fopen($this->filename, 'r');
		$address_book = [];

		while (!feof($handle)){
			$row = fgetcsv($handle);
			if(is_array($row)) {
				$address_book[] = $row;
			}
		}

		fclose($handle);
		return $address_book;
		}


	}
	function write_address_book($address_book)
    {
    	if(is_writable($this->filename)){
        $handle = fopen($this->filename, 'w');
        foreach ($address_book as $fields) {
        	fputcsv($handle, $fields);
        }
        	fclose($handle);
    	}
	}