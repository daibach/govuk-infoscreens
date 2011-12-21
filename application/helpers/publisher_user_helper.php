<?
if ( ! function_exists('gravatar_hash')) {
	function gravatar_hash($username)
	{
  	switch($username) {
  		case 'Sarah Richards': return "f1e7b753b18546a66b455861c6798b10"; break;
  		case 'Lisa Scott': return "f43a9b0e26fe4b133ea152dc36293562"; break;
  		case 'Simon Kaplan': return "008364c628b5df3ab16d14cec50e99ae"; break;
  		case 'Graham Spicer': return "ddf2e80bd5fc32be841441e92b5ec77d"; break;
  		case 'Julian Milne': return "cb50980366964966c1c03d0a30c2c155"; break;
  		case 'Alan Maddrell': return "fa0afd560e18f96e7b605fb538315cc0"; break;
  		default: return "";
  	}
  	return "";
	}
}
?>