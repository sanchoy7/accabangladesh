<?php
class Forge extends Forge_Core
{
	public function load_values($data) //you could call it populate_form as well
	{
		foreach($data as $field=>$value)
		{
			if(array_key_exists($field,$this->inputs))
			{
				$this->$field->set_value($value);
 
			}
		}
	}
}
?>