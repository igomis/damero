<?php

class ActivitatPHP
{
    /*
    public function _before(AcceptanceTester $I)
    {
    }

    public function try270WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/270.php');
        $I->seeInSource('<th>Prova</th> <th>Marca</th> <th>Atleta</th> <th>Natalici</th> <th>Club</th> <th>Data</th> <th>Lloc</th>');
        $I->seeInSource('<tr><td>1.500</td> <td>3:28.76</td> <td>Mohamed Katir El Haouzi</td> <td>1998</td> <td>Playas de Castellón</td> <td>09.07.2021</td> <td>Mónaco</td> </tr>');
    }


    public function try271WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/271.php');
        $I->see('Prova');
        $I->see('Marca');
        $I->seeInSource('<input id="natalici" name="natalici" placeholder="Any de naixement" type="text" class="form-control">');
        $I->dontSee('La prova 500 no existeix en la llista de records oficials de la FEA');
        $I->amOnPage('/271.php');
        $I->fillField('prova', 500);
        $I->click('submit');
        $I->see('La prova 500 no existeix en la llista de records oficials de la FEA');
        $I->amOnPage('/271.php');
        $I->fillField('prova', 200);
        $I->fillField('marca', '19:20');
        $I->fillField('atleta', 'Ignasi Gomis Mullor');
        $I->fillField('natalici', '1968');
        $I->fillField('club', 'POC A POC ALCOI');
        $I->fillField('data', '09.07.2022');
        $I->fillField('lloc', 'Alcoi');
        $I->click('submit');
        $I->dontSee('La prova 500 no existeix en la llista de records oficials de la FEA');
        $I->seeInSource('<th>Prova</th> <th>Marca</th> <th>Atleta</th> <th>Natalici</th> <th>Club</th> <th>Data</th> <th>Lloc</th>');
        $I->seeInSource('<tr><td>200</td> <td>19:20</td> <td>Ignasi Gomis Mullor</td> <td>1968</td> <td>POC A POC ALCOI</td> <td>09.07.2022</td> <td>Alcoi</td> </tr>');
        $I->seeInSource('<tr><td>1.500</td> <td>3:28.76</td> <td>Mohamed Katir El Haouzi</td> <td>1998</td> <td>Playas de Castellón</td> <td>09.07.2021</td> <td>Mónaco</td> </tr>');
    }

    public function try272WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/272.php');
        $I->see('Record més antic: Altura');
        $I->see('Club amb més títols: Playas de Castellón');
        $I->see('Persona amb més records: Bruno Hortelano Roig');
        $I->see('Ciutat més propicia: Mónaco');
        $I->seeInSource('<th>Prova</th> <th>Marca</th> <th>Atleta</th> <th>Natalici</th> <th>Club</th> <th>Data</th> <th>Lloc</th>');
        $I->seeInSource('<tr><td>1.500</td> <td>3:28.76</td> <td>Mohamed Katir El Haouzi</td> <td>1998</td> <td>Playas de Castellón</td> <td>09.07.2021</td> <td>Mónaco</td> </tr>');
    }

    */
}
