<?php


// you will want to display your entries at the top of the page

$new_address = [];

$filename = "address_book.csv";

$address_book = read_file($filename);


// $handle = fopen($filename, 'r');



// Write CSV function

function write_csv($address_book, $filename) {
        $handle = fopen($filename, 'w');
        foreach ($address_book as $fields) {
            fputcsv($handle, $fields);
        }
        fclose($handle);
    }


// Error check

if (!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip'])) {


    $new_address['name'] = $_POST['name'];
    $new_address['address'] = $_POST['address'];
    $new_address['city'] = $_POST['city'];
    $new_address['state'] = $_POST['state'];
    $new_address['zip'] = $_POST['zip'];
    $new_address['phone'] = $_POST['phone'];

    array_push($address_book, $new_address);
   	write_csv($address_book, $filename);
    
} else {

    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            echo "<p><center><h2><font color='red'>" . ucfirst($key) .  " is empty.</h1></center></p>";
        }
    }
}
// if (!empty($_POST['phone'])) {
//     array_push($new_address, $_POST['phone']);
//     write_csv($filename, $new_address);
// }
//Create a function to read the file and display all entries, just like the TODO list.

function read_file($filename){
	$handle = fopen($filename, 'r');
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




// check if we need to remove an item from the list
if (isset($_GET['removeindex'])) {
    $removeindex = $_GET['removeindex'];
    unset($address_book[$removeindex]);
    write_csv($address_book, $filename);
    // exit(0);

}

?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
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
    <form method="POST" action="/address_book.php">
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
            <input id="phone" name="phone" type="text" placeholder="phone">
        </p>
        
   		<input type='submit' value="Add contact">
    </form>


        </body>
        </html>