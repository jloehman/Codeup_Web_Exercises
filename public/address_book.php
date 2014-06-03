<?php


// you will want to display your entries at the top of the page
$address_book = [
    ['The White House', '1600 Pennsylvania Ave.', 'Washington', 'DC', '20500'],
    ['Marvel Comics', 'P.O. Box 1527', 'Long Island City', 'NY', '11101'],
    ['LucasArts', 'P.O. Box 29901', 'San Francisco', 'CA', '94129-0901'],
    ['Home', '18910 Marbach Ln', 'San Antonio', 'TX', '78266'],
    ['Codeup', '112 E Pecan St', 'San Antonio', 'TX', '78205']
];


$filename = "data/address_book.csv";

// Write CSV function

function write_csv($bigArray, $filename) {
    if (is_writable($filename)) {
        $handle = fopen($filename, "w");
        foreach ($bigArray as $fields) {
            fputcsv($handle, $fields);
        }
        fclose($handle);
    }
}

$new_address = [];

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
            echo "<h1>" . ucfirst($key) .  " is empty.</h1>";
        }
    }
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
<table>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zip</th>
                    <th>Phone</th>
                </tr>
                <? foreach ($address_book as $fields) : ?>
                <tr>
                    <? foreach ($fields as $value): ?>
                        <td><?= $value; ?></td>
                    <? endforeach; ?>
                </tr>
                <? endforeach; ?>
            </table>

            <h1>Add contact info:</h1>
    <form method="POST" action="/address_book.php">
        <p>
            <label for="contact">name</label>
            <input id="contact" name="contact" type="text" placeholder="name">
        </p>
        <p>
            <label for="contact">address</label>
            <input id="contact" name="contact" type="text" placeholder="address">
        </p>
         <p>
            <label for="contact">city</label>
            <input id="contact" name="contact" type="text" placeholder="city">
        </p>
        
        <p>
            <label for="contact">state</label>
            <input id="contact" name="contact" type="text" placeholder="state">
        </p>
        
        <p>
            <label for="contact">zip</label>
            <input id="contact" name="contact" type="text" placeholder="zip">
        </p>
        
   
 
        <p>
            <label for="contact">phone</label>
            <input id="contact" name="contact" type="text" placeholder="phone">
        </p>
        
   		<input type='submit' value="Add contact">
    </form>


        </body>
        </html>