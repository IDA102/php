<?php
$sock_gen = fsockopen ("192.168.0.113", 5025);
        $out1 = ":OUTP1 ON\n";
        $out2 = ":OUTP2 ON\n";
        fwrite($sock,$out1); fwrite($sock,$out2);
/////////////НАСТРОЙКА ПЕРВОГО КАНАЛА///////////////////////////
        $freq_gen=":FREQ1 10 MHZ\n";
        $volt_unit_gen=":VOLT1:UNIT DBM\n";
        $volt_gen=":VOLT1 -28\n";
        fwrite($sock,$freq_gen); fwrite($sock,$volt_unit_gen); fwrite($sock,$volt_gen);

        $sweep_start=":SWE1:STATE ON\n";
        $sweep_freq_start=":FREQ1:START 10 MHZ\n";
        $sweep_freq_stop=":FREQ1:STOP 20 MHZ\n";
        $sweep_time=":SWE1:TIME 0.5\n";
    fwrite($sock,$sweep_freq_start); fwrite($sock,$sweep_freq_stop); fwrite($sock,$sweep_time); fwrite($sock,$sweep_start);
 //////////////////НАСТРОЙКА ВТОРОГО КАНАЛА///////////////////////////////////////
         $freq_gen2=":FREQ2 30 MHZ\n";
        $volt_unit_gen2=":VOLT2:UNIT DBM\n";
        $volt_gen2=":VOLT2 -28\n";
        fwrite($sock,$freq_gen2); fwrite($sock,$volt_unit_gen2); fwrite($sock,$volt_gen2);

        $sweep_start2=":SWE2:STATE ON\n";
        $sweep_freq_start2=":FREQ2:START 30 MHZ\n";
        $sweep_freq_stop2=":FREQ2:STOP 60 MHZ\n";
        $sweep_time2=":SWE2:TIME 0.5\n";
    fwrite($sock,$sweep_freq_start2); fwrite($sock,$sweep_freq_stop2); fwrite($sock,$sweep_time2); fwrite($sock,$sweep_start2);
        fclose($sock);
?>