<?php


namespace App\View\Components;

use Illuminate\View\Component;

class Question extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $quiz;
    public $count;
    public $questions;
    public $question;
    public $answers;

    public function __construct($quiz, $count, $questions, $question, $answers)
    {
        $this->quiz = $quiz;
        $this->count = $count;
        $this->questions = $questions;
        $this->question = $question;
        $this->answers = $answers;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('quizzes.question');
    }
}
