<?php
# Løsning fra Bullhill
$hjul = array(
				array('PLUSS101', 'OPP7', 'MINUS9', 'PLUSS101'),
				array('TREKK1FRAODDE', 'MINUS1', 'MINUS9', 'PLUSS1TILPAR'),
				array('PLUSS1TILPAR', 'PLUSS4', 'PLUSS101', 'MINUS9'),
				array('MINUS9', 'PLUSS101', 'TREKK1FRAODDE', 'MINUS1'),
				array('ROTERODDE', 'MINUS1', 'PLUSS4', 'ROTERALLE'),
				array('GANGEMSD', 'PLUSS4', 'MINUS9', 'STOPP'),
				array('MINUS1', 'PLUSS4', 'MINUS9', 'PLUSS101'),
				array('PLUSS1TILPAR', 'MINUS9', 'TREKK1FRAODDE', 'DELEMSD'),
				array('PLUSS101', 'REVERSERSIFFER', 'MINUS1', 'ROTERPAR'),
				array('PLUSS4', 'GANGEMSD', 'REVERSERSIFFER', 'MINUS9')
		);

$hjulpos = array(0,0,0,0,0,0,0,0,0,0);

$penger = $argv[1];

while(true)
//for($i = 0; $i < 20; $i++)
{
	$nums = str_split($penger);
	$hjulno = $nums[count($nums)-1];
	$hjulposid = $hjulpos[$nums[count($nums)-1]];
	$hjulpos[$nums[count($nums)-1]] = ($hjulpos[$nums[count($nums)-1]] + 1) % 4; 
	//echo $hjulno . "-" . $hjulposid . "\n";
	//echo $hjul[$hjulno][$hjulposid] . " - " . $penger . "\n";
	
	$command = $hjul[$hjulno][$hjulposid];
	
	call_user_func($command, $penger);
	//echo "Penger: " . $penger . "\n";
	//print_r($hjulpos);
	
}
print_r($hjulpos);



function PLUSS4($num)
{
	global $penger;
	$penger = $num+4;
}

function PLUSS101($num)
{
	global $penger;
	$penger = $num+101;
}

function MINUS9($num)
{
	global $penger;
	$penger = $num-9;
}

function MINUS1($num)
{
	global $penger;
	$penger = ($penger-1);
}

function REVERSERSIFFER($num)
{
	global $penger;
	$str = str_split($num);
	krsort($str);
	$penger = implode($str);
}

function OPP7($num)
{
	global $penger;
	$last = 0;
	for($i = $num; $last != 7; $i++)
	{
		$nums = str_split($i);		
		$last = $nums[count($nums)-1];
	}
	$penger = $i-1;
}

function GANGEMSD($num)
{
	global $penger;
	$nums = str_split($num);
	if($num > 0 )
		$penger = $num * $nums[0];
	else
		$penger = $num * $nums[1];
		
}

function DELEMSD($num)
{
	global $penger;
	$nums = str_split($num);
	if($num > 0 )
		$penger = floor($num / $nums[0]);
	else
		$penger = floor($num / $nums[1]);
		
}

function PLUSS1TILPAR($num)
{
	global $penger;
	$nums = str_split($num);
	foreach($nums as $key => $i)
	{
		if($i == "-")
		{
			
		}
		elseif($i % 2 == 0)
		{
			$nums[$key] = $i+1;
		}
	}
	$penger = implode($nums)+0;
}

function TREKK1FRAODDE($num)
{
	global $penger;
	$nums = str_split($num);
	foreach($nums as $key => $i)
	{
		if($i == "-")
		{
			
		}
		elseif($i % 2 == 1)
		{
			$nums[$key] = $i-1;
		}
	}
	$penger = implode($nums)+0;
}

function ROTERPAR($num)
{
	global $penger;
	global $hjulpos;
	$hjulpos[0] = ($hjulpos[0]+1) % 4;
	$hjulpos[2] = ($hjulpos[2]+1) % 4;
	$hjulpos[4] = ($hjulpos[4]+1) % 4;
	$hjulpos[6] = ($hjulpos[6]+1) % 4;
	$hjulpos[8] = ($hjulpos[8]+1) % 4;
	$penger = $num;
}

function ROTERODDE($num)
{
	global $penger;
	global $hjulpos;
	$hjulpos[1] = ($hjulpos[1]+1) % 4;
	$hjulpos[3] = ($hjulpos[3]+1) % 4;
	$hjulpos[5] = ($hjulpos[5]+1) % 4;
	$hjulpos[7] = ($hjulpos[7]+1) % 4;
	$hjulpos[9] = ($hjulpos[9]+1) % 4;
	$penger = $num;
}

function ROTERALLE($num)
{
	global $penger;
	global $hjulpos;
	$hjulpos[1] = ($hjulpos[1]+1) % 4;
	$hjulpos[3] = ($hjulpos[3]+1) % 4;
	$hjulpos[5] = ($hjulpos[5]+1) % 4;
	$hjulpos[7] = ($hjulpos[7]+1) % 4;
	$hjulpos[9] = ($hjulpos[9]+1) % 4;
	$hjulpos[0] = ($hjulpos[0]+1) % 4;
	$hjulpos[2] = ($hjulpos[2]+1) % 4;
	$hjulpos[4] = ($hjulpos[4]+1) % 4;
	$hjulpos[6] = ($hjulpos[6]+1) % 4;
	$hjulpos[8] = ($hjulpos[8]+1) % 4;
	$penger = $num;
}

function STOPP($num)
{
	global $penger;
	echo $num . "\n";
	die;
}





?>