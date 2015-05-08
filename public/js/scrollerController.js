// JavaScript Document
////////////////////////

function speedController(getSpeed)
{
	var scrollerCurrentSpeed;
	scrollerCurrentSpeed = document.getElementById("scrollerSpeed").scrollDelay;
	
	if(eval(getSpeed) == -1)
	{
		if(eval(scrollerCurrentSpeed) < 60)
			{document.getElementById("scrollerSpeed").scrollDelay = eval((eval(scrollerCurrentSpeed) + 10));}
	}
	else if(eval(getSpeed) == 1)
	{
		if(eval(scrollerCurrentSpeed) > 10)
			{document.getElementById("scrollerSpeed").scrollDelay = eval((eval(scrollerCurrentSpeed) - 10));}
	}
	else
	{document.getElementById("scrollerSpeed").scrollDelay = 40;}
}

//////////////////////

function directionController(directionStatus)
{
	if(eval(directionStatus) == 1)
		{document.getElementById("scrollerSpeed").direction = "up";}
	else
		{document.getElementById("scrollerSpeed").direction = "down";}
}
