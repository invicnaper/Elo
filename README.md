Elo
===

Using Elo rating , this script will allows you to calculate a percent of many items that will be  chosen

What is it ?
===
Elo will take an array that contains many values of rating , and then calculate a percent for all items .

Ex : 
we have 2 elements with same rating 100 and 100 , than the probability to be chosen is 50% for the two elements .
and if the item was chosen he will get : Ea = 1/1+10*(Rb-Ra)/400
Rb = 100 and Ra = 100
and the second item : Eb = 1/1+10*(Ra-Rb)/400
the array can contains unlimited values :) .

How to use ?
===
first declare your array :

    $my_array = array('100',100','100');
    $elo = new elo($my_array);
  
than to calculate the probability , we will use the third methode and the <b>elo::calculate_percent</b> function

    echo 'Probability to be chosen is : ' . elo::calculate_percent(0,3) .'%'; /* 0 means that the function will return the result of the first element */
    echo '<p>if you chose it , the item will get '. elo::calculate_percent(0,1) .'</p>';
    
this will output
    Probability to be chosen is : 33%
    if you chose it , the item will get 24
    
Information
===
The class is probably not complete so you should add some stuff , for example your logic to calculate the rating and updating it
