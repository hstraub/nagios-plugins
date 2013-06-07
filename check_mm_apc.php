<?php
# check_mm_apc
# Copyright (C) 2007 Herbert Straub herbert@linuxhacker.at
# License: GNU/GPL Version 3
# For details see: http://www.gnu.org/licenses/gpl.html

# 2007-11-18 Herbert Straub <herbert@linuxhacker.at>

$CCHARGE='ff0000';
$CLOAD='00ff00';
$CLINEV='0000bb';
$CBATTV='00ffff';
$CTIMELEFT='ffff00';
$CLINEF='aaaa00';
$CLINE='332244';
$ZOOM='1';

$opt[1] = "--vertical-label \"% or Min\" --title \"APC Charge(load, timeleft) $hostname / $servicedesc\" ";
$opt[2] = "--vertical-label \"% or Min\" --title \"APC Load (timeleft) $hostname / $servicedesc\" ";
$opt[3] = "--vertical-label \"Volt\" --title \"APC Line Voltage $hostname / $servicedesc\" ";
$opt[4] = "--vertical-label \"Volt\" --title \"APC Battery Voltage $hostname / $servicedesc\" ";
$opt[5] = "--vertical-label \"Minutes\" --title \"APC Timeleft $hostname / $servicedesc\" ";
$opt[6] = "--vertical-label \"Hz\" --title \"APC Line frequency $hostname / $servicedesc\" ";

$def[1] = "DEF:charge=$rrdfile:$DS[1]:AVERAGE ";
$def[1] .= "DEF:load=$rrdfile:$DS[2]:AVERAGE ";
$def[1] .= "CDEF:zload=load,$ZOOM,* ";
$def[1] .= "DEF:linev=$rrdfile:$DS[3]:AVERAGE ";
$def[1] .= "DEF:battv=$rrdfile:$DS[4]:AVERAGE ";
$def[1] .= "DEF:timeleft=$rrdfile:$DS[5]:AVERAGE ";
$def[1] .= "CDEF:ztimeleft=timeleft,$ZOOM,* ";
$def[1] .= "DEF:linef=$rrdfile:$DS[6]:AVERAGE ";

$def[2] .= "DEF:charge=$rrdfile:$DS[1]:AVERAGE ";
$def[2] .= "DEF:load=$rrdfile:$DS[2]:AVERAGE ";
$def[2] .= "DEF:linev=$rrdfile:$DS[3]:AVERAGE ";
$def[2] .= "DEF:battv=$rrdfile:$DS[4]:AVERAGE ";
$def[2] .= "DEF:timeleft=$rrdfile:$DS[5]:AVERAGE ";
$def[2] .= "DEF:linef=$rrdfile:$DS[6]:AVERAGE ";

$def[3] .= "DEF:linev=$rrdfile:$DS[3]:AVERAGE ";
$def[4] .= "DEF:battv=$rrdfile:$DS[4]:AVERAGE ";
$def[5] .= "DEF:timeleft=$rrdfile:$DS[5]:AVERAGE ";
$def[6] .= "DEF:linef=$rrdfile:$DS[6]:AVERAGE ";



# Data Source Charge
$def[1] .= "LINE1:charge#$CCHARGE:\"Charge\" ";
$def[1] .= "LINE1:zload#$CLOAD:\"Load (Zoom x$ZOOM)\" ";
$def[1] .= "LINE1:ztimeleft#$CTIMELEFT:\"Time left(Zoom x$ZOOM)\\n\" ";

$def[1] .= "GPRINT:charge:AVERAGE:\"Charge\: Avg\: %3.2lf %% \" ";
$def[1] .= "GPRINT:charge:MAX:\"Max\: %3.2lf %% \" ";
$def[1] .= "GPRINT:charge:LAST:\"Last\: %3.2lf %%\\n\" ";

$def[1] .= "GPRINT:load:AVERAGE:\"Load\: Avg\: %3.2lf %% \" ";
$def[1] .= "GPRINT:load:MAX:\"Max\: %3.2lf %% \" ";
$def[1] .= "GPRINT:load:LAST:\"Last\: %3.2lf %%\\n\" ";

$def[1] .= "GPRINT:timeleft:AVERAGE:\"Timeleft\: Avg\: %3.2lf M \" ";
$def[1] .= "GPRINT:timeleft:MAX:\"Max\: %3.2lf M \" ";
$def[1] .= "GPRINT:timeleft:LAST:\"Last\: %3.2lf M\\n\" ";

# Data Source Load
$def[2] .= "AREA:timeleft#$CTIMELEFT:\"Time left\" ";
$def[2] .= "AREA:load#$CLOAD:\"Load\\n\" ";
$def[2] .= "LINE1:load#$CLINE:\"\" ";

$def[2] .= "GPRINT:load:AVERAGE:\"Load\: Avg\: %3.2lf %% \" ";
$def[2] .= "GPRINT:load:MAX:\"Max\: %3.2lf %% \" ";
$def[2] .= "GPRINT:load:LAST:\"Last\: %3.2lf %%\\n\" ";

$def[2] .= "GPRINT:timeleft:AVERAGE:\"Timeleft\: Avg\: %3.2lf M \" ";
$def[2] .= "GPRINT:timeleft:MAX:\"Max\: %3.2lf M \" ";
$def[2] .= "GPRINT:timeleft:LAST:\"Last\: %3.2lf M\\n\" ";




$def[3] .= "AREA:linev#$CLINEV:\"Line Volt\" ";
$def[3] .= "LINE1:linev#$CLINE:\"\" ";
$def[4] .= "COMMENT:\"\\n\" ";
$def[3] .= "GPRINT:linev:AVERAGE:\"nLine V\: Avg\: %3.2lf V \" ";
$def[3] .= "GPRINT:linev:MAX:\"Max\: %3.2lf V \" ";
$def[3] .= "GPRINT:linev:LAST:\"Last\: %3.2lf V\" ";

$def[4] .= "AREA:battv#$CBATTV:\"Batt Volt\" ";
$def[4] .= "LINE1:battv#$CLINE:\"\" ";
$def[4] .= "COMMENT:\"\\n\" ";
$def[4] .= "GPRINT:battv:AVERAGE:\"Batt V\: Avg\: %3.2lf V \" ";
$def[4] .= "GPRINT:battv:MAX:\"Max\: %3.2lf V \" ";
$def[4] .= "GPRINT:battv:LAST:\"Last\: %3.2lf V\" ";

$def[5] .= "AREA:timeleft#$CTIMELEFT:\"Time left\" ";
$def[5] .= "LINE1:timeleft#$CLINE:\"\" ";
$def[5] .= "COMMENT:\"\\n\" ";
$def[5] .= "GPRINT:timeleft:AVERAGE:\"Timeleft\: Avg\: %3.2lf M \" ";
$def[5] .= "GPRINT:timeleft:MAX:\"Max\: %3.2lf M \" ";
$def[5] .= "GPRINT:timeleft:LAST:\"Last\: %3.2lf M\" ";

$def[6] .= "LINE1:linef#$CLINEF:\"Line freqeuncy\" ";

?>
