<?php

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;

function welcome()
{
    line('Welcome to the Brain Game!');
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
    resultGame($name, $answer, $correctQuestion, $correctAnswer);
}

function evenEven()
{
    $name = welcome();
    line('Answer "yes" if the number is even, otherwise answer "no".');
    $correctAnswer = 0;
    while ($correctAnswer < 3) {
        $questionInt = random_int(0, 1000);
        $correctQuestion = $questionInt % 2 ? 'no' : 'yes';
        line("Question: %s!", $questionInt);
        $answer = prompt('Your answer: ');
        if ($correctQuestion === $answer) {
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
    line('Answer "yes" if the number is even, otherwise answer "no".');
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
    resultGame($name, $answer, $correctQuestion, $correctAnswer);
}

function resultGame($name, $answer, $correctQuestion, $correctAnswer)
{
    if ($correctAnswer === 3) {
        line("Congratulations, %s!", $name);
    } else {
        line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $correctQuestion);
        line("Let's try again, %s!", $name);
    }
}

function gcd($a, $b)
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
        $randomOperand = " + ";
    } elseif ($randomint === 2) {
        $randomOperand = " - ";
    } else {
        $randomOperand = " * ";
    }
    return $randomOperand;
}
