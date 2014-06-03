<?php


// you will want to display your entries at the top of the page
$address_book = [
    ['The White House', '1600 Pennsylvania Ave.', 'Washington', 'DC', '20500'],
    ['Marvel Comics', 'P.O. Box 1527', 'Long Island City', 'NY', '11101'],
    ['LucasArts', 'P.O. Box 29901', 'San Francisco', 'CA', '94129-0901'],
    ['Home', '18910 Marbach Ln', 'San Antonio', 'TX', '78266'],
    ['Codeup', '112 E Pecan St', 'San Antonio', 'TX', '78205']
];
$new_address = [];

$filename = "address_book.csv";

// Write CSV function

function write_csv($address_book, $filename) {
    if (is_writable($filename)) {
        $handle = fopen($filename, 'w');
        foreach ($address_book as $fields) {
            fputcsv($handle, $fields);
        }
        fclose($handle);
    }
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