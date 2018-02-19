<?php

namespace App\Models;

class Cart 
{
    public $total_qty = 0;
    public $total_price = 0;
    public $items = [];
    
    public function add($product) {
        // Increase total qty by 1
        $this->total_qty++;
        // Increase total price for the amount of product's price
        $this->total_price += $product->price;
        
        // If Cart object doesnt have this product
        if (!array_key_exists($product->id, $this->items)) { // Create key from product's id which will hold array of product's info
            // Set this item's quantity to 1
            $this->items[$product->id]['item_qty'] = 1;
            // Set this item's price to be equal to products price
            $this->items[$product->id]['item_price'] = $product->price;
            // Store this product 
            $this->items[$product->id]['item_object'] = $product;
            
        }else{ // Otherwise
            // Increase this item's quantity by 1
            $this->items[$product->id]['item_qty']++;
            // Increase this item's price for the amount of product's price
            $this->items[$product->id]['item_price'] += $product->price;
        }
    }
    
    public function reduce_by_one($product) {
        // Reduce total quantity by one, and total price for the amount of product's price
        $this->total_qty--;
        $this->total_price -= $product->price;
        
        // Reduce this item's quantity by 1
        $this->items[$product->id]['item_qty']--;
        // Reduce this item's price for the amount of product's price
        $this->items[$product->id]['item_price'] -= $product->price;
        
        // If items quantity is 0, remove item
        if ($this->items[$product->id]['item_qty'] === 0) {
            unset($this->items[$product->id]);
        }
    }
    
    public function remove_item($product) {
        $this->total_qty -= $this->items[$product->id]['item_qty'];
        $this->total_price -= $this->items[$product->id]['item_price'];
        unset($this->items[$product->id]);
    }
}
