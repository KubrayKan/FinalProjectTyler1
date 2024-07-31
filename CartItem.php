<?php
class CartItem{
    public $id;
    public $quantity;

    function __construct($id, $quantity) {
        $this->id = $id;
        $this->quantity = $quantity;
    }
    
    function set_id($id) {
        $this->id = $id;
    }
    
    function get_id() {
        return $this->id;
    }
    
    function increase_quantity() {
        ++$this->quantity;
    }
    
    function decrease_quantity() {
        --$this->quantity;
    }

    public function display(){
        echo $this->id." and the quantity is ".$this->quantity;
    }

    function equals($otherItem){
        return $otherItem->get_id() == $this->id;
    }
}

?>