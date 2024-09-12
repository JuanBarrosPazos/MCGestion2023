<?php

    $sqli = "SELECT * FROM $vnamei WHERE `factdate` $sent ";
    //echo $sqli."<br>";
    $sqlg = "SELECT * FROM $vnameg WHERE `factdate` $sent ";
    //echo $sqlg."<br>";
  
    /* INGRESOS SUMAR PVPTOT */
    $OperSqlToti = "SUM(`factpvptot`)";
    $sqlSumToti = "SELECT $OperSqlToti AS 'YearSumToti' FROM $vnamei WHERE `factdate` $sent ";
    /* INGRESOS SUMAR RETENCION TOT */
    $OperSqlRetei = "SUM(`factrete`)";
    $sqlSumRetei = "SELECT $OperSqlRetei AS 'YearSumRetei' FROM $vnamei WHERE `factdate` $sent ";
    /* INGRESOS SUMAR IVA */	
    $OperSqlIvai = "SUM(`factivae`)";
    $sqlSumIvai = "SELECT $OperSqlIvai AS 'YearSumIvai' FROM $vnamei WHERE `factdate` $sent ";
    /* GASTOS SUMAR PVPTOT  */
    $OperSqlTotg = "SUM(`factpvptot`)";
    $sqlSumTotg = "SELECT $OperSqlTotg AS 'YearSumTotg' FROM $vnameg WHERE `factdate` $sent ";
    /* GASTOS SUMAR RETENCION TOT */
    $OperSqlReteg = "SUM(`factrete`)";
    $sqlSumReteg = "SELECT $OperSqlReteg AS 'YearSumReteg' FROM $vnameg WHERE `factdate` $sent ";
    /* GASTOS SUMAR IVA */
    $OperSqlIvag = "SUM(`factivae`)";
    $sqlSumIvag = "SELECT $OperSqlIvag AS 'YearSumIvag' FROM $vnameg WHERE `factdate` $sent ";


?>