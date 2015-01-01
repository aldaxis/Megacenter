<?php

class Common {
    
    /**
     * Retorna uma string formatada pela mascara
     * 
     * @param string $val
     * @param string $mask
     * @return string
     */
	public static function mask($val, $mask)
	{
		$maskared = '';
		$k = 0;
		for($i = 0; $i <= strlen($mask)-1; $i++)
		{
			if($mask[$i] == '#')
			{
				if(isset($val[$k]))
				$maskared .= $val[$k++];
			}
			else
			{
				if(isset($mask[$i]))
                $maskared .= $mask[$i];
			}
		}
		return $maskared;
	}
    
    /**
     * Retorna somente os numeros de uma string
     * 
     * @param string $str
     * @return string
     */
    public static function soNumeros($str){
        $str = preg_replace('/[^0-9]/', '', $str);
        return $str;
    }
	
}