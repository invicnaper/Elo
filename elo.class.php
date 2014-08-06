<?php
/*
      * this class will calculate the percentage of the chance to
      * search an element using the Elo rating system
      * giving all elements a 0 of rating which mean 100 will be divided by number of elements  .
      * and calculating the score .
      * the difference here , is that we have a number of element that are not determined
      * so we will use for the first element :
      * Ea = 1/(1+10.(Rb-Ra)/400)
      * Eb = 1/(1+10.(Ra-Rb)/400)
      * that is just if we had 2 elements , and now we should edit the equation so as to calculate unlimited values
*/

class elo
{
    public static $array;
    public static $glob_result = array();
    public static $k = 2;

    function __construct($array) {
        self::$array = $array;
    }
    public static function calculate_percent($element,$method){
        /*
         * this function will calculate the percentage of the chance to
         * search an element using the Elo rating system
         * giving all elements a 0 of rating which mean 100 will be divided by number of elements  .
         * and calculating the score .
         * the difference here , is that we have a number of element that are not determined
         * so we will use for the first element :
         * Ea = 1/(1+10.(Rb-Ra)/400)
         * Eb = 1/(1+10.(Ra-Rb)/400)
         * that is just if we had 2 elements , and now we should edit the equation so as to calculate unlimited values
         */
        $noe = count(self::$array);
        $first_percent = 100 / $noe; /* chance of every word to be selected */
        $rating = 100; /* test with a fix rating */
        $result = array();$i = 0;
        $all_result = array();
        for($i=0;$i<$noe;$i++){
            if($method == 1)
                array_push($result,self::elo_equation());
            if($method == 2)
                array_push($result,self::second_method());
            if($method == 3)
                array_push($result,self::third_method($i));
        }
        self::$glob_result = $result;
        /*
        if($element == "all"){
            for($i=0;$i<$noe;$i++){
                array_push($all_result, $this->k * ($result[$element]*100));
            }
            return $all_result;
        }
        */
        return intval(($result[$element]*100));
    }
    public static function elo_equation(){
        $noe = count(self::$array);
        $sigma = self::$array[0];$elo = 0;
        for($i=0;$i<$noe;$i++){
            $sigma = $sigma - self::$array[$i];
        }
        $sigma_divided = (-$sigma)/400;
        $elo = 1/(1+pow(10,$sigma_divided));
        return $elo;
    }
    public static function second_method(){
        $noe = count(self::$array);
        $sigma = self::$array[0];$elo = 0;$actual_r = 0;
        for($i=0;$i<$noe;$i++){
            $actual_r = pow(10,self::$arrayrray[$i]/400);
            $sigma = $sigma + $actual_r;
        }
        $elo = (1 + $sigma) - pow(10,self::$array[$i]/400);
        return $elo;
    }
    public static function third_method($element){
        /*
         * Using probability event . Ex: how many people will attend an event .
         * every event has a number of people divided by the sum of all people will give us who will have chance to win
         */
        $noe = count(self::$array); /* number of elements */
        $sigma = 0; /* when sigma = 0 will not reduce the rating of our element later */
        for($i = 0;$i<$noe;$i++){
            $sigma = $sigma + self::$array[$i]; /* sum of all rating */
        }
        $pa = self::$array[$element] / $sigma; /* calculate our PA */
        return $pa;

    }
    public static function check_result(){
        /* if the somme of all elements is 1 than it's correct */
        $noe = count(self::$array);
        $check = 0;
        for($i=0;$i<$noe;$i++){
            $check = $check + self::$glob_result[$i];
        }
        if ($check == 1){
            return "Nothing";
        }
        else{
            $lost = 1-$check;
            return intval($lost * 100) .'%';
        }
    }
    public static function test_two(){
        $sigma_divided = 0/400;
        $elo = 1/(1+pow(10,$sigma_divided));
        return $elo;
    }
    public static function calculate_rating($element){
        /* your logic to calculate rating */
    }
    public static function update_rating($element){
        /* your logic to update rating */
    }
}
$my_array = array('100','100','100');
$elo = new elo($my_array);
echo 'This element got : ' . elo::calculate_percent(1,3) .'% if selected will have ' . elo::calculate_percent(1,1);


?>
