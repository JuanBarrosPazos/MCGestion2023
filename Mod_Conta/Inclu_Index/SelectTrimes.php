<?php

    
    $sqli = "SELECT * FROM $vnamei WHERE (`factdate` BETWEEN '$betwIni' AND '$betwFini') ORDER BY $orden";
    //echo $sqli."<br>";
    $sqlg = "SELECT * FROM $vnameg WHERE (`factdate` BETWEEN '$betwIng' AND '$betwFing') ORDER BY $orden ";
    //echo $sqlg."<br>";
    $sent = "(`factdate` BETWEEN '$betwIni' AND '$betwFini') ORDER BY $orden ";

    /* INGRESOS SUMAR PVPTOT */
    $OperSqlToti = "SUM(`factpvptot`)";
    $sqlSumToti = "SELECT $OperSqlToti AS 'YearSumToti' FROM $vnamei WHERE $sent ";
    /* INGRESOS SUMAR RETENCION TOT */
    $OperSqlRetei = "SUM(`factrete`)";
    $sqlSumRetei = "SELECT $OperSqlRetei AS 'YearSumRetei' FROM $vnamei WHERE $sent ";
    /* INGRESOS SUMAR IVA */	
    $OperSqlIvai = "SUM(`factivae`)";
    $sqlSumIvai = "SELECT $OperSqlIvai AS 'YearSumIvai' FROM $vnamei WHERE $sent ";
    /* GASTOS SUMAR PVPTOT  */
    $OperSqlTotg = "SUM(`factpvptot`)";
    $sqlSumTotg = "SELECT $OperSqlTotg AS 'YearSumTotg' FROM $vnameg WHERE $sent ";
    /* GASTOS SUMAR RETENCION TOT */
    $OperSqlReteg = "SUM(`factrete`)";
    $sqlSumReteg = "SELECT $OperSqlReteg AS 'YearSumReteg' FROM $vnameg WHERE $sent ";
    /* GASTOS SUMAR IVA */
    $OperSqlIvag = "SUM(`factivae`)";
    $sqlSumIvag = "SELECT $OperSqlIvag AS 'YearSumIvag' FROM $vnameg WHERE $sent ";

?>