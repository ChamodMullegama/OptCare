<?php

namespace domain\Services\AdminArea;

use App\Models\QuestionsAndAnswers;
use Illuminate\Support\Str;

class QuestionsAndAnswersService
{
    protected $qa;

    public function __construct()
    {
        $this->qa = new QuestionsAndAnswers();
    }

    public function all()
    {
        return $this->qa->all();
    }

    public function store(array $data)
    {
        $data['qaId'] = 'QA' . Str::random(6);
        return $this->qa->create($data);
    }

    public function update(array $data, $id)
    {
        $qa = $this->qa->findOrFail($id);
        $qa->update([
            'question' => $data['question'],
            'answer' => $data['answer'],
        ]);
        return $qa;
    }

    public function delete($id)
    {
        $qa = $this->qa->findOrFail($id);
        $qa->delete();
        return true;
    }
}
