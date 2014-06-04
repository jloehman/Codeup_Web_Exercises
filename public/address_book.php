<?php


// you will want to display your entries at the top of the page

// $address_book = [];
// $errorMessage = '';

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
	function __destruct($ads = '') 
    {
        echo "Goodbye {$this->name}\n";
    }


$ads = new AddressDataStore("address_book.csv");

// below was before construct
// $ads = new AddressDataStore();

$ads->filename;

$address_book = [];

$address_book = $ads->read_address_book();


// Error check

$new_address = [];
if (!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip'])) {


    $new_address['name'] = $_POST['name'];
    $new_address['address'] = $_POST['address'];
    $new_address['city'] = $_POST['city'];
    $new_address['state'] = $_POST['state'];
    $new_address['zip'] = $_POST['zip'];
    if(empty($_POST['phone'])){
    	$new_address['phone'] = '';
    }else{
    $new_address['phone'] = $_POST['phone'];
}
    array_push($address_book, $new_address);
   	$ads->write_address_book($address_book);
    
} else {

    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            echo "<p><center><h2><font color='red'>" . ucfirst($key) .  " is empty.</h1></center></p>";
        }
    }
}

// var_dump($_FILES);
// Verify there were uploaded files and no errors
if (count($_FILES) > 0 && $_FILES['file1']['error'] == 0) {

    if ($_FILES['file1']["type"] != "text/csv") {
        echo "ERROR: file must be in text/csv!";
    } else {
        // Set the destination directory for uploads
        // Grab the filename from the uploaded file by using basename
        $upload_dir = '/vagrant/sites/codeup.dev/public/uploads/';
        $uploadFilename = basename($_FILES['file1']['name']);
        // Create the saved filename using the file's original name and our upload directory
        $saved_filename = $upload_dir . $uploadFilename;
        // Move the file from the temp location to our uploads directory
        move_uploaded_file($_FILES['file1']['tmp_name'], $saved_filename);

        // load the new todos
        // merge with existing list
        $ups = new AddressDataStore($saved_filename);
        $address_uploaded = $ups->read_address_book();
        // var_dump($address_uploaded);
        $address_book = array_merge($todos_array, $todos_uploaded);
        //var_dump($address_book);
        write_file_save($filename, $todos_array);
    }
}
// check if we need to remove an item from the list
if (isset($_GET['removeindex'])) {
    $removeindex = $_GET['removeindex'];
    unset($address_book[$removeindex]);
    $ads->write_address_book($address_book);
    // exit(0);
}
unset($ads);
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/csv; charset=UTF-8"/>
        <title></title>
    </head>
    <body>
        <h1>My address book:</h1>
<table border = "1">
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zip</th>
                    <th>Phone</th>
                </tr>
                <? foreach ($address_book as $key => $fields) : ?>
                <tr>
                    <? foreach ($fields as $value): ?>
                        <td><?= htmlspecialchars(strip_tags($value)); ?></td>
               
                    <? endforeach; ?>

                    <td><?= "<a href='?removeindex=" . $key . "'>";?> delete </a></td>
                </tr>
                <? endforeach; ?>
            </table>

            <h1>Add contact info:</h1>
    <form method="POST" action="address_book.php">
        <p>
            <label for="name">name</label>
            <input id="name" name="name" type="text" placeholder="name">
        </p>
        <p>
            <label for="address">address</label>
            <input id="address" name="address" type="text" placeholder="address">
        </p>
         <p>
            <label for="city">city</label>
            <input id="city" name="city" type="text" placeholder="city">
        </p>
        
        <p>
            <label for="state">state</label>
            <input id="state" name="state" type="text" placeholder="state">
        </p>
        
        <p>
            <label for="zip">zip</label>
            <input id="zip" name="zip" type="text" placeholder="zip">
        </p>
        
        <p>
            <label for="phone">phone</label>
            <input id="phone" name="phone" type="text" placeholder="optional">
        </p>
        
   		<input type='submit' value="Add contact">
   		<h1>Upload File</h1>

		<form method="POST" enctype="multipart/form-data" action="address_book.php">
		    <p>
		        <label for="file1">File to upload: </label>
		        <input type="file" id="file1" name="file1">
		    </p>
		    <p>
		        <input type="submit" value="Upload">
		    </p>
</form>
    </form>
        </body>
        </html>