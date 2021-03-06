<?php

use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class TakeOrder extends Conversation
{
    /**used for constructor args only*/
    protected $item = NULL;
    /**Array of menu item tuples in assoc. array form. Key is in {NAMESIZE} fmt. */
    protected $menu = array();
    /**store names of items ordered */
    protected $cartItems = array();
    /**order total for all items */
    protected $cartTotal = 0.00;
    /**used to temporarily store current item info since Answers only support primitives */
    protected $itemIndex = "0";
    /**Used in sales tax calc */
    private const TAX_RATE = 0.07254;
    /**Used in order total calc */
    private const MEMBER_DISCOUNT = 0.25;

    public function __construct()
    {
        //constructor overload workaround
        $arguments = func_get_args();
        if (count($arguments) != 0) {
            $this->item = $arguments[0];
        }
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        //THIS WILL EVENTUALLY SUPPLY THE ITEM VALUE TO 
        //ANOTHER FUNCTION THAT HANDLES THE ITEM DETAILS
        if ($this->item != NULL) {
            $this->say("You want a $this->item");
        }
        $this->prompt();
    }

    /**
     * Take an order
     */
    public function prompt()
    {
        $question = Question::create("What can we get started for you?")
            ->fallback('Unable to ask question')
            ->callbackId('order_choice')
            ->addButtons([
                Button::create('Drinks')->value('drink'),
            ]);

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'drink') {
                    //call to get options array
                    $items = get_items('drink');
                    //present drink options as buttons
                    $this->displayItems($items);
                } else {
                    $this->say("not implemented");
                }
            }
        });
    }

    /**Present menu items and handles user selections */
    public function displayItems($items)
    {
        $buttons = array();

        foreach ($items as $index => $item) {
            //item var contains all properties in assoc. array
            //echo var_dump($item);
            $this->menu["$index"] = $item;
            $price = "{$this->money_format($item['price'])}";
            $name = $item['name'];
            $size = "({$item['size']} oz.)";
            $buttons[] = Button::create("$name $size - $price")->value($index);
        }

        $question = Question::create("Please select a drink: ")
            ->fallback('Unable to ask question')
            ->callbackId('item_choice')
            ->addButtons($buttons);

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->addToCart($answer);
                $resp = "{$this->getItemDetails($answer)} added to cart";
                $this->say($resp);
                $this->anythingElsePrompt();
            }
        });
    }

    private function anythingElsePrompt()
    {
        $question = Question::create("Would you like to order anything else?")
            ->fallback('Unable to ask question')
            ->callbackId('additional_order_choice')
            ->addButtons([
                Button::create('Yes')->value('y'),
                Button::create('No')->value('no'),
            ]);

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'y') {
                    $this->prompt();
                } else {
                    $resp = "Your total (with tax) will be {$this->getCartTotal()}";
                    if ($this->isLoggedIn()) {
                        $resp .= "<br><br>*Includes member discount of $" . self::MEMBER_DISCOUNT;
                    }
                    $this->say($resp);
                    submit_order($this->getCartItems(), $this->getCartTotalNoFmt());
                }
            }
        });
    }

    /**Add item to cart (order)
     * $index = the item assoc. array w/all properties
     */
    private function addToCart($index)
    {
        $this->cartItems[] = $this->menu["$index"]['name'];
        $this->addToCartTotal($this->menu["$index"]['price']);
    }

    /**Adds item cost to order
     * $val = The float value in either numeric or string form
     */
    private function addToCartTotal($val)
    {
        $this->cartTotal += floatVal($val);
    }

    /**returns tax amount of ~0.7% */
    private function getTaxAmt($total)
    {
        return $total * (self::TAX_RATE);
    }

    /**returns cart total in $XX.XX format */
    private function getCartTotal()
    {
        return $this->money_format(($this->cartTotal + $this->getTaxAmt($this->cartTotal) - $this->getDiscount()));
    }

    /**returns cart total without a dollar sign */
    private function getCartTotalNoFmt()
    {
        return (number_format($this->cartTotal + $this->getTaxAmt($this->cartTotal), 2) - $this->getDiscount());
    }

    /**Return positive dollar value discount for logged in users */
    private function getDiscount()
    {
        if ($this->isLoggedIn()) {
            return self::MEMBER_DISCOUNT;
        } else {
            return 0;
        }
    }

    /**Return T/F is user logged in or not */
    private function isLoggedIn()
    {
        return isset($_SESSION['userID']);
    }

    /**retuns a formatted string for a dollar amount given. Ex: $XX.XX */
    private function money_format($val)
    {
        return "\$" . number_format(floatval($val), 2);
    }

    /**Return array of cart item names */
    private function getCartItems()
    {
        return $this->cartItems;
    }

    /**Return string name of menu item + size. Takes an index arg*/
    private function getItemDetails($index)
    {
        $name = $this->menu["$index"]['name'];
        $size = $this->menu["$index"]['size'];
        return "$name ($size oz.)";
    }
}
