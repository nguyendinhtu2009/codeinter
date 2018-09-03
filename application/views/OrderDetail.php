<?php
echo base_url();
	echo count($data);
		for($i=0;$i<count($data);$i++){
			foreach ($data[$i] as $key => $value) {
				echo $key.':'.$value.'<br />';
			}
		}