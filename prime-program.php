<!DOCTYPE html>
<html>
    <head>
        <title>Consecutive Prime Sum</title>
    </head>
    <body>
        <form method="post" action="">
            <label>
                Enter the number to find consecutive prime :
            </label><br>
            <input type="text" name="number"><br>
            <button type="submit">Submit</button>
        </form>
        <?php
            if(isset($_POST['number'])){
                if(is_numeric($_POST['number'])){
                    $num = $_POST['number'];
                    $result = 0;
                    $numberOfPrimes = 0;
                    $primes = allPrime(0, $_POST['number']);
                    $primeSum=[];
                    $primeSum = array_fill(0, count($primes) + 1, 0);
                    $primeSum[0] = 0;
                    for ($i = 0; $i < count($primes); $i++){
                        $primeSum[$i + 1] = $primeSum[$i] + $primes[$i];
                    }
                    for ($i = $numberOfPrimes; $i < count($primeSum); $i++){
                        for ($j = $i - ($numberOfPrimes + 1); $j >= 0; $j--){
                            if ($primeSum[$i] - $primeSum[$j] > $num){
                                break;
                            }
                            if(array_search($primeSum[$i] - $primeSum[$j], $primes)){
                                $numberOfPrimes = $i - $j;
                                $result = $primeSum[$i] - $primeSum[$j];
                            }
                        }
                    }
                    echo "Largest primes below ".$num. " written as consequtive primes is ".$result."<br>";
                    echo "It consists of ".$numberOfPrimes." primes";
                }else{
                    echo 'Enter valid number';
                }
            }
            
            function allPrime($start, $finish) {
                $number = 2;
                $range = range(2, $finish);
                $primes = array_combine($range, $range);
                while ($number*$number < $finish) {
                  for ($i = $number; $i <= $finish; $i += $number) {
                    if ($i == $number) {
                      continue;
                    }
                    unset($primes[$i]);
                  }
                  $number = next($primes);
                }
                foreach ($primes as $prime) {
                  if ($prime < $start) {
                    unset($primes[$prime]);
                  } else {
                    break;
                  }
                }
                return array_values($primes);
            }
        ?>
    </body>
</html>