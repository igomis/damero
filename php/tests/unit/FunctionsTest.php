<?php

class FunctionsTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        include_once('./src/functions.php');
    }

    protected function _after()
    {
    }

    // tests
    public function test240EsParell()
    {
        $this->assertTrue(esParell(2));
        $this->assertFalse(esParell(3));
    }

    public function test240arrayAleatori()
    {
        $array = arrayAleatori(10,1,10);
        $this->assertEquals(10,count($array));
        $this->assertLessThan(100,array_sum($array));
        $this->assertLessThanOrEqual(10,max($array));
        $this->assertGreaterThanOrEqual(1,min($array));
    }

    public function test240countParells()
    {
        $array = ['1','2','3','4','5','6','7','8','9','10'];
        $this->assertEquals(5,countParells($array));
    }

    public function test241Major(){
        $this->assertEquals(10,major(1,2,3,4,5,6,7,8,9,10));
    }
    public function test241Concatenar(){
        $this->assertEquals('Hola mundo',concatenar('Hola','mundo'));
    }

    public function test242Digits(){
        $this->assertEquals(3,digits(123));
        $this->assertEquals(1,digits(1));
        $this->assertEquals(5,digits(12324));
        $this->assertEquals(5,digits(-12324));

    }

    public function test242DigitsN(){
        $this->assertEquals(3,digitsN(123,3));
        $this->assertEquals(false,digitsN(112,4));
        $this->assertEquals(2,digitsN(12324,2));

    }

    public function test242LlevaDarrere(){
        $this->assertEquals(1,llevaDarrere(123,2));
        $this->assertEquals(false,llevaDarrere(112,4));
        $this->assertEquals(123,llevaDarrere(12324,2));

    }

    public function test242LlevaDavant(){
        $this->assertEquals(3,llevaDavant(123,2));
        $this->assertEquals(false,llevaDavant(112,4));
        $this->assertEquals(324,llevaDavant(12324,2));

    }

    public function test243peseta2Euros(){
        $this->assertEquals(1,peseta2euros(166));
        $this->assertEquals(100,peseta2euros(16600));
    }

    public function test243euro2Pesetes(){
        $this->assertEquals(166,euro2pesetes(1));
        $this->assertEquals(16600,euro2pesetes(100));
    }

    /*
    public function test250frasesImparelles(){
        $this->assertEquals('hola',frasesImparelles('haollaa'));
    }

    public function test251vocals(){
        $this->assertEquals(3,vocals('HolÀ amigá')['a']);
    }

    public function test252qLletres(){
        $this->assertEquals(13,qLletres('Hello my friend'));
    }
    public function test252countWords(){
        $this->assertEquals(3,countWords('Hello my friend'));
    }

    public function test253cani(){
        $this->assertEquals('HoLa cOcOdRiLo',cani('Hola cocodrilo'));
    }

    public function test254Palindromo(){
        $this->assertEquals(1,palindromo('arroz a la zorra'));
        $this->assertEquals(1,palindromo('Arroz a la zorra'));
        $this->assertEquals(0,palindromo('arroz a la cubana'));
    }

    public function test255codifica(){
        $this->assertEquals('Ipmb',codifica('Hola',1));
        $this->assertEquals(codifica('Ipmb',1),codifica('Hola',2));
        $this->assertEquals('Bsspa',codifica('Arroz',1));
        $this->assertEquals(codifica('Bsspa',3),codifica('Arroz',4));
        $this->assertEquals('BsspA',codifica('ArroZ',1));
        $this->assertEquals(codifica('BsspA',5),codifica('ArroZ',6));
    }

    public function test256parells(){
        $this->assertContains(2,parells([1,2,3,4,5]));
        $this->assertContains(4,parells([1,2,3,4,5]));
        $this->assertNotContains(3,parells([1,2,3,4,5]));
        $this->assertNotContains(6,parells([1,2,3,4,5]));
    }
    */

}