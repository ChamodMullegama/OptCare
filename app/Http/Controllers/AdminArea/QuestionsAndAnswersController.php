<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Models\QuestionsAndAnswers;
use domain\Facades\QuestionsAndAnswersFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuestionsAndAnswersController extends Controller
{
    public function All()
    {
        try {
            $qas = QuestionsAndAnswersFacade::all();
            return view('AdminArea.Pages.QuestionsAndAnswers.index', compact('qas'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Add(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255|unique:questions_and_answers,question',
            'answer' => 'required|string',
        ], [
            'question.unique' => 'The question must be unique. Please choose another question.',
        ]);

        try {
            $data = $request->all();
            QuestionsAndAnswersFacade::store($data);
            return back()->with('success', 'Q&A added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Update(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255|unique:questions_and_answers,question,' . $request->id,
            'answer' => 'required|string',
        ], [
            'question.unique' => 'The question must be unique. Please choose another question.',
        ]);

        try {
            $data = $request->all();
            QuestionsAndAnswersFacade::update($data, $request->id);
            return redirect()->back()->with('success', 'Q&A updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:questions_and_answers,id',
            ]);

            QuestionsAndAnswersFacade::delete($request->id);
            return back()->with('success', 'Q&A deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
