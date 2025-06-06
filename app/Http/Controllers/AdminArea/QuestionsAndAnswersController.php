<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Models\QuestionsAndAnswers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuestionsAndAnswersController extends Controller
{
     public function All()
    {
        try {
            $qas = QuestionsAndAnswers::all();
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
            $data['qaId'] = 'QA' . Str::random(6);
            QuestionsAndAnswers::create($data);
            return back()->with('success', 'Q&A added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Update(Request $request)
    {
        $qa = QuestionsAndAnswers::find($request->id);

        $request->validate([
            'question' => 'required|string|max:255|unique:questions_and_answers,question,' . $qa->id,
            'answer' => 'required|string',
        ], [
            'question.unique' => 'The question must be unique. Please choose another question.',
        ]);

        try {
            $data = $request->all();
            $qa->update([
                'question' => $data['question'],
                'answer' => $data['answer'],
            ]);
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

            $qa = QuestionsAndAnswers::findOrFail($request->id);
            $qa->delete();
            return back()->with('success', 'Q&A deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
