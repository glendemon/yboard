<?

/* валидация разных текстов */

class textValidator extends CValidator {

    private $patterns = array(
        'iden' => '-_\w\W\.0-9',
        'string' => '- _\w\W\.0-9 ,!\?',
        'text' => '^<>',
        'message' => '- _\w\W\.0-9 ,!\?',
            //'html' => '-_\w\W\.0-9 ,!\?',
    );
    public $format = "iden";

    protected function validateAttribute($object, $attribute) {
        
        if( $this->format === "stopwords" ){
            if( !$this->validateStopWords($object->$attribute) ){
                $object->addError($attribute, t('Текст содержит недопустимые слова '));
            }
            if( !$this->validate_str($object->$attribute, "text") ) {
                $object->addError($attribute, t('Текст содержит недопустимые символы '));
            }
        }
        
        if (!$this->validate_str($object->$attribute, $this->format)) {
            $attrLabels = $object->attributeLabels();
            $object->addError($attribute, t('Неподходящий формат текстовых данных. '));
        }
    }

    public function validate_str($str, $format = 'string') {

        if ($str != '' and $str != null) {
            if (isset($this->patterns[$format])) {
                $str = trim($str);
                if (!preg_match("~^[" . $this->patterns[$format] . "]+$~", $str)) {
                    return false;
                }
            }

            if ($format === "html") {
                if (preg_match("#<script|javascript#is", $str)) {
                    return false;
                }
            }
        }
        return true;
    }
    
    public function validateStopWords( $str ){
        $ret = true;
        foreach( Yii::app()->params->stop_words as $v ){
            if(mb_strpos($str, $v) !== false )
                    $ret = false;
        }
        return $ret;
    }

}
