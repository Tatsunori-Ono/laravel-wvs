<?php

return [
    // index画面
    'title' => 'Equipment Rental Service',
    'create' => 'Add a New Item to the Catalogue',
    'search' => 'Search',
    'all-categories' => 'All Categories',
    'filter' => 'Filter',
    'favourites' => 'My Favourites',
    'go-to-cart' => 'Go to Cart',
    'details' => 'Show more',
    'status-rented' => 'Currently all rented',
    'status-available' => 'available',
    'no-items' => 'No Items Found',

    // create画面
    'product_name' => 'Name of the Product',
    'product_type' => 'Type of the Product',
    'manufacturer' => 'Manufacturer',
    'category' => 'Category',
    'location_stored' => 'Location Stored',
    'description' => 'Description of the Product',
    'purchase_date' => 'Purchase Date',
    'quantity' => 'Quantity',
    'max_rental_days' => 'Maximum Days of Rental Allowed (unless specified, 7 days is recommended)',
    'price' => 'Price for Rental (Put 0 for free rental)',
    'images' => 'Thumbnail Images of the Product (Maxmium 9 images)',
    'submit' => 'Add Item',

    // show画面
    'back-to-catalogue' => 'Back to Catalogue',
    'rental_days' => 'Days on Rental',
    'add-to-cart' => 'Add to Cart',
    'rented-times' => 'Total Rentals',
    'edit' => 'Edit',
    'delete' => 'Delete',

    // edit画面
    'edit-equipment' => 'Edit Equipment',
    'current-images' => 'Current Images',
    'new-images' => 'New Images',
    'remove-image' => 'Remove',

    // cart/index.blade.php
    'cart' => 'Your Cart',
    'item' => 'Item',
    'update' => 'Update',
    'remove' => 'Remove',
    'checkout-next' => 'Proceed to Checkout',
    'empty' => "Your Cart is Empty.",

    // checkout/index.blade.php
    'checkout' => "Checkout",
    'confirm' => 'Confirm Checkout',
    
    // admin/rentals/index.blade.php
    'rental-log' => "Rental Log",
    'user' => 'User',
    'borrowed-at' => 'Borrowed At',
    'return-by' => 'Return By',
    'actions' => 'Actions',
    'cancel' => 'Cancel',
    'no-logs' => 'No rental logs found.',

    // admin/rentals/edit.blade.php
    'edit-log' => 'Edit Rental Log',

    //dashboard.blade.php
    'no-rental' => 'You have no active rentals.',
];
