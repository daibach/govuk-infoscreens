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

  function fix_usernames($username) {
    switch($username) {
      case 'AbbyRudland':         return 'Abby Rudland';        break;
      case 'AlanMaddrell':        return 'Alan Maddrell';       break;
      case 'AleksMaricic':        return 'Aleks Maricic';       break;
      case 'AnnaTurner':          return 'Anna Turner';         break;
      case 'BeckThompson':        return 'Beck Thompson';       break;
      case 'DafyddVaughan':       return "Dafydd Vaughan";      break;
      case 'DarrylDeaton':        return 'Darryl Deaton';       break;
      case 'DavidBillany':        return 'David Billany';       break;
      case 'DavidThompson':       return 'David Thompson';      break;
      case 'DeborahStevenson':    return 'Deborah Stevenson';   break;
      case 'DonnaForsyth':        return 'Donna Forsyth';       break;
      case 'GrahamSpicer':        return 'Graham Spicer';       break;
      case 'IanStrafford':        return 'Ian Strafford';       break;
      case 'IllyWoolfson':        return 'Illy Woolfson';       break;
      case 'HowardGossington':    return 'Howard Gossington';   break;
      case 'JonAshton':           return 'Jon Ashton';          break;
      case 'JonathanTindale':     return 'Jonathan Tindale';    break;
      case 'JonSanger':           return 'Jon Sanger';          break;
      case 'JulianMilne':         return 'Julian Milne';        break;
      case 'LisaScott':           return 'Lisa Scott';          break;
      case 'MattJarvis':          return 'Matt Jarvis';         break;
      case 'NickDenton':          return 'Nick Denton';         break;
      case 'PadmaGillen':         return 'Padma Gillen';        break;
      case 'PaulBattley':         return 'Paul Battley';        break;
      case 'SarahRichards':       return 'Sarah Richards';      break;
      case 'SarahWalsh':          return 'Sarah Walsh';         break;
      case 'SheenaghReynolds':    return 'Sheenagh Reynolds';   break;
      case 'SimonKaplan':         return 'Simon Kaplan';        break;
      case 'StephenRehill':       return 'Stephen Rehill';      break;
      case 'SusanWilson':         return 'Susan Wilson';        break;
      case 'TomFreestone':        return 'Tom Freestone';       break;

      default: return $username;
    }
  }
}
?>