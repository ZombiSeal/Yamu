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


    public function __construct(
        public $quiz,
        public int $count,
        public $questions,
        public $question,
        public $answers) {}

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
