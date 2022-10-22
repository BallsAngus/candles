<?php 

function component($productname, $productprice, $productimg, $productid) {
    $element="
    
    <div class=\"col-md-3 col-sm-6 my-3 my-md-0 py-1\">
        <form action=\"index.php\" method=\"post\">
            <div class=\"card shadow\">
                <div>
                    <img src=\"$productimg\" class=\"img-fluid card-img-top\">
                </div>
                <div class=\"card-body\">
                    <h5 class=\"card-title\">$productname</h5>
                    <p class=\"card-text\">Classic Candle</p>
                    <h5 class=\"price\">\$$productprice</h5>
                    <button type=\"submit\" class=\"btn btn-dark my-3\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button>
                    <input type='hidden' name='product_id' value='$productid'>
                </div>
            </div>
        </form>
    </div>

    ";

    echo $element;
}

// ids are not zero indexed
function cartElement($productimg, $productname, $productprice, $productid, $button_id){
    $element = "
    <form action=\"cart.php\" id=\"update_add\" method=\"post\" class=\"py-2\"></form>
    <form action=\"cart.php\" id=\"update_sub\" method=\"post\" class=\"py-2\"></form>
    <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=$productimg alt=\"Image1\" class=\"img-fluid\">
                            </div>
                            <div class=\"col-md-6\">
                                <h5 class=\"pt-2\">$productname</h5>
                                <hr my-2>
                                <h5 class=\"pt-2\" id=\"price$button_id\">$$productprice</h5>
                                <button type=\"submit\" class=\"btn btn-dark\">Save for Later</button>
                                <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                            </div>
                            <div class=\"col-md-3 py-5 my-5\">
                                <div>
                                    <button type=\"button\" class=\"btn bg-light border rounded-circle subtract\" id=\"sub$button_id\"><i class=\"fas fa-minus\" form=\"update_sub\"></i></button>
                                    <input type=\"text\" value=\"1\" class=\"form-control w-25 d-inline amt\" id=\"amt$button_id\" name=\"amt$button_id\" form=\"checkout\">
                                    <button type=\"button\" class=\"btn bg-light border rounded-circle add\" id=\"add$button_id\"><i class=\"fas fa-plus\" form=\"update_add\"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
    
    ";
    echo $element;
}

function order_component($productname, $productprice, $productimg, $order_id, $amount) {
    $element = "
    
    <form action=\"track_orders.php?action=cancel&id=$order_id\" method=\"post\" class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=$productimg alt=\"Image1\" class=\"img-fluid\">
                            </div>
                            <div class=\"col-md-6\">
                                <h5 class=\"pt-2\">$productname</h5>
                                <hr my-2>
                                <h5 class=\"pt-2\">$$productprice</h5>
                                <button type=\"submit\" class=\"btn btn-danger\" name=\"cancel\">Cancel</button>
                            </div>
                            <div class=\"col-md-3 py-5 my-5\">
                                <div>
                                    <p>Amount: $amount</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
    
    ";
    echo $element;
}