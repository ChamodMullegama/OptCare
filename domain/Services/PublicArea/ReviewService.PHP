<?php

namespace domain\Services\PublicArea;

use App\Models\DoctorReview;
use App\Models\Review;
use Illuminate\Support\Str;

class ReviewService
{
    protected Review $review;
    protected DoctorReview $doctorReview;

    public function __construct()
    {
        $this->review = new Review();
        $this->doctorReview = new DoctorReview();
    }

    public function all()
    {
        return $this->review->all();
    }


    public function DoctorReviewAll()
    {
        return $this->doctorReview->all();
    }

    public function store(array $data)
    {
        $data['id'] = 'REV_' . Str::random(6);
        return $this->review->create($data);
    }

    public function update(array $data, $id)
    {
        $review = $this->review->findOrFail($id);
        $review->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'message' => $data['message'],
        ]);
        return $review;
    }

    public function delete($id)
    {
        $review = $this->review->findOrFail($id);
        $review->delete();
        return true;
    }

    public function find($id)
    {
        return $this->review->findOrFail($id);
    }

   public function DoctorReviewAdd(array $data)
{
    $data['id'] = 'REV_' . Str::random(6);
    return $this->doctorReview->create($data);
}

}
