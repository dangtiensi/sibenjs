<?php
class SiBenJs {
    private $js = '';

    private $numbers = [];

    private $chars = [];

    public function __construct() {
        $this->chars = array_merge($this->chars, range(48, 57));
        $this->chars = array_merge($this->chars, range(65, 90));
        $this->chars = array_merge($this->chars, range(97, 122));
        $this->chars = array_merge($this->chars, [61, 43, 47]);
        shuffle($this->chars);
    }

    private function handle($js) {
        $js = base64_encode($js);
        $array = [];
        $array[0] = (object)$this->chars;
        $this->createNumbers(strlen($js));
        for ($i = 0; $i < strlen($js); $i++) {
            $p = $this->getNumber();
            $array[1][$i + 1] = $p;
            $array[2][$p] = $this->getIndex($js[$i]);
        }
        return json_encode($array);
    }

    private function getIndex($char) {
        return array_flip($this->chars)[ord($char)] ?? null;
    }

    private function createNumbers($length) {
        $this->numbers = range(0, $length);
        shuffle($this->numbers);
    }

    private function getNumber() {
        $index = count($this->numbers) - 1;
        $get = $this->numbers[$index];
        unset($this->numbers[$index]);
        return $get;
    }

    public function render($js) {
        return is_string($js) ? '<script type="text/javascript">(()=>{const e=a=>eval(a),o=a=>atob(a),c=a=>String.fromCharCode(a),x=a=>{var s="";for(var i in a[1]){s+=c(a[0][a[2][a[1][i]]]);}e(o(s));};x(' . $this->handle($js) . ');})();</script>' : '';
    }
};