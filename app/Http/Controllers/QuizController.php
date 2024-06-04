<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Coupon;
use App\Models\Quiz;
use App\Models\QuizCoupon;
use App\Models\User;
use App\Models\UserCoupon;
use App\Models\UserQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function index()
    {
//        $user = User::find(Auth::id());

        $quizzesCoupon = Quiz::with('coupon')->pluck('coupon_id');
        $userCoupons =  UserCoupon::where('user_id', Auth::id())->pluck('coupon_id');

        $showQuizzes = $quizzesCoupon->diff($userCoupons);
        $quizzes = Quiz::whereIn('coupon_id', $showQuizzes)->get();

        return view('quizzes.all', ['quizzes' => $quizzes]);
    }

    public function detail(int $id, Request $request)
    {
        $couponId = Quiz::find($id)->coupon_id;
        $isDone = UserCoupon::where('user_id', Auth::id())->where('coupon_id', $couponId)->first();

        if($isDone) {
            abort(404);
        }

        $request->session()->put('answers');
        $params = $this->getQuestion($id, 0);
        return view('quizzes.quiz', $params);
    }

    public function updateQuestion(Request $request)
    {
        $request->session()->push('answers', $request->answer);
        if ($request->maxCount > $request->count) {
            $params = $this->getQuestion($request->quizId, $request->count);
            return response()->json(["status" => "ok", "template" => view('quizzes.question', $params)->render()]);
        } else {
            return response()->json(["status" => "end", "url" => "/quizzes/" . $request->quizId . "/end"]);
        }
    }

    public function end()
    {
        $info = $this->checkAnswers();
        return view('quizzes.end', $info);
    }

    private function checkAnswers(): array
    {
        if (session()->has('answers')) {
            foreach (session('answers') as $answer) {
                $answerInfo = Answer::find($answer);
                if ($answerInfo->is_correct) {
                    $result["correct"][] = $answerInfo->id;
                } else {
                    $result["wrong"][] = $answerInfo->id;
                }
            }

            if (!empty($result) && isset($result["wrong"]) && count($result["wrong"]) > 1) {
                $info = ["quizId" => \request()->route('id'), "text" => "К сожалению, вы не прошли тест((( Попробуйте снова", "status" => "fail"];
            } else {
                if($this->addUserCoupon()){
                    $info = ["text" => "У вас получилось))) Доступные купоны находятся в личном кабинете", "status" => "success"];
                }
            }
        }
        return $info ?? [];
    }

    private function addUserCoupon() : bool
    {
        $couponId= Quiz::find(\request()->route('id'))->coupon_id;
        $userCouponId = UserCoupon::create([
            'user_id' => Auth::id(),
            'coupon_id' => $couponId,
        ]);

        return ($userCouponId) ? true : false;
    }

    private function getQuestion(int $quizId, int $questionNumber): array
    {
        $quiz = Quiz::find($quizId);
        $answers = $quiz->questionAnswers($quiz->questions[$questionNumber]->id)->inRandomOrder()->get();
        $questions = $quiz->questions;

        return [
            'quiz' => $quiz,
            'questions' => count($questions),
            'question' => $quiz->questions[$questionNumber],
            'answers' => $answers,
            'count' => $questionNumber + 1
        ];
    }
}
