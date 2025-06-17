@extends('AdminArea.Layout.main')
@section('title', 'OCT Analysis')
@section('Admincontainer')

<div class="app-body">
    <div class="row gx-3">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">OCT Retinal Analysis</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('oct.analyze') }}" method="POST" enctype="multipart/form-data" id="octForm">
                        @csrf

                        <div class="mb-3">
                            <label for="image" class="form-label">Upload OCT Image</label>
                            <input class="form-control" type="file" id="image" name="image" accept="image/jpeg,image/png" required>
                            <div class="form-text">Upload a clear OCT scan in JPEG or PNG format</div>
                        </div>

                        <button type="submit" class="btn btn-primary" id="analyzeBtn">
                            <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                            Analyze Image
                        </button>
                    </form>

                    @if(session('prediction'))
                    <div class="mt-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Uploaded OCT Scan</h5>
                                    </div>
                                    <div class="card-body text-center">
                                        <img src="{{ asset('storage/' . session('image')) }}"
                                             class="img-fluid rounded"
                                             alt="OCT Scan"
                                             style="max-height: 400px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Analysis Results</h5>
                                        <span class="badge bg-{{ session('prediction') == 'NORMAL' ? 'success' : 'danger' }}">
                                            {{ session('prediction') }}
                                        </span>
                                    </div>
                                    <div class="card-body">
                                        @if(session('success') || session('warning'))
                                            <div class="alert alert-{{ session('success') ? 'success' : 'warning' }}">
                                                {{ session('success') ?? session('warning') }}
                                            </div>
                                        @endif

                                        <div class="recommendation-container bg-light p-3 rounded">
                                            {!! session('recommendation') !!}
                                        </div>

                                        <div class="mt-3">
                                            <button class="btn btn-outline-primary btn-sm"
                                                    onclick="window.print()">
                                                <i class="fas fa-print"></i> Print Report
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger mt-3">
                        {{ session('error') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.getElementById('octForm').addEventListener('submit', function() {
        const btn = document.getElementById('analyzeBtn');
        btn.disabled = true;
        btn.querySelector('.spinner-border').classList.remove('d-none');
    });
</script>
@endsection

@endsection
