<?php

	$taskList =  [
      "J1" => "",
      "J2" => "J3",
      "J3" => "J4",
      "J4" => "J5",
      "J5" => "",
      "J6" => "",
      "J7" => "J8",
      "J8" => "J9",
      "J9" => "J10",
      "J10" => "",
      "J11" => ""
    ];

    $expected = [
		"CH1" => array("J1","J6","J11"),
		"CH2" => array("J2","J3","J4","J5"),
		"CH3" => array("J7","J8","J9","J10"),
	];

	$output = TaskScheduler($taskList);	
	print_r($output);
	print_r($expected);

	if($output === $expected) {
		echo "\n\nThe problem is solved!!!\n\n";
	}


	function TaskScheduler($taskList)
	{	
		$expected_2 = Array();
		$channelNumPart = 1;
		
		while(sizeof($taskList) > 0) {
			reset($taskList);
			$task = key($taskList);
			$taskFollow = $taskList[$task];

			if($taskFollow === "") {
				$expected_2["CH1"][] = $task;
				array_shift($taskList);
			}
			else {
				$channelIndex = "CH" . ++$channelNumPart;
				$expected_2[$channelIndex] = currelatedTasks($taskList, $task);
			}	
		}
		
		return $expected_2;
	}
	function currelatedTasks(&$taskList, $job) {
	
		$currelated = Array();

		while($taskList[$job] != ""){
			$currelated[] = $job;
			$job = $taskList[$job];
			array_shift($taskList);
		}
		
		$currelated[] = $job;
		array_shift($taskList);

		return $currelated;
	}	
	

	


//hack the planet


