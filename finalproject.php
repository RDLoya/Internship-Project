<?php
echo '<table border="1">';
$start_row = 0;
$min_length = PHP_INT_MAX;
$max_length = PHP_INT_MIN;
$total_length = 0;

if(($csv_file = fopen("cognifrontstrengths.csv", "r")) !== FALSE) {
    while (($line = fgetcsv($csv_file, 1000, ",")) !== FALSE) {
        $column_count = count($line);
        $start_row++;
        for ($c=0; $c < $column_count; $c++) {
        
            echo '<tr>';
            echo "<td>".$line[0]."<br/></td>";
            echo "<td>".$line[1]."<br/></td>";
            echo "<td>".$line[2]."<br/></td>";
            $length = strlen($line[2]);
            // Assign score based on length range
            if ($length <= 100) {
                $score = 1;
            } elseif ($length <= 200) {
                $score = 2;
            } elseif ($length <= 300) {
                $score = 3;
            } elseif ($length <= 400) {
                $score = 4;
            } elseif ($length <= 500) {
                $score = 5;
            } elseif ($length <= 600) {
                $score = 6;
            } elseif ($length <= 700) {
                $score = 7;
            } elseif ($length <= 800) {
                $score = 8;
            } elseif ($length <= 999) {
                $score = 9;
            } else {
                $score = 10;
            }
            echo "<td>[length]: ".$length."<br/></td>";
            echo "<td>[score]: ".$score."<br/></td>";
            echo '</tr>';

            $current_length = strlen($line[2]);
            if($current_length != 20){
                $total_length += $current_length;
                if ($current_length < $min_length) {
                    $min_length = $current_length;
                }
                if ($current_length > $max_length) {
                    $max_length = $current_length;
                }
            }
            break;
        }
    }

    fclose($csv_file);

    echo '</table>';

    $num_rows = $start_row - 1;
    $average_length = $total_length / $num_rows;
    echo "Minimum length: " . $min_length . "<br>";
    echo "Maximum length: " . $max_length . "<br>";
    echo "Average length: " . $average_length . "<br>";
}
?>