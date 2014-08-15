<?php
    include_once('/fpdf.php');
    include_once('/PDF/fpdi.php');

    $templatePath = "template/";
    $font = 'Times';

    $firstName = empty($_REQUEST['firstName']) ? "" : $_REQUEST['firstName'];
    $lastName = empty($_REQUEST['lastName']) ? "" : $_REQUEST['lastName'];
    $state = empty($_REQUEST['state']) ? "" : $_REQUEST['state'];

    if(empty($state)){
        echo "Not Find State";
        exit;
    }

    $teacherName = $firstName." ".$lastName;
    $pdf = new FPDI();
    $pagecount = $pdf->setSourceFile($templatePath.'2014_'.$state.'.pdf');
    $tplidx = $pdf->importPage(1);
    $pdf->addPage('L', 'Letter');
    $pdf->useTemplate($tplidx, 0, 0, 0);

    if($state == "MD"){
        $pdf->SetFont($font,'BI',25);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetY(100);
        $pdf->Cell(0, 0, $teacherName, 0, 0, 'C');
    } elseif($state == "OH") {
        $pdf->SetFont($font,'',25);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetY(55);
        $pdf->Cell(0, 0, $teacherName, 0, 0, 'C');
    }

    $pdf->Output('Certificate.pdf', 'D');
    die();