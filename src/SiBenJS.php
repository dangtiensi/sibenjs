<?php
/*
 * Written by siben.vn
 */
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
        // (()=>{const e=a=>eval(a),o=a=>atob(a),c=a=>String.fromCharCode(a),x=a=>{var s="";for(var i in a[1]){s+=c(a[0][a[2][a[1][i]]]);}e(o(s));};x(' . $this->handle($js) . ');
        return is_string($js) ? 'var _0x6ba5=["\x66\x72\x6F\x6D\x43\x68\x61\x72\x43\x6F\x64\x65",""];(()=>{const _0x8df7x1=(_0x8df7x5)=>{return eval(_0x8df7x5)},_0x8df7x2=(_0x8df7x5)=>{return atob(_0x8df7x5)},_0x8df7x3=(_0x8df7x5)=>{return String[_0x6ba5[0]](_0x8df7x5)},_0x8df7x4=(_0x8df7x5)=>{var _0x8df7x6=_0x6ba5[1];for(var _0x8df7x7 in _0x8df7x5[1]){_0x8df7x6+= _0x8df7x3(_0x8df7x5[0][_0x8df7x5[2][_0x8df7x5[1][_0x8df7x7]]])};_0x8df7x1(_0x8df7x2(_0x8df7x6))};_0x8df7x4(' . $this->handle($js) . ');})();' : '';
    }
};