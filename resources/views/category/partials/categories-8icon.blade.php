@for ($i = 1; $i <= 7; $i++)
	<li><a href="{{ isset($topcategories[$i]) ? $topcategories[$i]->id : '#' }}"><img src="assets/images/catagory_icon{{$i}}.png" alt=""><br>{{ isset($topcategories[$i]) ? $topcategories[$i]->name : 'Add More!' }}</a></li>
@endfor
<li><a href="#"><img src="assets/images/catagory_icon8.png" alt=""><br>Other</a></li>
