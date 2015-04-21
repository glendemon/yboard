<?

class ConfigForm extends CFormModel {

    private $_config = array();
    private $_atribute = array();
    public $file_path = false;

    /**
     * Инициализация модели
     * @param array $config Массив из конфига
     * @param string $scenario Сценарий валидации
     */
    public function __construct($config, $scenario = '') {
        parent::__construct($scenario);
        $this->setConfig($config);
    }

    public function setConfig($config) {


        $this->file_path = $config;
        $this->_config = require $config;

        $conf_str = file_get_contents($config);

        foreach ($this->_config as $n => $cf) {
            if (preg_match("#" . $n . "[^\r\n]*//([^\n\r]+)[\n\r]#", $conf_str, $m)) {
                $this->_atribute[$n] = trim($m[1]);
            }
        }
    }

    public function updateConfig($conf) {
        foreach ($conf as $n => $v) {
            if(is_array($v)) {
                foreach ($v as $n1 => $v1) {
                    if (trim($v1) === "") {
                        unset($conf[$n][$n1]);
                    }
                }
            } 

            if (sizeof($this->_config[$n]) >= sizeof($conf[$n]))
                $this->_config[$n] = $conf[$n];
        }
    }
    
    public function updateParam($param,$value){
        $this->_config[$param]=$value;
    }

    public function saveToFile() {
        //$InitConf = $model->getConfig();
        $conf_str = var_export($this->_config, true);
        //$atr = $model->getAtribute();
        foreach ($this->_atribute as $n => $v) {
            $conf_str = preg_replace("#([^\n\r]*" . $n . "[^\n\r]*)[\n\r]#is", "\\1//" . $v . "\n", $conf_str);
        }

        file_put_contents($this->file_path, "<? \n return " . $conf_str . " \n ?>");
    }

    public function getConfig() {
        return $this->_config;
    }

    public function getAtribute() {
        return $this->_atribute;
    }

    public function __get($name) {
        if (isset($this->_config[$name]))
            return $this->_config[$name];
        else
            return parent::__get($name);
    }

    public function __set($name, $value) {
        if (isset($this->_config[$name]))
            $this->_config[$name] = $value;
        else
            parent::__set($name, $value);
    }

    public function save($path) {
        $config = $this->generateConfigFile();
        if (!is_writable($path))
            throw new CException("Cannot write to config file!");
        file_put_contents($path, $config, FILE_TEXT);
        return true;
    }

    public function generateConfigFile() {
        $this->generateConfigFileRecursive($this->_config, $output);
        $output = preg_replace('#,$\n#s', '', $output);
        return "<?php\nreturn " . $output . ";\n";
    }

    public function generateConfigFileRecursive($attributes, &$output = "", $depth = 1) {
        $output .= "array(\n";
        foreach ($attributes as $attribute => $value) {
            if (!is_array($value))
                $output .= str_repeat("\t", $depth) . "'" . $this->escape($attribute) . "' => '" . $this->escape($value) . "',\n";
            else {
                $output .= str_repeat("\t", $depth) . "'" . $this->escape($attribute) . "' => ";
                $this->generateConfigFileRecursive($value, $output, $depth + 1);
            }
        }
        $output .= str_repeat("\t", $depth - 1) . "),\n";
    }

    private function escape($value) {
        return str_replace("'", "\'", $value);
    }

    /**
     * Возвращает все атрибуты с их значениями
     *
     * @return array
     */
    public function getAttributes($names = NULL) {
        $this->attributesRecursive($this->_config, $output);
        return $output;
    }

    /**
     * Возвращает имена всех атрибутов
     *
     * @return array
     */
    public function attributeNames() {
        $this->attributesRecursive($this->_config, $output);
        return array_keys($output);
    }

    /**
     * Рекурсивно собирает атрибуты из конфига
     *
     * @param array $config
     * @param array $output
     * @param string $name
     */
    public function attributesRecursive($config, &$output = array(), $name = '') {
        foreach ($config as $key => $attribute) {
            if ($name == '')
                $paramName = $key;
            else
                $paramName = $name . "[{$key}]";
            if (is_array($attribute))
                $this->attributesRecursive($attribute, $output, $paramName);
            else
                $output[$paramName] = $attribute;
        }
    }

    public function attributeLabels() {
        return $this->_atribute;
    }

    public function rules() {
        $rules = array();
        $attributes = array_keys($this->_config);
        $rules[] = array(implode(', ', $attributes), 'safe');
        return $rules;
    }

}

?>