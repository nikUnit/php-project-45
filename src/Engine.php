<?php

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;

function welcome()
{
    line('Welcome to the Brain Games!');
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);
    return $name;
}

function evenCalc()
{
    $name = welcome();
    line("What is the result of the expression?");
    $correctAnswer = 0;
    while ($correctAnswer < 3) {
        $questionIntFirst = random_int(0, 5);
        $questionIntSecond = random_int(0, 5);
        $operand = randomOperand();
        $correctQuestion = $questionIntFirst . $operand . $questionIntSecond;
        eval("\$correctQuestion =$correctQuestion;");
        line("Question: %s %s %s", $questionIntFirst, $operand, $questionIntSecond);
        $answer = prompt('Your answer: ');
        if ($correctQuestion == $answer) {
            $correctAnswer++;
            line("Correct!");
        } else {
            break;
        }
    }
    resultGame($name, $answer, (string) $correctQuestion, $correctAnswer);
}

function evenEven()
{
    $name = welcome();
    line('Answer "yes" if the number is even, otherwise answer "no".');
    $correctAnswer = 0;
    while ($correctAnswer < 3) {
        $questionInt = random_int(0, 1000);
        $correctQuestion = $questionInt % 2;
        if ($correctQuestion === 0) {
            $correctQuestion = 'yes';
        } else {
            $correctQuestion = 'no';
        }
        line("Question: %s!", $questionInt);
        $answer = prompt('Your answer: ');
        if ($correctQuestion == $answer) {
            $correctAnswer++;
            line("Correct!");
        } else {
            break;
        }
    }
    resultGame($name, $answer, $correctQuestion, $correctAnswer);
}

function evenGcd()
{
    $name = welcome();
    line('Find the greatest common divisor of given numbers.');
    $correctAnswer = 0;
    while ($correctAnswer < 3) {
        $questionIntFirst = random_int(0, 100);
        $questionIntSecond = random_int(0, 100);
        $correctQuestion = gcd($questionIntFirst, $questionIntSecond);
        line("Question: %s %s!", $questionIntFirst, $questionIntSecond);
        $answer = prompt('Your answer: ');
        if ($correctQuestion == $answer) {
            $correctAnswer++;
            line("Correct!");
        } else {
            break;
        }
    }
    resultGame($name, (string) $answer, (string) $correctQuestion, $correctAnswer);
}

function evenProgression()
{
    $name = welcome();
    line('What number is missing in the progression?');
    $correctAnswer = 0;
    while ($correctAnswer < 3) {
        $progressionArray = progressionArray();
        $randomInt = array_rand($progressionArray);
        $correctQuestion = $progressionArray[$randomInt];
        $progressionArray[$randomInt] = '..';
        $questionInt = implode(' ', $progressionArray);
        line("Question: %s!", $questionInt);
        $answer = prompt('Your answer: ');
        if ($correctQuestion == $answer) {
            $correctAnswer++;
            line("Correct!");
        } else {
            break;
        }
    }
    resultGame($name, (string) $answer, (string) $correctQuestion, $correctAnswer);
}

function evenPrime()
{
    $name = welcome();
    line('Answer "yes" if given number is prime. Otherwise answer "no".');
    $correctAnswer = 0;
    while ($correctAnswer < 3) {
        $questionInt = random_int(2, 1000);
        $correctQuestion = checkPrimeInt($questionInt);
        line("Question: %s!", $questionInt);
        $answer = prompt('Your answer: ');
        if ($correctQuestion == $answer) {
            $correctAnswer++;
            line("Correct!");
        } else {
            break;
        }
    }
    resultGame($name, (string) $answer, (string) $correctQuestion, $correctAnswer);
}

function resultGame(string $name, string $answer, string $correctQuestion, int $correctAnswer)
{
    if ($correctAnswer == 3) {
        line("Congratulations, %s!", $name);
    } else {
        line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $correctQuestion);
        line("Let's try again, %s!", $name);
    }
}

function gcd(int $a, int $b)
{
    while ($a != $b) {
        if ($a > $b) {
            $a -= $b;
        } else {
            $b -= $a;
        }
    }
    return $a;
}

function randomOperand()
{
    $randomint = random_int(1, 3);
    if ($randomint === 1) {
        $randomOperand = "+";
    } elseif ($randomint === 2) {
        $randomOperand = "-";
    } else {
        $randomOperand = "*";
    }
    return $randomOperand;
}

function progressionArray()
{
    $questionInt = random_int(0, 100);
    $progressionInt = random_int(2, 10);
    $progressionLength = random_int(6, 10);
    $progressionArray = [];
    for ($i = 0; $i < $progressionLength; $i++) {
        $progressionArray[] = $questionInt;
        $questionInt += $progressionInt;
    }
    return $progressionArray;
}

function checkPrimeInt(int $questionInt)
{
    for ($i = 2; $i < $questionInt; $i++) {
        $result = $questionInt % $i;
        if ($result === 0) {
            return 'no';
        }
    }
    return 'yes';
}
