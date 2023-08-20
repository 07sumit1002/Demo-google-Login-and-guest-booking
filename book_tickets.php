<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Bookticket";
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $num_tickets = $_POST['num_tickets'];
    $total_price = $num_tickets * 50;
    
    $ticketCountSql = "SELECT SUM(num_tickets) AS total_tickets FROM bookings";
    $ticketCountResult = $conn->query($ticketCountSql);
    $ticketCountRow = $ticketCountResult->fetch_assoc();
    $totalTickets = $ticketCountRow['total_tickets'];
    $presentTICKET =$totalTickets + $num_tickets;
    if( $presentTICKET <100 ){
    
        
        
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "INSERT INTO bookings (nme, email, num_tickets, total_price) VALUES ('$name', '$email', $num_tickets, $total_price)";
        
        if ($conn->query($sql) === TRUE) {
            echo "Booking successful! Total price: $" . number_format($total_price, 2);
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    else{
        echo "Maximum Limit reached";
    }
    
    $conn->close();
}
?>
