<?php

class BuclesCest
{

    /*
    public function _before(AcceptanceTester $I)
    {
    }


    public function try220WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/220.php');
        $I->seeInSource('<ul> <li>2</li>');
        $I->see('14');
        $I->see('26');
        $I->see('38');
        $I->seeInSource('<li>50</li></ul>');
        $I->dontSee('52');
    }

    public function try221WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/221.php');
        $I->see('1+2+3+4+5+6+7+8+9+10=55');
    }

    public function try222WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/222.php');
        $I->see("Posa la base i l'exponent a les variables base i exponent pel QueryString");
        $I->amOnPage('/222.php?base=5&exponent=3');
        $I->see('5^3 = 125');
        $I->amOnPage('/222.php?base=2&exponent=0');
        $I->see('2^0 = 1');
        $I->amOnPage('/222.php?base=10&exponent=1');
        $I->see('10^1 = 10');
    }

    public function try223WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/223.php');
        $I->see("Posa el nombre pel QueryString");
        $I->amOnPage('/223.php?nombre=7');
        $I->seeInSource('<tr> <td>7</td> <td>*</td> <td>3</td> <td>=</td> <td>21</td> </tr>');
        $I->amOnPage('/223.php?nombre=5');
        $I->seeInSource('<tr> <td>5</td> <td>*</td> <td>3</td> <td>=</td> <td>15</td> </tr>');
        $I->see('35');
        $I->see('45');
        $I->amOnPage('/223.php?nombre=0');
        $I->seeInSource('<tr> <td>0</td> <td>*</td> <td>7</td> <td>=</td> <td>0</td> </tr>');
    }

    public function try224WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/224.html');
        $I->fillField('quantitat', 5);
        $I->click('submit');
        $I->seeInCurrentUrl('/224.php');
        $I->fillField('quantitat0', 5);
        $I->fillField('quantitat1', 5);
        $I->fillField('quantitat2', 5);
        $I->fillField('quantitat3', 5);
        $I->fillField('quantitat4', 5);
        $I->click('submit');
        $I->seeInCurrentUrl('/224.php');
        $I->see('25');
    }

    public function try225WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/225.html');
        $I->fillField('files', 2);
        $I->fillField('columnes', 2);
        $I->click('submit');
        $I->seeInCurrentUrl('/225.php');
        $I->seeInSource('<tr> <td>A1</td> <td>A2</td> </tr> <tr> <td>B1</td> <td>B2</td> </tr>');
    }

    public function try226WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/226.html');
        $I->fillField('files', 3);
        $I->fillField('columnes', 3);
        $I->click('submit');
        $I->seeInCurrentUrl('/226.php');
        $I->seeInSource('<tr> <td>A1</td> <td>A2</td> <td>A3</td> </tr> <tr> <td>B1</td> <td></td> <td></td> </tr> <tr> <td>C1</td> <td></td> <td></td> </tr>');
    }

    public function try227WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/227.html');
        $I->fillField('files', 3);
        $I->fillField('columnes', 3);
        $I->click('submit');
        $I->seeInCurrentUrl('/227.php');
        $I->seeInSource('<tr> <td>A1</td> <td></td> <td>A3</td> </tr> <tr> <td></td> <td>B2</td> <td></td> </tr> <tr> <td>C1</td> <td></td> <td>C3</td> </tr>');
    }
    */
}
