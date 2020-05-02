<?php
namespace App\Helpers;

class Helpers
{

	public static function czechDate($date, $format = NULL)
	{
		$date = !is_object($date) ? new \DateTime($date) : $date;
		$days = [1 => 'pondělí', 'úterý', 'středa', 'čtvrtek', 'pátek', 'sobota', 'neděle'];
		$days_abbr = [1 => 'po', 'út', 'st', 'čt', 'pá', 'so', 'ne'];
		$months = [1 => 'leden', 'únor', 'březen', 'duben', 'květen', 'červen', 'červenec', 'srpen', 'září', 'říjen', 'listopad', 'prosinec'];
		switch($format) {
			case 'month':
				$czechDate = $months[$date->format('n')] ;
				break;
			case 'monthY':
				$czechDate = $months[$date->format('n')] . ' ' . $date->format('Y');
				break;
			case 'full':
				$czechDate = $days[$date->format('N')] . ' ' . $date->format('j. n.');
				break;
			case 'abbr':
				$czechDate = $days_abbr[$date->format('N')] . ' ' . $date->format('j. n.');
				break;
			case 'abbrY':
				$czechDate = $days_abbr[$date->format('N')] . ' ' . $date->format('j. n. Y');
				break;
			default:
				$czechDate = $date->format('j. n.');
		}
		return $czechDate;
	}

	public static function currency($amount, $abbr = NULL)
	{
		if ($amount > 0) {
			return $amount . ($abbr ? ' '.$abbr : ' Kč');
		} else {
			return '';
		}
		
	}

	public static function type($type)
	{
		switch($type) {
			case 'instert':
				$return = 'vloženo';
				break;
			case 'update':
				$return = 'upraveno';
				break;
			case 'delete':
				$return = 'smazáno';
				break;
			default:
				$return = 'vloženo';
				break;
		}
		return $return;
	}

    public static function extraordinary($datetime)
    {
        $o = new \DateTime($datetime);
        $u = strtotime($datetime);
        $yesterday = $o->add(new \DateInterval('P1D'));
        $time = date('G.i', $u);
        if (date('m-d-H', $u)=='12-24-17') {
            $time = '16.30';
        }
        if (date('m-d-H', $yesterday->format('U'))==date('m-d-17', easter_date(date('Y',$u)))) {
            $time = '20.00';
        }
        return $time;
    }

    public static function ismonday($date)
    {
        $o = new \DateTime($date);
        if ($o->format('N')==1) {
            return true;
        } else {
            return false;
        }
    }
}
