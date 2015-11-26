#!/usr/bin/perl -w

use strict;
use Device::SerialPort;
use Tie::File qw();

my $port = Device::SerialPort->new("/dev/ttyUSB0");
my $serialIn = "";
my @serialIn;
my $dataOutput;

my @months = qw(Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec);
my @weekDays = qw(Sun Mon Tue Wed Thu Fri Sat Sun);
my ($second, $minute, $hour, $dayOfMonth, $month, $yearOffset, $dayOfWeek, $dayOfYear, $daylightSavings);
my $year;
my $theTime; 

my $serialID = "";
my $serialKind = "";
my $serialLocation = "";
	my $serialNumber = "";
my $serialValue = "";

$port->baudrate(9600);
$port->parity("none");
$port->handshake("none");
$port->databits(8);
$port->stopbits(1);
$port->read_char_time(0);
$port->read_const_time(20);

my $count = 0;
my $t = 1;

my $temp = -1;
my $photo = -1;
my @water = (-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1);

while ($t > 0) {
	#Read and Parse Data From Arduino
	$serialIn = $port->read(255);
	
	#Check that there is something there
	if (length($serialIn //= '')) {

		@serialIn = split /[|]+/, $serialIn;
		foreach(@serialIn) {
			if ($_ ne "!" && $_ ne "!\n" && $_ ne "\n" && $_ ne "") {
				print "$_";
				print " = ";
			
				$_ =~ /([^:]{1})([^:]{1})([^:]{1})([^:]*)([:]*)(.*)/;
					print "ID:" . $1 . ", ";
					print "K:" . $2 . ", ";
					print "L:" . $3 . ", " . $4 . ", ";
					print "N:" . $4 . ", ";
					print "V:" . $6 . ", ";
					print "\n";
					
					$serialID = $1;
					$serialKind = $2;
					$serialLocation = $3 . ", " . $4;
					$serialNumber = $4;
					$serialValue = $6;
					
				if ($serialID eq "#") {
					if ($serialKind eq "T") {$temp = $serialValue;}
					if ($serialKind eq "W") {$water[$serialNumber] = $serialValue;}
					if ($serialKind eq "P") {$photo = $serialValue;}
				}	
			}
		}
	
		#Figure Out Server Time
		($second, $minute, $hour, $dayOfMonth, $month, $yearOffset, $dayOfWeek, $dayOfYear, $daylightSavings) = localtime();
		$year = 1900 + $yearOffset;
		$theTime = "$hour:$minute:$second - $weekDays[$dayOfWeek] $months[$month] $dayOfMonth - $year";
			
		print "\nOUTPUT DATA AT: " . $theTime . "\n\n"; 

		#Output All Info to Data File
		open $dataOutput, ">", "/home/ben/public_html/daena.ca/public/plants/arduinoA.dat";
			print $dataOutput "Time,1," . $theTime . "\n";
			print $dataOutput "Photo,1," . $photo . "\n";
			print $dataOutput "Temp,1," . $temp . "\n";
			print $dataOutput "Water,1," . $water[0] . "\n";
			print $dataOutput "Water,2," . $water[1] . "\n";
			print $dataOutput "Water,3," . $water[2] . "\n";
			print $dataOutput "Water,4," . $water[3] . "\n";
			print $dataOutput "Water,5," . $water[4] . "\n";
			print $dataOutput "Water,6," . $water[5] . "\n";
			print $dataOutput "Water,7," . $water[6] . "\n";
			print $dataOutput "Water,8," . $water[7] . "\n";
			print $dataOutput "Water,9," . $water[8] . "\n";
			print $dataOutput "Water,10," . $water[9] . "\n";
			print $dataOutput "Water,11," . $water[10] . "\n";
			print $dataOutput "Water,12," . $water[11];
		close $dataOutput;
	}
	
	sleep 1;
}