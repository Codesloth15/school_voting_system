<?php
require('./fpdf182/fpdf.php');
ini_set('memory_limit', '1G');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Example: Replace this with your actual database query results
    $winners = [
        ['name' => 'John Doe', 'position' => 'President'],
        ['name' => 'Jane Smith', 'position' => 'Vice President'],
        ['name' => 'Alex Reyes', 'position' => 'Secretary'],
        ['name' => 'Maria Lopez', 'position' => 'Treasurer'],
    ];

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();

    // Title
    $pdf->SetFont('Arial', 'B', 24);
    $pdf->SetTextColor(0, 102, 204);
    $pdf->Cell(0, 20, 'Official List of Election Winners', 0, 1, 'C');

    $pdf->Ln(10);

    // Table header
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetFillColor(220, 220, 220);
    $pdf->Cell(100, 10, 'Name', 1, 0, 'C', true);
    $pdf->Cell(100, 10, 'Position', 1, 1, 'C', true);

    // Table rows
    $pdf->SetFont('Arial', '', 14);
    foreach ($winners as $winner) {
        $pdf->Cell(100, 10, $winner['name'], 1);
        $pdf->Cell(100, 10, $winner['position'], 1);
        $pdf->Ln();
    }

    // Footer
    $pdf->Ln(20);
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(0, 10, 'Generated on ' . date('F d, Y'), 0, 0, 'R');

    // Output PDF for download
    $pdf->Output('D', 'election_winners.pdf');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Generate Election Winner List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            text-align: center;
            padding-top: 80px;
        }
        form {
            display: inline-block;
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
        button {
            padding: 12px 25px;
            background-color: #28a745;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #1e7e34;
        }
    </style>
</head>
<body>
    <form method="post">
        <h2>Generate PDF of Election Winners</h2>
        <button type="submit">Download PDF</button>
    </form>
</body>
</html>
